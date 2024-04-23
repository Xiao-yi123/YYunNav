define(["jquery", "easy-admin","treetable","iconPickerFa"], function ($, ea) {
    var table = layui.table,
        iconPickerFa = layui.iconPickerFa,
        treetable = layui.treetable;

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'nav.comment/index',
        delete_url: 'nav.comment/delete',
        modify_url: 'nav.comment/modify',
    };

    var Controller = {

        index: function () {
            var renderTable = function () {
                layer.load(2);
                treetable.render({
                    treeColIndex: 1,
                    treeSpid: 0,
                    homdPid: 99999999,
                    treeIdName: 'id',
                    treePidName: 'reply_id',
                    url: ea.url(init.index_url),
                    elem: init.table_elem,
                    id: init.table_render_id,
                    toolbar: '#toolbar',
                    page: true,
                    skin: 'line',

                    // @todo 不直接使用ea.table.render(); 进行表格初始化, 需要使用 ea.table.formatCols(); 方法格式化`cols`列数据
                    cols: ea.table.formatCols([[
                        {type: 'checkbox'},
                        {field: 'author', title: '昵称',width: 250,align: 'left'},
                        {field: 'email', title: '邮箱'},
                        {field: 'content', title: '内容'},
                        {field: 'create_time', title: '评论时间',sort: true},
                        {field: 'place', title: '评论地点'},
                        {field: 'status', title: '状态', templet: ea.table.switch},
                        {width: 250, title: '操作', templet: ea.table.tool,operat:['delete']},

                    ]], init),
                    done: function (res) {
                        layer.closeAll('loading');
                    }
                });
            };
            renderTable();
            ea.table.listenSwitch({filter: 'status', url: init.modify_url});

            $('body').on('click', '[data-treetable-refresh]', function () {
                renderTable();
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
