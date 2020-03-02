function aboutUs(res)
{
    for (let i = 0; i < res.length; i++){
        $('.about_mod').html(' <img class="close_cont js-close" src="/adminka/test/close4.png" >\n' +
            '    <div class="about_inp"><span class="about_title">'+res[i]['title']+'</span></div>\n' +
            '    <div class="about_img"><img src="'+res[i]['image']+'" alt="image" style="width: 300px;height: 300px;"></div>\n' +
            '    <textarea class="about_text">'+res[i]['text']+'</textarea>\n' +
            '    <button class="about_edit" data-id="'+res[i]['id']+'">EDIT</button>')
    }

    $('.js-close').on('click', function (){
        $('.about_mod').hide();
        $('.aboutUsBoxUp').hide();
    })

}


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
            aboutUs(res);
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
            aboutUs(response);
            $('.textForm').trigger("reset");



        }
    })
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
            $('.text_address').val(res[0]['title']);
            $('.text_phone').text(res[0]['text']);
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
            aboutUs(response);

        }
    })
})

$('.about_edit').on('click', function () {
    $('.about_mod').hide();
    $('.aboutUsBoxUp').show();

})