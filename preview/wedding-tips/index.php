<!--Digital Book Sellers - Wedding Tips Version 03.07.15

- Added PHP Current Year
- Added Loader.gif

-->

<?php
require './libs/stripe-php-1.16.0/lib/Stripe.php';
include "./libs/MailChimp/MailChimp.php";

$month=date('m');
$year=date("Y");

$isSuccessShow = "false";
$isSuccess = "";
$error = "";

//User changes begin
$originalAmountByCents = 895; //Change here: original amount in cents, $8.95 would be 895
$purchaseAmountByCents = 595; //Change here: purchase amount in cents, $5.95 would be 595. This is the real amount charged using Stripe
$downloadLink = "enterYourDownloadUrlHere"; // Your digital book download url, must be valid url, otherwise buyer won't receive email
$sellerEmail = "enterYourEmailHere"; //Sells email to receive leads
$MailChimp = new \Drewm\MailChimp('enterYourMailChimpApiKeyHere'); //Change MailChimp API Key here, XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-us9
$MailChimpListID = "enterYourListIdHere";//Mailing list ID here, XXXXXXXXXX
Stripe::setApiKey("enterYourStripeApiKeyHere"); //Stripe API key, sk_live_XXXXXXXXXXXXXXXXXXXXXXXX
$GoogleSiteID = "UA-12345-X"; //Change UA-XXXXX-X to be your site's ID.
//User changes end

$originalAmount4Display = "$".substr_replace($originalAmountByCents, ".", -2, 0);
$purchaseAmount4Display = "$";
if($purchaseAmountByCents<10) {
	$purchaseAmount4Display = "$00".$purchaseAmountByCents;
} else if($purchaseAmountByCents<100) {
	$purchaseAmount4Display = "$0".$purchaseAmountByCents;
} else {
	$purchaseAmount4Display = "$".$purchaseAmountByCents;
}	
$purchaseAmount4Display = substr_replace($purchaseAmount4Display, ".", -2, 0);
	
