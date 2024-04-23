<?php

namespace app\index\controller;

use app\common\constants\IndexBase;
use app\common\service\ApiService;
use app\index\model\CommentModel;
use app\index\service\IndexService;
use app\Request;

class Message extends IndexBase
{
    /**
     * 留言
     * @param Request $request
     * @return string
     */
    public function index(Request $request){

        if($request->isGet()){
            $SIndex = new IndexService();
            $SIndex->GetUniversalData();
            $distinguish = [
                'source'    =>  "message",
                'FirstPanelName'    =>  '留言版',
                "FirstPanelContent" =>  "在这里您可以发表对本站的建议、讨论等等",
                'icon'  =>  "icons8-消息",
                "iconContent"  =>  "在线留言"
            ];

            $CommentMode = new CommentModel();
            $Comments = $CommentMode->where("status",1)
                ->order('create_time','desc')
                ->select()
                ->toArray();
            $NavComment = $CommentMode->display_comments($Comments);
            $this->assign('NavComment',$NavComment);
            $this->assign('distinguish',$distinguish);
            return $this->fetch("message_submit/index");

        }elseif($request->isPost()){
            $Rdata = $request->param();

            if(!captcha_check($Rdata['image_captcha'])){
                // 验证失败
                $this->error('验证码错误');

            };
            if (!filter_var($Rdata['email'], FILTER_VALIDATE_EMAIL)) {
                $this->error("邮箱地址错误");
            }

            $MComment = new CommentModel();

            $JudgeResult = $MComment->JudgeNicknameEmail($Rdata['author'],$Rdata['email']);
            if($JudgeResult){
                $this->error($JudgeResult);
            }

            try {
                $APIS = new ApiService();
                $info = $APIS->getIpInfo()['info'];
                $place = $info['country'].$info['prov'].$info['city'];
                $save = $MComment->save([
                    'author'    =>$Rdata['author'],
                    "content"    =>  $Rdata['content'],
                    'email'      =>  $Rdata['email'],
                    'reply_id' =>   (int)$Rdata['comment_parent'],
                    'place'     =>  $place
                ]);
            }catch (\Exception $e){

                $this->error('评论失败:'.$e->getMessage());
            }
            $save ? $this->success('评论成功') : $this->error('评论失败');

        }


    }
}