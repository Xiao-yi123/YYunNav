define(["jquery", "easy-admin","treetable","iconPickerFa"], function ($, ea) {
    var table = layui.table,
        iconPickerFa = layui.iconPickerFa,
        treetable = layui.treetable;

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'nav.node/index',
        add_url: 'nav.node/add',
        edit_url: 'nav.node/edit',
        delete_url: 'nav.node/delete',
        export_url: 'nav.node/export',
        modify_url: 'nav.node/modify',
        icon_url:'nav.node/icon'
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
                    treePidName: 'pid',
                    url: ea.url(init.index_url),
                    elem: init.table_elem,
                    id: init.table_render_id,
                    toolbar: '#toolbar',
                    page: false,

                    // @todo 不直接使用ea.table.render(); 进行表格初始化, 需要使用 ea.table.formatCols(); 方法格式化`cols`列数据
                    cols: ea.table.formatCols([[
                        {type: 'checkbox'},
                        {field: 'name', title: '类名', align: 'left'},
                        {field: 'icon', title: '图标标签',templet: ea.table.icon},
                        {field: 'display_type', title: '显示类型',selectList: ['',"default","mini","book","app"]},
                        {field: 'count', title: '接口数量'},
                        {field: 'status', search: 'select', selectList: ["不展示","展示"], title: '状态', templet: ea.table.switch},
                        {field: 'create_time', title: '创建时间'},
                        {width: 250, title: '操作', templet: ea.table.tool},
                    ]], init),
                    done: function () {
                        layer.closeAll('loading');
                    }
                });
            };

            renderTable();

            $('body').on('click', '[data-treetable-refresh]', function () {
                renderTable();
            });

            $('body').on('click', '[data-treetable-delete]', function () {
                var tableId = $(this).attr('data-treetable-delete'),
                    url = $(this).attr('data-url');
                tableId = tableId || init.table_render_id;

                url = url != undefined ? ea.url(url) : window.location.href;

                var checkStatus = table.checkStatus(tableId),
                    data = checkStatus.data;
                if (data.length <= 0) {
                    ea.msg.error('请勾选需要删除的数据');
                    return false;
                }

                var ids = [];
                $.each(data, function (i, v) {
                    ids.push(v.id);
                });
                ea.msg.confirm('确定删除？', function () {
                    ea.request.post({
                        url: url,
                        data: {
                            id: ids
                        },
                    }, function (res) {
                        ea.msg.success(res.msg, function () {
                            renderTable();
                        });
                    });
                });
                return false;
            });

            ea.table.listenSwitch({filter: 'status', url: init.modify_url});

            ea.listen();
        },
        add: function () {
            iconPickerFa.render({
                elem: '#icon',
                url: ea.url(init.icon_url),
                limit: 12,
                click: function (data) {
                    $('#icon').val('fa ' + data.icon);
                },
                success: function (d) {
                    console.log(d);
                }
            });
            $('#app-form input[name="icon"]').on('input propertychange',function () {
                input_val = $(this).val();
                $('#app-form i[data-name="icon-show"]').attr("class","fa "+input_val);
            })
            ea.listen();
        },
        edit: function () {
            iconPickerFa.render({
                elem: '#icon',
                url: ea.url(init.icon_url),
                limit: 12,
                click: function (data) {
                    $('#icon').val('fa ' + data.icon);
                },
                success: function (d) {
                    console.log(d);
                }
            });
            ea.listen();
        }
    };
    return Controller;

});