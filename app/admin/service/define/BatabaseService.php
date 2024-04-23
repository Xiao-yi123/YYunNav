<?php
declare (strict_types = 1);

namespace app\admin\service\define;

use think\facade\Db;
use zjkal\MysqlHelper;

class BatabaseService
{
    protected $BackupPath = '/backup/';
    /**获取所有表名
     * @return array
     */
    public function getTables(){
        // 获取数据库配置信息
        $config = config('database.connections.mysql');

        // 获取所有表名
        $tables = Db::query('SHOW TABLES');
        $tables = array_column($tables, 'Tables_in_' . $config['database']);

        return $tables;
    }

    /**备份数据库的内容
     * @param $tables
     * @return array|string|string[]|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function BackupContent($tables=null){
        if(!$tables){
            $tables = $this->getTables();
        }

       foreach ($tables as $tableKey => $tableVo){
            $tables[$tableKey] = str_replace(config("database.connections.mysql.prefix"), '', $tableVo);
       }
       $sql = null;
       // 备份每张表的数据
       foreach ($tables as $table) {
           $data = Db::name($table)->select()->toArray();
            $prefix = config("database.connections.mysql.prefix");
           // 将数据写入sql文件
           foreach ($data as $row) {

               $sql .= "INSERT INTO `$prefix$table` VALUES ";

               $sql .= "(" . implode(', ', array_map(function($value) {
                   if (is_string($value)) { // 判断是否为字符串类型
                       $value = addslashes($value); // 转义并存储
                   }
                   $value = str_replace(";", "&#59", $value);

                       return '\'' . $value . '\'';
                   }, $row));
               $sql .= ");\n";
           }

       }
        $sql = str_replace("''", "NULL", $sql);
        return  $sql;
    }

    /**备份数据库的结构
     * @param $tables
     * @return string
     */
    public function BackupStructure($tables=null){
        if(!$tables){
            $tables = $this->getTables();
        }
        $sql = '';
        foreach ($tables as $table) {
            $createTableSql = Db::query('SHOW CREATE TABLE ' . $table);
            $sql .= $createTableSql[0]['Create Table'] . ";\n";
        }
        return $sql;
    }

    /**还原数据库
     * @param $path 文件所在路径
     * @return array
     */
    public function RestoreDatabase($path){
        $mysql = new MysqlHelper();
        $config = config('database.connections.mysql');
        $mysql->setConfig($config);

        $result = [
            'code'  =>  0,
            'msg'   =>  ''
        ];
        Db::startTrans(); // 开启事务

        try {
            // 清空当前数据库
            $this->truncateTables();
            $mysql->importSqlFile((string)$path);
            Db::commit(); // 提交事务
            $result['code'] = 1;
            $result['msg']  =   '还原成功';
            return $result;

        } catch (\Exception $e) {
            Db::rollback(); // 回滚事务
            $result['msg'] = "数据库还原失败：" .$e->getMessage();
            return $result;
        }

    }

    //区分语法作用
    public function DistinguishGrammatical($sqlData = ''){
        $sql  =[
            'CREATE' => [],
            'INSERT'    =>  []
        ];
        try {
            $sql_commands = explode(';', $sqlData);

            foreach ($sql_commands as $sql_command) {
                $sql_command = str_replace("\n", "", $sql_command);
                if (strpos($sql_command, 'CREATE TABLE') === 0) {
                    echo "这是一个创建表的语句：\n";
                    $sql['CREATE'][] = $sql_command;
                } elseif (strpos($sql_command, 'INSERT INTO') === 0) {
                    echo "这是一个插入数据的语句：\n";
                    $sql['INSERT'][] = $sql_command;

                }

            }



        } catch (\Exception $e) {
            Db::rollback(); // 回滚事务

            $result1 = "数据库还原失败：" .$S. $e->getMessage();
        }

        return $sql;
    }

    // 清空当前数据库中的所有表
    private function truncateTables()
    {
        $tables = Db::query('SHOW TABLES');
        foreach ($tables as $table) {
            $table_name = current($table);
            Db::execute("DROP TABLE IF EXISTS `$table_name`");
        }
    }
}
