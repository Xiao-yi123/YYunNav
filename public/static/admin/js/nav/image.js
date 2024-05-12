define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        index_url:'nav.image/index',
        save_url:'nav.image/save',
    };

    var Controller = {

        index: function () {

            ea.listen();
        },

    };
    return Controller;
});