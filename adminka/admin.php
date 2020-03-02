<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/menu_items.css">
    <link rel="stylesheet" href="css/menu_icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <title>Document</title>

</head>
<body class="body_box">

<div class="title_box" >
    <h1 class="h4">ADMIN PANEL</h1>
    <img class="logout" src="/adminka/test/logout.png">
    <img class="aboutUs" tabindex="0" src="/adminka/test/us512.png">
    <img class="contactUs" tabindex="0" src="/adminka/test/contact.png">
</div>

<div class="about_mod">

</div>
<div class="contact_mod">

</div>

<div class="aboutUsBoxUp">
    <form class="UpAboutForm" enctype="multipart/form-data">
        <input class="text_title" maxlength="35" name="text_address" placeholder="Name"  type="text"> <br>
        <span class="errorName"></span>
        <input type="hidden" name="className" value="MenuIcons">
        <input type="hidden" name="actionName" value="UpdateAboutUs">
        <label for="updateAboutImage" class="custom-file-upload">Icon Upload</label>
        <input id="updateAboutImage" name="text-upload" class="text-upload" accept="image/*" type="file"/> <br>
        <span class="errorFile"></span>
        <textarea class="text_box" name="text_phone"></textarea>
        <input  class="btn_text" type="submit" value="UPDATE">
        <img class="close_cont js-close" src="/adminka/test/close4.png">
    </form>
</div>


<div class="aboutUsBox">
    <form class="textForm" enctype="multipart/form-data">
        <input class="text_title" maxlength="35" name="text_address" placeholder="Name" id="text_title" type="text"> <br>
        <span class="errorName"></span>
        <input type="hidden" name="className" value="MenuIcons">
        <input type="hidden" name="actionName" value="aboutUs">
        <label for="uploadImage" class="custom-file-upload">Icon Upload</label>
        <input id="uploadImage" name="text-upload" class="text-upload" accept="image/*" type="file"/> <br>
        <span class="errorFile"></span>
        <textarea class="text_box" name="text_phone"></textarea>
        <span class="errorTextArea"></span>
        <input  class="btn_text" type="submit" value="SAVE">
        <img class="close_cont js-close" src="/adminka/test/close4.png">
    </form>
</div>

<div class="contactUsBoxUp">
    <form class="UpContactForm" enctype="multipart/form-data">
        <input type="hidden" name="className" value="MenuIcons">
        <input type="hidden" name="actionName" value="UpdateContactUs">
        <input class="cont_inp_css text_address " name="text_address" placeholder="Address" type="text"><br>
        <span class="errorNamecont "></span>
        <input class="cont_inp_css text_phone " maxlength="25" name="text_phone" placeholder="Phone"  type="text"><br>
        <span class="errorNamecont"></span>
        <input class="cont_inp_css text_email" maxlength="15" name="text_email" placeholder="Email"  type="email"> <br>
        <span class="errorNamecont"></span>
        <input  class="btn_contact" type="submit" value="UPDATE">
        <img class="close_cont js-close" src="/adminka/test/close4.png">
    </form>
</div>

<div class="contactUsBox">
    <form class="contactForm" enctype="multipart/form-data">
        <input type="hidden" name="className" value="MenuIcons">
        <input type="hidden" name="actionName" value="contactUs">
        <input class="cont_inp_css text_address" name="text_address" placeholder="Address" type="text"><br>
        <span class="errorNamecont errorAddrescont"></span>
        <input class="cont_inp_css text_phone" maxlength="25" name="text_phone" placeholder="Phone"  type="text"><br>
        <span class="errorNamecont errorPhonecont"></span>
        <input class="cont_inp_css text_email "  name="text_email" placeholder="Email"  type="email"> <br>
        <span class="errorNamecont errorEmailcont"></span>
        <input  class="btn_contact" type="submit" value="SAVE">
        <img class="close_cont js-close" src="/adminka/test/close4.png">
    </form>
</div>

<div class="conf_box">
    <span class="span_del">Are you sure you want to delete</span>
    <input type="hidden" value="" class="iconMenuId">
    <button class="conf_accept" data-id="">Accept</button>
    <button class="conf_cancel">Cancel</button>
</div>

<div class="delete_box">
    <span class="span_del">Are you sure you want to delete.</span>
    <input type="hidden" value="" class="iconMenuId">
    <button class="dlt_accept" data-id="">Accept</button>
    <button class="dlt_cancel">Cancel</button>
</div>

<div class="return_box">
    <span class="span_del">Are you sure you want to return.</span>
    <input type="hidden" value="" class="iconMenuId">
    <button class="rtn_accept" data-id="">Accept</button>
    <button class="rtn_cancel">Cancel</button>
