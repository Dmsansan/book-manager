<html>
<head>
	<meta charset="UTF-8" >
	<title>账号登录</title>
	<link rel="stylesheet" type="text/css" href="./resources/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="./resources/themes/icon.css">
	<script type="text/javascript" src="./resources/js/jquery.min.js"></script>
	<script type="text/javascript" src="./resources/js/jquery.easyui.min.js"></script>
</head>
    <body class="easyui-layout">
        <div data-options="region:'north',title:'',split:false" style="height:80px;background-color:#E0ECFF;text-align: center">
        	<h1 style="color: #0E2D5F">欢迎登录南京挚信图书管理系统</h1>
        </div>
        <div data-options="region:'south',title:'南京挚信图书管理系统 V1.0',split:false" style="height:0px;"></div>
        <!--<div data-options="region:'east',title:'East',split:true" style="width:100px;"></div>-->
        <div data-options="region:'west',title:'管理菜单',split:false" style="width:150px;">
			<div class="easyui-accordion" data-options="fit:true,border:false"> 
				<div title="系统管理" data-options="selected:true" style="padding:10px;"> 
					<ul class="easyui-tree">  
						<li><a href="#" style="text-decoration: none;color:#000" onclick="addTab('权限列表','authority/list')">权限管理</a></li> 
    					<li><a href="#" style="text-decoration: none;color:#000" onclick="addTab('用户列表','user/list')">用户管理</a></li>
    				</ul>  
				</div> 
				<div title="图书管理"  style="padding:10px;"> 
					<ul class="easyui-tree">   
    					<li>图书列表</li>
    				</ul>   
				</div> 
			</div>
        </div>
        <div class="easyui-tabs" id="tt" data-options="region:'center',title:''" style="padding:0px;background:#eee;">
			<div title="首页" style="padding:20px;display:none">   
                首页展示   
            </div> 
        </div>
    </body>
    <script type="text/javascript">
    	//点击跳转tab添加菜单栏函数
    	function addTab(title, url){
	    	if ($('#tt').tabs('exists', title)){
	    		$('#tt').tabs('select', title);
		    	} else {
		    		var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:100%;"></iframe>';
		    		$('#tt').tabs('add',{
		    			title:title,
		    			content:content,
		    			closable:true
		    		});
		    	}
	    }

        $(document).ready(function () {
            
        });
       
    </script>
</html>