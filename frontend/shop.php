<?php
include '../adminka/php/MenuItems.php';
$obj = new MenuItems('localhost', 'root', '', 'flowers');
if (isset($_GET['id']) || isset($_GET['page'])) {
    $id = $_GET['id'];
    if (!isset($_GET['page'])) $page = 1; else $page = $_GET['page'];
    $count_query = $obj->mysqli->query("SELECT COUNT(*) FROM `menu_items` WHERE `status` = 'show' ");
    $count_array = $count_query->fetch_array(MYSQLI_NUM);
    $count = $count_array[0];
    $limit = 8;
    $start = ($page * $limit) - $limit;
    $length = ceil($count / $limit);
    $items = $obj->mysqli->query("SELECT * FROM `menu_items` WHERE `menu_id` = $id AND `status` = 'show' ORDER BY `id` DESC LIMIT $start , $limit");
    function pagination($length, $page, $id)
    {
        for ($i = 1; $i < $length; $i++) {
            echo '<a style="z-index:4" href="shop.php?id=' . $id . '&page=' . $i . '">' . $i . '</a>';
        }
    }
}

if (isset($_GET['shopId'])) {
    $id = $_GET['shopId'];
    $items = $obj->query("SELECT * FROM `menu_items` WHERE `id` = '$id'");
}


?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->


<body>

<?php include "header.php" ?>

<!-- Start Shop Page  -->
<div class="shop-box-inner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-sm-12 col-xs-12 shop-content-right">
                <div class="right-product-box">
                    <div class="product-item-filter row">
                        <div class="col-12 col-sm-8 text-center text-sm-left">
                            <div class="toolbar-sorter-right">
                                <span>Sort by </span>
                                <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                                    <option data-display="Select">Nothing</option>

                                    <option value="2">High Price → High Price</option>
                                    <option value="3">Low Price → High Price</option>

                                </select>
                            </div>
                            <p>Showing all 4 results</p>
                        </div>
                        <div class="col-12 col-sm-4 text-center text-sm-right"></div>
                    </div>

                    <div class="product-categorie-box">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                <div class="row special-list">
                                    <?php
                                    //                                    print_r($items);die;
                                    if ($items) {
                                        while ($row = $items->fetch_assoc()) {
                                            echo '
                                        <div class="col-xl-4 col-lg-3  col-md-4 col-sm-6 special-grid best-seller">
                                            <div class="products-single container">
                                                <div class="box-img-hover">
                                                    <div class="type-lb">';
                                            if ($row['discount'] = 'on' && $row['bonus']) {
                                                echo '<p class="sale">Sale' . $row['bonus'] .'%' .'</p>';
                                            };
                                            echo ' </div>
                                                    <img src="' . $row['path'] . '" class="img-fluid" alt="Image">
                                                    
                                                    <div class="why-text">
                                                        <h4>' . $row['description'] . '</h4>';
                                            if ($row['discount'] != 'on' && !$row['bonus']) {
                                                echo '<h5>' . $row['price'] . '</h5>';
                                            } else {
                                                if(is_numeric($row['price']) && is_numeric($row['bonus'])){
                                                 $newPrice = $row['price'] - ($row['price'] * $row['bonus'] / 100);
                                                }
                                                echo '<h5><del>' . $row['price'] . '</del></h5><h5>' . $newPrice . '</h5>';
                                            };
                                            echo '</div>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                        pagination($length, $page, $id);
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--				<div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">-->
<!--                    <div class="product-categori">-->
<!--                        <div class="search-product">-->
<!--                            <form action="#">-->
<!--                                <input class="form-control" placeholder="Search here..." type="text">-->
<!--                                <button type="submit"> <i class="fa fa-search"></i> </button>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                        <div class="filter-sidebar-left">-->
<!--                            <div class="title-left">-->
<!--                                <h3>Categories</h3>-->
<!--                            </div>-->
<!--                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">-->
<!--                                <div class="list-group-collapse sub-men">-->
<!--                                    <a class="list-group-item list-group-item-action" href="#sub-men1" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men1">Fruits & Drinks <small class="text-muted">(100)</small>-->
<!--								</a>-->
<!--                                    <div class="collapse show" id="sub-men1" data-parent="#list-group-men">-->
<!--                                        <div class="list-group">-->
<!--                                            <a href="#" class="list-group-item list-group-item-action active">Fruits 1 <small class="text-muted">(50)</small></a>-->
<!--                                            <a href="#" class="list-group-item list-group-item-action">Fruits 2 <small class="text-muted">(10)</small></a>-->
<!--                                            <a href="#" class="list-group-item list-group-item-action">Fruits 3 <small class="text-muted">(10)</small></a>-->
<!--                                            <a href="#" class="list-group-item list-group-item-action">Fruits 4 <small class="text-muted">(10)</small></a>-->
<!--                                            <a href="#" class="list-group-item list-group-item-action">Fruits 5 <small class="text-muted">(20)</small></a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="list-group-collapse sub-men">-->
<!--                                    <a class="list-group-item list-group-item-action" href="#sub-men2" data-toggle="collapse" aria-expanded="false" aria-controls="sub-men2">Vegetables-->
<!--								<small class="text-muted">(50)</small>-->
<!--								</a>-->
<!--                                    <div class="collapse" id="sub-men2" data-parent="#list-group-men">-->
<!--                                        <div class="list-group">-->
<!--                                            <a href="#" class="list-group-item list-group-item-action">Vegetables 1 <small class="text-muted">(10)</small></a>-->
<!--                                            <a href="#" class="list-group-item list-group-item-action">Vegetables 2 <small class="text-muted">(20)</small></a>-->
<!--                                            <a href="#" class="list-group-item list-group-item-action">Vegetables 3 <small class="text-muted">(20)</small></a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <a href="#" class="list-group-item list-group-item-action"> Grocery  <small class="text-muted">(150) </small></a>-->
<!--                                <a href="#" class="list-group-item list-group-item-action"> Grocery <small class="text-muted">(11)</small></a>-->
<!--                                <a href="#" class="list-group-item list-group-item-action"> Grocery <small class="text-muted">(22)</small></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="filter-price-left">-->
<!--                            <div class="title-left">-->
<!--                                <h3>Price</h3>-->
<!--                            </div>-->
<!--                            <div class="price-box-slider">-->
<!--                                <div id="slider-range"></div>-->
<!--                                <p>-->
<!--                                    <input type="text" id="amount" readonly style="border:0; color:#fbb714; font-weight:bold;">-->
<!--                                    <button class="btn hvr-hover" type="submit">Filter</button>-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

<!-- End Shop Page -->

<!-- Start Instagram Feed  -->
<div class="instagram-box">
    <div class="main-instagram owl-carousel owl-theme">
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-01.jpg" alt=""/>
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-02.jpg" alt=""/>
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-03.jpg" alt=""/>
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-04.jpg" alt=""/>
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-05.jpg" alt=""/>
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-06.jpg" alt=""/>
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-07.jpg" alt=""/>
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-08.jpg" alt=""/>
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-09.jpg" alt=""/>
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-05.jpg" alt=""/>
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Instagram Feed  -->

<?php include_once "footer.php" ?>
</body>

</html>