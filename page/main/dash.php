
<?php 
mysql_connect('10.3.5.222','hilman','hilman123');
mysql_select_db('85152_trafficability');
$datanta = db_query2list("Select distinct(inputdate) as tanggal from alarm_neid");
if(!empty($datanta)){
	foreach($datanta as $valny){
		$categories[] = $valny->tanggal;
	}
}
$data = db_query2list("Select inputdate as tanggal,count(*) as jumlah,bsc_rnc as nama from alarm_neid group by inputdate,bsc_rnc
					UNION
						Select inputdate as tanggal,count(*) as jumlah,band as nama from alarm_neid group by inputdate,band
						UNION

					Select inputdate as tanggal,count(*) as jumlah,'Total' as nama from alarm_neid group by inputdate
					");
if(!empty($data)){
	foreach($data as $val){
		foreach($datanta as $valny){
			//$categories[] = $valny->tanggal;
			if(strtoupper($val->nama)!='2G' && strtoupper($val->nama)!='3G' && strtoupper($val->nama)!='TOTAL'){
				$datagrap[$val->nama][$valny->tanggal] = $val->jumlah;
			}
			if(strtoupper($val->nama)=='2G' || strtoupper($val->nama)=='3G'){
				$datagrap_2g_3g[$val->nama][$valny->tanggal] = $val->jumlah;
			}
			if(strtoupper($val->nama)=='TOTAL'){
				$datagrap_total[$val->nama][$valny->tanggal] = $val->jumlah;
			}
		}
	}
	
}
//print_r($datagrap);
?>
<!-- 
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>--><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo url('themes/highchart/highcharts.js')?>"></script>
<script src="<?php echo url('themes/highchart/highcharts-3d.js')?>"></script>
<script src="<?php echo url('themes/highchart/exporting.js')?>"></script>
<script type="text/javascript">
	
$(function () {
	$('#container').highcharts({
    title: {
        text: 'Chart'
    },
	credits: {
      enabled: false
	},
    xAxis: {
        categories: <?php echo json_encode($categories); ?>
    },
    labels: {
        items: [{
            html: 'Total fruit consumption',
            style: {
                left: '50px',
                top: '18px',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
            }
        }]
    },
    series: [
		<?php 
		if(!empty($datagrap)){
			foreach($datagrap as $key => $value){
		?>
		{
			type: 'column',
			name: '<?php echo $key; ?>',
			data: [<?php 
					$n = count($value);
					$i = 0;
					foreach($value as $k => $v){
					$i++;
					$f = db_query("select count(*) as jumlah from alarm_neid Where bsc_rnc = '".$key."' and inputdate = '".$k."'");
					if(!empty($f)){
						echo $f->jumlah;
					}else{
						echo 0;
					}
					if($i<$n){echo ",";}
					} 
					?>]
		}, 
		<?php 
		}
		}
		if(!empty($datagrap_2g_3g)){
			$nnya = count($datagrap_2g_3g);
			$ni=0;
			foreach($datagrap_2g_3g as $key => $value){$ni++;
		?>	
		{
			type: 'spline',
			name: '<?php echo $key ?>',
			data: [<?php 
					$n = count($value);
					$i = 0;
					foreach($value as $k => $v){
					$i++;
					
					$f = db_query("select count(*) as jumlah from alarm_neid Where band = '".$key."' and inputdate = '".$k."'");
					if(!empty($f)){
						echo $f->jumlah;
					}else{
						echo 0;
					}
					if($i<$n){echo ",";}
					} 
					?>],
			marker: {
				lineWidth: 2,
				lineColor: Highcharts.getOptions().colors[3],
				fillColor: 'white'
			}
		},
		<?php 
			}
		}
		if(!empty($datagrap_total)){
			$nnya = count($datagrap_total);
			$ni=0;
			foreach($datagrap_total as $key => $value){$ni++;
		?>	
		{
			type: 'spline',
			name: '<?php echo $key ?>',
			data: [<?php 
					$n = count($value);
					$i = 0;
					foreach($value as $k => $v){
					$i++;
					
					$f = db_query("select count(*) as jumlah from alarm_neid Where inputdate = '".$k."'");
					if(!empty($f)){
						echo $f->jumlah;
					}else{
						echo 0;
					}
					if($i<$n){echo ",";}
					} 
					?>],
			marker: {
				lineWidth: 2,
				lineColor: Highcharts.getOptions().colors[3],
				fillColor: 'white'
			}
		}
		<?php 
			}
		}
		?>
		]
	});
});

</script>
<?php 
mysql_close();
?>
		<div class="main-grid">
			<div class="agile-grids">	
				
				<div class="chart-heading">
				</div>
				<div class="col-md-8 agile-grid-center">
					<div class="w3l-chart events-chart">
						<div class="events-chart-info">
							<div id="container"></div>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
				<!-- //agile-grid-right -->
			</div>
		</div>
		<br><br><hr>
<a href="<?php echo url('logout'); ?>" align="right"> (Logout)</a>