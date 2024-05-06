<?php

namespace app\admin\controller\nav;

use app\common\controller\AdminController;
use app\admin\model\nav\NodeModel;
use app\admin\service\define\Base64Service;
use app\admin\service\define\FileService;
use app\admin\service\define\ImageService;
use think\App;
use think\Exception;


/**
 * @ControllerAnnotation(title="接口表")
 */
class Link extends AdminController
{

    use \app\admin\traits\Curd;

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->prefix =  config("database.connections.mysql.prefix");

        $this->model = new \app\admin\model\nav\LinksModel();

        $this->assign('getStatusList', $this->model->getStatusList());
        $this->Image = new ImageService();
        $this->NodeModel = new NodeModel();
        $this->pidMenuList = $this->NodeModel->getPidMenuList();

    }
    /**
     * @NodeAnotation(title="列表")
     */

    public function index()
    {
        if ($this->request->isAjax()) {
            if (input('selectFields')) {

                    return $this->selectList();

            }
            list($page, $limit, $where) = $this->buildTableParames();
            try{
                $where = $this->model->FormatWhere($where);

                $count = $this->model
                    ->withJoin('nav_node', 'LEFT')
                    ->where($where)
                    ->count();

                $list = $this->model
                    ->withJoin('nav_node', 'LEFT')
                    ->where($where)
                    ->page($page, $limit)
                    ->order([
                        'id' => 'esc',
                    ])
                    ->select();

                foreach ($list as $key=>$vo){
                    if($vo['node_id'] == 0){
                        $list[$key]['navNode__name'] = '友链';

                    }
                }

                $data = [
                    'code'  => 0,
                    'msg'   => '',
                    'count' => $count,
                    'data'  => $list,
                ];
                return json($data);
            }
            catch(\Exception $e){
                $data = [
                    'code'  => 0,
                    'msg'   => '',
                    'count' => 0,
                    'data'  => [],
                ];
                return json($data);
            }
        }

        return $this->fetch();
    }
    /**
     * @NodeAnotation(title="添加")
     */
    public function add()
    {
        if($this->request->isGet()){
            $pidMenuList = $this->NodeModel->revisePidMenuList($this->pidMenuList,true,true);

            $this->assign('pidMenuList', $pidMenuList);
            return $this->fetch();
        }elseif ($this->request->isPost()) {
            $post = $this->request->post();
            $path = $this->model->getImagePath(0,$post['node_id']);

            try {
                //新增链接判断是否可以展示
                $post['status'] = $this->model->NodeIsStatus($post);
                $valData = [
                    'name'  => $post['name'],
                    'description' => $post['description'],
                    'url'   =>  $post['url']
                ];

                if($post['image_base64']){
                    $valData['image_base64'] = $post['image_base64'];
                }

                $this->model->validate($valData,true,true);

                if($post['image_base64']){
                    $Base64 = new Base64Service();
                    $post['image_path'] = $Base64->Base64ToImage($post['image_base64'],$path,$post['url']);
                }else{
                    $post['image_path'] = $this->Image->DownloadImage($post['url'],"random",$path);
                }

                $save = $this->model->save($post);
            } catch (\Exception $e) {
                $this->error('添加失败:'.$e->getMessage());
            }
            $save ? $this->success('添加成功') : $this->error('添加失败');
        }

    }
    /**
     * @NodeAnotation(title="编辑")
     */
    public function edit($id)
    {
        $row = $this->model->find($id);
        empty($row) && $this->error('数据不存在');
        if($this->request->isGet()){
            $pidMenuList = $this->NodeModel->revisePidMenuList($this->pidMenuList,true,true);

            $this->assign('pidMenuList', $pidMenuList);
            $this->assign('row', $row);
            return $this->fetch();
        }
        elseif ($this->request->isPost()) {
            $post = $this->request->post();

            $valData = [
                'name'  => $post['name'],
                'url'   => $post['url'],
                'description' => $post['description'],
            ];

            if($post['image_base64']){
                $valData['image_base64'] = $post['image_base64'];
            }

            $isDisplay = $this->model->NodeIsStatus($post);
            if($isDisplay == 3){
                $this->error('所在分类不展示，不可修改');
            }

            try {
                $this->model->validate($valData);

                if($post['image_base64']){
                    $Base64 = new Base64Service();
                    $path = $this->model->getImagePath($id);
                    $post['image_path'] = $Base64->Base64ToImage($post['image_base64'],$path,$post['url']);

                    $row->save([
                        'image_path' => $post['image_path']
                    ]);
                }
                //从申请友链到展示
                $this->model->FriendLinkApplication($row,$post);
                //修改了分类
                if($row['node_id'] != $post['node_id']){
                    $post['image_path'] = $this->model->CategoryModified($post['node_id'],$row);
                }
                $save = $row->save($post);
            } catch (\Exception $e) {
                $this->error('保存失败:'.$e->getMessage());
            }
            $save ? $this->success('保存成功') : $this->error('保存失败');
        }
        elseif($this->request->isPut()){
            //更新图片
            $LinkData = $this->model->where("id",$id)->find();
            try{
                $path = $this->model->getImagePath($id);

                $this->Image->DeleteLinkImage($id);

                $LinkData['image_path'] = $this->Image->DownloadImage($LinkData['url'],"random",$path);
                $LinkData->save();
            }catch (\Exception $e){
                $this->error('获取失败:'.$e->getMessage());
            }


            $this->success('更新成功',$LinkData['image_path']);
        }

    }
    /**
     * @NodeAnotation(title="导入")
     */
    public function linkimport($method=""){
        if($this->request->isGet()){
            $pidMenuList = $this->NodeModel->revisePidMenuList($this->pidMenuList,true,false);

            $this->assign('pidMenuList', $pidMenuList);
            return $this->fetch();
        }elseif ($this->request->isPost()){
            if($method == "file"){
                $file = $this->request->file('file');
                $FileS = new FileService();

                try{
                    $Extension = $file->getOriginalExtension();
                    if(!($Extension == "xlsx")){
                        $this->error("提交的文件类型不支持");
                    }
                    $ExcelData = $FileS->ExamineExcel($file);

                    if(!$ExcelData){
                        throw new Exception("对不起！上传的表格缺少数据，请完善后上传");
                    }

                    if(!(count($ExcelData[0])==3 || count($ExcelData[0])==4)){
                        throw new Exception("对不起！上传的表格不符合要求，请查看示例按要求上传");
                    }

                    $result['ExcelData'] = $ExcelData;
                    $result['path'] = $file->getPathname();
                }catch (\Exception $e){
                    $this->error('上传失败:'.$e->getMessage());
                }

                $this->success('上传成功',$result);
            }elseif ($method == 'submit'){
                $post = $this->request->param();

                $success  = [];
                $error = [];

                $isDisplay = $this->model->NodeIsStatus([
                    "node_id"   =>  $post['node_id'],
                    'status'    =>  0
                ]);
                if($isDisplay == 3){
                    $this->error('所在分类不展示，不可修改');
                }

                $path = $this->model->getImagePath(0,$post['node_id']);

                $linkdatas = [];
                foreach($post['file'] as $vo){
                    try {
                        $linkdata = count($vo)==3?['name'  => $vo[0],'url'   =>  $vo[1],'description' => $vo[2]]
                            :['name'  => $vo[0],'url'   =>  $vo[1],'description' => $vo[2],'image_base64'=>$vo[3]];
                        $this->model->validate($linkdata,true,true);

                        if(count($vo)==3)
                            $linkdata['image_path'] = $this->Image->DownloadImage($vo[1],"random",$path);
                        else{
                            $BaseS = new Base64Service();
                            $linkdata['image_path'] = $BaseS->Base64ToImage($vo[3],$path,$vo[1]);
                        }
                        $linkdata['node_id'] = $post['node_id'];

                        $linkdatas[] = $linkdata;
                        $success[] = [
                            'name'  =>  $linkdata['name'],
                            'description'  =>  $linkdata['description'],
                            'image_path'  =>  $linkdata['image_path'],
                            'url'  =>  $linkdata['url'],
                        ];
                    } catch (\Exception $e) {
                        $error[] = [
                            'name'  =>  $vo[0],
                            'url'   =>  $vo[1],
                            'reason'    =>  $e->getMessage(),
                        ];
                    }
                }
                try{
                    $this->model->saveAll($linkdatas);
                }catch (\Exception $e) {
                    $this->error('导入失败：',$e->getMessage());
                }

                $result = [
                    'success'   =>  $success,
                    'error'     =>  $error
                ];
                $this->success("导入成功",$result);
            }


        }
    }
    /**
     * @NodeAnotation(title="删除")
     */
    public function delete($id)
    {
        $this->checkPostRequest();
        $row = $this->model->whereIn('id', $id)->select();
        $row->isEmpty() && $this->error('数据不存在');
        try {
            foreach ($row as $vo){
                $this->Image->DeleteLinkImage(null,$vo['image_path']);
            }
            $save = $row->delete();
        } catch (\Exception $e) {
            $this->error('删除失败'.$e->getMessage());
        }
        $save ? $this->success('删除成功') : $this->error('删除失败');
    }
    /**
     * @NodeAnotation(title="其他操作")
     * @CrossOrigin
     */
    public function other($method="")
    {

        if ($this->request->isAjax()) {

            $Data = $this->request->param();

            if($method == 'get-all'){
                try {
                    $LinkDatas = $this->model->withJoin('navNode','LEFT')
                        ->where([
                            [$this->prefix.'nav_links.status','=',0],
                            [$this->prefix.'nav_links.node_id','<>',0],
                            ['navNode.status','=',1],
                            ['navNode.display_type','<',3]
                        ])
                        ->select();
                }catch (\Exception $e){
                    $this->error("获取失败".$e->getMessage());
                }

                $successCount = $errorCount = 0;

                foreach ($LinkDatas as $linkVo){
                    try{
                        $linkVo['image_path'] = $this->Image->DownloadImage($linkVo['url'],$Data['interface'],$this->model->getImagePath($linkVo['id']));

                        $linkVo->save();
                        $successCount ++;
                    }catch (\Exception $e){
                        $errorCount ++;
                    }
                }
                $this->success('获取成功'.$successCount.'个,获取失败'.$errorCount.'个');
            }
            elseif($method == "get-selected"){
                $IdAndUrl = $Data["IdAndUrl"];
                $successCount = $errorCount = 0;

                foreach ($IdAndUrl as $Vo){
                    try{
                        $image_path = $this->Image->DownloadImage($Vo['url'],$Data['interface'],$this->model->getImagePath($Vo['id']));
                        $this->model->find($Vo['id'])->save([
                            'image_path'    =>  $image_path
                        ]);
                        $successCount ++;
                    }catch (\Exception $e){
                        $errorCount ++;
                    }
                }

                $this->success('获取成功'.$successCount.'个,获取失败'.$errorCount.'个');

            }
            elseif($method == "get-not"){
                try {
                    $this->model->ExamineImagePathSQL();
                    $this->model->ExamineImagePathFile();

                    $LinkDatas = $this->model->withJoin('navNode','LEFT')
                        ->where([
                            [$this->prefix.'nav_links.image_path','=',null],
                            [$this->prefix.'nav_links.status','=',0],
                            [$this->prefix.'nav_links.node_id','<>',0],
                            ['navNode.status','=',1],
                            ['navNode.display_type','<',3]
                        ])
                        ->select();
                }catch (\Exception $e){
                    $this->error("获取失败".$e->getMessage());
                }
                $successCount = $errorCount = 0;

                foreach ($LinkDatas as $linkVo){
                    try{
                        $linkVo['image_path'] = $this->Image->DownloadImage($linkVo['url'],$Data['interface'],$this->model->getImagePath($linkVo['id']));
                        $linkVo->save();
                        $successCount++;
                    }catch (\Exception $e){
                        $errorCount++;
                    }
                }
                $this->success('获取成功'.$successCount.'个,获取失败'.$errorCount.'个');

            }
            elseif($method == 'examine_image'){
                if($Data['interface'] == 'sql'){

                    $this->model->ExamineImagePathSQL();

                    $this->success('检查完成');
                }elseif($Data['interface'] == 'file'){
                    $this->model->ExamineImagePathFile();

                    $this->success("检查完成");
                }
            }
            elseif($method == 'operate-node'){
                $links = $this->model->whereIn('id',$Data['ids'])->select();
                $links->each(function ($vo) use ($Data){
                    $vo->node_id = $Data['nodeID'];
                    $vo->save();
                });
                $this->success('修改成功');
            }
            else{
                $this->success();
            }
        }

        $pidMenuList = $this->NodeModel->revisePidMenuList($this->pidMenuList,true,true);
        $this->assign('pidMenuList',$pidMenuList);
        return $this->fetch();
    }

}