define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'system.user_info/index',
        add_url: 'system.user_info/add',
        edit_url: 'system.user_info/edit',
        delete_url: 'system.user_info/delete',
        export_url: 'system.user_info/export',
        modify_url: 'system.user_info/modify',
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                toolbar:['refresh','delete'],
                cols: [[
                    {type: 'checkbox'},
                    {field: 'username', title: '登录名'},
                    {field: 'nickname', title: '昵称'},
                    {field: 'sign', title: '签名'},
                    {field: 'web', title: '个人网站'},
                    {field: 'qq', title: 'QQ'},
                    {field: 'wechat', title: '微信'},
                    {field: 'email', title: '邮箱'},
                    {width: 250, title: '操作', templet: ea.table.tool,operat: ['edit']},
                ]],
            });

            ea.listen();
        },
        add: function () {
            ea.listen();
        },
        edit: function () {
            ea.listen();
        },
    };
    return Controller;
});