$(document).ready(function () {
    $.ajax({
        url: '../adminka/php/menu_items.php',
        method: "POST",
        data: {
            className: 'MenuItems',
            actionName: "get_last_products"
        },
        success: function (resp) {
            if (resp) {
                let data = JSON.parse(resp);
                console.log(data.length)
                console.log(data);
                for (let i = 0; i < data.length; i++) {
                    let path = '..' + data[i].path;
                    $(".get_last_products").append(
                        "<div class=\"col-xl-4 col-lg-5 col-md-6 col-sm-12 col-xs-12\">\n" +
                        "                    <div class=\"shop-cat-box\">\n" +
                        "                        <img class=\"img-fluid\" src=" + path + " alt=\"\" />\n" +
                        "                        <a class=\"btn hvr-hover\" href=\"#\">" + data[i].description + "</a>\n" +
                        "                    </div>\n" +
                        "                </div>"
                    )

                }
            }
        }
    })


    $("li.dropdown").on("mouseenter", function () {
        $.ajax({
            url: '../adminka/php/menu_icons.php',
            method: "POST",
            data: {
                className: 'MenuIcons',
                actionName: 'getAllIconNames',
            },
            success: function (resp) {
                if (resp) {
                    let items = JSON.parse(resp);
                    console.log(items);
                    $(".shop_item_names").empty();
                    for (let i = 0; i < items.length; i++) {
                        console.log(items[i].id);
                        $(".shop_item_names").append('<li><a href="../frontend/shop.php?id=' + items[i].id + '">' + items[i].name + '</a></li>');
                    }
                }
            }
        })
    })

    //--------sale----//


    $.ajax({
        method: "POST",
        url: "../adminka/php/menu_items.php",
        data: {
            className: 'MenuItems',
            actionName: 'getSale',
        },
        success: function (response) {
            let res = JSON.parse(response);
            console.log(res);
            for (let i = 0; i < res.length; i++) {
                let inner = '    <div class="col-lg-3  col-md-6 col-sm-6 special-grid best-seller">\n' +
                    '        <div class="products-single container">\n' +
                    '            <div class="box-img-hover">\n' +
                    '                <div class="type-lb">\n' +
                    '                    <p class="sale">Sale' + ' ' + res[i]["bonus"] + '%</p>\n' +
                    '                </div>\n' +
                    '                <img src="' + res[i]['path'] + '" class="img-fluid" alt="Image">\n' +
                    '           <div class="mask-icon">\n' +
                    '<ul>\n' +
                    '<li>\n' +
                    '<a href="../frontend/shop.php?shopId=' + res[i].id + '" data-toggle="tooltip" data-placement="right" title="View">\n' +
                    '<img src="/frontend/images/eye2.png" class="img_view">\n' + '</a>\n' + '</li>\n' + '</ul>\n' +
                    '            </div>\n' +
                    '            <div class="why-text">\n' +
                    '                <h4>' + res[i]['description'] + '</h4>';
                if (res[i]['discount'] != 'on' && !res[i]['bonus']) {
                    inner += '<h5>' + res[i]['price'] + '</h5>';
                } else {
                    let newPrice = res[i]['price'] - (res[i]['price'] * res[i]['bonus'] / 100);
                    inner += '<h5><del>' + res[i]['price'] + '</del> ' +
                        '</h5><h5>' + newPrice + '</h5>';
                }
                ;
                '            </div>\n';
                '        </div>\n';
                $('.special-list-home').append(inner);
            }
        }
    })

    $.ajax({
        method: "POST",
        url: "../adminka/php/menu_items.php",
        data: {
            className: 'MenuItems',
            actionName: 'slider',
        },
        success: function (resp) {
            let images = JSON.parse(resp);
            console.log(images);
            let htmlText = images['html'];
            $('.main-instagram').html(htmlText);
        }
    })


    getAllItems();

    function getAllItems(page) {
        $.ajax({
            method: "POST",
            url: "../adminka/php/menu_items.php",
            data: {
                className: 'MenuItems',
                actionName: 'gallary',
                page: page,
            },
            success: function (response) {
                let res = JSON.parse(response);
                console.log(res);
                $('.special-list_gal').empty();
                $('.pagination').empty();

                $('.special-list_gal').append(res['html']);
                $('.pagination').append(res['paginationGal']);
            }
        })
        $(document).on('click', '.pagination_btn', function () {
            var page = $(this).children().attr('id');
            getAllItems(page);
        });
    }

    $('.all_gal').on('click', function () {
        getAllItems();
    })


    $.ajax({
        url: '../adminka/php/menu_icons.php',
        method: "POST",
        data: {
            className: 'MenuIcons',
            actionName: 'gal_btn',
        },
        success: function (resp) {
            console.log(resp);
            if (resp) {
                let items = JSON.parse(resp);
                // $(".button-group").empty();
                for (let i = 0; i < items.length; i++) {
                    $(".button-group").append("<button data-id='" + items[i].id + "' class='gal_gal'>" + items[i].name + "</button>");
                }
            }

            $('.gal_gal').on('click', function () {
                $.ajax({
                    url: '../adminka/php/menu_items.php',
                    method: "POST",
                    data: {
                        className: 'MenuItems',
                        actionName: 'gallaryImg',
                        menuId: $(this).attr('data-id'),
                    },
                    success: function (response) {
                        let res = JSON.parse(response);
                        console.log(res);
                        $('.special-list_gal').empty();
                        for (let i = 0; i < res.length; i++) {
                            let inner = '    <div class="col-lg-3 col-md-6 special-grid">\n' +
                                '            <div class="products-single fix">\n' +
                                '            <div class="box-img-hover">\n' +
                                '            <img src="' + res[i]['path'] + '" class="img-fluid" alt="Image">\n' +

                                '            </div>\n' +
                                '            </div>\n' +
                                '            </div>';
                            $('.special-list_gal').append(inner);
                        }
                    }
                })
            })
        }
    })


})


