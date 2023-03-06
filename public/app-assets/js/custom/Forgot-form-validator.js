$(function () {

        $.validator.addMethod("nowhitespace", function(value, element) {
        	return value.indexOf(" ") < 0 && value != "";
        }, "No white space please"); 
       
        $("#formValidate").validate({
                rules: {
                    
                    email: {
                        required: true,
                        minlength: 5,
                        email:true
                    },
                },
                //For custom messages
                messages: {
                    email:{
                        required: "Enter a email",
                        minlength: "Enter at least 5 characters"
                    },
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