define(["jquery", "easy-admin"], function ($, ea) {


    var Controller = {

        index: function () {

            ea.listen();
        },
    };
    return Controller;
});