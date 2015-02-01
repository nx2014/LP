//backToTop//
(function() {
    // Scroll To
    $(".backToTop").click(function() {
        $('html, body').animate({
            scrollTop: $(".form").offset().top
        }, 500);
    });
}());

//clearMeFocus//
$(document).ready(function() {
    // clear input on focus
    $('.clearMeFocus').focus(function() {
        if ($(this).val() == this.defaultValue) {
            $(this).val('');
        }
    });
    // if field is empty afterward, add text again
    $('.clearMeFocus').blur(function() {
        if ($(this).val() == '') {
            $(this).val(this.defaultValue);
        }
    });
    // bxSlider
    var slider = $('#content-slider').bxSlider({
        infiniteLoop: false,
        pager: false,
        controls: false,
        adaptiveHeight: true
    });

    $('.testimonials .testi_2, .testimonials .testi_3').css('display', 'block');
    $('#albert, #mary, #barbara').click(function(e) {
        e.preventDefault();
        slider.goToSlide($(this).attr('data-slide'));
    });
    // Form Email Validation
	$('input.emailInput').blur(function(){
		var email = $(this).val();
		var reg=/(^[a-z]+|^[a-z]+[0-9]*)+[.]?([a-z]*|[a-z]*[0-9]*)*@([a-z]+)[.]([a-z]+)$/;
		$("div#errMsg").css('display','none');
		$('div#errMsg').html('');
		if(!reg.test(email)){
			$(this).focus();
			$(this).val('')
			$("div#errMsg").css('display','block');
			$('div#errMsg').html('Email not in correct format');
		}
		
	});
	// Form Phone Validation
	$("input.phoneInput").keypress(function(e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              return false;
    	}
	});


});


//form submit code is start from here


function sendMail(){
	var fname=document.getElementById("firstName").value;
	var lname=document.getElementById("lastName").value;
	var email=document.getElementById("email").value;
	var addr=document.getElementById("address").value;
	var mobno=document.getElementById("phoneNo").value;
	var err =new Array('First Name','Last Name','Email','Phone Number','Property Address')
	var error="";
	if(!Isnb(fname,err[0])){
		error=error+"<li>First Name</li>";
	}
	if(!Isnb(lname,err[1])){
		error=error+"<li>Last Name</li>";
	}
	if(!Isnb(addr,err[4])){
		error=error+"<li>Address</li>";
	}
	if(!Isnb(email,err[2])){
		error=error+"<li>Email</li>";
	}
	if(!Isnb(mobno,err[3])){
		error=error+"<li>Mobile No.</li>";
	}
	if(error==""){
		$("div#errMsg").css('display','none');
		var firstName = $("input#firstName").val();
		var lastName = $("input#lastName").val();
		var email = $("input#email").val();
		var phoneNo = $("input#phoneNo").val()
		var addr = $("input#address").val()
		var aUrl = "index.php?xAction=sendMail"+"&firstName="+firstName+"&lastName="+lastName+"&email="+email+"&phoneNo="+phoneNo+"&addr="+addr;
		$.ajax({
			type:"GET",
			url:aUrl,
			success: function(str){
				var str1 = str.split('~')
				//alert(str1[0]);
				if(str1[0] == "OK"){
					//alert("Success");
					var tmpl = [
						'<div class="modal fade success">',
						  	'<div class="modal-dialog">',
							    '<div class="modal-content">',
							      '<div class="modal-header">',
							        '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>',
							        '<h4 class="modal-title">Success!</h4>',
							      '</div>',
							      '<div class="modal-body">',
							        '<p>Thank you for your inquiry, we will be contacting you soon.</p>',
							      '</div>',
							      '<div class="modal-footer">',
							        '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>',
							      '</div>',
							    '</div>',
						  	'</div>',
						'</div>',
					  ].join('');
		 			 $(tmpl).modal();
				}else{
					//alert("Failed");	
					var tmpl = [
						'<div class="modal fade failed">',
						  	'<div class="modal-dialog">',
							    '<div class="modal-content">',
							      '<div class="modal-header">',
							        '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>',
							        '<h4 class="modal-title">Your Inquiry NOT Sent</h4>',
							      '</div>',
							      '<div class="modal-body">',
							        '<p>Please try again.</p>',
							      '</div>',
							      '<div class="modal-footer">',
							        '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>',
							      '</div>',
							    '</div>',
						  	'</div>',
						'</div>',
					  ].join('');
					  
					  $(tmpl).modal();
					  
				}
			}
		})
		
	}
	else{
		$("div#errMsg").css('display','block');
		document.getElementById("errMsg").innerHTML="<strong>Please Check The Following Fields:</strong>"+"<ul>"+error+"</ul>";
		return false;
	}
	return false;
}
function Isnb(chk,err){
	if(chk==err)
	{
		return false;
	}
	else
	{
		return true;
	}
}
//form submit code is end here

