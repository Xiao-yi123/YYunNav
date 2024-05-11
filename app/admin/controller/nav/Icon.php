<?php
declare (strict_types = 1);

namespace app\admin\controller\nav;

use app\admin\service\define\Base64Service;
use app\admin\service\define\IconService;
use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use think\App;
/**
 * @ControllerAnnotation(title="图标管理")
 */
class Icon extends AdminController
{
    /**
     * @NodeAnotation(title="图标首页")
     */
    public function index()
    {
        $SIcon = new IconService();
        $IconList = $SIcon->getIconList();
        $this->assign('IconList',$IconList);

        return $this->fetch();
    }
    /**
     * @NodeAnotation(title="新增图标")
     */
    public function add(){
        if($this->request->isPost()){
            $data = $this->request->param();

            $SBase = new Base64Service();
            $is_Base64 = $SBase->isBase64Image($data['icon-data']);
            if(!$is_Base64){
                $this->error('您上传的不是图标数据不是 Base64 格式的');
            }

            $SIcon = new IconService();
            $Iconlist = $SIcon->getIconList();
            if(in_array($data['icon-name'],$Iconlist)){
                $this->error('该图标已经存在');
            }

            $addResule = $SIcon->addIcon($data['icon-name'],$data['icon-data']);
            if($addResule){
                $this->success("新增{$data['icon-name']}图标");
            }else{
                $this->error('增加失败');
            }
        }
        $this->error('请求出错');
    }
    /**
     * @NodeAnotation(title="修改图标")
     */
    public function revise(){
        $SIcon = new IconService();

        if($this->request->isGet()){
            $IconName = $this->request->param('icon-name');
            $data = ['icon-base64' => $SIcon->getIconBase64($IconName)];
            $this->success('',$data);
        }
        elseif($this->request->isPost()){
            $data = $this->request->param();

            $Iconlist = $SIcon->getIconList();
            if(!in_array($data['icon-name'],$Iconlist)){
                $this->error('图标不存在');
            }

            $SBase = new Base64Service();
            $is_Base64 = $SBase->isBase64Image($data['icon-data']);
            if(!$is_Base64){
                $this->error('您上传的不是图标数据不是 Base64 格式的');
            }

            $SIcon->delIcon($data['icon-name']);
            $addResule = $SIcon->addIcon($data['icon-name'],$data['icon-data']);
            if($addResule){
                $this->success("修改{$data['icon-name']}图标");
            }else{
                $this->error('修改失败');
            }
        }
        $this->error('请求出错');
    }
    /**
     * @NodeAnotation(title="删除图标")
     */
    public function del(){
        if($this->request->isPost()){
            $data = $this->request->param();

            $SIcon = new IconService();
            $Iconlist = $SIcon->getIconList();
            if(!in_array($data['icon-name'],$Iconlist)){
                $this->error('图标不存在');
            }
            $SIcon->delIcon($data['icon-name']);
            $this->error('删除成功');

        }
        $this->error('请求出错');
    }
}
