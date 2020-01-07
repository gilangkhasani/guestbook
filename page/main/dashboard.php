
<script src="<?php echo url('themes/quick/dist/js/highchart/highcharts.js')?>"></script>
<script src="<?php echo url('themes/quick/dist/js/highchart/highcharts-3d.js')?>"></script>
<script src="<?php echo url('themes/quick/dist/js/highchart/exporting.js')?>"></script>
<script type="text/javascript">
  /*
  $(function () {
    $('#sales').highcharts({
      title: {
        text: 'Summary of Sales Perdana'
      },
      xAxis: {
        categories: <?php echo json_encode(array_unique($ca)); ?>
      },
      yAxis: {
      },
      tooltip: {
        valueSuffix: ''
      },
      legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
      },
      series: [
        <?php
          foreach ($SP as $kdate => $valnya) {
        ?>
        {
          name: '<?php echo $kdate?>',
          data: [
            <?php 
            $count = count($valnya);
			$no = 1;
              foreach ($valnya as $k => $value) {
              ?>
                <?php 
                echo $value;
                if($no<$count){
                  echo ",";
                }
                ?>
                
            <?php $no++;} ?>
          ]
        },
        <?php 
        } 
        ?>
      ]
    });

    $('#fitur').highcharts({
      title: {
        text: 'Summary of Fitur / TRX'
      },
      xAxis: {
        categories: <?php echo json_encode(array_unique($ca)); ?>
      },
      yAxis: {
      },
      tooltip: {
        valueSuffix: ''
      },
      legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
      },
      series: [
        <?php
          foreach ($Fitur as $kdate => $valnya) {
        ?>
        {
          name: '<?php echo $kdate?>',
          data: [
            <?php 
            $count = count($valnya);
			$no = 1;
              foreach ($valnya as $k => $value) {
              ?>
                <?php 
                echo $value;
                if($no<$count){
                  echo ",";
                }
                ?>
                
            <?php $no++;} ?>
          ]
        },
        <?php 
        } 
        ?>
      ]
    });

    $('#r_all').highcharts({
      title: {
        text: 'Summary of Recharge Data'
      },
      xAxis: {
        categories: <?php echo json_encode(array_unique($ca)); ?>
      },
      yAxis: {
      },
      tooltip: {
        valueSuffix: ''
      },
      legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
      },
      series: [
        <?php
          foreach ($RA as $kdate => $valnya) {
        ?>
        {
          name: '<?php echo $kdate?>',
          data: [
            <?php 
            $count = count($valnya);
			$no = 1;
              foreach ($valnya as $k => $value) {
                foreach ($rc399 as $keys => $values) {
                  if($kdate==$values->Cluster && $k==$values->Date)
                  echo $value*1000+$values->Total;
                }
              ?>
                <?php 
                if($no<$count){
                  echo ",";
                }
                ?>
                
            <?php $no++;} ?>
          ]
        },
        <?php 
        } 
        ?>
      ]
    });
	
    $('#r_data').highcharts({
      title: {
        text: 'Summary of Recharge All'
      },
      xAxis: {
        categories: <?php echo json_encode(array_unique($ca)); ?>
      },
      yAxis: {
      },
      tooltip: {
        valueSuffix: ''
      },
      legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
      },
      series: [
        <?php
          foreach ($RD as $kdate => $valnya) {
        ?>
        {
          name: '<?php echo $kdate?>',
          data: [
            <?php 
            $count = count($valnya);
			$no = 1;
              foreach ($valnya as $k => $value) {
                foreach ($rc399 as $keys => $values) {
                  if($kdate==$values->Cluster && $k==$values->Date)
                  echo $value*1000+$values->Total;
                }
              ?>
                <?php 
                if($no<$count){
                  echo ",";
                }
                ?>
                
            <?php $no++;} ?>
          ]
        },
        <?php 
        } 
        ?>
      ]
    });

    
  });*/
</script>
<?php 
$data_kunjungan = db_query2list("Select Date,count(*) as count_guest from t_guestbook group by Date");
$checkin_scc = db_query2list("Select Date,count(*) as count_scc from t_checkin_scc group by Date");
$checkin_ttc = db_query2list("Select Date,count(*) as count_ttc from t_checkin_ttc group by Date");
//print_r($data_kunjungan);
//print_r($checkin_scc);
//print_r($checkin_ttc);
?>
		<div class="main-grid">
			<div class="agile-grids">	
				
				<div class="chart-heading">
					<h2>Charts</h2>
				</div>
				<div class="col-md-4 agile-grid-left">
					<div class="w3l-chart events-chart">
						<h3>Number Of Visit TTC</h3>
						<div class="events-chart-info">
							<div id="grp_ttc"></div>
							<script>
							var ttc_data = <?php echo json_encode($checkin_ttc);  ?>;
							Morris.Line({
							  element: 'grp_ttc',
							  data: ttc_data,
							  xkey: 'Date',
							  ykeys: ['count_ttc'],
							  labels: ['Count Of Visit TTC'],
							  units: ' Person'
							});
							</script>
						</div>
					</div>
				</div>
				
				<div class="col-md-4 agile-grid-center">
					<div class="w3l-chart events-chart">
						<h3>Number Of Visit SCC</h3>
						<div class="events-chart-info">
							<div id="grp_scc"></div>
							<script>
							var scc_data = <?php echo json_encode($checkin_scc);  ?>;
							Morris.Line({
							  element: 'grp_scc',
							  data: scc_data,
							  xkey: 'Date',
							  ykeys: ['count_scc'],
							  labels: ['Count Of Visit Scc'],
							  units: ' Person'
							});
							</script>
						</div>
					</div>
				</div>
				<div class="col-md-4 agile-grid-right">
					<div class="w3l-chart events-chart">
						<h3>Number Of Guestbook</h3>
						<div class="events-chart-info">
							<div id="grp_guest"></div>
							<script>
							var guest_data = <?php echo json_encode($data_kunjungan);  ?>;
							Morris.Line({
							  element: 'grp_guest',
							  data: guest_data,
							  xkey: 'Date',
							  ykeys: ['count_guest'],
							  labels: ['Count Of guestbook'],
							  units: ' Person'
							});
							</script>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
				<!-- //agile-grid-right -->
			</div>
		</div>