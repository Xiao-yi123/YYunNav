<?php
declare (strict_types = 1);
namespace app\common\service;
class ApiService
{
    /**获取 IP 信息
     * API接口：https://api.vvhan.com/
     * @param $ip  指定IP
     * @return mixed
     */
    public function getIpInfo($ip = ''){
        $url = "https://api.vvhan.com/api/ipInfo";
        if($ip){
            $url .= "?ip=".$ip;
        }
        $ipInfo = file_get_contents($url);
        return json_decode($ipInfo,true);
    }
}
