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
			function newRecordUser() {
				$('#dlg').dialog('open').dialog('setTitle', 'Tambah User');
				$('#fm').form('clear');
				$('#fm input').removeAttr("readonly");
				$('#btnsave').hide();
				$('#btnaddNew').show();
				url = 'mahasiswa_crud.php?aksi=add';
			}

			function editRecordUser() {
				var row = $('#tt').datagrid('getSelected');
				$('#btnaddNew').hide();
				$('#btnsave').show();
				$('#username').attr('readonly','readonly');
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
			function saveUser() {
				var row = $('#tt').datagrid('getSelected');
				console.log(row);
				var fullname = $('#fullname').val();
				var roles = $('#roles').val();
				var email = $('#email').val();
				var tlp = $('#tlp').val();
				var id_building = $('#id_building').val();
				if (row) {
					$('#fm').form('submit',{
						url : 'http://10.3.5.225/guestbook/api/api.php?aksi=useredit&id='+row.id_user+'&fullname='+fullname+'&email='+email+'&roles='+roles+'&tlp='+tlp+'&building='+id_building,
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
			function saveUserNew() {
				var username = $('#username').val();
				var fullname = $('#fullname').val();
				var roles = $('#roles').val();
				var email = $('#email').val();
				var tlp = $('#tlp').val();
				var id_building = $('#id_building').val();
				$('#fm').form('submit',{
					url : 'http://10.3.5.225/guestbook/api/api.php?aksi=useradd&username='+username+'&fullname='+fullname+'&email='+email+'&roles='+roles+'&tlp='+tlp+'&building='+id_building,
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
		<script>
			var buttons = [{
				iconCls:'icon-add',
				handler:function(){
					alert('add');
				}
			},{
				iconCls:'icon-cut',
				handler:function(){
					alert('cut');
				}
			},{
				iconCls:'icon-save',
				handler:function(){
					alert('save');
				}
			}];
		</script>
         <table id="tt" class="easyui-datagrid" style="min-width:600px;min-height:590px; max-height: 590px;"
		        url="http://10.3.5.225/guestbook/api/api.php?aksi=list-user&roles=<?php echo $_SESSION['guestbook_building']->roles ?>""
		        data-options="singleSelect:true"
		        pageSize = "20"
				pageList = [20,30,40,50]
		        title="Site List Regional 4 Jawa Barat" iconCls="icon-save"
		        rownumbers="true" toolbar="#toolbar" fitColumns="true" pagination="true">
		    <thead>
		        <tr>
		            <th field="username" sortable="true">Username</th>
		            <th field="fullname" sortable="true">Fullname</th>
		            <th field="email" sortable="true">Email</th>
		            <th field="tlp" sortable="true">Telepon</th>
		            <th field="roles" sortable="true">Roles</th>
		            <th field="building_name" sortable="true">Building</th>
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
						<label>Username:</label>
						<input name="username" id="username" class="easyui-validatebox" required="true" readonly="readonly">
					</div>
					<div class="fitem">
						<label>Fullname</label>
						<input name="fullname" id="fullname" class="easyui-validatebox" required="true" >
					</div>
					<div class="fitem">
						<label>Email</label>
						<input name="email" id="email" class="easyui-validatebox" required="true" >
					</div>
					<div class="fitem">
						<label>Telepon</label>
						<input name="tlp" id="tlp" class="easyui-validatebox" required="true" >
					</div>
					<div class="fitem">
						<label>Roles</label>
						<select name="roles" id="roles" class="form-control" required="true">
							<option value="ttc">TTC</option>
							<option value="scc">SCC</option>
							<option value="guest">Guest</option>
							<option value="admin">Super Admin</option>
						</select>
					</div>
					<div class="fitem">
						<label>Building</label>
						<!--<input name="building"  id="building" class="easyui-validatebox" required="true">-->
						<select name="id_building" id="id_building" class="form-control" required="true">
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
				</div>
			</div>
		</div>
			
		<div id="dlg-buttons">
		<!-- onclick="saveIDttc()" -->
			 <?php if($_SESSION['guestbook_building']->roles=='admin'){?>
			<a href="#" class="easyui-linkbutton" iconCls="icon-ok" id="btnsave" onclick="saveUser()" >Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-ok" id="btnaddNew" onclick="saveUserNew();javascript:$('#dlg').dialog('close')">Add New</a>
			<?php }?>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
		</div>
		</form>
		<div id="mm" class="easyui-menu" style="width: 100px;">
			 <div onclick="editRecordUser()" data-options="iconCls:'icon-print'">View Detail</div>
		</div>
<script type="text/javascript" src="<?php echo url('themes/camera/js/qrcodelib.js')?>"></script>
<script type="text/javascript" src="<?php echo url('themes/camera/js/WebCodeCam.js')?>"></script>
<script type="text/javascript" src="<?php echo url('themes/camera/js/main_guest.js')?>"></script>

