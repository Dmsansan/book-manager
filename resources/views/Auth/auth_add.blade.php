<form id="ff" method="post">
	    	<table style="font-size:12px;padding:10px;" cellpadding="5">
	    		<input type="hidden" id="authID" name="authID" />
	    		<tr>
	    			<td>权限名称</td>
	    			<td><input class="easyui-textbox" type="text" name="authName" id="authName" data-options="required:true"></input></td>
	    			<td>管理范围</td>
	    			<td><input id="manager" class="easyui-combobox" name="manager" data-options="valueField:'manageID',textField:'manageTitle',url:'../system/getAllManager',multiple:true,panelHeight:'auto',required:true" /></td>
	    		</tr>
	    		<tr>
	    			<td>操作权限</td>
	    			<td><input id="edit" class="easyui-combobox" name="edit" data-options="valueField:'editID',textField:'editName',url:'../system/getAllEdit',multiple:true,panelHeight:'auto',required:true" />  </td>
	    		</tr>
	    	</table>
</form>	
<script>
$(document).ready(function(){
	$.ajax({
		url:'../authority/getAuthInfo',
		type:'post',
		dataType:'json',
		data:{'authID':{{$_GET['authID'] }}},
		success:function(res){
			var data = res.data;
				$('#ff').form('load',data);
				$('#manager').combobox('setValues',data.rangeValue);
				$('#edit').combobox('setValues',data.editValue);
		},
		error:function(res){
			$.messager.show({
				title:'提示',
				msg:"服务异常",
				timeout:1000,
				style:{
					right:'',
					bottom:''
				}
			});
		}
	})
})
</script>    
