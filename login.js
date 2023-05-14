// regexes obj
const regexes = {
    email: /^([\S]+)@([\S]+)\.([\S]+)$/,
    code: /^([a-zA-Z]{3})\-([0-9]{3})$/,
    roll: /^([0-9]{3})\/([a-zA-z]{2})\/([0-9]{2})$/,
    name: /^[a-zA-Z \']+$/,
    num: /^[0-9]+$/
  };

// validate input
function validateInput(type, input){

if (!regexes.hasOwnProperty(type)) {
    throw new Error('Invalid type');
    }

const regex = regexes[type];
return regex.test(input);
} 

// studnent's signup
function studentSignup() {
//Capture the submit event of #signup
$("#signup").submit(function() {
    var data = {};
    var isEmpty = 0;

    // Iterate over all input fields in the form #signup
    $("#signup input").each(function(k, v) {
    // alert if empty
    if (!$(v).val().length) {
        $('.alert span').html('Please enter <strong>' + $(v).attr('name') + '</strong> !');
        $('.alert').removeClass('hidden');
        isEmpty++;
        return false;
    }
    data[$(v).attr('name')] = $(v).val();
    });

    if (isEmpty) return false;

    // double check the password
    if ($("#signup input[name=password]").val() != $("#signup input[name=password2]").val()) {
    $('.alert span').html("Password don't match!");
    $('.alert').removeClass('hidden');
    return false;
    }

    // check the length of passward
    if ($("#signup input[name=password]").val().length < 6) {
    $('.alert span').html('Password is smaller than 6 characters!');
    $('.alert').removeClass('hidden');
    return false;
    }

    // check the format of email
    if (!verify('email', data.email)) {
    $('.alert span').html('Invalid Email');
    $('.alert').removeClass('hidden');
    return false;
    }

    // check the format of name
    if (!verify('name', data.name)) {
    $('.alert span').html('Invalid Name');
    $('.alert').removeClass('hidden');
    return false;
    }

    $.ajax({
    url: 'php/process_signup.php', 
    type: 'post',
    data: data,  // signin data
    dataType: 'json',
    success: function(r) {
        console.log(r);

        // alert information based on sever response
        switch (r.error) {
        case 'email':
            $('.alert span').html('Invalid Email');
            $('.alert').removeClass('hidden');
            break;
        case 'name':
            $('.alert span').html('Invalid Name');
            $('.alert').removeClass('hidden');
            break;
        case 'empty':
            $('.alert span').html('Fill all the details');
            $('.alert').removeClass('hidden');
            break;
        case 'mismatch':
            $('.alert span').html("Password doesn't match");
            $('.alert').removeClass('hidden');
            break;
        case 'small':
            $('.alert span').html('Password is too short! It should be at least 6 characters long');
            $('.alert').removeClass('hidden');
            break;
        case 'exists':
            $('.alert span').html('There already exists an account with that email ID. Try logging in.');
            $('.alert').removeClass('hidden');
            $("form#login input[name=email]").val($("form#signup input[name=email]").val());
            $("form#login input[name=email]").focus();
            break;
        case 'db_error':
            $('.alert span').html('We are facing troubles at our server side !');
            $('.alert').removeClass('hidden');
            break;
        case 'none':
            $('.alert span').html('You have successfully signed up! Login using the same credentials now.');
            $("form#login input[name=email]").val($("form#signup input[name=email]").val());
            $("form#login input[name=email]").focus();
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').addClass('alert-success');
            break;
        }
    }
    });
    return false;
});
}



function studentLogin() {
    $("#login").submit(function() {
        var data = {};
    
        // Iterate through each input field in the login form
        $("#login input").each(function(k, v) {
        if (!$(v).val().length) {
            // If the field is empty, display a warning message
            $('.alert span').html('Please enter <strong>' + $(v).attr('name') + '</strong> !');
            $('.alert').removeClass('hidden');
            return false;
        }
        data[$(v).attr('name')] = $(v).val();
        });
    
        $.ajax({
        url: 'php/process_login.php', // Backend URL to handle the login process
        type: 'post',
        data: data, // Data to be sent, containing the form field data
        dataType: 'json',
        success: function(r) {
            console.log(r);
    
            // Handle the response data returned from the server
            switch (r.error) {
            case 'empty':
                $('.alert span').html('Please fill all the credentials!');
                $('.alert').removeClass('hidden');
                break;
            case 'not_found':
                $('.alert span').html('No such user found! Try signing up.');
                $('.alert').removeClass('hidden');
                $("form#signup input[name=email]").val($("form#login input[name=email]").val());
                $("form#signup input[name=email]").focus();
                break;
            case 'incorrect':
                $('.alert span').html('Incorrect Password!');
                $('.alert').removeClass('hidden');
                $('.alert').removeClass('alert-warning');
                $('.alert').addClass('alert-danger');
                break;
            case 'none':
                $('.alert span').html('<img src="img/loading.gif"> <Strong>Welcome</strong>, you are being logged in ');
                $('.alert').removeClass('hidden');
                $('.alert').removeClass('alert-warning');
                $('.alert').removeClass('alert-danger');
                $('.alert').addClass('alert-success');
                window.location = "";
                break;
            }
        }
        });
    
        return false;
    });
    }
    
$(document).ready(function () {
    studentSignup();
    studentLogin();
});