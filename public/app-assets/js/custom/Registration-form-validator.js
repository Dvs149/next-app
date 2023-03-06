$(function () {

        $.validator.addMethod("nowhitespace", function(value, element) {
        	return value.indexOf(" ") < 0 && value != "";
        }, "No white space please"); 
       
        $("#formValidate").validate({
                rules: {
                    name:{
                        required:true,
                        maxlength:25,
                        nowhitespace:true
                    },
                    email: {
                        required: true,
                        minlength: 5,
                        email:true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    password_confirmation: {
                    equalTo: "#password"
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
                    password_confirmation: " Enter Confirm Password Same as Password"
            
                },
                errorElement : 'div',
                errorPlacement: function(error, element) {
                        var placement = $(element).data('error');
                        if (placement) {
                        $(placement).append(error)
                        } else {
                            error.insertAfter(element);
                        }
                }
        });
})