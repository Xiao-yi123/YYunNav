<?php

namespace app\admin\service\define;

use app\index\model\LinksModel;
use think\facade\Filesystem;

class ImageService
{
    /**
     * @var string[]
     */
    private $UrlInterfaces=[
        "Uomg"  =>  'https://api.uomg.com/api/get.favicon?url=',
        "Btstu" =>  "https://api.btstu.cn/getfav/api.php?url=",
        "Iowen" =>  "https://api.iowen.cn/favicon/"
    ];

    /**
     * 通过API返回图片数据
     * @param $url  string 需要查询的网址URL
     * @param $API  string 需要使用哪个API链接
     * @return false|string  返回图片数据
     */
    private function APIGetImageData($url="", $API=""){
        if($API == 'random'){
            $API=array_rand($this->UrlInterfaces,1);
        }
        if($API == "Iowen"){
            $url = parse_url($url, PHP_URL_HOST).".png";
        }
        $imageUrl = $this->UrlInterfaces[$API].$url;


        $imageData = file_get_contents($imageUrl);

        return $imageData;

    }

    /**下载图片
     * @param $url string 需要查询的网址URL
     * @param $API string 需要使用哪个API链接
     * @param $path string  图片保存路径
     * @return string  文件保存路径带文件名的
     */
    public function DownloadImage($url="", $API="", $path="",$imageData = ''){
        if(!$imageData){
            $imageData = $this->APIGetImageData($url,$API);
        }


        //php截取主符串中的主域名
        $host = parse_url($url, PHP_URL_HOST);
        $hostParts = explode('.', $host);

        $mainDomain = $hostParts[count($hostParts) - 2] . '.' . $hostParts[count($hostParts) - 1];

        // 保存图片到本地文件系统
        $filePath = $path.'image_url_' . $mainDomain. '.jpg';
        Filesystem::disk('public')->put($filePath, $imageData);

        return  $filePath;
    }

    /**删除链接图片
     * @param int $LinkId 链接表ID
     * @param string $image_path 图片路径
     * @return void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function DeleteLinkImage($LinkId='',$image_path=''){
        if($LinkId){
            $LinkMode = new LinksModel();
            $image_path = $LinkMode->where('id',$LinkId)->field("image_path")->find()['image_path'];
            if(!$image_path){
                return;
            }
        }
        if(Filesystem::disk('public')->has($image_path)){
            Filesystem::disk('public')->delete($image_path);
        }

    }
}