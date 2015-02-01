
	(function () {

	    // Scroll To
	  $(".scrollToForm").click(function() {
	    $('html, body').animate({
	        scrollTop: $(".form").offset().top
	    }, 500);
	  });
	  $(".scrollToTeam").click(function() {
	    $('html, body').animate({
	        scrollTop: $(".section3").offset().top
	    }, 500);
	  });
	  $(".scrollToDetails").click(function() {
	    $('html, body').animate({
	        scrollTop: $(".details").offset().top
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

		//show more
		$('section.section3 > div > div > div').each(function () {
		    $(this).find('div > p:eq(1) a:last').remove();
		    var txt = $(this).find('div > p:eq(1)').text(),
		        that = this,
		        aMore = document.createElement('a'),
		        aLess = document.createElement('a'),
		        i = 301,
		        str = ' ';

		    $(aMore).attr({href: '#'})
		        .text('More')
		        .click(function (e) {
		            $(that).find('span.more').show('slow');
		            $(this).hide();
		            $(aLess).show();
		            e.preventDefault();
		        });
		    $(aLess).attr({href: '#'})
		        .text('Less')
		        .click(function (e) {
		            $(that).find('span.more').hide('slow', function () {
		                $(aMore).show();
		            });
		            $(this).hide();
		            e.preventDefault();
		        }).hide();

		    while (txt[i] !== ' ') {
		        i -= 1;
		        str += "&nbsp;";
		    }

		    $(this).find('div > p:eq(1)')
		        .empty()
		        .append(txt.substr(0, i) + str)
		        .append(aMore)
		        .append('<span class="more">' + txt.substring( i + 1) + '</span> ')
		        .append(aLess);
		    $(this).find('.more').hide();
		});

	});