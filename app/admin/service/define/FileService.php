<?php

namespace app\admin\service\define;
use think\facade\Filesystem;
use ZipArchive;
class FileService
{
    protected  $result = [
        'code'  =>  0,
        'msg'   =>  ''
        ];
    /**检查Excel
     * @param $path
     * @return array|false
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function ExamineExcel($path='')
    {
        $data = $this->ReadExcel($path);

        $nameIndex = $URLIndex = $descriptionIndex = -1;
        foreach ($data[0] as $key => $vo){
            if($vo == 'name' || $vo == '接口名'){
                $nameIndex = $key;
            }
            if($vo == 'url' || $vo == 'URL'){
                $URLIndex = $key;
            }
            if($vo == 'description' || $vo == '描述'){
                $descriptionIndex = $key;
            }
        }
        if($nameIndex == -1 || $URLIndex == -1 || $descriptionIndex === -1){
            return false;
        }
        $newData = [
            ['name','url',"description"]
        ];
        foreach ($data as $key=>$vo){
            if($key > 0){
                $newData[] = [
                    $vo[$nameIndex],$vo[$URLIndex],$vo[$descriptionIndex]
                ];
            }
        }
        return $newData;
    }

    /**读取excel
     * @param $path 文件路径
     * @return array
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    protected function ReadExcel($path = ''){
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($path); //载入excel表格

        $sheet = $spreadsheet->getSheet(0); // 读取第一個工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数

        $data = $spreadsheet->getActiveSheet()->toArray();
        return $data;
    }
    /**备份文件夹并压缩成 zip
     * @param $fileName  文件名
     * @param $sourceFolder 源文件夹路径
\     * @param $skipFolders 要跳过备份的文件夹列表
     * @param $skipFiles 要跳过备份的文件列表
     * @return string
     */
    public function BackupFolder($fileName = "", $sourceFolder = '' ,$skipFolders = [], $skipFiles = []) {
        $backupFolder = Filesystem::disk('backup')->path("");
        // 创建备份目标文件夹
        if (!file_exists($backupFolder)) {
            mkdir($backupFolder, 0777, true);
        }

        // 创建 ZIP 文件
        $zip = new ZipArchive();
        $zipFileName = $backupFolder . '/'.$fileName.'.zip';
        if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            die("无法创建ZIP文件\n");
        }
        $this->AddFolderToZip($sourceFolder,$zip,strlen($sourceFolder) + 1,$skipFolders,$skipFiles);
        $filePath = $zip->filename;
        $zip->close();
        return $filePath;
    }

    /**使用递归函数将文件夹内容添加到 ZIP 文件，并跳过指定的文件夹和文件
     * @param $source 源文件夹路径
     * @param $zip zip文件对象
     * @param $baseLength  基本长度
     * @param $skipFolders 要跳过备份的文件夹列表
     * @param $skipFiles 要跳过备份的文件列表
     * @return void
     */
    protected function AddFolderToZip($source, $zip, $baseLength = 0, $skipFolders = [], $skipFiles = []) {
        $handle = opendir($source);
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $filePath = $source . '/' . $file;
                $localPath = substr($filePath, $baseLength);
                if (is_file($filePath)) {
                    if (!in_array($file, $skipFiles)) {
                        $zip->addFile($filePath, $localPath);
                    }
                } elseif (is_dir($filePath) && !in_array($file, $skipFolders)) {
                    $this->AddFolderToZip($filePath, $zip, $baseLength, $skipFolders, $skipFiles);
                }
            }
        }
        closedir($handle);
    }

    //

    /**判断文件生成时间是否在规定时间内
     * @param string $pattern glob函数判断模式
     * @param $time   在多久之前，秒为单位，默认1800秒 30分钟
     * @return array
     */
    public function FileGenerationTime($pattern, $time = 1800){
        //获取指定列表中最近生成的SQL文件

        //1获取指定目录中的SQL文件列表：
        $files = glob($pattern);

        if(!$files){
            $this->result['msg'] =  '最近您没有做过全备，请先做个全备再来进行还原！！！';
            return $this->result;
        }
        //2根据文件的最后修改时间对文件进行排序以获取最新的文件：
        usort($files, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        //3获取最近生成的SQL文件的路径
        $latestFile = $files[0];

        $ComparisonResult =  $this->TimeComparison($latestFile,$time);
        if(!$ComparisonResult['code']){
            return $ComparisonResult;
        }
        $this->result['code'] = 1;
        $this->result['msg'] = $latestFile;
        return $this->result;
    }


    /**时间比对
     * @param $path 文件路径
     * @param $time 在多久之前，秒为单位，默认1800秒 30分钟
     * @return array|mixed
     */
    public function TimeComparison($path, $time = 1800){

        // 获取文件的最后修改时间
        $fileLastModified = filemtime($path);
        // 获取当前时间戳
        $currentTimestamp = time();

        //检查文件是否在最近30分钟内生成
        if (!($currentTimestamp - $fileLastModified <= $time)) {
            $this->result['msg'] =  "最近生成的SQL文件不是在最近30分钟内生成的。";
            return $this->result;
        }
        $this->result['code'] = 1;
        $this->result['msg'] = $fileLastModified;
        return $this->result;
    }

}