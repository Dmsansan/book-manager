    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Basic DataGrid - jQuery EasyUI Demo</title>
        <link rel="stylesheet" type="text/css" href="./resources/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="./resources/themes/icon.css">
        <script type="text/javascript" src="./resources/js/jquery.min.js"></script>
        <script type="text/javascript" src="./resources/js/jquery.easyui.min.js"></script>
    </head>
    <body>

            <table  id="bg" class="easyui-datagrid" title="" 
                    data-options="rownumbers:false,
                    singleSelect:true,
                    collapsible:true,
                    url:'findUserList',
                    method:'get',
                    toolbar:toolbar,
                    pagination:true,
                    pageSize:10,
                    nowrap:true,
                    idField:'userID',
                    loadMsg:'数据正在加载，请稍后.......',">
                <thead>
                    <tr>
                        <th data-options="field:'userID',sortable:true,resizable:false">序号</th>
                        <th data-options="field:'userName',resizable:false">用户名</th>
                        <th data-options="field:'name',align:'right',resizable:false">姓名</th>
                        <th data-options="field:'sex',align:'right',resizable:false,formatter: function(value,row,index){
                                                                                                        if(value==1){
                                                                                                            return '男';
                                                                                                        }else if(value==0){
                                                                                                            return '女';
                                                                                                        }else{
                                                                                                            return '未知';
                                                                                                        } }">性别</th>
                        <th data-options="field:'phone',align:'right',resizable:false">联系方式</th>
                        <th data-options="field:'qq',resizable:false">QQ</th>
                        <th data-options="field:'email',resizable:false">Email</th>
                        <th data-options="field:'address',align:'center',resizable:false">居住地</th>
                        <th data-options="field:'addStamp',align:'center',resizable:false">添加日期</th>
                    </tr>
                </thead>
            </table>
            <div id="dd" style="background-color:#E0ECFF"></div> 
        <script type="text/javascript">
            var toolbar = [{
                text:'添加',
                iconCls:'icon-add',
                handler:function(){
                    $('#dd').dialog({    
                            title: '添加用户',    
                            width: 530,    
                            height: 300,    
                            closed: false,    
                            cache: false,    
                            href: 'userAddView?userID=0', 
                            modal: true,
                            buttons : [ {
                                id : "sure",
                                text : "确认",
                                handler : function() {
                                    $('#ff').form('submit', {    
                                        url:'changeUserInfo',  
                                        onSubmit: function(param){    
                                            param.type="insert";    
                                        },    
                                        success:function(data){ 
                                            var data = eval('('+data+')');   
                                            if(data.code==104){
                                                $.messager.alert('提示',data.msg,'info',function(){
                                                    $('#dd').dialog("close");
                                                    $('#bg').datagrid('reload');
                                                });
                                            }else{
                                                $.messager.alert('提示',data.msg,'error');
                                            }  
                                        }    
                                    }); 
                                }},
                                {
                                    id:"cancle",
                                    text:'取消',
                                    handler:function(){
                                        $('#dd').dialog("close");
                                    }
                                }],  
                        });   
                }
            },{
                text:'删除',
                iconCls:'icon-cut',
                handler:function(){
                    var row = $('#bg').datagrid('getSelected');
                    if(row){
                        $.messager.confirm('提示', '确定删除这条记录?', function(r){
                            if (r){
                                $.ajax({
                                    url:'deleteUser',
                                    type:'post',
                                    dataType:'json',
                                    data:{'userID':row.userID},
                                    success:function(data){
                                         $.messager.alert('提示',data.msg,'info',function(){
                                                    $('#bg').datagrid('reload');
                                                });
                                    },
                                    error:function(data){
                                        $.messager.alert('提示','服务器异常！','error');
                                    }
                                })
                            }
                        });
                    }else{
                        $.messager.alert('提示','请选择需要删除的数据','error'); 
                    }
                }
            },'-',{
                text:'编辑',
                iconCls:'icon-save',
                handler:function(){
                    var row = $('#bg').datagrid('getSelected');
                    if(row){
                         $('#dd').dialog({    
                            title: '编辑用户',    
                            width: 530,    
                            height: 300,    
                            closed: false,    
                            cache: false,    
                            href: 'userAddView?userID='+row.userID, 
                            modal: true,
                            buttons : [ {
                                id : "sure",
                                text : "确认",
                                handler : function() {
                                    $('#ff').form('submit', {    
                                        url:'changeUserInfo',  
                                        onSubmit: function(param){    
                                            param.type="update";    
                                        },    
                                        success:function(data){ 
                                            var data = eval('('+data+')');   
                                            if(data.code==102){
                                                $.messager.alert('提示',data.msg,'info',function(){
                                                    $('#dd').dialog("close");
                                                    $('#bg').datagrid('reload');
                                                });
                                            }else{
                                                $.messager.alert('提示',data.msg,'error');
                                            }  
                                        }    
                                    }); 
                                }},
                                {
                                    id:"cancle",
                                    text:'取消',
                                    handler:function(){
                                        $('#dd').dialog("close");
                                    }
                                }],  
                        });   
                    }else{
                        $.messager.alert('提示','请选择需要编辑的数据','error');
                    }
                }
            }]; 
              
    </script>
    </body>
    </html>