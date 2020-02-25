<?php include '../adminka/php/MenuIcons.php';
$menuIcon = new MenuIcons('localhost','root','','flowers');
$aboutAs = $menuIcon->mysqli->query("SELECT * FROM `aboutus`")->fetch_assoc();
//print_r($aboutAs['title']);

?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<body>

<?php include_once "header.php" ?>

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>ABOUT US</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">ABOUT US</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start About Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="row textBox">
                <div class="col-lg-6">
                    <div class="banner-frame">
                        <img class="img-fluid" src="<?php echo $aboutAs['image']; ?>" alt="about us" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="noo-sh-title-top"><?php echo $aboutAs['title']; ?></h2>
                    <p><?php echo $aboutAs['text']; ?></p>
                </div>
            </div>
            </div>

    </div>
    <!-- End About Page -->

<?php include_once "footer.php" ?>
</body>

</html>