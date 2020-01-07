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
if(!empty($_GET['ID'])&&$_GET['action']=='checkout'){
	$exec = mysql_query("Update t_guestbook set End_time = now() where IDGuest = '".$_GET['ID']."' ");
	if($exec){
		echo status("Checkout successfully...");
		echo redirect("history-guestbook");
		return;
	}else{
		
		echo status("Checkout failed!!!");
		echo redirect("history-guestbook");
		return;
	}
}
$data = db_query2list("SELECT a.*,b.building_name,CONCAT(c.floor_room_name,' / ',c.room_name) AS roomin FROM 16011164_portal.t_guestbook a,16010754_sik.building b,16010754_sik.room c
WHERE a.building=b.id_building AND a.floor=c.id_room ORDER BY DATE,Start_time DESC");
// print_r($val);
?>
<style type="text/css">
table th{
  background: #e50012;
}
</style>
<div class="panel panel-widget forms-panel" style="overflow-x:auto">
<legend align="center" style="font-size: 20px;  padding: 10px;"><strong>Guest Book History <?php echo strtoupper($_SESSION['quick_login']->roles) ?><strong></legend>
<table id="table-swap-axis  " style="width:80%;margin:0 auto" >
          <thead>
            <tr>
            <th>No</th>
            <?php //<th>#</th>?>
            <th>Name</th>
            <th>Date</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Intended Person</th>
			<th>Building</th>
            <th>Room</th>
            <th>Agenda</th>
			<th>User Response</th>
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
					// if($values->Photo_checkin!=''){
						// echo "<td><img src='".url('file/photo/'.$values->Photo_checkin)."' style='width:100px'></td>";
					// }else{						
						// echo "<td><img src='".url('themes/img/user.png')."' style='width:100px'></td>";
					// }
            		echo "<td>".$values->Name."</td>";
            		echo "<td>".$values->Date."</td>";
            		echo "<td>".$values->Start_time."</td>";
            		echo "<td>".$values->End_time."</td>";
            		echo "<td>".$values->Person."</td>";
            		echo "<td>".$values->building_name."</td>";
            		echo "<td>".$values->roomin."</td>";
            		echo "<td>".$values->Agenda."</td>";
            		echo "<td>".$values->person_response."</td>";
					if($values->End_time==''){
            		echo "<td><a href='".url('history-guestbook?ID='.$values->IDGuest.'&action=checkout')."' class='btn btn-info'>Checkout</a></td>";
					}else{
						echo "<td><i class='icon icon-check'></i></td>";
					}
            		echo "</tr>";
	            }
	          }
            //print_r($arr); 
            ?>
          </tbody>
</table>
</div>