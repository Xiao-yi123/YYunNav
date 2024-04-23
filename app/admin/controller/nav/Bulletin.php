<?php

namespace app\admin\controller\nav;

use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use think\App;

/**
 * @ControllerAnnotation(title="通告表")
 */
class Bulletin extends AdminController
{

    use \app\admin\traits\Curd;

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->model = new \app\admin\model\nav\BulletinModel();
        
        $this->assign('getTopList', $this->model->getTopList());

        $this->assign('getStatusList', $this->model->getStatusList());

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
            foreach ($where as $whereKey => $whereVo){
                if($whereVo[0] == "status"){
                    $where[$whereKey][0] = "ea_nav_bulletin.".$whereVo[0];
                }

            }

            $count = $this->model
                ->withJoin("systemadmin","LEFT")
                ->where($where)
                ->count();
            $list = $this->model
                ->withJoin("systemadmin","LEFT")
                ->where($where)
                ->page($page, $limit)
                ->order($this->sort)
                ->select()->toArray();

            $data = [
                'code'  => 0,
                'msg'   => '',
                'count' => $count,
                'data'  => $list,
            ];
            return json($data);
        }
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="添加")
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $post = $this->request->post();
            $rule = [];
            $this->validate($post, $rule);

            $admin = session('admin');
            $post['admin_id'] = $admin['id'];

            $data = $this->model->where([
                'title' =>  $post['title'],
                'content'   =>  $post['content']
            ])->find();
            if($data){
                $this->error('发布失败：该通知您已经发过了');
            }

            try {
                $save = $this->model->save($post);
            } catch (\Exception $e) {
                $this->error('发布失败:'.$e->getMessage());
            }
            $save ? $this->success('发布成功') : $this->error('发布失败');
        }
        return $this->fetch();
    }
}