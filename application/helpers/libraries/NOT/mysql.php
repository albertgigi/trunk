<?php
  /**
  * Ignited Datatables ActiveRecords library for MySql
  *
  * @subpackage libraries
  * @category   library
  * @version    0.1a
  * @author     Yusuf Ozdemir <yusuf@ozdemir.be>
  */
  class ActiveRecords     
  {
    /**
    * Variables
    *
    */
    var $ar_select      = array();
    var $ar_from        = array();
    var $ar_join        = array();
    var $ar_where       = array();
    var $ar_like        = array();
    var $ar_orderby     = array();
    var $ar_groupby     = array();
    var $ar_limit       = FALSE;
    var $ar_offset      = FALSE;
    var $ar_order       = FALSE;
    
    var $_escape_char   = '`';
    var $_count_string  = 'SELECT COUNT(*) AS ';

    var $username       = 'root';
    var $password       = '';
    var $database       = '';
    var $hostname       = 'localhost';
    var $port           = '';
    var $db ;
    var $_result;

    /**
    * Construct function
    *
    */
    public function connect($config)
    {
      foreach ($config as $key => $val)
        if(in_array($key, array('hostname', 'username', 'password', 'database', 'port')))
          $this->$key = $val;

      $this->db_connect();
      $this->db_select();
    }

    /**
    * DB connection
    *
    */
    protected function db_connect()
    {
      if ($this->port != '')
        $this->hostname .= ':'.$this->port;

      $this->db = @mysql_connect($this->hostname, $this->username, $this->password, TRUE);
    }

    /**
    * DB Select
    *
    */
    protected function db_select()
    {
      @mysql_select_db( $this->database, $this->db ) or 
        die( 'Could not select database ' . $this->database );        
    }

    /**
    * Generates the SELECT portion of the query
    *
    */
    public function select($columns, $backtick_protect = TRUE)
    {
      foreach ($columns as $column)
        $this->ar_select[] = ($backtick_protect == TRUE)? $this->_protect_identifiers(trim($column)) : trim($column);

      return $this;
    }

    /**
    * Generates the FROM portion of the query
    *
    */
    public function from($from)
    {
      foreach ((array)$from as $f)
        $this->ar_from[] = $this->_protect_identifiers(trim($f));

      return $this;    
    }

    /**
    * Generates a custom GROUP BY portion of the query
    *
    * @param string $val
    * @return mixed
    */
    public function group_by($val)
    {
      foreach ($val as $v)
        $this->ar_groupby[] = $this->_protect_identifiers(trim($v));

      return $this;
    }

    /**
    * Generates the JOIN portion of the query
    *
    */
    public function join($table, $cond, $type = '')
    {
      if ($type != '')
      {
        $type = strtoupper(trim($type));
        $type = (!in_array($type, array('LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER')))? '':$type.' ' ;
      }

      $join = $type.'JOIN '.$this->_protect_identifiers($table).' ON '.$this->_protect_identifiers($cond);
      $this->ar_join[] = $join;

      return $this;
    }

    /**
    * Generates the WHERE portion of the query
    *
    */
    public function where($key, $value = NULL, $escape = TRUE, $type = 'AND ')
    {
      if ( ! is_array($key))
        $key = array($key => $value);
		
      foreach ($key as $k => $v)
      {
        $prefix = (count($this->ar_where) == 0)? '' : $type;

        if($v != NULL) 
        {
          $k = ($this->_has_operator($k) == TRUE)? $k : $k . ' ='; 
          $v = ($escape == TRUE)? " '" . $v . "'" : $v;  
        }

        $this->ar_where[] = $prefix . (($escape == TRUE)? $this->_protect_identifiers($k.$v) : $k.$v);
      }
      return $this;
    }

    /**
    * Generates the LIKE portion of the query
    *
    */
    public function like($key, $match = '', $type = 'AND ', $side = 'both', $not = '')
    {
      if ( ! is_array($key))
      {
        $key = array($key => $match);
      }

      foreach ($key as $k => $v)
      {
        $k = $this->_protect_identifiers($k);

        $prefix = (count($this->ar_like) == 0) ? '' : $type;

        $v = $this->escape_db($v);
        
        if ($side == 'none')
        {
          $like_statement = $prefix." $k $not LIKE '{$v}'";
        }
        elseif ($side == 'before')
        {
          $like_statement = $prefix." $k $not LIKE '%{$v}'";
        }
        elseif ($side == 'after')
        {
          $like_statement = $prefix." $k $not LIKE '{$v}%'";
        }
        else
        {
          $like_statement = $prefix." $k $not LIKE '%{$v}%' ";
        }

        $this->ar_like[] = $like_statement;

      }
      return $this;
    }


    /**
    * Generates the LIMIT portion of the query
    *
    */
    public function limit($value, $offset = '')
    {
      $this->ar_limit = $value;

      if ($offset != '')
        $this->ar_offset = $offset;

      return $this;
    }

    /**
    * Generates the ORDER BY portion of the query
    *
    */
    public function order_by($orderby, $direction = '')
    {
      $direction = (in_array(strtoupper(trim($direction)), array('ASC', 'DESC'), TRUE))? ' '.$direction : ' ASC';
      $this->ar_orderby[] = $orderby.$direction;

      return $this;
    }

    /**
    * Runs the Query
    *
    */
    public function get()
    {
      $result = mysql_query($this->_compile_select(), $this->db) or die(mysql_error());
      $this->_reset_select();
      $this->_result = $result;

      return $this;
    }

    /**
    * Results as object
    *
    */
    public function result()
    {
      $aData = array();

      while ($aRow = mysql_fetch_object($this->_result))
        $aData[] = $aRow;

      return $aData;
    }

    /**
    * Results as array
    *
    */
    public function result_array()
    {
      $aData = array();

      while ($aRow = mysql_fetch_array($this->_result, MYSQL_ASSOC))
        $aData[] = $aRow;

      return $aData;
    }

    /**
    * Count Results
    *
    */
    public function count_all_results($table = '')
    {    
      if ($table != '')
        $this->from($table);

      $sql = $this->_compile_select($this->_count_string . 'numrows');
      $query = mysql_query($sql) or die(mysql_error());
      $this->_reset_select();
      $row = mysql_fetch_object($query);

      return (int) $row->numrows;
    }

    /**
    * Escape
    *
    */
    public function escape_db($text = "")
    {
      return mysql_real_escape_string($text);
    }

    /**
    * Compile sql string
    *
    */
    protected function _compile_select($q = NULL)
    {
      $sql  = ($q == NULL)? 'SELECT ' : $q ;
      $sql .= implode(',', $this->ar_select);

      if(count($this->ar_from) > 0) 
        $sql .= "\nFROM (".implode(',', $this->ar_from).")";

      if (count($this->ar_join) > 0)
        $sql .= "\n".implode("\n", $this->ar_join);

      if (count($this->ar_where) > 0 OR count($this->ar_like) > 0)
      {
        $sql .= "\nWHERE ";
      }
      $sql .= implode("\n", $this->ar_where);

      if (count($this->ar_groupby) > 0)
        $sql .= "\nGROUP BY " . implode(', ', $this->ar_groupby);

      if (count($this->ar_like) > 0)
      {
        if (count($this->ar_where) > 0)
          $sql .= "\nAND ";

        $sql .= implode("\n", $this->ar_like);
      }

      if (count($this->ar_orderby) > 0)// check
      {
        $sql .= "\nORDER BY " . implode(', ', $this->ar_orderby);
        if ($this->ar_order !== FALSE)
          $sql .= ($this->ar_order == 'desc')? ' DESC' : ' ASC';
      }

      if (is_numeric($this->ar_limit))
        $sql .= "\nLIMIT ".(($this->ar_offset == 0)? '' : $this->ar_offset.', ').$this->ar_limit;

      return $sql;
    }

    /**
    * Protect identifiers
    *
    */
    protected function _protect_identifiers($text)
    {
      $_pattern = '/\b(?<!"|\')(\w+)(?!\\1)\b/i';
      $item = preg_replace('/[\t ]+/', ' ', $text);
      $alias = '';

      if (strpos($item, ' ') !== FALSE)
      {
        $alias = strstr($item, " ");
        $item = substr($item, 0, - strlen($alias));
      }

      if (strpos($item, '(') !== FALSE)
        return $item.$alias;

      return preg_replace($_pattern, $this->_escape('$1'), $item).$alias;
    }

    /**
    * Test Operator
    *
    */
    protected function _has_operator($str)
    {
      return (!preg_match("/(\s|<|>|!|=|is null|is not null)/i", trim($str)))? FALSE : TRUE;
    }

    /**
    * Escape
    *
    */
    protected function _escape($text)
    {
      return $this->_escape_char . $text . $this->_escape_char ;
    }

    /**
    * Reset arrays
    *
    */
    protected function _reset_select()
    {
      $ar_reset_items = array(
        'ar_select'     => array(),
        'ar_from'       => array(),
        'ar_join'       => array(),
        'ar_where'      => array(),
        'ar_like'       => array(),
        'ar_orderby'    => array(),
        'ar_groupby'    => array(),
        'ar_limit'      => FALSE,
        'ar_offset'     => FALSE,
        'ar_order'      => FALSE    
       );

      foreach ($ar_reset_items as $item => $default_value)
        $this->$item = $default_value;
    }
  }
/* End of file ActiveRecords.php */