
define(["jquery", "easy-admin"], function ($, ea) {
    var table = layui.table,
        form = layui.form,
        upload = layui.upload;
    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'nav.link/index',
        add_url: 'nav.link/add',
        edit_url: 'nav.link/edit',
        delete_url: 'nav.link/delete',
        export_url: 'nav.link/export',
        modify_url: 'nav.link/modify',
        linkimport_url: 'nav.link/linkimport',
        other_url: 'nav.link/other',
    };



    var Controller = {
        index: function () {
            ea.table.render({
                init: init,
                toolbar: ['refresh','add','delete',[{
                    text: '导入',
                    url: init.linkimport_url,
                    method: 'open',
                    class: 'layui-btn layui-btn-sm layui-btn-success import',
                    auth:"linkimport",
                }], [{
                    text: '其他',
                    url: init.other_url,
                    method: 'open',
                    class: 'layui-btn layui-btn-normal layui-btn-sm other ',
                    auth:"other",
                }]],
                cols: [[
                    {type: 'checkbox'},
                    {field: 'id', title: 'id',search: false},
                    {field: 'navNode__name', title: '归属节点'},
                    {field: 'name', title: '接口名'},
                    {field: 'description', title: '描述',search: false},
                    {field: 'image_path', minWidth: 80, title: '链接图片', search: false, templet: ea.table.image},
                    {field: 'url', title: 'URL'},
                    {field: 'create_time', title: '录入时间',search: false},
                    {
                        field: 'status',
                        search: 'select',
                        title: '状态',
                        selectList: {0: '展示', 1: '不展示',3:"关闭"},
                        templet: function (d) {
                            if (d.status === 0) {
                                return '<span class="layui-badge layui-bg-blue">展示</span>';
                            }
                            else if (d.status === 1 || d.status ===3) {
                                return '<span class="layui-badge layui-bg-gray">不展示</span>';
                            }else if(d.status === 2){
                                return '<span class="layui-badge-rim layui-bg-orange">审核中</span>';
                            }else if (d.status === 4){
                                return '<span class="layui-badge layui-bg-red">链接不可用</span>';
                            } else {
                                return '<span class="layui-badge-rim">其他</span>';
                            }
                        }},
                    {width: 250, title: '操作', templet: ea.table.tool},
                ]],
            });


            ea.listen();
        },
        add: function () {
            var imageDiv = $("#app-form div[name='image_base64']");
            imageDiv.hide();
            form.on('select(node_id)', function(data){
                OptionType = $('#app-form select[name="node_id"] option:selected').attr("data-type");
                $("#app-form textarea[name='image_base64']").val('');
                if(OptionType === "0" || OptionType === "1" || OptionType === "2"){
                    imageDiv.hide();
                }else if(OptionType === "3" || OptionType === "4"){
                    imageDiv.show();
                }
            });
            ea.listen();
        },
        edit: function () {
            var imageDiv = $("#app-form div[name='image_base64']");
            var updateImageEle = $("#app-form a[data-name='update-image']");
            OptionType = $('#app-form select[name="node_id"] option:selected').attr("data-type");
            if(OptionType === "0" || OptionType === "1" || OptionType === "2"){
                imageDiv.hide();
            }else if(OptionType === "3" || OptionType === "4"){
                imageDiv.show();
                updateImageEle.hide();
            }

            form.on('select(node_id)', function(data){
                $("#app-form textarea[name='image_base64']").val('');
                OptionType = $('#app-form select[name="node_id"] option:selected').attr("data-type");
                if(OptionType === "0" || OptionType === "1" || OptionType === "2"){
                    imageDiv.hide();
                    updateImageEle.show();
                }else if(OptionType === "3" || OptionType === "4"){
                    imageDiv.show();
                    updateImageEle.hide();
                }
            });

            updateImageEle.on("click",function () {
                var load = ea.msg.loading("获取中...")
                url = window.location.href;
                ea.request.ajax("put",
                    {
                        url: window.location.href,
                    }, function (res) {
                        console.log("ok:",res);
                        $("#app-form img[data-name='update-image']").attr('src',res.data);
                        $("#app-form input[name='image_path']").attr("value",res.data);
                        ea.msg.close(load)
                    },function (res) {
                        ea.msg.error(res.msg);
                        ea.msg.close(load);
                    }
                );
            })
            ea.listen();
        },
        linkimport:function () {
            var ExcelData = [],
                divSuccess = $('#app-form div[data-name="success"]'),
                divError = $('#app-form div[data-name="error"]'),
                SubmitTable = function (successData,errorData) {
                    divSuccess.show();
                    divError.show();
                    table.render({
                        elem:"#success_table",
                        skin:'line',
                        cols:[[
                            {field: 'name', title: '名字'},
                            {field: 'image_path', title: '图片路径'},
                            {field: 'url', title: '链接'},
                            {field: 'description', title: '描述'},
                        ]],
                        data:successData
                    });
                    table.render({
                        elem:"#error_table",
                        skin:'line',
                        cols:[[
                            {field: 'name', title: '名字'},
                            {field: 'url', title: '链接'},
                            {field: 'reason', title: '失败原因'},
                        ]],
                        data:errorData
                    });
                };
            divSuccess.hide();
            divError.hide();
            $('#app-form a[data-name="select-file"]').on('click',function () {
                $("#app-form input[name='file']").click();
            });
            $("#app-form input[name='file']").change(function () {
                var load = ea.msg.loading("上传中...")
                var formData = new FormData();
                var file = $(this).prop('files')[0];
                formData.append('file',file);
                $.ajax({
                    url: window.location.href +"?method=file",
                    type: 'POST',
                    data: formData,
                    dataType:'json',
                    processData: false,
                    contentType : false,
                    headers:{'X-CSRF-TOKEN': window.CONFIG.CSRF_TOKEN},
                    success: function (returndata) {
                        if(returndata.code){
                            $("#app-form input[name='file_path']").attr('value',returndata.data.path);
                            ExcelData = returndata.data.ExcelData;
                            ea.msg.success(returndata.msg);
                            ea.msg.close(load);
                        }else{
                            $("#app-form input[name='file_path']").attr('value',"");
                            ea.msg.error(returndata.msg);
                            ea.msg.close(load);

                        }
                    },
                    error: function (returndata) {
                        ea.msg.error(returndata.msg)
                    }
                });
            });
            $("#app-form button[type='submit']").on("click",function () {
                var load = ea.msg.loading("上传中...")
                if(JSON.stringify(ExcelData)==='[]'){
                    ea.msg.error('请先上传文件！！！');
                    return false;
                }
                var node_id  = $("#app-form select[name='node_id']").val();
                var formData =  {
                    'file' : ExcelData,
                    "node_id" :node_id,
                };

                $.ajax({
                    url: window.location.href+"?method=submit" ,
                    type: 'POST',
                    data: formData,
                    headers:{'X-CSRF-TOKEN': window.CONFIG.CSRF_TOKEN},
                    success: function (returndata) {
                        if(returndata['code'] === 0){
                            ea.msg.error(returndata.msg)
                        }else{
                            SubmitTable(returndata.data['success'],returndata.data['error']);
                            ea.msg.success(returndata.msg)
                        }
                        ea.msg.close(load);

                    },
                    error: function (returndata) {
                        ea.msg.error(returndata.msg);
                        ea.msg.close(load);

                        console.log("失败",returndata);
                    }
                });
                return false;
            });
            ea.listen();
        },
        other: function () {
            var button = $('#link_image button');

            ea.request.get(
                {
                    url: window.location.href,
                }, function (res) {
					$("#link_image .get-all button").on("click",function(){
						var load = ea.msg.loading("获取中...");
                        button.attr("disabled",true);

						data_interface = $(this).attr('data-interface');
						data = {"interface":data_interface}
						ea.request.post({
						    url:window.location.href+"?method=get-all",
							data : data,
						    },function (res) {
                                button.attr("disabled",false);
                                ea.msg.success(res.msg);
						        ea.msg.close(load);
						    },function (res) {
						        ea.msg.error(res.msg);
                                ea.msg.close(load);

						    }
						)
					});
					
					$("#link_image .get-selected button").on("click",function(){
						var load = ea.msg.loading("获取中...")
                        button.attr("disabled",true);

						//获取选中信息
						parentTable = parent.layui.table; // 获取父页面中的 table 模块
						checkStatus = parentTable.checkStatus('currentTableRenderId'); // 获取选中行的数据
						checkedData = checkStatus.data; // 获取选中行的数据数组
                        IdAndUrl = checkedData.map(function (obj){
                            if(obj.navNode__display_type < 3)
                                return {id:obj.id,url:obj.url}
                        });

						if(IdAndUrl.length<=0){
							ea.msg.error("请选择要获取图片的链接");
							return;
						}

						// 获取interface信息
						data_interface = $(this).attr('data-interface');
						
						data = {"IdAndUrl":IdAndUrl,"interface":data_interface}
						console.log(data)
						ea.request.post({
						    url:window.location.href+"?method=get-selected",
							data : data,
						    },function (res) {
                                ea.msg.success(res.msg);
                                button.attr("disabled",false);
						        ea.msg.close(load)
						    },function (res) {
                                button.attr("disabled",false);
						        ea.msg.error(res.msg);
						    }
						)
					});

                    $("#link_image .get-not button").on("click",function () {
                        var load = ea.msg.loading("获取中...")
                        button.attr("disabled",true);

                        data_interface = $(this).attr('data-interface');
                        data = {"interface":data_interface}
                        ea.request.post({
                                url:window.location.href+"?method=get-not",
                                data : data,
                            },function (res) {
                                ea.msg.success(res.msg)
                                button.attr("disabled",false);
                                ea.msg.close(load)
                            },function (res) {
                                button.attr("disabled",false);
                                ea.msg.error(res.msg);
                            }
                        )
                    });

                    $("#link_image .examine_image button").on("click",function () {
                        var load = ea.msg.loading("获取中...")
                        button.attr("disabled",true);

                        data_interface = $(this).attr('data-interface');
                        data = {"interface":data_interface}
                        ea.request.post({
                                url:window.location.href+"?method=examine_image",
                                data : data,
                            },function (res) {
                                ea.msg.success(res.msg)
                                button.attr("disabled",false);
                                ea.msg.close(load)
                            },function (res) {
                                button.attr("disabled",false);
                                ea.msg.error(res.msg);
                            }
                        )
                    });

                    $("#operate #other-operate-form button[data-method=\"submit\"]").on("click",function () {
                        var load = ea.msg.loading("获取中...")
                        button.attr("disabled",true);

                        //获取选中信息
                        parentTable = parent.layui.table; // 获取父页面中的 table 模块
                        checkStatus = parentTable.checkStatus('currentTableRenderId'); // 获取选中行的数据
                        checkedData = checkStatus.data; // 获取选中行的数据数组
                        Ids = checkedData.map(function (obj){
                                return obj.id;
                        });

                        if(Ids.length<=0){
                            ea.msg.error("请选择要修改的数据");
                            return;
                        }

                        node_id = $("select[name='node_id'] option:selected").val();

                        data = {
                            'ids': Ids,
                            'nodeID':node_id
                        }
                        ea.request.post({
                                url:window.location.href+"?method=operate-node",
                                data : data,
                            },function (res) {
                                ea.msg.success(res.msg)
                                button.attr("disabled",false);
                                ea.msg.close(load)
                            },function (res) {
                                button.attr("disabled",false);
                                ea.msg.error(res.msg);
                            }
                        )
                    })

                });
            ea.listen();

        }
    };

    return Controller;
});

