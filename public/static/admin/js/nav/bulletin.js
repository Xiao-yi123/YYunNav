define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'nav.bulletin/index',
        add_url: 'nav.bulletin/add',
        edit_url: 'nav.bulletin/edit',
        delete_url: 'nav.bulletin/delete',
        export_url: 'nav.bulletin/export',
        modify_url: 'nav.bulletin/modify',
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                toolbar:['refresh',
                [{
                    text: '发布',
                    url: init.add_url,
                    method: 'open',
                    auth: 'add',
                    class: 'layui-btn layui-btn-normal layui-btn-sm',
                    icon: 'fa fa-plus ',
                    extend: 'data-full="true"',
                }],
                'delete'],
                cols: [[
                    {type: 'checkbox'},
                    {field: 'systemadmin.username', title: '发布者',search:false},
                    {field: 'title', title: '标题'},
                    {field: 'content', title: '内容'},
                    {field: 'top', search: 'select', selectList: ["不置顶","置顶"], title: '置顶'},
                    {field: 'status', search: 'select', selectList: ["隐藏","展示"], title: '状态', templet: ea.table.switch},
                    {field: 'create_time', title: '发布时间',search:false,sort:true},
                    {width: 250, title: '操作', templet: ea.table.tool},

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