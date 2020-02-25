<?php

include 'MenuItems.php';

function getDataFromItemsClass($data,$file){

    $className = $data['className'];
    $funcName = $data['actionName'];
//    print_r($className);
//    print_r($funcName);die;
//    print_r($className);die;
    $obj = new $className('localhost','root','','flowers');
    $obj->$funcName($data['itemName'],$data['itemPrice'],$data['discountPercent'],$data['discount']);
}

if (!is_null($_POST)){
    getDataFromItemsClass ($_POST,$_FILES);
}

//
//
//
//require_once 'db_conaction.php';
//
//$itemName = $_POST['itemName'];
//$itemPrice = $_POST['itemPrice'];
//$discountPercent = $_POST['discountPercent'];
//$discount = $_POST['discount'];
//
////var_dump($_FILES);die;
//
//if (isset($_POST['itemName']) && !empty($_POST['itemName']) && isset($_POST['itemPrice']) && !empty($_POST['itemPrice'])) {
//    $target_dir = "../src/images/";
//    $target_file = $target_dir . uniqid() . '.' . strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
//    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//    if ($_FILES["file"]["size"] > 500000) {
//        $error = [
//            'error' => [
//                'message' => 'Sorry, your file is too large. Max allowed file size is 5MB',
//            ]
//        ];
//        echo json_encode($error);die;
//    }elseif(empty($_FILES)) {
//        $error = [
//            'error' => [
//                'message' => 'Sorry, your file was not uploaded.',
//            ]
//        ];
//        echo json_encode($error);die;
//    }elseif (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
//        $imagePath = str_replace('..', '/adminka', $target_file);
//    } elseif($_POST['action'] !== 'edit') {
//        $error = [
//            'error' => [
//                'message' => 'Sorry, there was an error uploading your file.',
//            ]
//        ];
//        echo json_encode($error);die;
//    }
//
//    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
//        $itemId = $_POST['itemId'];
//        if (!empty($_FILES["file"]) && $_FILES["file"]["size"] > 0) {
//            $imagePath = str_replace('..', '/adminka', $target_file);
//        } else {
//            $imagePath = $mysqli->query("SELECT `path` FROM `menu_items` WHERE `id` = '$itemId'")->fetch_row()[0];
//        }
//        $mysqli->query("UPDATE `menu_items` SET description = '$itemName',price = '$itemPrice',bonus = '$discountPercent',path = '$imagePath',discount = '$discount',status = 'show'  WHERE `id` = '$itemId'");
//    } else {
//        $iconId = $_POST['iconId'];
//        $mysqli->query("INSERT INTO `menu_items`(menu_id,description,price,bonus,path,discount,status) VALUES ( $iconId,'$itemName','$itemPrice','$discountPercent','$imagePath','$discount','show')");
//    }
//
//    $selectItems = $mysqli->query("SELECT * FROM `menu_items` WHERE `path` = '$imagePath'");
//
//    $itemList = [];
//    while ($row = mysqli_fetch_assoc($selectItems)) {
//        array_push($itemList, $row);
//    }
//    echo json_encode($itemList);die;
//}
//
//if ($_POST['action'] == 'deleteItem'){
//    $deleteId = $_POST['data_id'];
//    $mysqli->query("DELETE FROM `menu_items` WHERE `id` = '$deleteId'");
//    echo $mysqli->error;
//    $success = [
//        'success' => [
//            'message' => 'Item  was deleted',
//        ]
//    ];
//    echo json_encode($success);
//}
//
//if ($_POST['action'] == 'editing') {
//    $rowId = $_POST['dataId'];
//    $sql = $mysqli->query("SELECT * FROM  `menu_items` WHERE `id` ='$rowId'");
//    $row = mysqli_fetch_assoc($sql);
//    if (is_array($row)){
//        echo json_encode($row);die;
//    }else{
//        $error = [
//            'error' => [
//                'message' => 'Sorry, the requested item does not exists.',
//            ]
//        ];
//        echo json_encode($error);die;
//    }
//}
//
//if ($_POST['action'] == 'hide') {
//    $rowId = $_POST['dataId'];
//
//    $mysqli->query("UPDATE `menu_items` SET `status` = 'hide' WHERE `id` ='$rowId'");
//
//    $success = [
//        'success' => [
//            'message' => 'Item status was changed',
//        ]
//    ];
//    echo json_encode($success);die;
//}
//
//if ($_POST['action'] == 'show') {
//    $rowId = $_POST['dataId'];
//
//    $mysqli->query("UPDATE `menu_items` SET `status` = 'show' WHERE `id` ='$rowId'");
//
//    $success = [
//        'success' => [
//            'message' => 'Item status was changed',
//        ]
//    ];
//    echo json_encode($success);die;
//}
//
//
//if($_POST['action'] == "get_last_products"){
//    $items = $mysqli->query("SELECT * FROM `menu_items` ORDER BY id DESC LIMIT 3");
//    $itemListS = [];
//    while ($row = mysqli_fetch_assoc($items)) {
//
//        array_push($itemListS, $row);
//    }
//    echo json_encode($itemListS);
//}
//
//if($_POST['action'] == "get_sale_products"){
//    $items = $mysqli->query("SELECT * FROM `menu_items` WHERE `discount`='on' ORDER BY id DESC LIMIT 4");
//    $itemListS = [];
//    while ($row = mysqli_fetch_assoc($items)) {
//
//        array_push($itemListS, $row);
//    }
//    echo json_encode($itemListS);
//}