<?php

namespace app\admin\controller\nav;

use app\common\controller\AdminController;
use think\App;

/**
 * @ControllerAnnotation(title="分类表")
 */
class Node extends AdminController
{

    use \app\admin\traits\Curd;

    protected $allowModifyFileds = ['create_time'];

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->model = new \app\admin\model\nav\NodeModel();
        
        $this->assign('getStatusList', $this->model->getStatusList());
        $this->assign('getDisplayTypeList', $this->model->getDisplayTypeList());


    }
    /**
     * @NodeAnotation(title="列表")
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            list($page, $limit, $where) = $this->buildTableParames();

            $list = $this->model
                ->where($where)
                ->order($this->sort)
                ->select()->toArray();
            $linkList = $this->model->navLinks()->select()->toArray();
            $idCounts = array_count_values(array_column($linkList, 'node_id'));
            foreach ($list as $key=>$value){
                try{
                    $list[$key]['count'] = $idCounts[$value['id']];
                }catch (\Exception $e){
                    $list[$key]['count'] = 0;
                }
            }
            $data = [
                'code'  => 0,
                'msg'   => '',
                'data'  => $list,
            ];
            return json($data);
        }
        return $this->fetch();
    }
    /**
     * @NodeAnotation(title="添加")
     */
    public function add($id = null)
    {
        if ($this->request->isPost()) {
            $post = $this->request->post();

            $isIcon = false;
            if($post['pid'] == 0){
                $isIcon = true;
            }
            try {
                $this->model->validate($post,true, $isIcon);

                $save = $this->model->save($post);
            } catch (\Exception $e) {
                $this->error('添加失败:'.$e->getMessage());
            }
            $save ? $this->success('添加成功') : $this->error('添加失败');
        }
        $pidMenuList = $this->model->getPidMenuList(['id','name','pid','display_type'],false);
        $displayTypeList = $this->model->getDisplayTypeList();
        $this->assign('id', $id);
        $this->assign('pidMenuList', $pidMenuList);
        $this->assign('displayTypeList', $displayTypeList);
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="编辑")
     */
    public function edit($id)
    {
        $row = $this->model->find($id);
        empty($row) && $this->error('数据不存在');
        if ($this->request->isPost()) {
            $post = $this->request->post();

            if($post['pid'] == $id){
                $this->error("归属节点不能归属于自己");
            }

            $isIcon = false;
            if($post['pid'] == 0){
                $isIcon = true;
            }


            try {
                $this->model->validate($post,false, $isIcon);
                if($post['pid'] == 0){
                    $this->model->where("pid",$id)->find();
                }
                if($post['status'] != $row['status']){
                    $Rdata = [
                        'id'    =>  $id,
                        'value'    =>  $post['status'],
                        'field' =>  'status'
                    ];
                    $this->model->modifyStatus($Rdata);
                }
                $save = $row->save($post);
                $this->model->CheckOneNode($id);
            } catch (\Exception $e) {
                $this->error('修改失败：'.$e->getMessage());
            }

            $this->success('修改成功');
        }
        $pidMenuList = $this->model->getPidMenuList(['id','name','pid','display_type'],false);
        $displayTypeList = $this->model->getDisplayTypeList();

        $this->assign([
            'id'          => $id,
            'pidMenuList' => $pidMenuList,
            'row'         => $row,
            'displayTypeList'   =>  $displayTypeList,
        ]);
        return $this->fetch();
    }
    /**
     * @NodeAnotation(title="属性修改")
     */
    public function modify()
    {
        $this->checkPostRequest();
        $post = $this->request->post();

        $row = $this->model->find($post['id']);
        if (!$row) {
            $this->error('数据不存在');
        }
        if (!in_array($post['field'], $this->allowModifyFields)) {
            $this->error('该字段不允许修改：' . $post['field']);
        }
        try {
            if($post['field'] == "status")
                $this->model->modifyStatus($post);
            $row->save([
                $post['field'] => $post['value'],
            ]);
            $this->model->CheckOneNode($post['id']);

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->success('修改成功');

    }

    /**
     * @NodeAnotation(title="删除")
     */
    public function delete($id)
    {
        $this->checkPostRequest();

        $ChildNode = $this->model->IsChildNode($id);
        if($ChildNode){
            $this->error("删除失败,此节点下还有子节点存在");
        }

        $row = $this->model->whereIn('id', $id)->select();
        $row->isEmpty() && $this->error('数据不存在');

        try {
            $save = 1;
            foreach ($row as $key=>$value){
                $linksRow = $this->model->navLinks()->where("node_id",$value['id'])->find();
                if($linksRow){
                    $save = 0;
                }else{
                    $value->delete();
                    $this->model->where('pid',$value['id'])->update(['pid'=>0]);
                }
            }
        } catch (\Exception $e) {
            $this->error('删除失败'.$e->getMessage());
        }
        $save ? $this->success('删除成功',$save) : $this->error('删除失败,此节点下还有接口，请先处理相关接口再进行删除');
    }
    /**
     * @NodeAnotation(title="获取图标")
     */
    public function icon(){
        $cssContent = file_get_contents(public_path('static/index/wp-content/themes/onenav/css').'my-iconfont.css');
        // 使用正则表达式匹配所有以 "fa-var" 开头的类名
        preg_match_all('/\.fa-([^\s,:{]+)/', $cssContent, $matches);

        // $matches[1] 包含所有匹配的类名
        $classNames = $matches[1];
        $resule = [];
        // 输出类名
        foreach ($classNames as $className) {
            $resule[] =  "fa-var-" . $className . ":'';";
        }

        halt($resule);
    }
}