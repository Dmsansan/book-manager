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

            <table id="bg" class="easyui-datagrid" title="" 
                    data-options="rownumbers:true,singleSelect:true,collapsible:true,url:'findUserList',method:'get',toolbar:toolbar">
                <thead>
                    <tr>
                        <th data-options="field:'userID',width:80">序号</th>
                        <th data-options="field:'userName',width:100">用户名</th>
                        <th data-options="field:'name',width:80,align:'right'">姓名</th>
                        <th data-options="field:'phone',width:80,align:'right'">联系方式</th>
                        <th data-options="field:'qq',width:250">QQ</th>
                        <th data-options="field:'address',width:60,align:'center'">居住地</th>
                    </tr>
                </thead>
            </table>
    
        <script type="text/javascript">
        // $(document).ready(function(){
        // //加载数据
        // $.ajax({
        //     url:'findUserList',
        //     type:'get',
        //     dataType:'json',
        //     success:function(res){
              
        //         $('#bg').datagrid('loadData',res.data);
        //         console.log(data.length);
        //     },
        //     error:function(res){

        //     }
        // })
            
        
        // })
        //工具栏
            var toolbar = [{
                text:'添加',
                iconCls:'icon-add',
                handler:function(){alert('add')}
            },{
                text:'删除',
                iconCls:'icon-cut',
                handler:function(){alert('cut')}
            },'-',{
                text:'编辑',
                iconCls:'icon-save',
                handler:function(){alert('save')}
            }];
    </script>
    </body>
    </html>