</div>




<div id="cont" class="cont">
    <form class="itemForm" enctype="multipart/form-data">
        <input class="inp_name" maxlength="15" name="inp_name" placeholder="Name" id="inp_name" type="text"> <br>
        <span class="errorName"></span>
        <input type="hidden" name="className" value="MenuIcons">
        <input type="hidden" name="actionName" value="saveIcons">
        <label for="upload" class="custom-file-upload">Icon Upload</label>
        <span class="errorFile"></span>
        <input id="upload" name="file-upload" class="file-upload" accept="image/*" type="file"/> <br>
        <input id="btn_save" class="btn_save" type="submit" value="SAVE">
        <img class="close_cont js-close" src="/adminka/test/close4.png">
    </form>
</div>

<div id="editDiv" class="editDiv">
    <form class="updateForm" enctype="multipart/form-data">
        <input class="edit_name" maxlength="15" name="inp_name" placeholder="Name"  type="text"> <br>
        <span class="errorName"></span>
        <label for="file-upload" class="custom-file-upload">Icon Upload</label>
        <span class="errorFile"></span>
        <input name="file-upload" id="file-upload" accept="image/*" type="file"/> <br>
        <input type="hidden" name="className" value="MenuIcons">
        <input type="hidden" name="actionName" value="updateIcon">
        <input type="hidden" class="hiddenInput" name="hiddenInput" value="">
        <input  class="btn_update" data-id="" type="submit" value="UPDATE">
        <img class="close_cont js-close" src="/adminka/test/close4.png">
    </form>
</div>


<div id="icon_panel" class="icon_panel">
    <div class="menu_panel"></div>

    <input id="add" class="btn_add" value="+" type="button"/>
</div>


<div class="inputContainer" style="display: none">
    <div class="containerCustom">
        <form id="updateForm" action="php/menu_items.php" method="post" enctype="multipart/form-data">
            <input type="text" maxlength="30" id="edit_name" name="itemName" placeholder="Name" value="" class="itemName input">
            <input type="text" maxlength="7" id="edit_price" value="" name="itemPrice" class="itemPrice input">
            <label for="edit_file" class="file-upload">Choose a file</label>
            <input type="file" id="edit_file" name="file">
            <div>
                <input type="text" maxlength="2" id="edit_discount" value="" name="discountPercent" class="cowbell">
            </div>
            <label class="switch">
                <input name="actionName" value="updateItem" type="hidden">
                <input name="className" value="MenuItems" type="hidden">
                <input name="itemId" id="edit_itemId" value="" type="hidden">
                <input id="edit_discountState" name="discount" value="on" type="hidden">
                <input type="checkbox" checked>
                <span class="checkBoxSwitch slider round"></span>
            </label><br>
            <button class="button" name="submit" type="submit">Update</button>
            <button class="deletBtn button" data-id="" name="submit" type="button">Delete</button>
        </form>
        <img class="close_cont js-close-campaign" src="/adminka/test/close4.png">
    </div>
</div>

<div id="createArea">
    <div id="container">
        <form id="itemForm" action="php/menu_items.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="className" value="MenuItems">
            <input type="hidden" name="actionName" value="saveItems">
            <input type="text" maxlength="30" name="itemName" placeholder="Name" class="itemName input">
            <p class="errorNameSpan"></p>
            <input type="text" maxlength="7" pattern="\d*" title="Only Numbers" name="itemPrice" placeholder="Price"
                   class="itemPrice input">
            <p class="errorPriceSpan"></p>
            <label for="file" class="file-upload">Choose a file</label>
            <input id="file" type="file" name="file" class="file" accept="image/*">
            <p class="errorFileSpan"></p>
            <input type="text" maxlength="2" pattern="\d*" title="Please Enter A Numbers" name="discountPercent"
                   placeholder="Discount" class="cowbell"><br>
            <p class="errorDiscountSpan"></p>
            <label class="switch">
                <input class="discount" name="discount" value="on" type="hidden">
                <input type="checkbox" checked>
                <span class="checkBoxSwitch slider round"></span>
            </label><br>
            <button class="button" name="submit" type="submit">Save</button>
        </form>
        <img class="close_cont js-close-campaign" src="/adminka/test/close4.png">
    </div>
</div>

<div class="body_cont">
    <div class="menu_title"><h2></h2></div>
    <img class="close_btn_b js-close" src="/adminka/test/close3.png">
    <div class="allItems row"></div>
    <div class="pagination"></div>
</div>


<script src="js/jQuery/jquery.js"></script>
<script src="js/menu_items.js"></script>
<script src="js/menu_icons.js"></script>
<script src="js/contact.js"></script>
<script src="js/about.js"></script>


</body>

</html>

