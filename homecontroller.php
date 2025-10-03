<?php
class HomeController{

    public function trangchu(){
        include_once 'Model/connectmodel.php';
        $sp=new ConnectModel();
        $sql='select * from products';
        $dssp=$sp->selectall($sql);
        include_once '../Public/index.php';
    }

}
?>