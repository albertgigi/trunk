<script src="http://code.highcharts.com/highcharts.js"></script>
<p align="left">
  <select id="chartType">
    <option value="0">-select chart type-</option>  
    <option value="line">line</option>
    <option value="column">column</option>
</select>
</p>
<pre>
        
</pre>
<span style="display:inline-block; width:50px;"></span>

<input class="test" name="g" type="radio" value="a">#Active learners</input>
<span style="display:inline-block; width:50px;"></span>

<input class="test" name="g" type="radio" value="b">#Active learner by grade</input>
<span style="display:inline-block; width:50px;"></span>

<input class="test" name="g" type="radio" value="c">#Active learners by age</input>
<pre>
</pre>

<span style="display:inline-block; width:200px;"></span>

<span style="display:inline-block; width:50px;"></span>

<SELECT id="list">
    <OPTION VALUE="0">-Select a grade-</OPTION>
    <OPTION VALUE="1">primary</OPTION>
    <OPTION VALUE="2">secondary</OPTION>
</SELECT>
<span style="display:inline-block; width:90px;"></span>

<SELECT id="list">
    <OPTION VALUE="0">-Select an age group-</OPTION>
    <OPTION VALUE="1">children</OPTION>
    <OPTION VALUE="2">adult</OPTION>
</SELECT>

<div id="container" style="height: 500px; width: 1000px"></div>


<script type="text/javascript"> //INICIO DEL SCRIPT PARA CARGAR LA GRAFICA
$(function () {
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'line',
            title: 'please select a category'
        },

        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']//here we have a common timeline  (dates)
        }
    });

    $(".test").change(function() {
        var value = this.getAttribute("value");
        while (chart.series.length > 0) {
            chart.series[0].remove(true);
        }
        if (value == 'a') {
            chart.yAxis[0].setTitle({ text: "#Active Learners" });
            chart.setTitle({text: "Active Learners"});
            chart.addSeries({
                name: '#Active Leaners',
                type: 'column',
                color: '#43cd80',  
                data:[100, 200, 300, 400, 100, 200, 100,200,300,100,400,100]//no. of active learners           
            });      
            
        } else if (value == 'b') {
            chart.addSeries({
                name: 'grade1',
                type: 'column',
                color: '#7FCDBB',  
                data:[100, 280, 300, 490, 670, 900,100,200,300,400,500,100]             
            });
            chart.addSeries({
                name: 'grade2',
               type: 'column',
               color: '#41B6C4',  
                data:[100, 200, 300, 400, 100, 200,900,800,300,500,200,100]             
            });                      
            chart.addSeries({
                name: 'grade3',
               type: 'column',
                color: '#1D91C0',  
                data:[234,578,234,895,234,54,214,234,474,214,123,235]             
            });
             chart.addSeries({
                name: 'grade4',
               type: 'column',
                color: '#253494',  
                data:[343,132,467,124,214,55,73,546,435,23,56,746]             
            });               
            chart.yAxis[0].setTitle({ text: "#Learners" });
            chart.setTitle({ text: "Learners per grade" });
        } else if (value == 'c') {
            chart.addSeries({
                name: 'age group 1',
                type: 'column',
                color: '#FCC5C0',  
                data:[450, 770, 540, 110, 340, 870,200,500,300,600,100]             
            });
            chart.addSeries({
                name: 'age group 2',
                type: 'column',
                color: '#F768A1',
                data:[563,234,675,567,234,834,341,415,300,200,100,200,400]
            });
            chart.addSeries({
                name: 'age group 3',
                type: 'column',
                color: '#AE017E',
                data:[100,200,300,400,500,100,200,300,400,500]
            });
            chart.addSeries({
                name: 'age group 4',
                type: 'column',
                color: '#49006A',
                data:[400,300,200,400,200,300,500,600,100,600,700]
            });
        } else {
                chart.addSeries({
                name: 'total number of learners',
                type: 'column',
                color: '#ffcc99',  
                data:[100,0,200,0,300,100,400,100,500,200,500,300]             
            }); 
        }
    });
});
</script><!--CIERRE DEL SCRIPT PARA LA GRÁFICA-->