


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
  $where[] = "fullname like '%$search%'";
}
if(!empty($where)){
  $where_out = "Where ".implode(" And ", $where);
}else{
  $where_out = "";
}

$ruangan_dago = db_query2list("Select * from t_ruangan where id_ttc = 1");
$ruangan_soeta = db_query2list("Select * from t_ruangan where id_ttc = 2");

$data = db_query2list("Select * from t_whitelist Left join t_ruangan ON t_ruangan.IDRuangan = t_whitelist.IDRuangan Left Join t_ttc ON t_ruangan.id_ttc = t_ttc.id_ttc $where_out order by fullname,t_ruangan.id_ttc");
if(!empty($data)){
  foreach ($data as $key => $value) {
    $val[$value->id_ttc][$value->fullname][] = $value->Ruangan;
  }
}
// print_r($val);
?>
<style type="text/css">
table th{
  background: #e50012;
}
</style>
<div class="panel panel-widget forms-panel">
<legend align="center" style="font-size: 20px;  padding: 10px;"><strong>DATA AKSES TTC DAGO</strong></legend>
        
<table id="table-swap-axis  " style="font-size: 10px;" >
          <thead>
            <tr>
            <th>Name</th>
            <?php 
            foreach ($ruangan_dago as $key => $value) {
              echo "<th>".$value->Ruangan."</th>";
            }
            ?>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($val)){
            foreach ($val as $key => $values) {
              if($key==1){
                foreach ($values as $k => $vals) {
                  echo "<tr>";
                    echo "<td><b>".strtoupper($k)."</b></td>";
                  foreach ($vals as $keys => $valuess) {
                    foreach ($ruangan_dago as $keyu => $valu) {
                      if ($keys== $keyu) echo "<td><i class='fa fa-check'></i></td>";
                    }
                  }

                  echo "</tr>";
                }
              }
            }
          }
            //print_r($arr);
            ?>
          </tbody>
</table>
</div>
<div class="panel panel-widget forms-panel">
<legend align=center style="font-size: 20px;  padding: 10px;"><strong>DATA AKSES TTC SOETA</strong></legend>
         
<table id="table-swap-axis  " style="font-size: 11px;" >
          <thead>
            <tr>
            <th>Name</th>
            <?php 
            foreach ($ruangan_soeta as $key => $value) {
              echo "<th>".$value->Ruangan."</th>";
            }
            ?>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($val)){
            foreach ($val as $key => $values) {
              if($key==2){
                foreach ($values as $k => $vals) {
                  echo "<tr>";
                    echo "<td><b>".strtoupper($k)."</b></td>";
                  foreach ($vals as $keys => $valuess) {
                    foreach ($ruangan_soeta as $keyu => $valu) {
                      if ($keys== $keyu) echo "<td><i class='fa fa-check'></i></td>";
                    }
                  }

                  echo "</tr>";
                }
              }
            }
            }
            //print_r($arr);
            ?>
          </tbody>
</table>
</div>