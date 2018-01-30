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
        <div data-options="region:'north',title:'',split:false" style="height:80px;"></div>
        <div data-options="region:'south',title:'南京挚信图书管理系统 V1.0',split:false" style="height:0px;"></div>
        <!--<div data-options="region:'east',title:'East',split:true" style="width:100px;"></div>-->
        <div data-options="region:'west',title:'管理菜单',split:false" style="width:150px;">
			<div class="easyui-accordion" data-options="fit:true,border:false"> 
				<div title="系统管理" style="padding:10px;"> 
					<ul id="tt" class="easyui-tree">   
    					<li><span>用户管理</span></li>
    				</ul>  
				</div> 
				<div title="图书管理" data-options="selected:true" style="padding:10px;"> 
					<ul id="tt" class="easyui-tree">   
    					<li>图书列表</li>
    				</ul>   
				</div> 
			</div>
        </div>
        <div class="easyui-tabs" id="tb" data-options="region:'center',title:''" style="padding:0px;background:#eee;">
			<div title="首页" style="padding:20px;display:none">   
                tab1   
            </div> 
        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tt').tree({
                onClick: function (node) {
                    $('#tb').tabs('add', {
                        title:  '用户管理',
                        href: 'user/list',
                        closable: true
                    });  

                }
            });
        });
       
    </script>
</html>