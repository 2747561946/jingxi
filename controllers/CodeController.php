<?php
namespace controllers;

class CodeController
{
    // 生成代码
    public function make()
    {
        $tableName = $_GET['name'];
        // 控制器
        $cname = ucfirst($tableName).'Controller';
        // echo $cname;

        // 加载模板
        ob_start();
        include(ROOT . 'templates/controller.php');
        $str = ob_get_clean();
        file_put_contents(ROOT.'controllers/'.$cname.'.php',"<?php\r\n".$str);

        // 生成模型
        $mname = ucfirst($tableName);
        ob_start();
        include(ROOT . 'templates/model.php');
        $str = ob_get_clean();
        file_put_contents(ROOT.'models/'.$mname.'.php',"<?php\r\n".$str);

        // 生成视图
        @mkdir(ROOT . 'views/'.$tableName,0777);

        // 取出表中所有字段
        $sql = "SHOW FULL FIELDS FROM $tableName";
        $db = \libs\Db::make();
        // 预处理
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $fields = $stmt->fetchAll( \PDO::FETCH_ASSOC);


        // create.html
        ob_start();
        include(ROOT . 'templates/create.html');
        $str = ob_get_clean();
        file_put_contents(ROOT.'views/'.$tableName.'/create.html',$str);

        // edit.html
        ob_start();
        include(ROOT . 'templates/edit.html');
        $str = ob_get_clean();
        file_put_contents(ROOT.'views/'.$tableName.'/edit.html',$str);

        // index.html
        ob_start();
        include(ROOT.'templates/index.html');
        $str = ob_get_clean();
        file_put_contents(ROOT.'views/'.$tableName.'/index.html',$str);


        var_dump($fields);
        die;
    }
}