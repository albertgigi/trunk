<?php
if(isset($_POST['submit']))
{
$phone=$_POST['phone'];

if(empty($phone))
{
echo "Please enter a value.";
}
else if(!is_numeric($phone))
{
echo "Value entered is not numeric.";
}
else if(strlen($phone) !=10)
{
echo "Please enter 10 digits number..";
}
else
{
echo "<table align='center'>
<tr>
<td>Mobile Number is:<input type='text' value='".$phone."' readonly/></td>
</tr>
</table>";
}
}
?>

<!DOCTYPE html>

<head>
<meta charset="utf-8">
<title> Numeric Validation in PHP </title>
</head>

<body>

<form action="" method="post">
<table align="center" >
<tr>
<td> <input type="phone" name="phone" placeholder="Mobile Number"> </td>
<td> <input type="submit" name="submit" value="Click Here"> </td>
</tr>
</table>
</form>

</body>

</html>