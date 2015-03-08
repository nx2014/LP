    //jQuery is used only for this example; it isn't required to use Stripe 

	// this identifies your website in the createToken call below
	Stripe.setPublishableKey('pk_test_4L13r8dLhN7f8io5MWkK9u3p');//Change here: your Stripe live public key
	 
	function testClick() {
		//alert("alert from testClick:"+$('.emailInput').val());
		$(".modalSuccess").modal();
	}
	//RX:
	function getCardType(number) {            
		var re = new RegExp("^4");
		if (number.match(re) != null)
			return "Visa";

		re = new RegExp("^(34|37)");
		if (number.match(re) != null)
			return "American Express";

		re = new RegExp("^5[1-5]");
		if (number.match(re) != null)
			return "MasterCard";

		re = new RegExp("^6011");
		if (number.match(re) != null)
			return "Discover";

		return "";
	}	

	
	function stripeResponseHandler(status, response) {

		if (response.error) {
			// re-enable the submit button
			$('.submit-button').removeAttr("disabled");
			// show the errors on the form
			$(".payment-errors").html(response.error.message);
			$("div#errMsg").css('display','block');
		} else {
			var form$ = $("#payment-form");
			// token contains id, last4, and card type
			var token = response['id'];
			// insert the token into the form so it gets submitted to the server
			form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
			//all form fields to be set here for resubmission
			form$.append("<input type='hidden' name='hiddenEmail' value='" + $('.emailInput').val() + "' />");
			form$.append("<input type='hidden' name='hiddenFirstName' value='" + $('.firstName').val() + "' />");
			form$.append("<input type='hidden' name='hiddenLastName' value='" + $('.lastName').val() + "' />");
			form$.append("<input type='hidden' name='hiddenCardType' value='" + getCardType($('.cardNumberInput').val()) + "' />");
			form$.append("<input type='hidden' name='hiddenCardLast4Digits' value='" + $('.cardNumberInput').val().slice(-4) + "' />");
			if(document.getElementById("subscribeMailChimp").checked) {
				form$.append("<input type='hidden' name='hiddenSubscribeMailChimp' value='Y' />");
			}
			//submit
			form$.get(0).submit();
		}
	}
	 
	 //RX: only defines form submit function
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
		$('input.firstName').blur(function(){
			$("div#errMsg").css('display','none');
			$('div#errMsg').html('');
			var firstName = $(this).val();
			if(firstName.trim()=='') {
				$("div#errMsg").css('display','block');
				$('div#errMsg').html('First name should not be empty');
				$(this).focus();
				$(this).val('')
			}
		});
		$('input.lastName').blur(function(){
			$("div#errMsg").css('display','none');
			$('div#errMsg').html('');
			var firstName = $(this).val();
			if(firstName.trim()=='') {
				$("div#errMsg").css('display','block');
				$('div#errMsg').html('Last name should not be empty');
				$(this).focus();
				$(this).val('')
			}
		});
		$("input.cardNumberInput").keypress(function(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				  return false;
			}
		});
		$("input.monthInput").keypress(function(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				  return false;
			}
		});
		$("input.yearInput").keypress(function(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				  return false;
			}
		});		
		$("input.cvcInput").keypress(function(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				  return false;
			}
		});		
		
	    // Back To Top
		$(".backToTop").click(function() {
		    $('html, body').animate({
		        scrollTop: $(".form").offset().top
		    }, 500);
		});

		//Stripe stuff
		$("#payment-form").submit(function(event) {
			//form validation
			var error="";
			if(document.getElementById("email").value==''){
				error=error+"<li>Your Email Address</li>";
			}
			if(document.getElementById("firstName").value==''){
				error=error+"<li>First Name</li>";
			}
			if(document.getElementById("lastName").value==''){
				error=error+"<li>Last Name</li>";
			}
			if(document.getElementById("creditCardNumber").value==''){
				error=error+"<li>Credit Card Number</li>";
			}
			if(document.getElementById("cvcCode").value==''){
				error=error+"<li>CVC Code</li>";
			}		
			if(error!=""){
				error = "<strong>Please Check The Following Fields:</strong>"+error;
				$("div#errMsg").css('display','block');
				$('div#errMsg').html(error);
				return false;
			}

			// disable the submit button to prevent repeated clicks
			//$('.submit-button').attr("disabled", "disabled");
			document.getElementById("sendText").innerHTML = "";
			document.getElementById("submitBtnImg").style.display = "";
			document.getElementById("submitBtn").disabled = true;			
			 
			// createToken returns immediately - the supplied callback submits the form if there are no errors
			Stripe.createToken({
				number: $('.card-number').val(),
				cvc: $('.card-cvc').val(),
				exp_month: $('.card-expiry-month').val(),
				exp_year: $('.card-expiry-year').val()
			}, stripeResponseHandler);
			return false; // submit from callback
		});
		
		//final transaction message here
		var isSuccessShow = $('.modelResultStatusShow').val();
		var isSuccess = $('.modelResultStatus').val();
		if(isSuccessShow) {
			if(isSuccess == "true") {
				$(".modalSuccess").modal();
			} else if(isSuccess == "false"){
				$(".modalFailed").modal();
			}
		}
	});



