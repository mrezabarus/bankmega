<?php 
	$data['Regional Office - Bandung']['register'] = 114;
	$data['Regional Office - Bandung']['remains'] = 20;
	$data['Regional Office - Bandung']['onProgres'] = 50;
	$data['Regional Office - Bandung']['finish'] = 10;
	
	$data['Regional Office - Jakarta 1']['register'] = 0;
	$data['Regional Office - Jakarta 1']['remains'] = 10;
	$data['Regional Office - Jakarta 1']['onProgres'] = 20;
	$data['Regional Office - Jakarta 1']['finish'] = 20;
	
	$data['Regional Office - Makassar']['register'] = 114;
	$data['Regional Office - Makassar']['remains'] = 20;
	$data['Regional Office - Makassar']['onProgres'] = 50;
	$data['Regional Office - Makassar']['finish'] = 10;
	
	$data['Regional Office - Medan']['register'] = 114;
	$data['Regional Office - Medan']['remains'] = 20;
	$data['Regional Office - Medan']['onProgres'] = 50;
	$data['Regional Office - Medan']['finish'] = 10;
	
	$data['Regional Office - Semarang']['register'] = 114;
	$data['Regional Office - Semarang']['remains'] = 20;
	$data['Regional Office - Semarang']['onProgres'] = 50;
	$data['Regional Office - Semarang']['finish'] = 10;
	
	$data['Regional Office - Surabaya']['register'] = 114;
	$data['Regional Office - Surabaya']['remains'] = 20;
	$data['Regional Office - Surabaya']['onProgres'] = 50;
	$data['Regional Office - Surabaya']['finish'] = 10;
	
	echo '<pre>';
	foreach($data as $key => $value){		
		$key = str_replace("Regional Office - ", "", $key);
		$categories[] = $key;
		
		$register[] = $value['register'];
		$remains[] 	= $value['remains'];
		$onProgres[] = $value['onProgres'];
		$finish[] 	= $value['finish'];
	}
	
	$categories2 	= "'" . implode("','", $categories) . "'";
	$register2 		= implode(",", $register);
	$remains2 		= implode(",", $remains);
	$onProgres2 	= implode(",", $onProgres);
	$finish2 		= implode(",", $finish);
	
	// print_r($categories2);
	// print_r($register2);
	// print_r($remains2);
	// echo '<br>';
	// echo '<pre>';
	// print_r($data);
	// die;

?>

<!DOCTYPE html>
<html><head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Highcharts Example</title>

		<style type="text/css">
			${demo.css}
		</style>
	</head>

<body>
  <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
  
 
</body>
 
<script type="text/javascript" src="jquery.js"></script>

<script src="highcharts.js"></script>
<script src="exporting.js"></script>

  <script>
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Historic Test Online Frontliner by Region'
        },
        subtitle: {
            text: 'HCMG File'
        },
        xAxis: {
            // categories: ['Jakarta', 'Bandung', 'Semarang', 'Surabaya', 'Makassar'],
            categories: [<?php echo $categories2; ?>],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'person (participation)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' millions'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Register',
            data: [<?php echo $register2; ?>]
        },{
            name: 'Remains',
            data: [<?php echo $remains2; ?>]
        },  {
            name: 'Finish',
            data: [<?php echo $finish2; ?>]
        } ]
    });
});  
  </script>
  
  

</html>