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
					$('#dlg').dialog('dialog').attr('tabIndex','-1').bind('keydown',function(e){
						if (e.keyCode == 27){
							$('#dlg').dialog('close');
						}
					});
					if((row.End_time==null && row.guest_card != null)&&(row.End_time==null && row.guest_card != '')){ 
						$('#checkoutlink').show();
					}else{
						$('#checkoutlink').hide();
					}
					$('#fm').form('load', row);
					$('#Photo_checkin').attr('src','file/photo/'+row.Photo_checkin);
					$('#Photo_ktp').attr('src','file/photo/'+row.Photo_ktp);
					url = 'mahasiswa_crud.php?aksi=edit&id=' + row.IDGuest;
				}
				console.log(url);
			}
			function checkout(){
				var row = $('#tt').datagrid('getSelected');
				var nama = $('#Name').val();
				var Person_phonenumber = $('#Person_phonenumber').val();
				//var url = 'http://10.3.5.225/guestbook/api/api.php?aksi=checkout&id='+row.IDGuest+'&nama='+nama+'&nohp='+Person_phonenumber;
				//alert(url);
				if (row) {
					$('#fm').form('submit',{
						url : 'http://10.3.5.225/guestbook/api/api.php?aksi=checkout&id='+row.IDGuest+'&nama='+nama+'&nohp='+Person_phonenumber+'&gdg=<?php echo $_SESSION['guestbook_building']->building_name;?>',
						success: function(data){
							//var data = eval('(' + data + ')');  // change the JSON string to javascript object
							//if (data.success){
								alert("Checkout Successfully....");
								$('#dlg').dialog('close');		// close the dialog
								$('#tt').datagrid('reload');	// reload the user data
							//}
						}
					});
				}
			}
			function saveIDttc(){
				var row = $('#tt').datagrid('getSelected');
				var ktp = $('#ktp').val();
				var nomer_keplek = $('#guest_card').val();
				if (row) {
					if(nomer_keplek ==''||nomer_keplek == null){
						alert("silahkan isi nomer visitor");
						return false;
					}else{
						$('#fm').form('submit',{
							url : 'http://10.3.5.225/guestbook/api/api.php?aksi=Editrecord&id='+row.IDGuest+'&nomer_keplek='+nomer_keplek+'&building=<?php echo $_SESSION['guestbook_building']->id_building;?>',
							success : function(data){
								var data = eval('(' + data + ')');  // change the JSON string to javascript object
								if (data.success){
									alert(data.message);
									//alert('ok');
										$('#dlg').dialog('close');		// close the dialog
										$('#tt').datagrid('reload');	// reload the user data
										return true;
								}else{
									alert(data.message);
									return true;
								}
							}
						});
					}
					return true;
				}
			}			
			
			$(function(){
			  var dg = $('#tt');
			  dg.datagrid();
			  dg.datagrid({ 
				onRowContextMenu: function(e,index,row){
				  $(this).datagrid('selectRow',index);
				  e.preventDefault();
				  $('#mm').menu('show', {
					left:e.pageX,
					top:e.pageY
				  });
				}
			  });
			  dg.datagrid('enableFilter');
			})
			function reloadtable(){
				$('#tt').datagrid('reload');
			}
			setInterval(reloadtable, 60000);
		</script>
         <table id="tt" class="easyui-datagrid" style="width:100%;height:100%;min-width:600px;min-height:600px;"
		        url="http://10.3.5.225/guestbook/api/api.php?aksi=all&build=<?php echo $_SESSION['guestbook_building']->id_building ?>"
		        data-options="singleSelect:true"
				onRowContextMenu="onRowContextMenu"
				pageSize = 20
				pageList = [20,30,40,50]
		        title="History Guest book <?php echo $_SESSION['guestbook_building']->building_name ?> at last 4 Days" iconCls="icon-save"
		        rownumbers="true" toolbar="#toolbar" fitColumns="true" pagination="true">
		    <thead>
		        <tr>
		            <th field="Name" sortable="true">Name</th>
		            <th field="Company" sortable="true">Company</th>
		            <th field="Start_time" sortable="true">Check In</th>
		            <th field="End_time" sortable="true">Check Out</th>
		            <th field="Person" sortable="true">Intended Person</th>
		            <th field="building_name" sortable="true">Building</th>
		            <!--<th field="roomin">Room</th>-->
		            <!--<th field="Agenda" sortable="true">Agenda</th>-->
		            <th field="person_response" sortable="true">User Response</th>
					<th field="person_notes" sortable="true">User Notes</th>
					<th field="guest_card" sortable="true">Visitor Card</th>
		        </tr>
		    </thead>
		</table>
       	<div id="dlg" class="easyui-dialog" style="width:90%;height:550px;padding:10px 20px"
		closed="true" buttons="#dlg-buttons" tabIndex="-1">
			<div class="ftitle">
				Record Info
			</div>
			<form id="fm" method="post" novalidate>
			<div>
				<div class="col-md-4">
					<div class="fitem">
						<label>Name:</label>
						<input name="Name" id="Name" class="easyui-validatebox" required="true" readonly="readonly">
						<input name="IDGuest" type="hidden" class="easyui-validatebox" required="true">
					</div>
					<div class="fitem">
						<label>Email</label>
						<input name="Email" class="easyui-validatebox" required="true" readonly="readonly">
					</div>
					<div class="fitem">
						<label>Telephone</label>
						<input name="Phonenumber" class="easyui-validatebox" required="true" readonly="readonly">
					</div>
					<div class="fitem">
						<label>Company</label>
						<input name="Company" class="easyui-validatebox" required="true" readonly="readonly">
					</div>
					<div class="fitem">
						<label>Building Name</label>
						<input name="building_name" class="easyui-validatebox" required="true" readonly="readonly">
					</div>
					<!--
					<div class="fitem">
						<label>Room</label>
						<input name="roomin" class="easyui-validatebox" required="true" readonly="readonly">
					</div>
					-->
					<div class="fitem">
						<label>The Intended Person</label>
						<input name="Person" class="easyui-validatebox" required="true" readonly="readonly">
					</div>
					<div class="fitem">
						<label>Person Phone Number</label>
						<input name="Person_phonenumber" id="Person_phonenumber" class="easyui-validatebox" required="true" readonly="readonly">
					</div>
					<div class="fitem">
						<label>Agenda</label>
						<textarea name="Agenda" class="easyui-validatebox" required readonly="readonly"></textarea>
					</div>
					<div class="fitem">
						<label>Estimate Time</label>
						<input name="Estimate_time_visit" class="easyui-validatebox" required="true" readonly="readonly">
					</div>
					<div class="fitem">
						<label>Nomor KTP/SIM</label>
						<input name="Number_of_ktp" id="Number_of_ktp" class="easyui-validatebox">
					</div>
					<div class="fitem" id ='idtt'>
						<label>Identity TTC Number</label>
						<input name="guest_card" id="guest_card" class="easyui-validatebox" <?php if($_SESSION['guestbook_building']->roles=='guest'){ echo 'disabled=true';}else{echo ''; } ?>>
					</div>
				</div>
				<div class="col-md-6">
					<img id="Photo_checkin" src="themes/img/no_avatar.jpg" width="230" height="200">
					<img id="Photo_ktp" src="themes/img/no_avatar.jpg" width="230" height="200">
					<br><br>
					<div class="fitem" id ='citt'>
						<label>Check In Time</label>
						<input name="Start_time" id="Start_time" class="easyui-validatebox" required="true" readonly="readonly">
					</div>
					<div class="fitem" id ='cott'>
						<label>Check Out Time</label>
						<input name="End_time" id="End_time" class="easyui-validatebox" readonly="readonly"><a href="#" class="easyui-linkbutton" iconCls="icon-undo" onclick="checkout()" id="checkoutlink" >Check Out</a>
					</div><br>
				</div>
			</div>
		</div>
			
		<div id="dlg-buttons">
		<!-- onclick="saveIDttc()" -->
			 <?php 
			 if($_SESSION['guestbook_building']->roles=='guest'){
				 
			 }else{
				 ?><a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveIDttc()" >Save</a> 
			<?php }?>
			<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
		</div>
		</form>
		<div id="mm" class="easyui-menu" style="width: 100px;">
			 <div onclick="editRecord()" data-options="iconCls:'icon-print'">View Detail</div>
		</div>
		
<script type="text/javascript" src="<?php echo url('themes/camera/js/qrcodelib.js')?>"></script>
<script type="text/javascript" src="<?php echo url('themes/camera/js/WebCodeCam.js')?>"></script>
<script type="text/javascript" src="<?php echo url('themes/camera/js/main_guest.js')?>"></script>

