<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', 'admin/login/index');
Route::group('/',function (){
//    首页
    Route::rule("",'index/index');
//    go
    Route::rule('go','Index/go');
//    ajax访问
    Route::rule("ajax",'index/ajax');
});

//    留言
Route::group('/Message/',function (){
    Route::rule('Message','Message/index');
});

//    网站提交
Route::group('/WebSubmit/',function (){
    Route::rule('','WebSubmit/index');
});
//    通知
Route::group('/Bulletin/',function (){
    Route::rule('','Bulletin/index');
    Route::rule('all','Bulletin/all');

});

//    权限
Route::group('/Author/',function (){
    Route::rule('','Author/index');
});

//    免责声明
Route::group('/Disclaimer/',function (){
    Route::rule('','Disclaimer/index');
});

//    Mini书签
Route::group('/Mini/',function (){
    Route::rule('','Mini/index');
});