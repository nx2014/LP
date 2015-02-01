
	(function () {

	    // Scroll To
	  $(".backToTop").click(function() {
	    $('html, body').animate({
	        scrollTop: $(".form").offset().top
	    }, 500);
	  });

	}());

	//clearMeFocus//


	$(document).ready(function(){

	  // clear input on focus
	  $('.clearMeFocus').focus(function(){
	  if($(this).val()==this.defaultValue){
	  $(this).val('');
	  }
	  });
	
	  // if field is empty afterward, add text again
	  $('.clearMeFocus').blur(function(){
	  if($(this).val()==''){
	  $(this).val(this.defaultValue);
	  }
	  });
	  
	  //for background slider 
	  var i=1;
			
			setInterval(function(){
			i++;
			if(i==5) //upto four images
			{
			i=1;
			}
			$(".mainContent").fadeOut(600, function() { $(this).css("background-image","url(img/mainContent_bg"+i+".jpg)")
			}).fadeIn(600);;
			}, 6000)
	});