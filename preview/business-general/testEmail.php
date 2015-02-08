<?php

/*
	$from = "DoNotReply <donotreply@landingpageburger.com>";
	$headers .= "MIME-Version: 1.0" . " \r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: ".$from." \r\n";
	mail("rongxia2014@gmail.com","test","msg",$headers);
*/

	
if ($_POST) {
	$firstName = trim($_POST['firstName']);
	$lastName = trim($_POST['lastName']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$message = trim($_POST['message']);
	
	$Subject="New message from user ".$firstName." ".$lastName;
	
	//$from = "DoNotReply <donotreply@landingpageburger.com>";
	$from = "aa bb <aa@bb.com>";
	$to="rongxia2014@gmail.com";
	$headers .= "MIME-Version: 1.0" . " \r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: ".$from." \r\n";
	
	$emailSent = mail($to,$Subject,$message,$headers);
	//to show confirmation modal
	if($emailSent){
		$isSuccess = 'true';						   
	}
	
} else {
	$firstName = "post is empty"." "."<"."email".">";
}
	
?>



<form action="" method="POST" id="payment-form">
	<input type="text" size="4" name="firstName" value="abcd"/>
	<button type="submit">send</button>
	<?php  echo $firstName;   ?>
	<?php  echo $isSuccess;   ?>
</form>



