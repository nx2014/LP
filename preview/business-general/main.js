
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
		$('input.firstNameInput').blur(function(){
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
		$('input.lastNameInput').blur(function(){
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
		//http://css-tricks.com/snippets/javascript/javascript-keycodes/ k
		$("input.phoneInput").keypress(function(e) {
			if (e.which != 8 //"backspace"
				&& e.which != 0 //"del"
			    && e.which != 45 //"-"
				&& e.which != 43 //"+"
				&& e.which != 40 //"("
				&& e.which != 41 //")"
				&& e.which != 32 //" "
				&& (e.which < 48 || e.which > 57) // out range of [0, 9]
				) {
				  return false;
			}
		});	
	
	

		$("#mainForm").submit(function(event) {
			//alert("aaa");
			//document.getElementById("errMsg").style.display="block";
			//document.getElementById("errMsg").innerHTML="error 001";
			//form validation
			var error="";
			if(document.getElementById("firstName").value==''){
				error=error+"<li>First Name</li>";
			}
			if(document.getElementById("lastName").value==''){
				error=error+"<li>Last Name</li>";
			}
			if(document.getElementById("email").value==''){
				error=error+"<li>Email Address</li>";
			}
			if(document.getElementById("phone").value==''){
				error=error+"<li>Phone Number</li>";
			}
			if(error!=""){
				error = "<strong>Please Check The Following Fields:</strong>"+error;
				$("div#errMsg").css('display','block');
				$('div#errMsg').html(error);
				return false;
			}
			
			// disable the submit button to prevent repeated clicks
			document.getElementById("submitBtn").disabled = true;
			document.getElementById("submitBtnImg").src = "img/loader.gif";
			document.getElementById("submitBtnImg").style.visibility = "";
			return false;
			//$("#mainForm").submit();
		});

	});