<?php

namespace app\admin\controller;


use app\admin\model\nav\BulletinModel;
use app\admin\model\nav\CommentModel;
use app\admin\model\nav\LinksModel;
use app\admin\model\nav\NodeModel;
use app\admin\model\SystemAdmin;
use app\admin\model\SystemQuick;
use app\common\controller\AdminController;
use think\App;

class Index extends AdminController
{

    /**
     * 后台主页
     * @return string
     * @throws \Exception
     */
    public function index()
    {
        return $this->fetch('', [
            'admin' => session('admin'),
        ]);
    }

    /**
     * 后台欢迎页
     * @return string
     * @throws \Exception
     */
    public function welcome()
    {
        $quicks = SystemQuick::field('id,title,icon,href')
            ->where(['status' => 1])
            ->order('sort', 'desc')
            ->limit(8)
            ->select();

        $MSystemAdmin = new SystemAdmin();
        $userCount = $MSystemAdmin->select()->count();

        $MNavLink = new LinksModel();
        $linkCount = $MNavLink->select()->count();

        $MComment = new CommentModel();
        $CommentCount = $MComment->select()->count();

        $MNode = new NodeModel();
        $NodeCount = $MNode->select()->count();

        $MBulletin = new BulletinModel();
        $data = $MBulletin->withJoin("systemadmin","LEFT")
            ->where(config("database.connections.mysql.prefix")."nav_bulletin.status",1)
            ->select()
            ->toArray();
        $bulletins = [
            'conunt'    =>count($data),
            'top'   =>  [],
            'no_top'    =>  []
        ];
        foreach($data as $vo){
            $bulletin = [
                'id'    =>$vo['systemadmin']['id'],
                'title'   =>  $vo['title'],
                'content'   =>  $vo['content'],
                "time"      =>  $vo['create_time']
            ];
            if($vo['top'] == 1){
                $bulletins['top'][] = $bulletin;
            }else{
                $bulletins['no_top'][] = $bulletin;
            }
        }

        $this->assign('bulletin', $bulletins);
        $this->assign('userCount', $userCount);
        $this->assign('LinkCount', $linkCount);
        $this->assign('CommentCount', $CommentCount);
        $this->assign('NodeCount', $NodeCount);
        $this->assign('quicks', $quicks);
        return $this->fetch();
    }

    /**
     * 修改管理员信息
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function editAdmin()
    {
        $id = session('admin.id');
        $row = (new SystemAdmin())
            ->withoutField('password')
            ->find($id);
        empty($row) && $this->error('用户信息不存在');
        if ($this->request->isPost()) {
            $post = $this->request->post();
            $this->isDemo && $this->error('演示环境下不允许修改');
            $rule = [];
            $this->validate($post, $rule);
            try {
                $save = $row
                    ->allowField(['head_img', 'phone', 'remark', 'update_time'])
                    ->save($post);
            } catch (\Exception $e) {
                $this->error('保存失败');
            }
            $save ? $this->success('保存成功') : $this->error('保存失败');
        }
        $this->assign('row', $row);
        return $this->fetch();
    }

    /**
     * 修改密码
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function editPassword()
    {
        $id = session('admin.id');
        $row = (new SystemAdmin())
            ->withoutField('password')
            ->find($id);
        if (!$row) {
            $this->error('用户信息不存在');
        }
        if ($this->request->isPost()) {
            $post = $this->request->post();
            $this->isDemo && $this->error('演示环境下不允许修改');
            $rule = [
                'password|登录密码'       => 'require',
                'password_again|确认密码' => 'require',
            ];
            $this->validate($post, $rule);
            if ($post['password'] != $post['password_again']) {
                $this->error('两次密码输入不一致');
            }

            try {
                $save = $row->save([
                    'password' => password($post['password']),
                ]);
            } catch (\Exception $e) {
                $this->error('保存失败');
            }
            if ($save) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
        $this->assign('row', $row);
        return $this->fetch();
    }

    public function BackupRestoreUograde(){
        return "BackupRestoreUograde1231";
    }
}
