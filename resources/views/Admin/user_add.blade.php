<form id="ff" method="post">
	    	<table style="font-size:12px;padding:10px;" cellpadding="5">
	    		<input type="hidden" id="userID" name="userID" />
	    		<tr>
	    			<td>用户名</td>
	    			<td><input class="easyui-textbox" type="text" name="userName" id="userName" data-options="required:true"></input></td>
	    			<td>姓名</td>
	    			<td><input class="easyui-textbox" type="text" name="name" id="name" data-options="required:true"></input></td>
	    		</tr>
	    		<tr>
	    			<td>性别</td>
	    			<td><input class="easyui-textbox" type="text" name="sex" id="sex" data-options="required:true"></input></td>
	    			<td>联系方式</td>
	    			<td><input class="easyui-numberbox" type="text" name="phone" id="phone" data-options="required:true"></input></td>
	    		</tr>
	    		<tr>
	    			<td>QQ</td>
	    			<td><input class="easyui-numberbox" type="text" name="qq" id="qq" data-options="required:true"></input></td>
	    			<td>Email</td>
	    			<td><input class="easyui-textbox" type="text" name="email" id="email" data-options="required:true,validType:'email'"></input></td>
	    		</tr>
	    		<tr>
	    			<td>居住地</td>
	    			<td><input class="easyui-textbox" type="text" name="address" id="address" data-options="required:true"></input></td>
	    		</tr>
	    	</table>
</form>	
<script>
$(document).ready(function(){
	$.ajax({
		url:'getUserInfo',
		type:'post',
		dataType:'json',
		data:{'userID':{{$_GET['userID'] }}},
		success:function(res){
			if(res){
				$('#ff').form('load',res);
			}
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
