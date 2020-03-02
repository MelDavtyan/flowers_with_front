<?php
include 'MenuIcons.php';

function getDataFromIconClass($data,$file){

    $className = $data['className'];
    $funcName = $data['actionName'];
    $obj = new $className('localhost','root','','flowers');
    $obj->$funcName($data['text_address'],$data['text_phone'],$data['text_email']);

}
if (!is_null($_POST)){
    getDataFromIconClass($_POST,$_FILES);
}


