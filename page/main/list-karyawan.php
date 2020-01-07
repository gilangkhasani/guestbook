       	<style>
		#fm {
			margin: 0;
			padding: 5px 5px;
		}
		.ftitle {
			font-size: 12px;
			font-weight: bold;
			color: #666;
			padding: 5px 0;
			margin-bottom: 10px;
			border-bottom: 1px solid #ccc;
		}
		.fitem {
			margin-bottom: 5px;
		}
		.fitem label {
			display: inline-block;
			width: 80px;
		}
		</style>
		<script type="text/javascript">
			var url;
			function newRecord() {
				$('#dlg').dialog('open').dialog('setTitle', 'Tambah User');
				$('#fm').form('clear');
				$('#fm input').removeAttr("readonly");
				$('#Photo_checkin').attr('src','themes/img/no_avatar.jpg');
				$('#End_time').remove();
				$('#Start_time').remove();
				$('#idtt').remove();
				$('#citt').remove();
				$('#cott').remove();
				
				url = 'mahasiswa_crud.php?aksi=add';
			}

			function editRecord() {
				var row = $('#tt').datagrid('getSelected');
				console.log(row);
				if (row) {
					$('#dlg').dialog('open').dialog('setTitle', 'Edit Record');					
					if(row.End_time){ 
						$('#checkoutlink').hide();
					}else{
						$('#checkoutlink').show();
					}
					$('#fm').form('load', row);
					$('#building').val(row.building);
					$('#Photo_checkin').attr('src','file/photo/'+row.Photo_checkin);
					$('#Photo_ktp').attr('src','file/photo/'+row.Photo_ktp);
					url = 'http://10.3.5.225/guestbook/api/api.php?aksi=edit&id=' + row.IDGuest;
				}
				console.log(url);
			}
			function saveIDttc() {
				var row = $('#tt').datagrid('getSelected');
				var fullname = $('#fullname').val();
				var nomerHP = $('#nomerHP').val();
				var mail = $('#mail').val();
				var departement = $('#departement').val();
				var building = $('#building').val();
				var lantai = $('#lantai').val();
				var telpon = $('#telpon').val();
				if (row) {
					$('#fm').form('submit',{
						url : 'http://10.3.5.225/guestbook/api/api.php?aksi=karedit&id='+row.id_karyawan+'&fullname='+fullname+'&mail='+mail+'&nomerHP='+nomerHP+'&departement='+departement+'&building='+building+'&lantai='+lantai+'&telpon='+telpon+'&editedby=<?php echo $_SESSION['guestbook_building']->username;?>',
						success : function(data){
							var data = eval('(' + data + ')');  // change the JSON string to javascript object
							if (data.success){
								alert(data.message);
								//alert('ok');
								$('#dlg').dialog('close');		// close the dialog
								$('#tt').datagrid('reload');	// reload the user data
							}
						}
					});
				}
			}
			
			$(function(){
			  $('#tt').datagrid({ 
				onRowContextMenu: function(e,index,row){
				  $(this).datagrid('selectRow',index);
				  e.preventDefault();
				  $('#mm').menu('show', {
					left:e.pageX,
					top:e.pageY
				  });
				}
			  })
				var dg = $('#tt');
				dg.datagrid('enableFilter'); 
			})
		</script> 
		<!-- <div id="tb" style="padding:3px;background:#ddd">
			<span>Search By Name:</span>
			<input id="fullname" style="line-height:26px;border:1px solid #ccc">
			<a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>
		</div> -->
         <table id="tt" class="easyui-datagrid" style="min-width:600px;min-height:590px; max-height: 590px;"
		        url="http://10.3.5.225/guestbook/api/api.php?aksi=list-karyawan&build=<?php echo $_SESSION['guestbook_building']->id_building ?>""
		        data-options="singleSelect:true"
				multiSort = "true"
		        pageSize = "20"
				pageList = [20,30,40,50]
		        title="Site List Regional 4 Jawa Barat" iconCls="icon-save"
		        rownumbers="true" toolbar="#toolbar" fitColumns="true" pagination="true">
		    <thead>
		        <tr>
		            <th field="nik" sortable="true">NIK</th>
		            <th field="fullname" sortable="true">Name</th>
		            <th field="nomerHP" sortable="true">HP</th>
		            <th field="telpon" sortable="true">Ext</th>
		            <th field="mail" sortable="true">Email</th>
		            <th field="departement" sortable="true">Departement</th>
		            <th field="building_name" sortable="true">Building</th>
		            <th field="lantai" sortable="true">Lantai</th>
		        </tr>
		    </thead>
		</table>
       	<div id="dlg" class="easyui-dialog" style="width:40%;height:550px;padding:10px 20px"
		closed="true" buttons="#dlg-buttons">
			<div class="ftitle">
				Info Karyawan
			</div>
			<form id="fm" method="post" novalidate>
			<div>
				<div class="col-md-12">
					<div class="fitem">
						<label>Name:</label>
						<input name="fullname" id="fullname" class="form-control easyui-validatebox" required="true" >
					</div>
					<div class="fitem">
						<label>Email</label>
						<input name="mail" id="mail" class="form-control easyui-validatebox" required="true" >
					</div>
					<div class="fitem">
						<label>Telephone</label>
						<div class="input-group">
						<span class="input-group-addon"id="basic-addon1">+62</span>
						<input name="nomerHP" id="nomerHP" class="form-control easyui-validatebox" required="true" >
						</div>
					</div>
					<div class="fitem">
						<label>Extension</label>
						<input name="telpon" id="telpon" class="form-control easyui-validatebox">
					</div>
					<div class="fitem">
						<label>Departement</label>
						<!--<input name="departement"  id="departement" class="easyui-validatebox" required="true" >-->
						<select name="departement"  id="departement" class="form-control" required="true">
							<?php 
							$data_building = db_query2list("Select distinct(departement) as dep from karyawan_jabar");
							if(!empty($data_building)){
								foreach($data_building as $val){
									echo "<option value='".$val->dep."'>".$val->dep."</option>";
								}
							}
							?>
						</select>
					</div>
					<div class="fitem">
						<label>Building</label>
						<!--<input name="building"  id="building" class="easyui-validatebox" required="true">-->
						<select name="building" id="building" class="form-control" required="true">
							<?php 
							$data_building = db_query2list("Select * from building");
							if(!empty($data_building)){
								foreach($data_building as $val){
									echo "<option value='".$val->id_building."'>".$val->building_name."</option>";
								}
							}
							?>
						</select>
					</div>
					<div class="fitem">
						<label>Lantai</label>
						<input name="lantai"  id="lantai" class="easyui-validatebox" required="true">
					</div>
				</div>
			</div>
		</div>
			
		<div id="dlg-buttons">
		<!-- onclick="saveIDttc()" -->
			 <?php if($_SESSION['guestbook_building']->roles=='guest'){}else{?><a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveIDttc()" >Save</a> <?php }?>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
		</div>
		</form>
		<div id="mm" class="easyui-menu" style="width: 100px;">
			 <div onclick="editRecord()" data-options="iconCls:'icon-print'">View Detail</div>
		</div>
		
<script type="text/javascript" src="<?php echo url('themes/camera/js/qrcodelib.js')?>"></script>
<script type="text/javascript" src="<?php echo url('themes/camera/js/WebCodeCam.js')?>"></script>
<script type="text/javascript" src="<?php echo url('themes/camera/js/main_guest.js')?>"></script>

