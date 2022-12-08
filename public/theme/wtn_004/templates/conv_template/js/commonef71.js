 jQuery(document).ready(function(){
	console.log('jainish');
	jQuery('h3.redblack').each(function(){
		var headings= jQuery(this).text().split(' ')[0];
		console.log(headings);
		jQuery(headings).css('color','red');
	});

	jQuery('.hiddenoverlay').hide();
	jQuery('.products_menu').click(function(){
		jQuery('.hiddenoverlay').toggle();
	});

	 jQuery("#international_contents").click(function(){  
	     jQuery("#international_continents").toggle();  
	     jQuery(".products_complete").hide();
	 });  
 
	jQuery('.closeimg').click(function(){
		jQuery('.hiddenoverlay').hide();
		jQuery('.homepageoverlay').hide();
		jQuery('.products_complete').show();
		jQuery("#international_continents").hide();
	});


	
	var scroll;
	jQuery(window).scroll(function(){
		var sticky = jQuery('#header'),
		scroll = jQuery(window).scrollTop();
		if (scroll >= 50)
		{ 
			sticky.addClass('fixed');
		}
		else{ sticky.removeClass('fixed');
	}

});

	/*slide-ease*/
	jQuery('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = jQuery(this.hash);
			target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				jQuery('html,body').animate({
          scrollTop: target.offset().top - 165 //offsets for fixed header
      }, 1000);
				return false;
			}
		}
	});

	/*sidebar toggle*/
	jQuery('#sidefixedbar .moduletable').addClass('hidefixedbar');
	jQuery('.close-button').hide();

	/*after submit*/
	if (window.location.href.indexOf("chronoform=contact-us") > -1) {
		jQuery('#sidefixedbar .moduletable').removeClass('hidefixedbar');
		jQuery('.close-button').show();
		jQuery('.feedback-button').hide();
		jQuery(".close-button").click(function(){
			window.location.href = window.location.href.split('?')[0];
		});
	}
	
	jQuery('#sidefixedbar .moduletable').addClass('hidefixedbar');
	jQuery('.close-button').hide();
	jQuery('.feedback-button').click(function(){
		jQuery('#sidefixedbar .moduletable').removeClass('hidefixedbar', 2000 , "easeOutSine");
		jQuery('.close-button').show();
		jQuery('#sidefixedbar_brochure').hide();
		jQuery(this).hide();
	});
	jQuery('.close-button').click(function(){
		jQuery('#sidefixedbar .moduletable').addClass('hidefixedbar', 2000 , "easeOutSine");
		jQuery('.feedback-button').show();
		jQuery('#sidefixedbar_brochure').show();
		jQuery(this).hide();
	});

	jQuery('#sidefixedbar_brochure .moduletable').addClass('hidefixedbar');
	jQuery('.close-button_brochure').hide();
	jQuery('.feedback-button_brochure').click(function(){
		jQuery('#sidefixedbar_brochure .moduletable').removeClass('hidefixedbar', 2000 , "easeOutSine");
		jQuery('#sidefixedbar_brochure').addClass('openform');
		jQuery('.close-button_brochure').show();
		jQuery(this).hide();
	});
	jQuery('.close-button_brochure').click(function(){
		jQuery('#sidefixedbar_brochure .moduletable').addClass('hidefixedbar', 2000 , "easeOutSine");
		jQuery('.feedback-button_brochure').show();
		jQuery('#sidefixedbar_brochure').removeClass('openform');
		jQuery(this).hide();
	});
	jQuery('body.aboutus .hiddenoverlay').show();
  
  	/*jQuery('.modaloverlay').hide();
	jQuery('body.homepage .modaloverlay').show();
    jQuery('#modalclose').click(function(){
		jQuery('.modaloverlay').hide();
	});
*/
	/*Products Page Fixed Sidebar JS*/
	function checkOffset() {
		if(jQuery('.products_categories').offset().top + jQuery('.products_categories').height() 
			>= jQuery('#footer').offset().top - 10)
			jQuery('.products_categories').css('position','absolute');
		if(jQuery(document).scrollTop() + window.innerHeight < jQuery('#footer').offset().top)
        		jQuery('.products_categories').css({'position':'fixed','top':'100px'}); // restore when you scroll up
        	if(jQuery(document).scrollTop()< 150)
        		jQuery('.products_categories').css({'position':'unset'});
        }
        jQuery(document).scroll(function() {
        	checkOffset();
        });
    })


