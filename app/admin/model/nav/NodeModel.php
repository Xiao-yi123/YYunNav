<?php

namespace app\admin\model\nav;

use app\admin\validate\NodeValidate;
use app\common\model\nav\NodeBaseModel;
use think\Exception;

class NodeModel extends NodeBaseModel
{

    /**
     * 获取所有节点并格式化
     * @param $field  需要获取的字段
     * @param $isTwo  是否需要获取二级节点
     * @return Node|array|Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function getPidMenuList($field = ['id','name','pid','display_type'],$isTwo = true){
        $repeatString = "├-├-";
        $reqult = [[
            'id'    =>  0,
            'name'  =>  "顶级节点"
        ]];
        $data = $this->where([
            'status'=>1,
            'pid'  =>0
        ])->field($field)->select()->toArray();


        foreach ($data as $key => $value){
            $reqult[] = $value;
            if($isTwo) {
                $two_data = $this->where([
                    'status' => 1,
                    'pid' => $value['id']
                ])->field($field)->select()->toArray();

                foreach ($two_data as $vo) {
                    $vo['name'] = $repeatString . $vo['name'];
                    $reqult[] = $vo;
                }
            }
        }


        return $reqult;
    }

    /**修改节点
     * @param $PidMenuListData 需要修改的节点数据
     * @param $isShift  是否去掉开头
     * @param $isUnShift  是否在添加友链信息
     * @return array|mixed
     */
    public function revisePidMenuList($PidMenuListData = [], $isShift = false, $isUnShift=false){
        if($isShift)
            array_shift($PidMenuListData);
        if($isUnShift)
            array_unshift($PidMenuListData,[
                'id'    =>  0,
                'name'  =>  '友链',
                'pid'   =>  0,
            ]);
        return $PidMenuListData;
    }

    /**检查唯一性
     * @param $Where
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function CheckOnly($Where){
        $value = $this-> where($Where)->find();
        if($value){
            return true;
        }else{
            return false;
        }

    }

    /**修改 Status 属性
     * @param $data  请求时的数据
     * @return void
     * @throws Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function modifyStatus($data){
        $status = 0;
        $whereStatus = 3;
        if($data['field'] == "status" && $data['value'] == 0){
            $status = 3;
            $whereStatus = 0;
            $ChildNode = $this->IsChildNode($data['id']);
            if($ChildNode){
                throw new Exception("修改失败,此节点下还有子节点存在");
            }
        }

        if($data['field'] == "status" && $data['value'] == 1){
            $ChildNode = $this->getParentNodeStatus($data['id']);
            if(!$ChildNode){
                throw new Exception("无法启动，此节点的父节点未启动",$ChildNode);
            }
        }

        $this->navLinks()->where([
            "node_id"  =>  $data['id'],
            'status'    =>  $whereStatus
        ])->update(['status' => $status]);
    }

    /**检查一级节点下是否有子节点
     * @param $id 当前节点ID
     * @return void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function CheckOneNode($id){
        $row = $this->find($id);
        if($row['pid'] == 0){
            $twoNode = $this->where("pid",$id)->find();

            if($twoNode){
                $this->navLinks()->where('node_id',$id)->update(["status"=>3]);
            }
        }
    }
    /**验证器
     * @param $data 验证的数据
     * @param $isName  是否要验证 name 字段唯一
     * @param $isIcon bool 是否要验证 icon 字段
     * @return void
     * @throws Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function validate($data, $isName=false,$isIcon=false){
        validate(NodeValidate::class)->check((array)$data);
        if($isName && $this->CheckOnly(['name'=>$data['name']])){
            throw new Exception('节点已存在');
        }
        if($isIcon && !$data['icon']){
            throw new Exception('图标必须存在');
        }
        if(strlen($data['icon']) > 30){
            throw new Exception('icon长度不能超过30');
        }
    }
}