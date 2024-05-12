<?php
declare (strict_types = 1);

namespace app\admin\controller\nav;

use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use think\facade\Filesystem;

/**
 * @ControllerAnnotation(title="图片设置")
 */
class Image extends AdminController
{
    /**
     * @NodeAnotation(title="首页")
     */
    public function index(){

        return $this->fetch();
    }
    /**
     * @NodeAnotation(title="保存")
     */
    public function save(){
        if($this->request->isPost()){
            $postData = $this->request->post();
            $domain = $this->request->domain();
            if($postData['QQGroup'] != '/static/logo/QQGroup.jpg'){
                if(strpos($postData['QQGroup'],$domain) === false){
                    $this->error('请先上传图片');
                }else{
                    $path  = str_replace($domain,'',$postData['QQGroup']);
                    copy(Filesystem::disk('public')->path($path),Filesystem::disk('public')->path('/static/logo/QQGroup.jpg'));
                }
            }

            if($postData['wechat'] != '/static/logo/wechat.jpg'){
                if(strpos($postData['wechat'],$domain) === false){
                    $this->error('请先上传图片');
                }else{
                    $path  = str_replace($domain,'',$postData['wechat']);
                    copy(Filesystem::disk('public')->path($path),Filesystem::disk('public')->path('/static/logo/wechat.jpg'));
                }
            }

            $this->success('保存成功');
        }
        $this->error('请求错误');
    }
}
