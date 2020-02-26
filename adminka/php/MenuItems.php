<?php


class MenuItems
{
    public $mysqli;
    public $imagePath;
    public $target_file;

    public function __construct($host, $userName, $password, $dbName)
    {
        $this->mysqli = new mysqli($host, $userName, $password, $dbName);
    }

    public function __destruct()
    {
        $this->mysqli->close();
    }

    public function checkImage($file)
    {
        $target_dir = "../src/images/";
        $this->target_file = $target_dir . uniqid() . '.' . strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

        if ($file["size"] > 500000) {
            $error = [
                'error' => [
                    'message' => 'Sorry, your file is too large. Max allowed file size is 5MB',
                ]
            ];
            echo json_encode($error);
            die;
        } elseif (empty($file)) {
            $error = [
                'error' => [
                    'message' => 'Sorry, your file was not uploaded.',
                ]
            ];
            echo json_encode($error);
            die;
        } elseif (move_uploaded_file($file["tmp_name"], $this->target_file)) {
            $this->imagePath = str_replace('..', '/adminka', $this->target_file);
        }
    }

    public function query($sql)
    {
        $result = [];
        $query = $this->mysqli->query($sql);
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
        return $result;
    }

    public function getItem()
    {
        $record_per_page = 13;
        $page = '';
        $output = '';
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
        } else {
            $page = 1;
        }

