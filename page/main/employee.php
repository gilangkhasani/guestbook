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
if(!empty($_GET['id'])){
	$save = mysql_query("Delete from t_employee where IDEmployee = '".$_GET['id']."'");
	if($save){
		echo status("Deleting Employee Successfully....");
		echo redirect("employee");
		return;
	}
}

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

$data = db_query2list("Select * from t_employee");
// print_r($val);
?>
<style type="text/css">
table th{
  background: #e50012;
}
</style>
<div class="panel panel-widget forms-panel">
<legend align="center" style="font-size: 20px;  padding: 10px;"><strong>Employee</strong></legend>
        
<table id="table-swap-axis  " style="width:70%;margin:0 auto" >
          <thead>
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>TLP/HP</th>
            <th>Employee</th>
            <th>Code</th>
            <th>Action</th>
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
            		echo "<td>".$values->email."</td>";
            		echo "<td>".$values->tlp."</td>";
            		echo "<td>".$values->Employee."</td>";
            		echo "<td><img src='".url("file/qrcode/".$values->Qr_Code)."'></td>";
            		echo "<td><a href='".url('employee?id='.$values->IDEmployee)."'><i class='icon icon-trash'></i></a></td>";
            		echo "</tr>";
	            }
	          }
            //print_r($arr);
            ?>
          </tbody>
</table>
</div>