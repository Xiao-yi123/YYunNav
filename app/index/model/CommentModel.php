<?php

namespace app\index\model;

use app\common\model\nav\CommentBaseModel;

class CommentModel extends CommentBaseModel
{
    /**
     * 评论相关的所有数据
     * @var array
     */
    protected $comments = [];
    /**
     * 返回的结果
     * @var array
     */
    protected $reqult = [];

    /**
     *  获得3级评论，并从评论数据中删除查到的评论
     * @return void
     */
    protected function three_comments(){
        if(!$this->comments){
            return;
        }

        foreach ($this->comments as $key=>$value){
            foreach ($this->reqult as $key1=>$value1){
                if(isset($value1['twoComment']))
                    foreach ($value1['twoComment'] as $key2=>$value2){
                        if($value['reply_id'] == $value2['id']){
                            $value['author'] .= "@".explode("@",$value2['author'])[0];
                            array_splice($this->reqult[$key1]['twoComment'],$key2+1,0,array($value));
                            unset($this->comments[$key]);
                        }
                    }
            }

        }
        return $this->three_comments();
    }

    /**
     * 显示所有评论内容
     * @param $comments 评论相关所有数据
     * @return array|mixed
     */
    public function display_comments($comments='') {
        $this->comments = $comments;
//        获得1级评论，并从评论数据中删除查到的评论
        foreach ($this->comments as $key=>$value){
            if($value['reply_id'] == 0){
                $this->reqult[] = $value;
                unset($this->comments[$key]);
            }

        }
//        获得2级评论，并从评论数据中删除查到的评论
        foreach ($this->reqult as $key=>$value){
            foreach ($this->comments as $key1=>$value1){

                if($value['id'] == $value1['reply_id']){
                    $this->reqult[$key]['twoComment'][] = $value1;
                    unset($this->comments[$key1]);
                }
            }
        }

        $this->three_comments();
        return $this->reqult;
    }

    /**判断作者和邮箱是否匹配  匹配返回false
     * @param $nickname
     * @param $email
     * @return false|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function JudgeNicknameEmail($nickname='', $email=''){
        $data =  $this->where('author',$nickname)->find()->toArray();
        if($data && $data['email'] == $email){
            return false;
        }
        return "作者邮箱不匹配";
    }
}