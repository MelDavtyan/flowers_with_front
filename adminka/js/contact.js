function contactUs(res){

    for(let i = 0; i< res.length; i++) {
        $('.contact_mod').html(' <img class="close_cont js-close" src="/adminka/test/close4.png">\n' +
            '    <div class="cont_div"><span class="cont_span">' + res[i]['address'] + '</span></div>\n' +
            '    <div class="cont_div"><span class="cont_span">' + res[i]['phone'] + '</span></div>\n' +
            '    <div class="cont_div"><span class="cont_span">' + res[i]['email'] + '</span></div>\n' +
            '    <button type="button" class="contact_edit" data-id="' + res[i]['id'] + '">EDIT</button>')



        $('.js-close').on('click', function (){
            $('.contact_mod').hide();
            $('.contactUsBoxUp').hide();
        })
    }
}


$.ajax({
    url : 'php/menu_icons.php',
    method : 'POST',
    data : {
        className : 'MenuIcons',
        actionName : 'getAllItemsFromContactUs'
    },
    success : function (response) {
        let res = JSON.parse(response);
        // console.log(res);
        if(res){
            contactUs(res);
        }

    }
})


$('.contactUs').on('click', function () {
    $.ajax({
        url : 'php/menu_icons.php',
        method : 'POST',
        data : {
            className : 'MenuIcons',
            actionName : 'getAllItemsFromContactUs'
        },
        success : function (response) {
            let res = JSON.parse(response);
            // console.log(res);
            if(res.length > 0){
                $('.contact_mod').show();
            }else{
                $('.contactUsBox').show();
            }
        },

    });
})

//$('body').delegate('.textForm','submit', function () {
$('.contactForm').on('submit', function (event) {
    event.preventDefault();
    let text_address = $(' .contactForm .text_address').val();
    console.log(text_address);
    let text_phone = $(' .contactForm .text_phone').val();
    let text_email =  $('.contactForm .text_email').val();

    if (text_address == null || text_address == ''){
        $('.contactForm .errorAddrescont').html('Please fill in the blank fields');

        return false;
    }else if(text_phone == null || text_phone == ''){
        $('.contactForm .errorPhonecont').html('Please fill in the blank fields');
        $('.contactForm .errorAddrescont').hide();
        return  false;
    }else if(text_email == null || text_email == ''){
        $('.contactForm .errorEmailcont').html('Please fill in the blank fields');
        $('.contactForm .errorPhonecont').hide();
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

            $('.contactUsBox').hide()
            $('.contact_mod').show();
            contactUs(response);


        }
    })
})

$('body').delegate('.contact_edit','click', function () {
    $.ajax({
        url : 'php/menu_icons.php',
        method : 'POST',
        data : {
            className : 'MenuIcons',
            actionName : 'editContactUsData',
            editId :  $(this).attr('data-id'),
        },
        success : function (response) {
            let res = JSON.parse(response);
            console.log(res[0]['address']);
            $('.contact_mod').hide();
            $('.contactUsBoxUp').show();
            $('.text_address').val(res[0]['address']);
            $('.text_phone').val(res[0]['phone']);
            $('.text_email').val(res[0]['email']);

        }
    })
})


$('.UpContactForm').on('submit',function (event) {
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
            $('.contactUsBoxUp').hide();
            $('.contact_mod').show();
            // $('.contact_mod').empty();
            contactUs(response);
        }
    })
})

