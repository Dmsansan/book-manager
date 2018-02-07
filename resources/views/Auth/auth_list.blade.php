    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Basic DataGrid - jQuery EasyUI Demo</title>
        <link rel="stylesheet" type="text/css" href="../resources/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="../resources/themes/icon.css">
        <script type="text/javascript" src="../resources/js/jquery.min.js"></script>
        <script type="text/javascript" src="../resources/js/jquery.easyui.min.js"></script>
    </head>
    <body>
            <table  id="bg" class="easyui-datagrid" title="" 
                    data-options="rownumbers:false,
                    singleSelect:true,
                    collapsible:true,
                    url:'../authority/getAuthList',
                    method:'get',
                    toolbar:toolbar,
                    pagination:true,
                    pageSize:10,
                    nowrap:true,
                    idField:'authID',
                    loadMsg:'数据正在加载，请稍后.......',">
                <thead>
                    <tr>
                        <th data-options="field:'authID',sortable:true,resizable:false">序号</th>
                        <th data-options="field:'authName',align:'center',resizable:false">权限名称</th>
                        <th data-options="field:'rangeTitle',align:'center',resizable:false">管理范围</th>
                        <th data-options="field:'editTitle',align:'center',resizable:false">操作权限</th>
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
                            title: '添加权限',    
                            width: 530,    
                            height: 300,    
                            closed: false,    
                            cache: false,    
                            href: '../authority/authAddView?authID=0', 
                            modal: true,
                            buttons : [ {
                                id : "sure",
                                text : "确认",
                                handler : function() {
                                    $('#ff').form('submit', {    
                                        url:'../authority/changeAuthInfo',  
                                        onSubmit: function(param){    
                                            param.type="insert"; 
                                            param.managerValue=$('#manager').combobox('getValues'); 
                                            param.managerTitle=$('#manager').combobox('getText');
                                            param.editValue=$('#edit').combobox('getValues'); 
                                            param.editTitle=$('#edit').combobox('getText');  
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
                                    url:'../deleteUser',
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
                            href: '../authority/authAddView?authID='+row.authID, 
                            modal: true,
                            buttons : [ {
                                id : "sure",
                                text : "确认",
                                handler : function() {
                                    $('#ff').form('submit', {    
                                        url:'../authority/changeAuthInfo',  
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