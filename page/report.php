<?php 
if($_SESSION['quick_login']->roles=='user') {
  $where[] = "id_user = '".$_SESSION['quick_login']->roles."' " ;
}
$where[] = "roles='user'";
if(!empty($_GET['search_date'])) {
  $where[] = "date = '".$_GET['search_date']."'";
  $search_date = $_GET['search_date'];
  $datadate = explode("-", $_GET['search_date']);
  $tahun = $datadate[0];
  if($datadate[1]<10){
    $bulan = str_replace("0","", $datadate[1]);
  }else{
    $bulan = $datadate[1];
  }
  $where_target[] = "tahun = '".$tahun."' and bulan = '".$bulan."'";
}else{
   $where[] = "date = ".date('Y-m-d');
  $search_date = date('Y-m-d');
  $datadate = explode("-", $search_date);
  $tahun = $datadate[0];
  if($datadate[1]<10){
    $bulan = str_replace("0","", $datadate[1]);
  }else{
    $bulan = $datadate[1];
  }
  $where_target[] = "tahun = '".$tahun."' and bulan = '".$bulan."'";
}

if(!empty($where)){
  $where_out = "Where ".implode(" And ", $where);
}else{
  $where_out = "";
}


if(!empty($where_target)){
  $where_out_target = "Where ".implode(" And ", $where_target);
}else{
  $where_out_target = "";
}
// if($_SESSION['quick_login']->roles=='user'){
?>
<div align="right">
<form method="get">
<input style="max-width:160px;padding: 6px 12px;border-radius:5px" id="date" type="text" name="search_date" value="<?php if(!empty($search_date)) echo $search_date; ?>">
<input type="submit" value="search" class="btn btn-danger">
</form>
</div>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">PERFORMANSI CSR SHOP TASIK</h3>
  </div><!-- /.box-header -->
  <div class="box-body" style="overflow-x:auto">
      <table id="example1" class="table table-bordered table-striped" style="font-size: 12px;" >
        <thead>
          <tr>
            <th>No</th>
            <th>Customer Service</th>
            <th>VAS Qty</th>
            <th>Bobot</th>
            <th>VAS Rev</th>
            <th>Bobot</th>
            <th>Staterpack Qty</th>
            <th>Bobot</th>
            <th>Staterpack Rev</th>
            <th>Bobot</th>
            <th>Device Qty</th>
            <th>Bobot</th>
            <th>Halo</th>
            <th>Bobot</th>
            <th>Overtime</th>
            <th>Bobot</th>
            <th>Total CES</th>
            <th>Bobot</th>
            <!-- <th>date</th> -->
          </tr>
        </thead>
        <?php 
        $data_target = db_query("Select * from t_target $where_out_target");
        // echo "Select * from t_target $where_out_target";
        $data = db_query2list("Select * from t_report tr inner join user ON tr.id_user=user.id_user $where_out");
        if(!empty($data)){
          $no = 0;
        ?>
        <tbody>
          <?php 
          foreach ($data as $value) {

            $bobot_vasqty = round(($value->vas_qty/$data_target->vas_qty)*100,2);
            $bobot_vasrev =  round(($value->vas_rev/$data_target->vas_rev)*100,2);
            $bobot_staterpack_qty =  round(($value->staterpack_qty/$data_target->staterpack_qty)*100,2);
            $bobot_staterpack_rev =  round(($value->staterpack_rev/$data_target->staterpack_rev)*100,2);
            $bobot_device_qty =  round(($value->device_qty/$data_target->device_qty)*100,2);
            // $bobot_device_rev =  round(($value->device_rev/$target_device_rev)*100,2);
            $bobot_halo =  round(($value->halo/$data_target->halo)*100,2);
            $bobot_overtime =  round(($value->overtime/$data_target->overtime)*100,2);
            $bobot_total_ces =  round(($value->total_ces/$data_target->total_ces)*100,2);
            $no++;


            ($bobot_vasqty<100) ? $style_vasqty = "style='background:red'" :  $style_vasqty = "style='background:#32ef32'" ;
            ($bobot_vasrev<100) ? $style_vasrev = "style='background:red'" :  $style_vasrev = "style='background:#32ef32'" ;
            ($bobot_staterpack_qty<50) ? $style_staterpack_qty = "style='background:red'" :  $style_staterpack_qty = "style='background:#32ef32'" ;
            ($bobot_staterpack_rev<50) ? $style_staterpack_rev = "style='background:red'" :  $style_staterpack_rev = "style='background:#32ef32'" ;
            ($bobot_device_qty<100) ? $style_device_qty = "style='background:red'" :  $style_device_qty = "style='background:#32ef32'" ;
            // ($bobot_device_rev<50) ? $style_device_rev = "style='background:red'" :  $style_device_rev = "style='background:#32ef32'" ;
            ($bobot_halo<50) ? $style_halo = "style='background:red'" :  $style_halo = "style='background:#32ef32'" ;
            echo '<tr class="odd gradeA">';
            ($bobot_overtime<100) ? $style_overtime = "style='background:red'" :  $style_overtime = "style='background:#32ef32'" ;
            ($bobot_total_ces<100) ? $style_total_ces = "style='background:red'" :  $style_total_ces = "style='background:#32ef32'" ;
            echo '<tr class="odd gradeA">';
              echo "<td>".$no."</td>";
              echo "<td>".$value->fullname."</td>";
              echo "<td>".$value->vas_qty."</td>";
              echo "<td ".$style_vasqty.">".$bobot_vasqty."%</td>";
              echo "<td>".$value->vas_rev."</td>";
              echo "<td ".$style_vasrev.">".$bobot_vasrev."%</td>";
              echo "<td>".$value->staterpack_qty."</td>";
              echo "<td ".$style_staterpack_qty.">".$bobot_staterpack_qty."%</td>";
              echo "<td>".$value->staterpack_rev."</td>";
              echo "<td ".$style_staterpack_rev.">".$bobot_staterpack_rev."%</td>";
              echo "<td>".$value->device_qty."</td>";
              echo "<td ".$style_device_qty.">".$bobot_device_qty."%</td>";
              // echo "<td>".$value->device_rev."</td>";
              // echo "<td ".$style_device_rev.">".$bobot_device_rev."%</td>";
              echo "<td>".$value->halo."</td>";
              echo "<td ".$style_halo.">".$bobot_halo."%</td>";
              echo "<td >".$value->overtime."</td>";
              echo "<td ".$style_overtime.">".$bobot_overtime."%</td>";
              echo "<td>".$value->total_ces."</td>";
              echo "<td ".$style_total_ces.">".$bobot_total_ces."%</td>";
              // echo "<td>".$value->date."</td>";
            echo '</tr>';
            $arr_vas_qty[] = $value->vas_qty;
            $arr_vas_qty_bobot[] = $bobot_vasqty;
            $arr_vas_rev[] = $value->vas_rev;
            $arr_vas_rev_bobot[] = $bobot_vasrev;
            $arr_staterpack_qty[] = $value->staterpack_qty;
            $arr_staterpack_qty_bobot[] = $bobot_staterpack_qty;
            $arr_staterpack_rev[] = $value->staterpack_rev;
            $arr_staterpack_rev_bobot[] = $bobot_staterpack_rev;
            $arr_device_qty[] = $value->device_qty;
            $arr_device_qty_bobot[] = $bobot_device_qty;
            $arr_halo[] = $value->halo;
            $arr_halo_bobot[] = $bobot_halo;
            $arr_overtime[] = $value->overtime;
            $arr_overtime_bobot[] = $bobot_overtime;
            $arr_total_ces[] = $value->total_ces;
            $arr_total_ces_bobot[] = $bobot_total_ces;
          }
          echo '<tr><td colspan=18></td></tr>';
          echo '<tr class="odd gradeA" style="background:#ddd">';
              echo "<td colspan=2>TOTAL</td>";
              echo "<td>".array_sum($arr_vas_qty)."</td>";
              echo "<td>".array_sum($arr_vas_qty_bobot)/$no."%</td>";
              echo "<td>".array_sum($arr_vas_rev)."</td>";
              echo "<td>".array_sum($arr_vas_rev_bobot)/$no."%</td>";
              echo "<td>".array_sum($arr_staterpack_qty)."</td>";
              echo "<td>".array_sum($arr_staterpack_qty_bobot)/$no."%</td>";
              echo "<td>".array_sum($arr_staterpack_rev)."</td>";
              echo "<td>".array_sum($arr_staterpack_rev_bobot)/$no."%</td>";
              echo "<td>".array_sum($arr_device_qty)."</td>";
              echo "<td>".array_sum($arr_device_qty_bobot)/$no."%</td>";
              echo "<td>".array_sum($arr_halo)."</td>";
              echo "<td>".array_sum($arr_halo_bobot)/$no."%</td>";
              echo "<td >".array_sum($arr_overtime)."</td>";
              echo "<td >".array_sum($arr_overtime_bobot)/$no."%</td>";
              echo "<td>".array_sum($arr_total_ces)."%</td>";
              echo "<td>".array_sum($arr_total_ces_bobot)/$no."%</td>";
            echo '</tr>';

          echo '<tr class="odd gradeA" style="background:#ddd">';
              echo "<td colspan=2>Target / CSR</td>";
              echo "<td>".$data_target->vas_qty."</td>";
              echo "<td>".$data_target->vas_qty_bobot."%</td>";
              echo "<td>".$data_target->vas_rev."</td>";
              echo "<td>".$data_target->vas_rev_bobot."%</td>";
              echo "<td>".$data_target->staterpack_qty."</td>";
              echo "<td>".$data_target->staterpack_qty_bobot."%</td>";
              echo "<td>".$data_target->staterpack_rev."</td>";
              echo "<td>".$data_target->staterpack_rev_bobot."%</td>";
              echo "<td>".$data_target->device_qty."</td>";
              echo "<td>".$data_target->device_qty_bobot."%</td>";
              echo "<td>".$data_target->halo."</td>";
              echo "<td>".$data_target->halo_bobot."%</td>";
              echo "<td >".$data_target->overtime."</td>";
              echo "<td >".$data_target->overtime_bobot."%</td>";
              echo "<td>".$data_target->total_ces."%</td>";
              echo "<td>".$data_target->total_ces_bobot."%</td>";
            echo '</tr>';
          ?>
        </tbody>
        <?php 
        }
        ?>
      </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
<script type="text/javascript">
$('#date').daterangepicker();
</script>
<?php 


            // ($data_target->vas_qty==0) ? $target_vas_qty = 1 : $target_vas_qty = $data_target->vas_qty;
            // ($data_target->vas_rev==0) ? $target_vas_rev = 1 : $target_vas_rev = $data_target->vas_rev;
            // ($data_target->staterpack_qty==0) ? $target_staterpack_qty = 1 : $target_staterpack_qty = $data_target->staterpack_qty;
            // ($data_target->staterpack_rev==0) ? $target_staterpack_rev = 1 : $target_staterpack_rev = $data_target->staterpack_rev;
            // ($data_target->device_qty==0) ? $target_device_qty = 1 : $target_device_qty = $data_target->device_qty;
            // // ($data_target->device_rev==0) ? $target_device_rev = 1 : $target_device_rev = $data_target->device_rev;
            // ($data_target->halo==0) ? $target_halo = 1 : $target_halo = $data_target->halo;
            // ($data_target->overtime==0) ? $target_overtime = 1 : $target_overtime = $data_target->overtime;
            // ($data_target->total_ces==0) ? $target_total_ces = 1 : $target_total_ces = $data_target->total_ces;
?>