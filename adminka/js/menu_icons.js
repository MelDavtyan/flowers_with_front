$(document).ready(function () {
    $('.btn_add').on('click', function () {
        $('.cont').show();
        $('.body_cont').css('filter', 'blur(3px)');
    })

    $('.js-close').on('click', function () {
        $('.itemForm .errorFile').html('');
        $('.itemForm .errorName').html('');
        $('.cont').hide();
        $('.about_mod').css('display', 'none');
        $('.itemForm')[0].reset();
        $('.body_cont').css('filter', 'none');
        $('.aboutUsBox').hide();
        $('.textForm .errorName').html('');
        $('.textForm .errorTextArea').html('');
        $('.textForm .errorFile').html('');
        $('.textForm').trigger("reset");
    })

    $('.js-close').on('click', function () {
        $('.itemForm .errorFile').html('');
        $('.itemForm .errorName').html('');
        $('.editDiv').hide();
        $('.body_cont').css('filter', 'none');
    })


    $('body').delegate('.itemForm', 'submit', function () {
        var name = $('.itemForm .inp_name').val().trim();
        var file = $('.itemForm .file-upload').val();
        if (name == '' || name == null) {
            $('.itemForm .errorName').html('Please fill in the blank fields');
            return false;
        } else {
            $('.itemForm .errorName').html('');
        }
        if (file == '' || file == null) {
            $('.itemForm .errorFile').html('Please select file');
            return false;
        } else {
            $('.itemForm .errorFile').html('');
        }
        // event.preventDefault();
        $.ajax({
            url: 'php/menu_icons.php',
            dataType: "JSON",
            method: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function (response) {
                console.log(response);
                if (response['error']) {
                    alert(response['error']['message'])
                } else {
                    $('.menu_panel').append('<div class="menu_icon">\n' +
                        '<img src="' + response['path'] + '">\n' +
                        '<span class="menu_span">' + response['name'] + '</span>\n' + '</div>')
                    $(".cont").css("display", "none");
                }
            }
        })
    });


    $.ajax({
        url: 'php/menu_icons.php',
        method: 'POST',
        data: {
            className: 'MenuIcons',
            actionName: 'getAllIcons',
        },
        success: function (response) {
            // console.log(response);
            let menu_icons = JSON.parse(response);
            console.log(menu_icons);
            for (let i = 0; i < menu_icons.length; i++) {
                let inner = '<div tabindex="0" class="menu_icon" data-id="' + menu_icons[i]['id'] + '">\n' +
                    '<img class="ima_ge" src="' + menu_icons[i]['path'] + '">\n' +
                    '<div class="span_div">\n' +
                    '<span class="menu_span" data-id="' + menu_icons[i]['id'] + '">' + menu_icons[i]['name'] + '</span>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '<img class="edit_img" data-id="' + menu_icons[i]['id'] + '" src="test/edit-button.png">\n';
                if (menu_icons[i]['status'] != 'deleted') {
                    inner += '<img class="delete_btn" src="test/delete (2).png" data-id = "' + menu_icons[i]['id'] + '" >';
                } else {
                    inner += '<img class="backup" src="test/backup2.png" data-id = "' + menu_icons[i]['id'] + '" >';
                }
                $('.menu_panel').append(inner);
            }

            $(".edit_img").on('click', function () {
                var menuId = $(this).attr("data-id");
                $.ajax({
                    url: 'php/menu_icons.php',
                    method: 'POST',
                    data: {
                        className: 'MenuIcons',
                        actionName: 'editItem',
                        menuId: menuId,
                    },
                    success: function (response) {
                        console.log(response);
                        let editIcons = JSON.parse(response);
                        let editIconId = editIcons[0]['id'];
                        $('.editDiv').show();
                        $('.edit_name').val(editIcons[0]['name']);
                        $('.hiddenInput').val(editIconId);
                    }
                })
            });
        },
    })

    $('.menu_panel').on('click', '.delete_btn', function () {
        let dataId = $(this).attr('data-id');
        localStorage.setItem('dataId', dataId);
        $('.conf_box').show();
        $('.body_cont').hide();
    })
    //
    //
    //
    $('.menu_panel').on('click', '.backup', function () {
        let backupId = $(this).attr('data-id');
        localStorage.setItem('backupId', backupId);
        $('.return_box').show();
        $('.body_cont').hide();
    })

    $('.rtn_accept').on('click', function () {
        let backupId = localStorage.getItem('backupId');
        $.ajax({
            url: 'php/menu_icons.php',
            method: 'POST',
            data: {
                className: 'MenuIcons',
                actionName: 'backupIcon',
                dataId: backupId,
            },
            success: function (response) {
                window.location.reload();
            }
        })
    })

    $('.rtn_cancel').on('click', function () {
        $('.return_box').hide();
        $('.body_cont').show();
    })

    $('.conf_accept').click(function () {
        let iconId = localStorage.getItem('dataId');
        console.log(iconId);
        $.ajax({
            url: 'php/menu_icons.php',
            method: 'POST',
            data: {
                className: 'MenuIcons',
                actionName: 'daleteIcon',
                dataId: iconId,
            },
            success: function (response) {
                window.location.reload();
            }
        })
    });

    $('.conf_cancel').on('click', function () {
        $('.conf_box').hide();
    });

    $('.updateForm').on('submit', function (event) {
        event.preventDefault()
        let data = new FormData(this);
        $.ajax({
            url: 'php/menu_icons.php',
            dataType: "JSON",
            method: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function (response) {
                window.location.reload();
            }
        })
    })

    $(".menu_panel").on("click", ".menu_icon", function () {
        var menuId = $(this).attr("data-id");
        localStorage.setItem('menu_id', menuId);
        console.log(menuId);
        load_data();
        // console.log($('.hiddenInput').val());
        // $(this).siblings("button").val();
        function load_data(page) {
            $.ajax({
                url: 'php/menu_items.php',
                method: 'POST',
                data: {
                    className: 'MenuItems',
                    actionName: 'getItem',
                    menuId: menuId,
                    page: page,
                },
                success: function (response) {
                    let res = JSON.parse(response);
                    console.log(res);
                    let htmlText = res['html'];
                    let pagination = res['pagination'];
                    $('.menu_title').children("h2").html(res['name']);
                    $('.allItems').html(htmlText);
                    $('.pagination').html(pagination);
                    $('.body_cont').css('display', 'block');
                    $('.conf_box').hide();
                    $('.return_box').hide();
                    $('body').delegate('#create', 'click', function () {
                        $('#createArea').show();
                        $('.body_cont').css('filter', 'blur(3px)');
                    });
                }
            });
        }

        $(document).on('click', '.pagination_btn', function () {
            var page = $(this).children().attr('id');
            load_data(page);
        });
    })

    $.ajax({
        url : 'php/menu_icons.php',
        method : 'POST',
        data : {
            className : 'MenuIcons',
            actionName : 'getAllItemsFromAboutUs'
        },
        success : function (response) {
            let res = JSON.parse(response);
            // console.log(res);
            if(res){
                $('.about_mod').html(' <img class="close_cont js-close" src="/adminka/test/close4.png" >\n' +
                    '    <div class="about_inp"><span class="about_title">'+res[0]['title']+'</span></div>\n' +
                    '    <div class="about_img"><img src="'+res[0]['image']+'" alt="image" style="width: 300px;height: 300px;"></div>\n' +
                    '    <textarea class="about_text">'+res[0]['text']+'</textarea>\n' +
                    '    <button class="about_edit" data-id="'+res[0]['id']+'">EDIT</button>')
            }

        }
    })


    $('.aboutUs').on('click', function () {
        $.ajax({
            url : 'php/menu_icons.php',
            method : 'POST',
            data : {
                className : 'MenuIcons',
                actionName : 'getAllItemsFromAboutUs'
            },
            success : function (response) {
                let res = JSON.parse(response);
                // console.log(res);
                if(res.length > 0){
                    $('.about_mod').show();
                }else{
                    $('.aboutUsBox').show();
                }
            }
        })
    })

    //$('body').delegate('.textForm','submit', function () {
    $('.textForm').on('submit', function (event) {
        event.preventDefault();
       let text_title =  $('.textForm .text_title').val();
        let text_box = $(' .textForm .text_box').val();
        let text_upload = $(' .textForm .text-upload').val();

        if (text_title == null || text_title == ''){
            $('.textForm .errorName').html('Please fill in the blank fields');
            return false;
        }else if(text_box == null || text_box == ''){
            $('.textForm .errorTextArea').html('Please fill in the blank fields');
            return false;
        }else if(text_upload == null || text_upload == ''){
            $('.textForm .errorFile').html('Please select file');
            return false;
        }

        $.ajax({
            url: 'php/menu_icons.php',
            dataType: "JSON",
            method: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function (response) {
                console.log(response);
                console.log(response[0]['image']);
                $('.aboutUsBox').hide()
                $('.about_mod').show();
                $('.about_mod').html(' <img class="close_cont js-close" src="/adminka/test/close4.png">\n' +
                    '    <div class="about_inp"><span class="about_title">'+response[0]['title']+'</span></div>\n' +
                    '    <div class="about_img"><img src="'+response[0]['image']+'" alt="image" style="width: 300px;height: 300px;"></div>\n' +
                    '    <textarea class="about_text">'+response[0]['text']+'</textarea>\n' +
                    '    <button class="about_edit" data-id="'+response[0]['id']+'">EDIT</button>')

                $('.textForm').trigger("reset");


                $('.js-close').on('click', function (){
                    $('.about_mod').hide();
                    $('.aboutUsBoxUp').hide();
                })

                $('.about_mod').on('click','.about_edit',function () {
                    $.ajax({
                        url : 'php/menu_icons.php',
                        method : 'POST',
                        data : {
                            className : 'MenuIcons',
                            actionName : 'editAboutUsData',
                            editId :  $(this).attr('data-id'),
                        },
                        success : function (response) {
                            let res = JSON.parse(response);
                            $('.about_mod').hide();
                            $('.aboutUsBoxUp').show();
                            $('.text_title').val(res[0]['title']);
                            $('.text_box').text(res[0]['text']);
                        }
                    })
                })

            }
        })
    })

    $('.UpAboutForm').on('submit',function (event) {
        event.preventDefault();
        $.ajax({
            url: 'php/menu_icons.php',
            dataType: "JSON",
            method: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success : function (response) {
                console.log(response);
                $('.aboutUsBoxUp').hide();
                $('.about_mod').show();
                // $('.about_mod').empty();
                $('.about_mod').html('<img class="close_cont js-close" src="/adminka/test/close4.png">\n' +
                    '    <div class="about_inp"><span class="about_title">'+response[0]['title']+'</span></div>\n' +
                    '    <div class="about_img"><img src="'+response[0]['image']+'" alt="image" style="width: 300px;height: 300px;"></div>\n' +
                    '    <textarea class="about_text">'+response[0]['text']+'</textarea>\n' +
                    '    <button class="about_edit" data-id="'+response[0]['id']+'">EDIT</button>')

            }
        })
    })

    $('.about_edit').on('click', function () {
        $('.about_mod').hide();
        $('.aboutUsBoxUp').show();

    })

    $('.logout').on('click', function () {
        window.location.href = 'index.php';
    })
});