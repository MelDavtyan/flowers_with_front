$(".itemPrice").blur(function () {
    let d = $(".itemPrice").val();
    if (isNaN(d)) {
        $(".errorPriceSpan").text("Please enter a number");
    } else {
        $(".errorPriceSpan").text("");
    }
});
$(".cowbell").blur(function () {
    let d = $(".cowbell").val();
    if (isNaN(d)) {
        $(".errorDiscountSpan").text("Please enter a number");
    } else {
        $(".errorDiscountSpan").text("");
    }
});

function load_data(page) {
    let iconId = localStorage.getItem('menu_id');
    $.ajax({
        url: 'php/menu_items.php',
        method: 'POST',
        data: {
            className: 'MenuItems',
            actionName: 'getItem',
            menuId: iconId,
            page: page,
        },
        success: function (response) {
            let res = JSON.parse(response);
            let htmlText = res['html'];
            let pagination = res['pagination'];
            $('.allItems').html(htmlText);
            $('.pagination').html(pagination);
            $('.body_cont').css('display', 'block');
        }
    });
}

$(document).ready(function () {
    $('.js-close-campaign').click(function () {
        $('#itemForm .errorNameSpan').html('');
        $('#itemForm .errorPriceSpan').html('');
        $('#itemForm .errorFileSpan').html('');
        $('.body_cont').css('opacity', '1');
        $('.body_cont').css('filter', 'none');
        $('#itemForm').trigger("reset");
        $(this).parent().parent().css('display', 'none');
    });

    $('#itemForm').on('submit', function (event) {
        event.preventDefault();
        var iconId = localStorage.getItem('menu_id');
        $('#itemForm').append("<input type='hidden' name='iconId' value="+iconId+">");
        var name = $('#itemForm .itemName').val().trim();
        var price = $('#itemForm .itemPrice').val().trim();
        var file = $('#itemForm .file').val();
        var discount = $('#itemForm .cowbell').val().trim();
        if (name == '' || name == null) {
            $('#itemForm .errorNameSpan').html('Please fill in the blank fields');
            return false;
        }else{
            $('#itemForm .errorNameSpan').html('');
        }
        if (price == '' || price == null) {
            $('#itemForm .errorPriceSpan').html('Please fill in the blank fields');
            return false;
        }else{
            $('#itemForm .errorPriceSpan').html('');
        }
        if (file == '' || file == null) {
            $('#itemForm .errorFileSpan').html('Please select file');
            return false;
        }else{
            $('#itemForm .errorFileSpan').html('');
        }
        $.ajax({
            url: 'php/menu_items.php',
            dataType: "JSON",
            method: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function (response) {
                console.log(response);
                if (response['error']){
                    alert(response['error']['message']);
                }else{
                    load_data(1);
                    $('#createArea').hide();
                    $('.body_cont').css('filter', 'none');
                    $('#itemForm').trigger("reset");
                }
            }
        });
    });
    $('.checkBoxSwitch').on('click', function () {
        let elem = $(this).prev().prev();
        if ($(elem).val() === "off") {
            $(elem).val('on');
        } else {
            $(elem).val('off');
        }
    });
    $('.allItems').on('click', '.editButton', function () {
        $.ajax({
            url: 'php/menu_items.php',
            method: 'POST',
            data: {
                className: 'MenuItems',
                actionName: 'editItem',
                action: 'editing',
                dataId: $(this).attr('data-id'),
            },
            success: function (res) {
                let response = JSON.parse(res);
                if (response['error']){
                    alert(response['error']['message']);
                }else{
                    $('.inputContainer').show();
                    $('.body_cont').css('opacity', '0.5');
                    $('.body_cont').css('filter', 'blur(3px)');
                    $('#edit_name').val(response['description']);
                    $('#edit_price').val(response['price']);
                    $('#edit_discount').val(response['bonus']);
                    $('#edit_itemId').val(response['id']);
                    $('.deletBtn').attr({'data-id': response['id']})
                }
            }
        })
    });

    $('.deletBtn').on('click',function (){
        let deleteId = $(this).attr('data-id');
        localStorage.setItem('deleteId',deleteId);
        $('.delete_box').show();
        $('.inputContainer').css('display', 'none');
        $('.icon_panel').css('opacity', '0.5');
        $('.body_box').css('background-color', 'grey');
        $('.delete_box').css("z-index",'3');
    })

    $('.dlt_accept').on('click',function () {
        let acceptId = localStorage.getItem('deleteId');
        $.ajax({
            url: 'php/menu_items.php',
            method: 'POST',
            data: {
                className:'MenuItems',
                actionName: 'deleteItem',
                data_id: acceptId,
            },
            success:function (response) {
                let res= JSON.parse(response);
                if (res['success']){
                    alert(res['success']['message']);
                    load_data(1);
                    $('.inputContainer').hide();
                    $('.body_cont').css('filter', 'none');
                    $('.body_cont').css('opacity', '1');
                    $('.body_box').css('background-color', 'rgba(42, 42, 44, 0.9)');
                    $('.icon_panel').css('opacity', '1');
                    $('#itemForm').trigger("reset");
                    $('.delete_box').hide();
                    $('.inputContainer').css('opacity', '5');
                }
            }
        })
    })

    $('.dlt_cancel').on('click',function () {
        $('.inputContainer').css('display', 'block');
        $('.icon_panel').css('opacity', '1');
        $('.body_box').css('background-color', 'rgba(42, 42, 44, 0.9)');
        $('.delete_box').hide();
    })

    $('#updateForm').on('submit', function (event) {
        event.preventDefault();
        let data = new FormData(this);
        console.log(data);
        $.ajax({
            url: 'php/menu_items.php',
            dataType: "JSON",
            method: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: data,
            success: function (response) {
                if (response['error']){
                    alert(response['error']['message']);
                }else{
                    alert('Editing item was successful');
                    load_data(1);
                    $('.inputContainer').hide();
                    $('.body_cont').css('filter', 'none');
                    $('.body_cont').css('opacity', '1');
                    $('#itemForm').trigger("reset");
                }
            },
        });
    });

    $('.allItems').on('click', '.hideOrShow', function () {
        let elem = $(this);
        let val = $(this).attr('value');
        let act = $(this).html().trim();
        $.ajax({
            url: 'php/menu_items.php',
            method: 'POST',
            data: {
                className: 'MenuItems',
                actionName: act,
                dataId: $(this).attr('data-id'),
            },
            success: function (response) {
                $(elem).html(val);
                $(elem).attr('value', act);
            }
        })
    })
});
$('.js-close').on('click',function () {
    $('.body_cont').css('display','none');
})