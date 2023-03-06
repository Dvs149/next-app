/*================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 5.0
	Author: PIXINVENT
	Author URL: https://themeforest.net/user/pixinvent/portfolio
================================================================================

NOTE:
------
PLACE HERE YOUR OWN JS CODES AND IF NEEDED.
WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR CUSTOM SCRIPT IT'S BETTER LIKE THIS. */

$(document).ready(function () {
	$('body').on('input','.phone_number',function(e){
 		
        this.value = this.value
	      .replace(/[^\d]/g, '')             // numbers and decimals only
	      .replace(/(^[\d]{10})[\d]/g, '$1');   // not more than 2 digits at the beginning
	      
	});
})