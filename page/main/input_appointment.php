    <p>Create Appointment for Guest:</p>
    <div style="margin:10px 0;"></div>
	<div class="row">
	<div class="col-md-4">
		<div class="easyui-panel" title="Appointment Details" style="width:100%;max-width:600px;padding:10px 10px;">
			<form id="ff" method="post">
				<div style="margin-bottom:10px">
					<input class="easyui-textbox" name="name" style="width:100%" data-options="label:'To:',labelWidth:'30%',required:true"> <a href="javascript:void(0)" class="easyui-linkbutton" onclick="search()" style="width:80px">Search</a>
				</div>
				<div style="margin-bottom:10px">
					<input class="easyui-textbox" name="message" style="width:100%;height:60px" data-options="label:'Agenda:',labelWidth:'30%',multiline:true">
				</div>
				<div style="margin-bottom:10px">
					<input class="easyui-textbox" name="subject" style="width:100%" data-options="label:'Duration:',labelWidth:'30%',required:true">
				</div>
				<div style="margin-bottom:10px">
					<select class="easyui-combobox" name="language" label="Num of Guests" data-options="labelWidth:'30%'" style="width:100%">
						<option value="1">1</option>
						<option value="2">2</option>
						</select>
				</div>
			</form>
			<div style="text-align:center;padding:5px 0">
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">Submit</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width:80px">Clear</a>
			</div>
		</div>
		</div>
	<div class="col-md-6">
		<div class="easyui-panel" title="New Topic" style="width:100%;max-width:600px;padding:30px 60px;">
			<form id="ff2" method="post">
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="name" style="width:100%" data-options="label:'Name:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="email" style="width:100%" data-options="label:'Email:',required:true,validType:'email'">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="subject" style="width:100%" data-options="label:'Subject:',required:true">
				</div>
				<div style="margin-bottom:20px">
					<input class="easyui-textbox" name="message" style="width:100%;height:60px" data-options="label:'Message:',multiline:true">
				</div>
				<div style="margin-bottom:20px">
					<select class="easyui-combobox" name="language" label="Number of Guests" style="width:100%"><option value="ar">Arabic</option><option value="bg">Bulgarian</option><option value="ca">Catalan</option><option value="zh-cht">Chinese Traditional</option><option value="cs">Czech</option><option value="da">Danish</option><option value="nl">Dutch</option><option value="en" selected="selected">English</option><option value="et">Estonian</option><option value="fi">Finnish</option><option value="fr">French</option><option value="de">German</option><option value="el">Greek</option><option value="ht">Haitian Creole</option><option value="he">Hebrew</option><option value="hi">Hindi</option><option value="mww">Hmong Daw</option><option value="hu">Hungarian</option><option value="id">Indonesian</option><option value="it">Italian</option><option value="ja">Japanese</option><option value="ko">Korean</option><option value="lv">Latvian</option><option value="lt">Lithuanian</option><option value="no">Norwegian</option><option value="fa">Persian</option><option value="pl">Polish</option><option value="pt">Portuguese</option><option value="ro">Romanian</option><option value="ru">Russian</option><option value="sk">Slovak</option><option value="sl">Slovenian</option><option value="es">Spanish</option><option value="sv">Swedish</option><option value="th">Thai</option><option value="tr">Turkish</option><option value="uk">Ukrainian</option><option value="vi">Vietnamese</option></select>
				</div>
			</form>
			<div style="text-align:center;padding:5px 0">
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">Submit</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width:80px">Clear</a>
			</div>
		</div>
	</div>
	</div>
    <script>
        function submitForm(){
            $('#ff').form('submit');
        }
        function clearForm(){
            $('#ff').form('clear');
        }
    </script>