        $start_from = ($page - 1) * $record_per_page;
        $t = $_POST["menuId"];
        $selectItems = $this->mysqli->query("SELECT * FROM `menu_items` WHERE `menu_id` = '$t' ORDER BY `id` DESC LIMIT $start_from, $record_per_page");
        $a = $this->mysqli->query("SELECT `name` FROM `menu_icons` WHERE `id` = '$t'")->fetch_row()[0];
        $output .= '<div class="create" id="create"><img class="image_add" src="test/plus%20red%20(2).png"></div>';
        while ($row = mysqli_fetch_array($selectItems)) {
            $output .= '<div class = "itemsContainer">' .
                '<div class="image_div" ><img src="' . $row['path'] . '" alt="" class="image"></div>' .
                '<div class="name_div"><span title="' . $row['description'] . '" class="nameSpan">' . $row['description'] . '</span></div>' .
                '<span class="span_amd">AMD</span>';
            if ($row['discount'] == 'off') {
                $output .= '<div class="price_div"><span class="priceSpan">' . $row['price'] . '</span></div>';
            } else {
                if (is_numeric($row['price']) && is_numeric($row['bonus'])) {
                    $newPrice = $row['price'] - ($row['price'] * $row['bonus'] / 100);
                }
                $output .= '<div class="price_div"><span class="priceSpan"><del>' . $row['price'] . '</del></span><span class="priceSpan">' . $newPrice . '</span></div>';
            }
            $output .= '<span class="span_sale">SALE</span>';
            if ($row['discount'] == 'on' && $row['bonus']) {
                $output .= '<span class="discountSpan">' . $row['bonus'] . '%'.'</span>';
            }
            $output .= '<button type="button" data-id="' . $row['id'] . '" class="editButton itembtn rounded-0" name="editButton">edit</button>';
            $hideOrShowValue = $row['status'] === 'hide' ? 'show' : 'hide';
            $output .= '<button type="button" data-id="' . $row['id'] . '" class="hideOrShow itembtn rounded-0" name="hideOrShowButton" value="' . $row['status'] . '">' . $hideOrShowValue . '</button>' .
                '    </div>';
        }
        $page_query = "SELECT * FROM `menu_items` WHERE `menu_id` = '$t' ORDER BY `id` DESC";
        $page_result = $this->mysqli->query($page_query);
        $total_records = mysqli_num_rows($page_result);
        $total_pages = ceil($total_records / $record_per_page);
        $pagination = '';
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagination .= '<div class="pagination_btn"><span class = "pagination_link" id="' . $i . '">' . $i . '</span></div>';
        }
        $res = [
            'name' => $a,
            'html' => $output,
            'pagination' => $pagination
        ];
        echo json_encode($res);

    }

    public function saveItems($itemName, $itemPrice, $discountPercent, $discount)
    {
        $this->checkImage($_FILES["file"]);
        $iconId = $_POST['iconId'];
        $this->mysqli->query("INSERT INTO `menu_items`(menu_id,description,price,bonus,path,discount,status) VALUES ( $iconId,'$itemName','$itemPrice','$discountPercent','$this->imagePath','$discount','show')");
        $selectItems = $this->mysqli->query("SELECT * FROM `menu_items` WHERE `path` = '$this->imagePath'");

        $itemList = [];
        while ($row = mysqli_fetch_assoc($selectItems)) {
            array_push($itemList, $row);
        }
        echo json_encode($itemList);
        die;
    }

    public function editItem()
    {
        $rowId = $_POST['dataId'];
        $sql = $this->mysqli->query("SELECT * FROM  `menu_items` WHERE `id` ='$rowId'");
        $row = mysqli_fetch_assoc($sql);
        if (is_array($row)) {
            echo json_encode($row);
            die;
        } else {
            $error = [
                'error' => [
                    'message' => 'Sorry, the requested item does not exists.',
                ]
            ];
            echo json_encode($error);
            die;
        }
    }

    public function updateItem($itemName, $itemPrice, $discountPercent, $discount)
    {
        $this->checkImage($_FILES["file"]);
        $itemId = $_POST['itemId'];
        if (!empty($_FILES["file"]) && $_FILES["file"]["size"] > 0) {
            $imagePath = str_replace('..', '/adminka', $this->target_file);
        } else {
            $imagePath = $this->mysqli->query("SELECT `path` FROM `menu_items` WHERE `id` = '$itemId'")->fetch_row()[0];
        }
        $this->mysqli->query("UPDATE `menu_items` SET description = '$itemName',price = '$itemPrice',bonus = '$discountPercent',path = '$imagePath',discount = '$discount',status = 'show'  WHERE `id` = '$itemId'");
        $selectItems = $this->mysqli->query("SELECT * FROM `menu_items` WHERE `path` = '$imagePath'");

        $itemList = [];
        while ($row = mysqli_fetch_assoc($selectItems)) {
            array_push($itemList, $row);
        }
        echo json_encode($itemList);
        die;
    }

    public function deleteItem()
    {
        $deleteId = $_POST['data_id'];
        $this->mysqli->query("DELETE FROM `menu_items` WHERE `id` = '$deleteId'");
        echo $this->mysqli->error;
        $success = [
            'success' => [
                'message' => 'Item  was deleted',
            ]
        ];
        echo json_encode($success);
    }

    public function hide()
    {
        $rowId = $_POST['dataId'];

        $this->mysqli->query("UPDATE `menu_items` SET `status` = 'hide' WHERE `id` ='$rowId'");

        $success = [
            'success' => [
                'message' => 'Item status was changed',
            ]
        ];
        echo json_encode($success);
        die;
    }

    public function show()
    {
        $rowId = $_POST['dataId'];

        $this->mysqli->query("UPDATE `menu_items` SET `status` = 'show' WHERE `id` ='$rowId'");

        $success = [
            'success' => [
                'message' => 'Item status was changed',
            ]
        ];
        echo json_encode($success);
        die;
    }

    public function get_last_products()
    {
        $items = $this->mysqli->query("SELECT * FROM `menu_items` WHERE `status` = 'show' ORDER BY id DESC LIMIT 3");
        $itemListS = [];
        while ($row = mysqli_fetch_assoc($items)) {

            array_push($itemListS, $row);
        }
        echo json_encode($itemListS);
    }


    public function getSale()
    {
        $sale = $this->mysqli->query("SELECT * FROM `menu_items` WHERE `discount` = 'on' AND `status` = 'show' ORDER BY id DESC LIMIT 4");
        $itemListS = [];
        while ($row = mysqli_fetch_assoc($sale)) {

            array_push($itemListS, $row);
        }
        echo json_encode($itemListS);
    }

    public function slider()
    {
        $slider = $this->mysqli->query("SELECT `path` FROM `menu_items` WHERE `status` = 'show' LIMIT 10");
        $imageOut = '';
        while ($row = mysqli_fetch_assoc($slider)) {
            $imageOut .= '<div class="item">
                    <div class="ins-inner-box">
                        <img src="' . $row['path'] . '" style="height: 200px;width: 200px" alt="" />
                        <div class="hov-in">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>';
        }
        $imageList = [
            'html' => $imageOut,
        ];
        echo json_encode($imageList);
    }

    public function gallary()
    {     $record_per_page = 8;
        $page = '';
        $output = '';

        if (isset($_POST['page'])) {
            $page = $_POST['page'];
        } else {
            $page = 1;
        }

             $start_from = ($page - 1) * $record_per_page;



        $sale = $this->mysqli->query("SELECT `path` FROM `menu_items` WHERE `status` = 'show' ORDER BY `id` DESC LIMIT $start_from, $record_per_page ");

        while ($row = mysqli_fetch_assoc($sale)) {
            $output .= '    <div class="col-lg-3 col-md-6 ">' .
                '            <div class="products-single fix">' .
                '            <div class="box-img-hover">' .
                '            <img src="' . $row['path'] . '" class="img-fluid" alt="Image">'.
                '            </div>'.
                '            </div>'.
                '            </div>';
        }


        $page_query = "SELECT * FROM `menu_items` WHERE `status` = 'show' ORDER BY `id` DESC";
        $page_result = $this->mysqli->query($page_query);
        $total_records = mysqli_num_rows($page_result);
        $total_pages = ceil($total_records / $record_per_page);
        $paginationGal = '';
        for ($i = 1; $i <= $total_pages; $i++) {
            $paginationGal .= '<div class="pagination_btn active"><span class = "pagination_link" id="' . $i . '">' . $i . '</span></div>';
        }
        $res = [
            'html' => $output,
            'paginationGal' => $paginationGal,
        ];
//        print_r($res['html']);die;
        echo json_encode($res);

    }

    public function gallaryImg()
    {
        $menuId = $_POST["menuId"];
        $itemListS = $this->query("SELECT * FROM `menu_items` WHERE `menu_id` = '$menuId' AND `status` = 'show'");
        echo json_encode($itemListS);
    }


}
