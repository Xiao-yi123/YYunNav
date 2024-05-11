<?php
declare (strict_types = 1);

namespace app\admin\service\define;

use app\admin\controller\nav\Node;

class IconService
{
    public function __construct()
    {
        $this->IconFilePath = public_path('static/index/wp-content/themes/onenav/css').'my-iconfont.css';
    }

    /**获取图标列表
     * @return string[]
     */
    public function getIconList(){
        $cssContent = file_get_contents($this->IconFilePath);
        // 使用正则表达式匹配所有以 "fa-var" 开头的类名
        preg_match_all('/\.fa-([^\s,:{]+)/', $cssContent, $matches);

        return $matches[1];
    }

    /**新增图标
     * @param $name  图标名
     * @param $data  图标数据 base64格式
     * @return bool
     */
    public function addIcon($name, $data){
        $str = ".fa-{$name}{
    display: inline-block;
    width: 20px;
    height: 20px;
    background: url('{$data}') 50% 50% no-repeat;
    background-size: 100%;
}\n";
        // 检查文件是否可写
        if (is_writable($this->IconFilePath)) {
            // 打开文件准备写入，'a' 模式表示追加到文件末尾
            $fileHandle = fopen($this->IconFilePath, 'a');

            // 写入数据
            fwrite($fileHandle, $str);

            // 关闭文件句柄
            fclose($fileHandle);
            return true;
        } else {
            return false;
        }
    }

    /**删除图标
     * @param $name 图标名
     * @return Node
     */
    public function delIcon($name){
        $cssContent = file_get_contents($this->IconFilePath);
        // 使用正则表达式匹配所有以 "fa-var" 开头的类名
        preg_match_all("/(\.fa-{$name}\s*\{[^}]*\})/s", $cssContent, $matches);
        $str = ".fa-{$name}\{\}";
        $content = file_get_contents($this->IconFilePath);
        $updatedContent = str_replace($matches[1], '', $content);
        file_put_contents($this->IconFilePath, $updatedContent);
    }

    /**获取图标 Base64 数据
     * @param $name 图标名
     * @return string[]
     */
    public function getIconBase64($name){
        $cssContent = file_get_contents($this->IconFilePath);
        // 使用正则表达式匹配所有以 "fa-var" 开头的类名
        preg_match_all("/\.fa-{$name}\s*\{[^}]*?background[^;]*?url\('([^)]+)'\)[^}]*?\}/", $cssContent, $matches);

        return $matches[1][0];
    }
}
