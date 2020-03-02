<!DOCTYPE html>
<html lang="en">
<!-- Basic -->


<body>

<?php include_once "header.php" ?>



    <!-- Start Slider (home) -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            <li class="text-center">
                <img src="images/banner-01.jpg" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome<br> Flowers shop</strong></h1>
                            <p class="m-b-40"><br></p>

                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="images/banner-02.jpg" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome  <br> Flowers shop</strong></h1>
                            <p class="m-b-40"><br> </p>

                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="images/banner-03.jpg" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome <br> Flowers shop</strong></h1>
                            <p class="m-b-40"><br></p>

                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Categories (home) -->
    <div class="categories-shop">
        <div class="container">
            <div class="row get_last_products">

            </div>
        </div>
    </div>
    <!-- End Categories -->


    <!-- mini slider (home & shop) -->
<!--	<div class="box-add-products">-->
<!--        <div class="instagram-box">-->
<!--            <div class="main-instagram owl-carousel owl-theme">-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--	</div>-->


<!----taza slider--->



    <!-- Start Products (home)  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Flowers and compositions</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                </div>
            </div>
            <div class="row special-list-home"></div>
        </div>
    </div>


<div class="slider container-fluid">
    <div class="thing" id="wrapper">
        <div><img class="sld_img" src="images/1.jpg" alt="slider image"></div>
        <div><img class="sld_img" src="images/2.jpg" alt="slider image"></div>
        <div><img class="sld_img" src="images/3.jpg" alt="slider image"></div>
        <div><img class="sld_img" src="images/4.jpg" alt="slider image"></div>
        <div><img class="sld_img" src="images/5.jpg" alt="slider image"></div>
        <div><img class="sld_img" src="images/6.jpg" alt="slider image"></div>
        <div><img class="sld_img" src="images/7.jpg" alt="slider image"></div>
        <div><img class="sld_img" src="images/8.jpg" alt="slider image"></div>
        <div><img class="sld_img" src="images/9.jpg" alt="slider image"></div>

    </div>
</div>





<script type="text/javascript">
    $(document).ready(function () {
        $('.thing').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            respondTo: 'window',
            centerPadding: '10px',
            arrows:false,
            infinite: true,
            responsive: [
                {
                    breakpoint: 1450,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true,

                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 760,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });

</script>


<?php include_once "footer.php" ?>
</body>

</html>