<?php
declare (strict_types = 1);

namespace app\index\service;

use app\index\model\NodeModel;
use app\index\model\SystemAdmin;
use think\facade\Cache;
use think\facade\View;

class IndexService
{
    /**
     * 获取json文件数据并缓存
     * @param $CacheKye
     * @param $JsonFilePath
     * @param $CacheTime
     * @return mixed
     */
    public function GetJsonFileCache($CacheKye = "", $JsonFilePath = "", $CacheTime = 0){
        $CacheData = Cache::get($CacheKye,"");
        if(!$CacheData){
            $CacheData = json_decode(file_get_contents($JsonFilePath));
            Cache::set($CacheKye,$CacheData,$CacheTime);
        }
        return $CacheData;
    }

    /**
     * 获得通用数据并分配
     * @return null
     */
    public function GetUniversalData($CachTime = 10){
        $MNode = new NodeModel();

        $HeaderMenu = $this->GetJsonFileCache("HeaderMenu",'static/index/json/header_menu.json',$CachTime);
        $SidebarItem = $MNode->FgetAllNodes(['id','name','icon']);
        $SearchData = $this->GetJsonFileCache("SearchData", 'static/index/json/search_data.json',$CachTime);
        $SidebarTopItem = $this->GetJsonFileCache("SidebarTopItem",'static/index/json/sidebar_top.json',$CachTime);

        $SystemAdminMoel = new SystemAdmin();
        $AdminInfo = $SystemAdminMoel->withJoin('system_user_info',"LEFT")
                                        ->where("ea_system_admin.id",1)
                                        ->find()
                                        ->toArray();
        $field = ['head_img','systemUserInfo__nickname','systemUserInfo__sign','systemUserInfo__web','systemUserInfo__web','systemUserInfo__qq','systemUserInfo__wechat','systemUserInfo__email','create_time'];
        $AdminInfo =  array_intersect_key($AdminInfo, array_flip($field));

        View::assign("IsSSearch",false);
        View::assign("SidebarItem",$SidebarItem);
        View::assign("SearchData",$SearchData);
        View::assign("HeaderMenu",$HeaderMenu);
        View::assign("SidebarTopItem",$SidebarTopItem);
        View::assign("AdminInfo",$AdminInfo);

    }

    public function GetMiniData($CachTime = 10){
        $SearchData = $this->GetJsonFileCache("SearchData", 'static/index/json/search_data.json',$CachTime);

        View::assign("SearchData",$SearchData);

    }
}
