<?php
declare (strict_types = 1);

namespace app\admin\controller\WebsiteControl;

use app\admin\service\define\BatabaseService;
use app\admin\service\define\FileService;
use app\common\controller\AdminController;
use think\facade\Filesystem;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;

/**
 * @ControllerAnnotation(title="备份控制")
 */
class Backup extends AdminController
{
    /**
     * @NodeAnotation(title="列表")
     */
    public function index($method='')
    {

        if($this->request->isGet()){

            return $this->fetch();
        }elseif ($this->request->isPost()){
            $SBatabase = new BatabaseService();
            $current_time = date('Y_m_d_H_i_s');
            $file_name = $current_time."-".$method;


            if($method == "project"){
                $SFile = new FileService();
                $currentPath = root_path();

                $skipFolders = ['.git','.idea','backup','temp','upload','runtime','image','docs','vendor'];
                $skipFiles = ['.env','install.lock',''];
                $SFile->BackupFolder($file_name,$currentPath,$skipFolders,$skipFiles);

                $this->success("备份整个项目".$file_name);
            }elseif($method == 'fullsql'){
                $sqlContent = $SBatabase->BackupContent();
                $sqlStructure = $SBatabase->BackupStructure();

                $sql = $sqlStructure.$sqlContent;

                Filesystem::disk('backup')->put($file_name.".sql", $sql);

                $this->success("完全备份成功");
            }elseif($method == 'contentsql'){
                $sqlContent = $SBatabase->BackupContent();

                Filesystem::disk('backup')->put($file_name.".sql", $sqlContent);

                $this->success("备份内容成功");
            }elseif($method == 'configsql'){
                $table = $SBatabase->getTables();

                $prefix = 'ea_system_';
                $table = array_filter($table, function($element) use ($prefix) {
                    return strpos($element, $prefix) === 0;
                });

                $sqlStructure = $SBatabase->BackupStructure();
                $sqlContent = $SBatabase->BackupContent($table);

                $sql = $sqlStructure.$sqlContent;

                Filesystem::disk('backup')->put($file_name.".sql", $sql);

                $this->success("备份配置数据库");
            }elseif($method == 'structuresql'){
                $sqlStructure = $SBatabase->BackupStructure();

                Filesystem::disk('backup')->put($file_name.".sql", $sqlStructure);

                $this->success("备份结构成功");
            }
        }
    }

}
