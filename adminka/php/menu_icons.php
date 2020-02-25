 <?php
include 'MenuIcons.php';

function getDataFromIconClass($data,$file){

    $className = $data['className'];
    $funcName = $data['actionName'];
    $obj = new $className('localhost','root','','flowers');
    $obj->$funcName($data['inp_name'],$data['text_box']);

}
if (!is_null($_POST)){
    getDataFromIconClass($_POST,$_FILES);
}

