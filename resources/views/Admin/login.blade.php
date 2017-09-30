<html>
<head>
	<meta charset="UTF-8">
	<title>账号登录</title>
	<link rel="stylesheet" type="text/css" href="./resources/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="./resources/themes/icon.css">
	<script type="text/javascript" src="./resources/js/jquery.min.js"></script>
	<script type="text/javascript" src="./resources/js/jquery.easyui.min.js"></script>
</head>
<body>
<div style="width:400px;margin:300px auto;">
	<h2>后台登录</h2>
	<div style="margin:20px 0;"></div>
	<div class="easyui-panel" title=登录 style="width:400px">
		<div style="padding:10px 60px 20px 60px">
	    <form id="ff" method="post">
	    	<table cellpadding="5">
	    		<tr>
	    			<td>账号:</td>
	    			<td><input class="easyui-textbox" type="text" name="name" data-options="required:true"></input></td>
	    		</tr>
	    		<tr>
	    			<td>密码:</td>
	    			<td><input class="easyui-textbox" type="password" name="password" data-options="required:true"></input></td>
	    		</tr>
	    	</table>
	    </form>
	    <div style="text-align:center;padding:5px">
	    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">登录</a>
	    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">重置</a>
	    </div>
	    </div>
	</div>
</div>
	<script>
		function submitForm(){
			$('#ff').form('submit',{
				url:'login1',
				success:function(result){
					//var result = eval('('+result+')');
					if(result){
						$.messager.show({
							title:'Error',
							msg:result
						});
					}else{
						$.messager.show({
							msg:'登陆成功'
						});
					}
				}
			});
		}
		function clearForm(){
			$('#ff').form('clear');
		}
	</script>
</body>
</html>