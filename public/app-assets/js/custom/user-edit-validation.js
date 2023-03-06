$(document).ready(function () {

  $('#email').on('blur', function(){
    $(".invalid_email").remove();
  }).on('focus', function(){
    $(".invalid_email").remove();
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
                        email:true
                    },
                    mobile: {
                        required:true,
                        number: true,
                        maxlength:12
                    },
                    facebook_link: {
                        url:true,
                    },
                    snapchat_link: {
                        url:true,
                    },
                    twitter_link: {
                        url:true,
                    },
                    tiktok_link:{
                        url:true
                    },
                    linkedin_link:{
                        url:true
                    },
                    tiktok_link:{
                        url:true
                    },
                    linkedin_link:{
                        url:true
                    },
                    instagram_link:{
                        url:true
                    },
                    youtube_link:{
                        url:true
                    },
                    behance_link:{
                        url:true
                    },
                    soundcloud_link:{
                        url:true
                    },
                    podcast_link:{
                        url:true
                    },
                    youtube_video_link:{
                        url:true
                    },
                    
                    b_bio : {
                        required:true,
                        maxlength:255
                    },
                    b_title : {
                        required:true,
                        maxlength:25
                    },
                    b_company_name : {
                        required:true,
                        maxlength:25
                    },
                    b_department : {
                        required:true,
                        maxlength:25
                    },
                    b_contact_number : {
                        required:true,
                        number: true,
                        maxlength:12
                    },
                    b_ext : {
                        required:true,
                        maxlength:10
                    },
                    b_website : {
                        required:true,
                        url:true,
                        maxlength:255
                    },
                    b_whatsapp_url : {
                        required:true,
                        url:true,
                        maxlength:255
                    },
                    b_location_latitude : {
                        required:true,
                        maxlength:25
                    },
                    b_location_longitute : {
                        required:true,
                        maxlength:25
                    },

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
            
                },
                errorElement : 'div',
                errorClass: "error",
        });
});