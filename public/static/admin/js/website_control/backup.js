define(["jquery", "easy-admin"], function ($, ea) {


    var Controller = {

        index: function () {
            $("#backup-index .start-backup button").on("click",function () {
                var method = $(this).attr("data-method");
                var url = window.location.href + "?method=" + method;
                var load = ea.msg.loading("备份中...");
                $("#backup-index button").attr("disabled",true);

                ea.request.post({
                        url:url,
                    },function (res) {
                        ea.msg.success(res.msg);
                        setTimeout(function () {
                            $("#backup-index button").attr("disabled",false);
                        },3000)
                        ea.msg.close(load);
                    },function (res) {
                        ea.msg.error(res.msg);
                        ea.msg.close(load);
                        setTimeout(function () {
                            $("#backup-index button").attr("disabled",false);
                        },3000)
                    }
                )
            });
            ea.listen();
        },
    };
    return Controller;
});