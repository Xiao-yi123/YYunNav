define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        add_url: 'nav.icon/add',
        revise_url: 'nav.icon/revise',
        del_url: 'nav.icon/del',
    };
    var Controller = {

        index: function () {
            $('#ws-docs-icon>div').on("click",function () {
                var icon_name = $(this).find('.docs-icon-name').text();
                ea.request.get({
                    url:'revise',
                    data:{
                        'icon-name':icon_name
                    }
                },function (res) {
                    $('#icon-operate .layui-tab-content .layui-show').removeClass('layui-show');
                    $('#icon-operate .layui-tab-title .layui-this').removeClass('layui-this');

                    $('#icon-operate .layui-tab-content>div:eq(1)').addClass('layui-show');
                    $('#icon-operate .layui-tab-title>li:eq(1)').addClass('layui-this');

                    $("#form-revise input[name=\"icon-name\"]").val(icon_name);
                    $("#form-revise textarea[name=\"icon-data\"]").text(res.data['icon-base64']);
                })
            })
            ea.listen();
        },

    };
    return Controller;
});
