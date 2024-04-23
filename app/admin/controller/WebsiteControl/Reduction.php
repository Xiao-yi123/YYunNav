<?php
declare (strict_types = 1);

namespace app\admin\controller\WebsiteControl;

use app\admin\service\define\BatabaseService;
use app\admin\service\define\FileService;
use app\common\controller\AdminController;
use think\facade\Filesystem;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;

use ZipArchive;

/**
 * @ControllerAnnotation(title="还原控制")
 */

class Reduction extends AdminController
{
    /**
     * @NodeAnotation(title="列表")
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $listContents = Filesystem::disk('backup')->listContents('');//列出目录下的内容

            usort($listContents, function($a, $b) {
                return $b['timestamp'] <=> $a['timestamp']; // 按照创建时间升序排序
            });

            foreach ($listContents as $key => $vo){
                $listContents[$key]['id'] = $vo['basename'];
                $listContents[$key]['timestamp'] = date('Y-m-d H:i',$listContents[$key]['timestamp']);
                if(stripos($vo['filename'], 'project') !== false || stripos($vo['filename'], 'fullsql') !== false){
                    $listContents[$key]['isReduction'] = true;
                }else{
                    $listContents[$key]['isReduction'] = false;
                }
            }

            $data = [
                'code'  => 0,
                'msg'   => '',
                'count' => count($listContents),
                'data'  => $listContents,
            ];
            return json($data);
        }

        return $this->fetch();

    }

    /**
     * @NodeAnotation(title="上传")
     */
    public function upload(){
        //判断还原之前是否有过备份
        if($this->request->isPost()){
            $file =  $this->request->file('file');

            $Extension = $file->getOriginalExtension();
            if(!($Extension == "zip" || $Extension == "sql")){
                $this->error("提交的文件类型不支持");
            }
            $FileS = new FileService();

            if($Extension == 'sql'){
                $pattern = Filesystem::disk('backup')->path('').'/*fullsql.sql';
                $sqlTimeResult = $FileS->FileGenerationTime($pattern);
                //判断文件生成时间是否在规定时间内
                if(!$sqlTimeResult['code']){
                    $this->error($sqlTimeResult['msg']);
                }

                $BataBaseS = new BatabaseService();

                $savefile = Filesystem::disk('temp')->putFile('Reduction', $file);

                $RestoreResult= $BataBaseS->RestoreDatabase(Filesystem::disk('temp')->path($savefile));

                Filesystem::disk('temp')->delete($savefile);


                if($RestoreResult['code']){
                    $this->success($RestoreResult['msg']);
                }else{
                    $this->error($RestoreResult['msg']);
                }

            }elseif($Extension == 'zip'){
                $pattern = Filesystem::disk('backup')->path('').'/*project.zip';
                $zipTimeResult = $FileS->FileGenerationTime($pattern);
                //判断文件生成时间是否在规定时间内
                if(!$zipTimeResult['code']){
                    $this->error($zipTimeResult['msg']);
                }

                $savefile = Filesystem::disk('temp')->putFile('Reduction', $file);
                $zip = new ZipArchive();
                if ($zip->open(Filesystem::disk('temp')->path($savefile)) === TRUE) {

                    $zip->extractTo(root_path());
                    $zip->close();

                    Filesystem::disk('temp')->delete($savefile);
                    $this->success('还原成功');
                }

                $this->error('还原失败，原因请联系管理员！！！');


            }
        }
    }

    /**
     * @NodeAnotation(title="下载")
     */
    public function download(){
        $id = $this->request->param('id');
        $path = Filesystem::disk('backup')->path($id);
        if (!file_exists($path)) {
            $this->error("文件不存在");
        }

        $ex = explode('.',$id);
        $filename = date("Ymd").".".end($ex);
        return  download($path,$filename);
    }

    /**
     * @NodeAnotation(title="还原")
     */
    public function reduction(){
        if($this->request->isPost()){
            // ID为文件名
            $id = $this->request->param('id');

            $Extension = explode('.',$id)[1];


            if($Extension == 'sql'){
                if(explode('-',$id)[1] !== 'fullsql.sql'){
                    $this->error('您选择的数据库不是全备的数据库，无法还原');
                }

                $BataBaseS = new BatabaseService();

                $RestoreResult= $BataBaseS->RestoreDatabase(Filesystem::disk('backup')->path($id));

                if($RestoreResult['code']){
                    $this->success($RestoreResult['msg']);
                }else{
                    $this->error($RestoreResult['msg']);
                }

            }elseif ($Extension == 'zip'){
                $zip = new ZipArchive();
                if ($zip->open(Filesystem::disk('backup')->path($id)) === TRUE) {

                    $zip->extractTo(root_path());
                    $zip->close();

                    $this->success('还原成功');
                }
            }else{
                $this->error('该文件类型不支持还原');
            }
        }

    }
    /**
     * @NodeAnotation(title="删除")
     */
    public function delete(){
        if($this->request->isPost()){
            $id = $this->request->param('id');
            Filesystem::disk('backup')->delete($id);
            $this->success('删除成功');
        }


    }
}
