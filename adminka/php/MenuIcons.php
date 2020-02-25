<?php


class MenuIcons
{
    public  $mysqli;
    public  $imagePath;
    public $target_file;

    public function __construct($host,$userName,$password,$dbName)
    {
        $this->mysqli = new mysqli($host,$userName,$password,$dbName);
    }

    public function __destruct()
    {
      $this->mysqli->close();
    }

    public function checkImage($file){
        $target_dir = "../src/images/";
        $this->target_file = $target_dir . uniqid() . '.' . strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

        if ($file["size"] > 500000) {
            $error = [
                'error' => [
                    'message' => 'Sorry, your file is too large. Max allowed file size is 5MB',
                ]
            ];
            echo json_encode($error);die;
        }elseif(empty($_FILES)) {
            $error = [
                'error' => [
                    'message' => 'Sorry, your file was not uploaded.',
                ]
            ];
            echo json_encode($error);die;
        }elseif (move_uploaded_file($file["tmp_name"], $this->target_file)) {
            $this->imagePath = str_replace('..', '/adminka', $this->target_file);
        }
    }

    public function query($sql){
        $result = [];
        $query = $this->mysqli->query($sql);
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
        return $result;
    }

     public function saveIcons($iconName)
    {
        $this->checkImage($_FILES['file-upload']);
        $this->mysqli->query("INSERT INTO `menu_icons` (name,path) VALUES ('$iconName','$this->imagePath')");
        $allIcons = $this->query("SELECT * FROM `menu_icons` WHERE `path` = '$this->imagePath'");
        echo json_encode($allIcons);
    }

    public function getAllIcons($iconName)
    {
        $menuIcons = $this->query("SELECT * FROM `menu_icons` ORDER BY `status` ASC ");
        echo json_encode($menuIcons);
    }

    public function getAllIconNames($iconName)
    {
        $menuIconNames = $this->query("SELECT `name`,`id` FROM `menu_icons`");
//        print_r($menuIconNames);die;

        echo json_encode($menuIconNames);
    }

    public function editItem($iconName)
    {
        $menuId = $_POST['menuId'];
        $sql = $this->query("SELECT * FROM `menu_icons` WHERE `id` = '$menuId'");
        echo json_encode($sql);
    }

    public function updateIcon($iconName)
    {
        $this->checkImage($_FILES['file-upload']);
            $iconIda = $_POST['hiddenInput'];
            if (!empty($_FILES["file-upload"]) && $_FILES["file-upload"]["size"] > 0){
               $this->imagePath = str_replace('..', '/adminka', $this->target_file);
            }else{
                $this->imagePath = $this->mysqli->query("SELECT `path` FROM `menu_icons` WHERE `id` = '$iconIda'")->fetch_row()[0];
            }
            $this->mysqli->query("UPDATE `menu_icons` SET `name` = '$iconName',`path` = '$this->imagePath' WHERE `id` = '$iconIda'");


        $allIcons = $this->query("SELECT * FROM `menu_icons` WHERE `path` = '$this->imagePath'");
       echo json_encode($allIcons);
    }

    public function daleteIcon($dataId)
    {
        $dataId = $_POST['dataId'];
        $this->mysqli->query("UPDATE `menu_icons` SET `status` = 'deleted' WHERE id = '$dataId'");
        $this->mysqli->query("UPDATE `menu_items` SET `status` = 'hide' WHERE `menu_id` = '$dataId'");

        $success = [
            'success' => [
                'message' => 'Item  was deleted',
            ]
        ];
        echo json_encode($success);
    }

    public function backupIcon($dataId,$tbName){
        $dataId = $_POST['dataId'];
        $this->mysqli->query("UPDATE `menu_icons` SET `status` = null WHERE id = '$dataId'");
        $this->mysqli->query("UPDATE `menu_items` SET `status` = 'show' WHERE `menu_id` = '$dataId'");

        $success = [
        'success' => [
            'message' => 'Item  was deleted',
            ]
        ];
        echo json_encode($success);
    }

    public function gal_btn(){
        $menuIconNames = $this->query("SELECT `name`,`id` FROM `menu_icons`");

        echo json_encode($menuIconNames);
    }


    public function aboutUs ($title,$text)
    {
        $this->checkImage($_FILES['text-upload']);
        $this->mysqli->query("INSERT INTO `aboutus` (title,image,text) VALUES ('$title','$this->imagePath','$text')");

        $allIcons = $this->query("SELECT * FROM `aboutus` WHERE `image` = '$this->imagePath'");


        echo $this->mysqli->error;
        echo json_encode($allIcons);
    }

}

