$(document).ready(function () {

  $('#email').on('blur', function(){
    $(".invalid_email").remove();
  }).on('focus', function(){
    $(".invalid_email").remove();
  });

  $('#mobile').on('blur', function(){
    $(".invalid_mobile").remove();
  }).on('focus', function(){
    $(".invalid_mobile").remove();
  });

  

  $.validator.addMethod("nowhitespace", function(value, element) {
        	return value.indexOf(" ") < 0 && value != "";
        }, "No white space please"); 
         $("#formValidate").validate({
                rules: {
                    name:{
                        required:true,
                        maxlength:25,
                        
                    },
                    email: {
                        required: true,
                        minlength: 5,
                        maxlength:100,
                        email:true
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength:15,
                    },
                    country_code: {
                        required: true,
                        maxlength:5,
                    },
                    mobile:{
                        required:true,
                        maxlength:10,
                    }
                },
                //For custom messages
                messages: {
                    name:{
                        required: "Enter a name",
                        maxlength: "Enter at less than 25 characters"
                    },
                    email:{
                        required: "Enter a email",
                        minlength: "Enter at least 5 characters"
                    },
                    password:{
                        required:'Enter password',
                        minlength: "Enter at least 5 characters"
                    },
                    country_code: {
                        required: 'Enter country code',
                    },
                    mobile:{
                        required:'Enter mobile number',
                    }
            
                },
                errorElement : 'div',
                errorClass: "error",
        });
});