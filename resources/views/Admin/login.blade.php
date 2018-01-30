<html>
<head>
	<meta charset="UTF-8" >
	<title>账号登录</title>
	<link rel="stylesheet" type="text/css" href="./resources/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="./resources/themes/icon.css">
	<script type="text/javascript" src="./resources/js/jquery.min.js"></script>
	<script type="text/javascript" src="./resources/js/jquery.easyui.min.js"></script>
</head>
<style>
body{background-color:#E0ECFF}
.main{width:400px;margin:100px auto;}
</style>
<body>
<div class="main">
	<h2>后台登录</h2>
	<div style="margin:20px 0;"></div>
	<div class="easyui-panel" title=登录 style="width:400px">
		<div style="padding:10px 60px 20px 60px">
	    <form id="login" method="post">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<table cellpadding="5">
	    		<tr>
	    			<td>账号:</td>
	    			<td><input class="easyui-textbox" type="text" name="userName"  data-options="required:true"></input></td>
	    		</tr>
	    		<tr>
	    			<td>密码:</td>
	    			<td><input class="easyui-textbox" type="password" name="passWord"  data-options="required:true"></input></td>
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
			$('#login').form('submit',{
				url:'login',
				success:function(result){
					var result = eval('('+result+')');
					if(result.code==102){
						$.messager.alert('提示',result.msg,'info',window.location.href="index");
					}else{
						$.messager.alert('提示',result.msg,'error');
					}
				}
			});
		}
		function clearForm(){
			$('#login').form('clear');
		}
	</script>
</body>
</html>