if ($_POST) {

	try {
		//submit payment charge request
		if (!isset($_POST['stripeToken'])) {
			throw new Exception("The Stripe Token was not generated correctly");
		}
		
		$isSuccessShow = 'true';
		$isSuccess = 'false';
		
		$firstName = trim($_POST['hiddenFirstName']);
		$lastName = trim($_POST['hiddenLastName']);

		$cardType = trim($_POST['hiddenCardType']);
		$cardLast4Digits = trim($_POST['hiddenCardLast4Digits']);
		$buyerEmail = trim($_POST['hiddenEmail']);
		
		//Get the credit card details submitted by the form
		$token = $_POST['stripeToken'];
		error_log("token:".$token);
		Stripe_Charge::create(array("amount" => $purchaseAmountByCents, //in cents, Stripe doesn't use decimal point, so 123 cents means $1.23
									"currency" => "usd",
									"card" => $token,
									"description" => $buyerEmail
									)
							);		
		
		//send email to seller
		$from = "DoNotReply <donotreply@landingpageburger.com>";
		$to = $sellerEmail; 
		$Subject = "New Purchase From Your Landing Page";
		$msg = "Congratulations! You have a new purchase form your landing page. Details from this purchase are below:<BR><BR>";
		$msg .= "<strong>First Name:</strong> ".$firstName."<BR>";
		$msg .= "<strong>Last Name:</strong> ".$lastName."<BR>";
		$msg .= "<strong>Email:</strong> ".$buyerEmail."<BR>";
		$msg .= "<strong>Purchase Amount:</strong> ".$purchaseAmount4Display."<BR>";
		$msg .= "<strong>Card Type:</strong> ".$cardType."<BR>";
		$msg .= "<strong>Last 4 Digit of Credit Card:</strong> ".$cardLast4Digits."<BR>";
		$headers = "MIME-Version: 1.0" . " \r\n";
		$headers .= "Content-type:text/html;charset=UTF-8\r\n";
		$headers .= "From: ".$from." \r\n";

		$sentToSeller = mail($to,$Subject,$msg,$headers);
		
		//send email to buyer
		$from = $sellerEmail;
		$to = $buyerEmail;
		$Subject = "Thank You For Your Purchase!";
		$msg = "<strong>Amount Paid:</strong> ".$purchaseAmount4Display."<BR>";
		$msg .= "Congratulations! Your transaction was successful. You can now view or download your ebook from the below link:<BR>";
		$msg .= $downloadLink."<BR>";
		
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8\r\n";
		$headers .= "From: ".$from."\r\n";
		$sentToBuyer = mail($to,$Subject,$msg,$headers);
		
		//MailChimp integration, transaction success doesn't depend on this subscription
		$subscribeMailChimp = trim($_POST['hiddenSubscribeMailChimp']);
		error_log("subscribeMailChimp:".$subscribeMailChimp);
		if($subscribeMailChimp == "Y") {
			//find API key at MailChimp site, dropdown account/Extras/API keys
			$result = $MailChimp->call('lists/subscribe', array(
                'id'            => $MailChimpListID,
                'email'         => array('email'=>$buyerEmail),
                'merge_vars'    => array('FNAME'=>$firstName, 'LNAME'=>$lastName),
				'double_optin'  => false  
            ));
			error_log("subscribe MailChimp result:".$result);
		}
		
		//to show confirmation modal
		if($sentToSeller && $sentToBuyer){
			$isSuccess = 'true';						   
		}
	} catch (Exception $e) {
		$error = $e->getMessage();
	}
}
?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Wedding Tips Ebook</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="favicon.ico">

    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>

	
	<body>
		<input type="hidden" class="modelResultStatusShow" value="<?php echo $isSuccessShow; ?>" />
		<input type="hidden" class="modelResultStatus" value="<?php echo $isSuccess; ?>" />
		<div class="modal fade success modalSuccess">
			<div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Thank You For Your Purchase</h4>
				  </div>
				  <div class="modal-body">
	                <p>Congratulations! Your transaction was succesful. You can now view or download your ebook from the below link:</p>
	                <a href="<?php  if ($isSuccess == 'true') { echo $downloadLink; }?>" target="_blank"><?php  if ($isSuccess == 'true') { echo $downloadLink; }?></a>
	              </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>
			</div>
		</div>	
		<div class="modal fade failed modalFailed">
			<div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Your Inquiry NOT Sent</h4>
				  </div>
				  <div class="modal-body">
					<p>Please try again.</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>
			</div>
		</div>	
	
		<div class="wrap">
			<!--[if lt IE 7]>
	            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	        <![endif]-->

	    <!-- Add your site or application content here -->
	    <div class="container">
	    	<div class="row">
          <h1 class="headline col-md-12"><i class="fa fa-bolt"></i> Avoid Wedding Day Disasters!</h1><!--END headline-->
          <h4 class="subHeadline col-md-12">Learn the common mistakes brides make, and tips on how you can avoid them on your wedding day.</h4>
        </div><!--END row-->
        <div class="mainContent row">
        	<div class="productImg col-md-4 col-sm-12">
            	<img class="product img-responsive col-sm-12" src="img/book.png">
            	<div class="preview col-md-12 text-center" data-toggle="modal" data-target="#previewModal">
            		<a><span class="glyphicon glyphicon-search"></span> Click Here For A Preview of Content</a>
            	</div>
            	<div class="clearfix"></div>
          	</div><!--END productImg-->
          <div class="bullets col-md-4 col-sm-12">
            <h3>Have you ever thought about:</h3>
            <ul>
              <li><span class="glyphicon glyphicon-star"></span> Setting the date first</li>
              <li><span class="glyphicon glyphicon-star"></span> No gap between your ceremony and reception</li>
              <li><span class="glyphicon glyphicon-star"></span> Hiring amateurs or friends for your wedding day</li>
              <li><span class="glyphicon glyphicon-star"></span> Conflict over the guest list</li>
              <li><span class="glyphicon glyphicon-star"></span> Should you have a gift list?</li>
              <li><span class="glyphicon glyphicon-star"></span> What song to choose for your first dance?</li>
              <li><span class="glyphicon glyphicon-star"></span> How to handle divorced parents</li>
              <li><span class="glyphicon glyphicon-star"></span> ...and other decisions you are not too sure about?</li>
              <li><span class="glyphicon glyphicon-star"></span> Then you must read this ebook!</li>
            </ul>
            <div class="contact row-fluid text-center">
            	<img class="margin-bottom" src="img/support.png">
            	<h3>Questions? Just Contact Us!</h3>
            	<p>202-555-0101</p>
            </div>
          </div><!--END bullets-->
        	<div class="form col-md-4 col-sm-12">

        		<div class="header">
						<h3 class="offer">Limited Time Special</h3> 
						<p class="price"><span class="was"><strike>Original Price: <?php echo $originalAmount4Display ?></strike></span><br><span class="now">Now Only: <?php echo $purchaseAmount4Display ?></span></p>
						</div><!--END header-->

						<div class="body">
							<!--stripe form begin-->
							<form action="" method="POST" id="payment-form">
									<!-- to display errors returned by createToken -->
									<div id="errMsg" class="payment-errors alert alert-danger"
									<?php if ($error == "") { ?>
									style="display:none"
									<?php } ?>
									>
									<?php echo $error ?>
									</div>

									<div class="email form-row form-group">
										<label>Where to send the ebook?</label>
										<input class="emailInput clearMeFocus form-control" id="email" type="text" size="20" value="<?php echo $form_email ?>" placeholder="Your Email Address" data-stripe="email"/>
									</div>

									<label>Credit Card Information</label><div class="cc pull-right"><img src="img/cc.png" width="125"></div>
									<div class="clearfix"></div>

									<div class="bs-callout bs-callout-primary">
										Transactions are performed securely by Stripe Checkout
									</div>
									<div class="fullName form-row">
										<input class="firstName clearMeFocus form-control" id="firstName" type="text" size="20" value="<?php echo $form_firstName ?>" placeholder="First Name">
										<input class="lastName clearMeFocus form-control" id="lastName" type="text" size="20" value="<?php echo $form_lastName ?>" placeholder="Last Name">
									</div>
									<div class="clearfix"></div>									

									<div class="number form-row">
										<input type="text" size="20" autocomplete="off" id="creditCardNumber" class="card-number cardNumberInput clearMeFocus form-control" value="<?php echo $form_creditCardNumber ?>" placeholder="Credit Card Number" data-stripe="number"/>
									</div>

									<div class="expiration form-row">
										<select class="form-control card-expiry-month monthInput" data-stripe="exp-month">
												<option value="1" <?PHP if($month==1) echo "selected";?>>January</option>
												<option value="2" <?PHP if($month==2) echo "selected";?>>February</option>
												<option value="3" <?PHP if($month==3) echo "selected";?>>March</option>
												<option value="4" <?PHP if($month==4) echo "selected";?>>April</option>
												<option value="5" <?PHP if($month==5) echo "selected";?>>May</option>
												<option value="6" <?PHP if($month==6) echo "selected";?>>June</option>
												<option value="7" <?PHP if($month==7) echo "selected";?>>July</option>
												<option value="8" <?PHP if($month==8) echo "selected";?>>August</option>
												<option value="9" <?PHP if($month==9) echo "selected";?>>September</option>
												<option value="10" <?PHP if($month==10) echo "selected";?>>October</option>
												<option value="11" <?PHP if($month==11) echo "selected";?>>November</option>
												<option value="12" <?PHP if($month==12) echo "selected";?>>December</option>
										</select>
										<select class="form-control card-expiry-year yearInput" data-stripe="exp-year">
												<?PHP for($i=date("Y"); $i<=date("Y")+2; $i++)
												if($year == $i)
													echo "<option value='$i' selected>$i</option>";
												else
													echo "<option value='$i'>$i</option>";
												?>
										</select>
									</div>

									<div class="cvc form-row">
										<input type="text" size="4" autocomplete="off" id="cvcCode" class="card-cvc cvcInput clearMeFocus form-control" value="<?php echo $form_cvcCode ?>" placeholder="CVC Code" data-stripe="cvc"/>
									</div>
									<div class="clearfix"></div>
									<div class="checkbox form-row">
										<label>
											<input type="checkbox" align="left" id="subscribeMailChimp" value="Y" checked />Subscribe to newsletter
										</label>
									</div>
									
									<button type="submit" class="submit-button btn btn-primary" id="submitBtn">
										<div id="sendText">Get Instant Access &rarr;</div><img src="img/loader.gif" style="display:none" id="submitBtnImg" >
									</button>

							</form>
						</div><!--END body-->

					</div><!--END form-->
          <div class="clearfix"></div>
				</div><!--END mainContent-->
				<section class="testimonials row">
	        <div class="col-md-12">
	          <p class="col-md-12">"It's a good thing I read this before my wedding day! I would've made all the mistakes mentioned in this ebook. Thank God I purchased it." <br><span class="customer pull-right">-Helena, age 32, California</span></p>
	        </div>   
	      </section>
	      <section class="detailsSection1 row">
	        <div class="col-md-12">
	          <h3>Why You Need This Ebook</h3>
	          <p>Getting good advice for planning your wedding can be tricky. Everyone is different! You're planning probably one of the most expensive events of your life and you want to get it just right. This ebook will help you consider things you won't even have thought about yet. Should you let the photographer take up all of your precious time on the day? Is your well-meaning relative the right person to video the event? Learn from those who have been through it and make an educated, informed choice for the wedding of your dreams. You wouldn't buy a car or a house without doing good, thorough research and this ebook will help you get your perfect day, your way.<br>
	          <button type="button" class="backToTop btn btn-primary">Get Instant Access Now!</button>
	        </div>   
	      </section>
	      </div><!--END container-->
				<footer>
	        <div class="container">&copy; <?php echo date("Y"); ?> - All rights reserved | <a data-toggle="modal" data-target="#privacyModal">Privacy Policy</a> | <a data-toggle="modal" data-target="#termsModal">Terms & Conditions</a></div>
	      </footer>

		<!--preview Modal-->
        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Chapter One</h4>
              </div>
              <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus eu lacus eu venenatis. Proin quis lectus eget odio fringilla fermentum lacinia quis nisi. Aliquam nec pretium nunc. Sed dignissim libero sit amet dapibus viverra. In nec erat ut massa dapibus vehicula eu tincidunt nulla. Etiam elementum, justo sit amet venenatis laoreet, diam sem placerat nulla, porttitor lobortis erat ipsum sed arcu. Morbi scelerisque felis lacus, sit amet hendrerit sapien fringilla nec. Maecenas justo augue, scelerisque id scelerisque sit amet, feugiat eget lectus.</p>

                <p>Etiam porta venenatis dolor id aliquam. Aliquam mattis malesuada ultrices. Sed ullamcorper lacus id sem luctus, vitae consectetur sapien gravida. Sed bibendum fermentum odio et venenatis. Vivamus gravida magna et nibh iaculis, nec ultrices ante rutrum. Aliquam eleifend non ante in vestibulum. Duis tellus justo, tempus quis viverra in, ultricies vitae est. Sed sagittis rhoncus tincidunt. Sed sed justo vestibulum, mollis felis sit amet, consectetur sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer euismod ligula lobortis, vulputate ligula id, porttitor lacus. Mauris et velit quis justo ultricies pharetra. Vivamus et erat a velit vulputate eleifend. Curabitur at mollis magna.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div><!--END preview Modal-->

        <!--privacy Modal-->
        <div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="privacyModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Privacy Policy</h4>
              </div>
              <div class="modal-body">
                <p>Your privacy policy here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur imperdiet, erat sit amet dapibus ultrices, elit magna tempus ante, in hendrerit elit elit facilisis ipsum. Integer ut ante varius, euismod erat eu, facilisis purus. Aliquam tempus metus quis purus feugiat fringilla. Aenean convallis purus quis dignissim ullamcorper. Etiam euismod et sem sed vestibulum. Nullam porta, dolor quis volutpat dapibus, augue orci ultrices lorem, quis laoreet lacus nibh eget augue. Vivamus non ante sapien.</p>

                <p>Pellentesque posuere tincidunt magna non molestie. Pellentesque porta aliquet quam, quis volutpat arcu condimentum cursus. Integer facilisis justo enim, at ullamcorper ipsum semper eget. Nulla tristique tellus justo. Nullam sed tellus vel purus elementum faucibus in et elit. Praesent faucibus nibh ut commodo laoreet. Pellentesque adipiscing leo ante, eu vulputate lorem rutrum at. Suspendisse vulputate vel turpis eu blandit. Fusce ultrices congue mi sed aliquet. Curabitur ac libero at nulla aliquam porttitor sed in neque. Cras vehicula, neque eu egestas ornare, felis metus consectetur diam, sed imperdiet lorem neque in erat. Integer non lectus eget nisl bibendum gravida. Curabitur eu quam vestibulum, semper eros vel, eleifend tortor. Vivamus blandit vel nisl in euismod.</p>

                <p>Sed mattis vitae purus non mattis. Nulla felis neque, sollicitudin vitae lobortis non, gravida sed nisi. In dictum aliquet pretium. Donec id auctor purus, id hendrerit lorem. Proin quis eros justo. Phasellus purus sapien, tincidunt ut aliquet eu, mattis et lectus. Fusce et adipiscing lectus. Phasellus eleifend, sem tempor scelerisque dignissim, orci felis pharetra lorem, at cursus orci velit at velit. Aliquam a lorem rutrum, blandit orci ac, gravida ligula. Integer malesuada diam nec consectetur molestie. Duis elit lectus, tincidunt quis urna volutpat, blandit porta lectus. Pellentesque nulla lorem, blandit et sapien sit amet, pellentesque ultrices lectus.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div><!--END privacy Modal-->

        <!--terms Modal-->
        <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Terms and Conditions</h4>
              </div>
              <div class="modal-body">
                <p>Your terms and condition here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean elementum, nulla in pulvinar consectetur, urna lectus egestas tortor, mollis hendrerit ipsum neque ut dui. Integer faucibus nec libero et tempus. Sed pharetra tincidunt lacinia. Integer non risus iaculis, fermentum dolor sed, hendrerit mi. Vivamus quis elit purus. Cras laoreet, neque vel convallis scelerisque, tellus purus fringilla erat, et iaculis nisi sapien ut ipsum. Etiam eget lacus lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque viverra ultricies velit semper tincidunt. Nullam a lobortis lacus. Integer pulvinar erat non tortor iaculis facilisis.</p>

                <p>Aliquam rhoncus suscipit ultrices. Proin eu lectus lectus. Cras tincidunt eu metus sit amet lobortis. Nam commodo volutpat nibh vitae ornare. Vestibulum ut venenatis tellus. In sit amet suscipit risus. Fusce mattis nec augue quis cursus. Fusce id varius orci. In mollis ut nisl eget ornare.</p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dolor erat, dignissim nec massa quis, condimentum pellentesque mi. Nullam tempus, tortor at sollicitudin interdum, augue metus fringilla quam, at luctus tortor libero vitae dolor. Integer fermentum dui sed lectus tempus vehicula. Sed consequat mollis nibh, ac dictum mi sagittis varius. Mauris sed felis accumsan, interdum nibh at, mollis enim. Morbi placerat in eros sit amet lobortis. Donec rutrum elementum felis in consectetur. Maecenas gravida, lorem id hendrerit tincidunt, neque diam aliquet leo, sed eleifend nibh neque id sapien. Donec blandit nec neque vel dapibus.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div><!--END terms Modal-->

		</div><!--END wrap-->

		<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="./libs/bootstrap/js/bootstrap.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>



<!-- Google Analytics -->
<script>
	(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
	function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
	e=o.createElement(i);r=o.getElementsByTagName(i)[0];
	e.src='//www.google-analytics.com/analytics.js';
	r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
	ga('create',<?php echo $GoogleSiteID ?>);ga('send','pageview');
</script>



	</body>
</html>