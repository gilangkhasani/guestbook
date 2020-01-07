<link rel="stylesheet" type="text/css" href="<?php echo url('themes/tmp/css/table-style.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo url('themes/tmp/css/basictable.css')?>" />
<script type="text/javascript" src="<?php echo url('themes/tmp/js/jquery.basictable.min.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<?php 
$where = array();
empty($_GET['search']) ? $search = '': $search = $_GET['search'];
if(!empty($search)){
  $where[] = "Name like '%$search%'";
}
if(!empty($where)){
  $where_out = "Where ".implode(" And ", $where);
}else{
  $where_out = "";
}
if($_SESSION['quick_login']->roles=='scc'){
	$data = db_query2list("Select * from t_checkin_scc left join t_employee On t_employee.IDEmployee = t_checkin_scc.IDEmployee order by Date,Start_time desc");
}else{
	$data = db_query2list("Select * from t_checkin_ttc left join t_whitelist On t_whitelist.IDWhitelist = t_checkin_ttc.IDWhitelist order by Date,Start_time desc");
}
// print_r($val);
?>
<style type="text/css">
table th{
  background: #e50012;
}
</style>
<div class="panel panel-widget forms-panel">
<legend align="center" style="font-size: 20px;  padding: 10px;"><strong>Guest Book History <?php echo strtoupper($_SESSION['quick_login']->roles) ?><strong></legend>
        
<table id="table-swap-axis  " style="width:70%;margin:0 auto" >
          <thead>
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Date</th>
            <th>Check In</th>
            <th>Check Out</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($data)){
            	$no = 0;
            	foreach ($data as $key => $values) {$no++;
            		echo "<tr>";
            		echo "<td>".$no."</td>";
            		echo "<td>".$values->fullname."</td>";
            		echo "<td>".$values->Date."</td>";
            		echo "<td>".$values->Start_time."</td>";
            		echo "<td>".$values->End_time."</td>";
            		echo "</tr>";
	            }
	          }
            //print_r($arr);
            ?>
          </tbody>
</table>
</div>