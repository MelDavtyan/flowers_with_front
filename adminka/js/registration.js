$(document).ready(function () {
    $('.button').click(function () {
        $.ajax({
            url : 'php/registration.php',
            method : 'POST',
            data: {
                user:{
                    username : $('.username').val(),
                    password : $('.password').val(),
                },
            },
        }).done(function (response) {
            if(response == 'success'){
                location.href = 'admin.php';
            }else{
                $('#span').html('Username or password is incorrect');
            }
        })
    })
})