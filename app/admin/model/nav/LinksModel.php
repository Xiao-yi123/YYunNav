<?php

namespace app\admin\model\nav;

use app\admin\service\define\ImageService;
use app\admin\validate\LinkValidate;
use app\common\model\nav\LinksBaseModel;
use think\Exception;
use think\facade\Filesystem;

class LinksModel extends LinksBaseModel
{
    protected $name = "nav_links";


    /**检查字段是否唯一
     * @param $Where  条件
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

    /**修改分类
     * @param $NewCid  修改后的 node表的 id
     * @param array $row  修改的那一行的数据
     * @return bool
     * @throws \League\Flysystem\FileExistsException
     * @throws \League\Flysystem\FileNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function CategoryModified($NewCid, $row){
        //判断文件是否存在  存在就删除
        if(Filesystem::disk("public")->has($row['image_path'])){
            Filesystem::disk("public")->delete($row['image_path']);
        }

        if($NewCid)
            $nodeName = $this->navNode()->where('id',$NewCid)->field('name')->find()['name'];
        else{
            $nodeName = '友链';
        }
        $savepath = "/static/image/urlimage/".$nodeName."/";

        $ImageS = new ImageService();
        $path = $ImageS->DownloadImage($row['url'],"random",$savepath);

        $row->save([
            'image_path'=>$path,
            'node_id'  =>  $NewCid
        ]);
        return $path;
    }


    /**检查数据库中的 image_path 字段 如果路径文件不存在就设置为空
     * @return void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function ExamineImagePathSQL(){
        $linkdata = $this->where("image_path", "<>",null)->select();

        foreach ($linkdata as $vo){
            if(!Filesystem::disk("public")->has($vo['image_path'])){
                $vo->save([
                    'image_path'    =>  null
                ]);
            }
        }
    }

    /**检查 urlimage 文件夹中的图片文件 对应数据库中的 image_path 字段 如果没有被使用就删除
     * @return void
     * @throws \League\Flysystem\FileNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function ExamineImagePathFile(){
        $dirlist = Filesystem::disk('public')->listContents('static/image/urlimage');
        $linkdata = $this->where("image_path","<>", null)->field('image_path')->select()->toArray();
        foreach ($dirlist as $dirvo){
            $list = Filesystem::disk('public')->listContents($dirvo['path']);
            foreach ($list as $listvo){
                $flag = false;
                foreach ($linkdata as $linkvo){
                    if($listvo['type'] == 'file' && strpos($linkvo['image_path'],$listvo['path'])){
                        $flag = true;
                    }
                }
                if(!$flag){
                    Filesystem::disk('public')->delete($listvo['path']);
                }
            }
        }
    }

    /**根据节点判断是该链接是否展示   顶级节点下有子节点不展示
     * @param array $post  新增节点时请求的数据  需要有的字段  status node_id(实际是node表的id)
     * @return int  3 不展示--由于节点不展示
     */
    public function NodeIsStatus($post){
        $OneNodeData = $this->navNode()->where([
            'id'    =>  $post['node_id'],
            'pid'    =>  0
        ])->find();

        if($OneNodeData){
            $twoNode = $this->navNode()->where("pid",$OneNodeData['id'])->find();
            if($twoNode)
                $post['status'] =  3;
        }

        return $post['status'];
    }

    /**友链申请  如果通过就发通知
     * @param $row
     * @param $post
     * @return void
     */
    public function FriendLinkApplication($row, $post){
        //友链申请
        if($row['status']==2 && $post['status'] == 0){
            $MBulletin = new BulletinModel();
            $NodeName = $this->navNode()->where('id',$post['node_id'])->field('name')->find();
            if($NodeName){
                $NodeName = $NodeName['name'];
            }else{
                $NodeName = '友链';
            }
            $CommentMsg = "“".$NodeName."”里面新增“".$post['name']."”";
            $data = $MBulletin->where([
                'title' =>  '新增资源',
                'content'   =>  $CommentMsg
            ])->find();
            if(!$data)
                $MBulletin->save([
                    "admin_id" => \session('admin')['id'],
                    'title' => '新增资源',
                    'content'   =>  $CommentMsg
                ]);
        }
    }

    /**验证器
     * @param array $data 验证的数据
     * @param $isName  是否要验证 name 字段唯一
     * @param $isUrl   是否要验证 url 字段唯一
     * @return void
     * @throws Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function validate($data, $isName=false, $isUrl=false){
        validate(LinkValidate::class)->check((array)$data);
        if($isName && $this->CheckOnly(['name'=>$data['name']])){
            throw new Exception('接口已存在,无需添加');
        }
        if($isUrl && $this->CheckOnly(['url'=>$data['url']])){
            throw new Exception('URL已存在,无需添加');
        }

    }

    /**格式化搜索条件
     * @param $where 查询条件
     * @return array
     */
    public function FormatWhere($where){
        foreach ($where as $whereKey => $whereVo){
            if($whereVo[0] == 'navNode__name'){
                $whereVo[0] = 'name';
                $NodeInfo  = $this->navNode()->where($whereVo[0],$whereVo[1],$whereVo[2])->find();
                if($NodeInfo){
                    $where[$whereKey][0] = "node_id";
                    $where[$whereKey][2] = $NodeInfo['id'];
                }
            }

        }
        foreach ($where as $whereKey => $whereVo){
            if($whereVo[0] == "name" or $whereVo[0] == "status"){
                $where[$whereKey][0] = config("database.connections.mysql.prefix")."nav_links.".$whereVo[0];
            }

        }
        return $where;
    }
}