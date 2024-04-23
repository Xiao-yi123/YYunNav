define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#FromServerTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'WebsiteControl.reduction/index',
        reduction_url:"WebsiteControl.Reduction/reduction",
        download_url:"WebsiteControl.Reduction/download",
        delete_url: 'WebsiteControl.reduction/delete',

    };

    var Controller = {

        index: function () {
            var upload = layui.upload;
            ea.table.render({
                init: init,
                toolbar:[],
                search:false,
                cols: [[
                    {field: 'filename', title: '文件名',search:false},
                    {field: 'basename', title: '基本名称',search:false},
                    {field: 'size', title: '大小',search:false},
                    {field: 'extension', title: '后缀名',search:false},
                    {field: 'timestamp', title: '时间',search:false},
                    {
                        width: 250,
                        title: '操作',
                        templet: ea.table.tool,
                        operat: [
                            [{
                                text: '下载',
                                url: init.download_url,
                                method: 'none',
                                auth: 'download',
                                class: 'layui-btn layui-btn-xs layui-btn-success download',
                                extend: `onclick="this.href=window.location.origin+'/admin/${init.download_url}'+'?'+nextElementSibling.getAttribute('data-request').split('?')[1];" target="_blank" `,
                            },{
                                text: '还原',
                                title:'您确定要还原此文件吗？',
                                url: init.reduction_url,
                                method: 'request',
                                auth: '',
                                class: 'layui-btn layui-btn-xs layui-btn-success',
                                extend: 'data-full="true"',
                            }],'delete']
                    }

                ]],
            });

            upload.render({
                elem: '.upload_file', // 绑定多个元素
                url: 'upload', // 此处配置你自己的上传接口即可
                headers:{'X-CSRF-TOKEN': window.CONFIG.CSRF_TOKEN},
                accept: 'file', // 普通文件
                size: 1024*8, // 限制文件大小，单位 KB
                done: function(res){
                    if(res['code'] === 1){
                        ea.msg.success(res['msg']);
                    }else{
                        ea.msg.error(res['msg']);
                    }

                    console.log(res);
                },error:function (res) {
                    ea.msg.error('上传错误:'+res['msg'])
                }
            });

            ea.listen();
        },
    };

    return Controller;
});