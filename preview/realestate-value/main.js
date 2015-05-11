//slider
//split form to 2 input sections
$(document).ready(function(){
			
	$("#form2").hide();
	$("#btn-submit1").click(function(){
		$("#form1").hide("slide", { direction: "right" });
		setTimeout(function() {
		$("#form2").show("slide","left");
		},500);
	});
	
	$("#back").click(function(){
		$("#form2").hide("slide", { direction: "left" });
		setTimeout(function() {
		$("#form1").show("slide", { direction: "right" });
		},500);
	});

});


	function toggleSubmitBtn(status) {
		if("disable" == status) {
			document.getElementById("sendText").innerHTML = "";
			document.getElementById("submitBtnImg").style.display = "";
			document.getElementById("submitBtn").disabled = true;			
		} else if("enable" == status) {
			document.getElementById("sendText").innerHTML = "Get FREE Advice &rarr;";
			document.getElementById("submitBtnImg").style.display = "none";
			document.getElementById("submitBtn").disabled = false;	
		}
	}


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
		
		$('input.streetAddressInput').blur(function(){
			$("div#errMsg").css('display','none');
			$('div#errMsg').html('');
			var streetAddress = $(this).val();
			if(streetAddress.trim()=='') {
				$("div#errMsg").css('display','block');
				$('div#errMsg').html('Street address should not be empty');
				$(this).focus();
				$(this).val('')
			}
		});
		
		$('input.cityInput').blur(function(){
			$("div#errMsg").css('display','none');
			$('div#errMsg').html('');
			var city = $(this).val();
			if(city.trim()=='') {
				$("div#errMsg").css('display','block');
				$('div#errMsg').html('City should not be empty');
				$(this).focus();
				$(this).val('')
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
		$("input.phoneInput").keypress(function(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				  return false;
			}
		});
		
		//form stuff
		$("#mainForm").submit(function(event) {
			//form validation
			var error="";
			if(document.getElementById("firstName").value==''){
				error=error+"<li>First Name</li>";
			}
			if(document.getElementById("lastName").value==''){
				error=error+"<li>Last Name</li>";
			}
			if(document.getElementById("email").value==''){
				error=error+"<li>Your Email Address</li>";
			}
			if(document.getElementById("phoneNo").value==''){
				error=error+"<li>Phone Number</li>";
			}
			if(document.getElementById("address").value==''){
				error=error+"<li>Address</li>";
			}		
			if(error!=""){
				error = "<strong>Please Check The Following Fields:</strong>"+error;
				$("div#errMsg").css('display','block');
				$('div#errMsg').html(error);
				return false;
			}

			// disable the submit button to prevent repeated clicks
			toggleSubmitBtn("disable");
			form$.get(0).submit(); 
		});
		
		//final transaction message here
		var isSuccessShow = $('.modelResultStatusShow').val();
		var isSuccess = $('.modelResultStatus').val();
		//alert("isSuccessShow:"+isSuccessShow);
		//alert("isSuccess:"+isSuccess);
		if(isSuccessShow) {
			if(isSuccess == "true") {
				$(".modalSuccess").modal();
			} else if(isSuccess == "false"){
				$(".modalFailed").modal();
			}
		};

	});

