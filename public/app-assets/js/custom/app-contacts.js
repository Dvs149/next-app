$(document).ready(function () {
   "use strict";
   
  

   

   

   // Modals Popup
   $(".modal").modal();
   // contact-overlay and sidebar hide
   // --------------------------------------------
   var contactOverlay = $(".contact-overlay"),
      updatecontact = $(".update-contact"),
      addcontact = $(".add-contact"),
      contactComposeSidebar = $(".contact-compose-sidebar"),
      labelEditForm = $("label[for]");
   $(".contact-sidebar-trigger").on("click", function () {
      contactOverlay.addClass("show");
      updatecontact.addClass("display-none");
      addcontact.removeClass("display-none");
      contactComposeSidebar.addClass("show");
      labelEditForm.removeClass("active");
      $(".contact-compose-sidebar input").val("");
   })
   $(
      ".contact-compose-sidebar .update-contact, .contact-compose-sidebar .close-icon, .contact-compose-sidebar .add-contact, .contact-overlay"
   ).on("click", function () {
      contactOverlay.removeClass("show");
      contactComposeSidebar.removeClass("show");
   });
});
