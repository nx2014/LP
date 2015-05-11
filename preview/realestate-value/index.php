<?php
include "./libs/MailChimp/MailChimp.php";

$isSuccessShow = "false";
$isSuccess = "";
$error = "";

$sellerEmail = "rongxia2014@gmail.com"; //
$MailChimp = new \Drewm\MailChimp('3e2074c3da2d0262d35926048bdc6cae-us9'); // need to comment User change block, then MailChimp can work
$MailChimpListID = "4c703dc232";//

//form inputs
/*
$form_streetAddress="123 main street";
$form_suiteNumber="168";
$form_city="new york city";
$form_state="NY";
$form_zipCode="10001";

$form_email="rongxia123@gmail.com";
$form_firstName="Rong001";
$form_lastName="Xia002";
$form_phoneNumber="2011231234";
*/

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {

	try {
		$isSuccessShow = 'true';
		$isSuccess = 'false';

		$buyerStreetAddress = trim($_POST['streetAddress']);
		$buyerSuiteNumber = trim($_POST['suiteNumber']);
		$buyerCity = trim($_POST['city']);
		$buyerState = trim($_POST['state']);
		$buyerZipCode = trim($_POST['zipCode']);
		
		$firstName = trim($_POST['firstName']);
		$lastName = trim($_POST['lastName']);
		$buyerEmail = trim($_POST['email']);
		$buyerPhoneNo = trim($_POST['phoneNo']);
		
		//send email to seller
		$from = "DoNotReply <donotreply@landingpageburger.com>";
		$to = $sellerEmail; 
		$Subject = "New Purchase From Your Landing Page";
		$msg = "Congratulations! You have a new purchase form your landing page. Details from this purchase are below:<BR><BR>";
		$msg .= "<strong>First Name:</strong> ".$firstName."<BR>";
		$msg .= "<strong>Last Name:</strong> ".$lastName."<BR>";
		$msg .= "<strong>Email:</strong> ".$buyerEmail."<BR>";
		$msg .= "<strong>Phone Number:</strong> ".$buyerPhoneNo."<BR>";
		$msg .= "<strong>Address:</strong> ".$buyerStreetAddress." #".$buyerSuiteNumber.", ".$buyerCity.", ".$buyerState.", ".$buyerZipCode."<BR>";
		$headers = "MIME-Version: 1.0" . " \r\n";
		$headers .= "Content-type:text/html;charset=UTF-8\r\n";
		$headers .= "From: ".$from." \r\n";

		$sentToSeller = mail($to,$Subject,$msg,$headers);		
		
		error_log("sentToSeller:".$sentToSeller);
		
		//send email to buyer
		$from = $sellerEmail;
		$to = $buyerEmail;
		$Subject = "Thank You For Your Purchase!";
		$msg = "<strong>Thanks for your inquiry</strong><BR>";
		$msg .= "Congratulations! Your ... <BR>";
		
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8\r\n";
		$headers .= "From: ".$from."\r\n";
		$sentToBuyer = mail($to,$Subject,$msg,$headers);
		error_log("sentToBuyer:".$sentToBuyer);
		
		//MailChimp integration, transaction success doesn't depend on this subscription
		$subscribeMailChimp = trim($_POST['subscribeMailChimp']);
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
		error_log($error);
	}
}


?>



<!--
  - Combined 2 forms inside 1 form tag
-->

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>What's Your Home Worth Now?</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="font-awesome-4.2.0/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Chelsea+Market' rel='stylesheet' type='text/css'>
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
	                <p>Congratulations! Your transaction was successful. You can now view or download your ebook from the below link:</p>
	                thanks ...
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
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
  
        <!-- Add your site or application content here -->
        <h1 class="mainHeadline text-center">What's The Value Of My Home?</h1>
        <h3 class="subHeadline text-center">Get a thorough evaluation of my home's current value.</h3>
		
        <form action="" method="POST" id="mainForm">
		<div id="errMsg" class="alert alert-danger"></div>
        <div class="forms">
          <div class="submit1">
          <div id="form1">
              <div class="formContent col-lg-5 col-md-8 col-sm-12 center-block">

                <h4 class="formTitle text-center">My Property Address</h4>
                  <div class="form-group">
                      <div class="streetAddress col-md-8">
                        <label>Street Address</label>
                        <input class="streetAddressInput clearMeFocus form-control" id="streetAddress" name="streetAddress" type="text" size="4" value="<?php echo $form_streetAddress ?>" placeholder="Street Address" required>
                      </div>
                      <div class="suiteNumber col-md-4">
                        <label>Suite #</label>
                        <input class="suiteNumberInput clearMeFocus form-control" id="suiteNumber" name="suiteNumber" type="text" size="4" value="<?php echo $form_suiteNumber ?>" placeholder="Suite #">
                      </div>
                      <div class="clearfix"></div>
                  </div><!--END form-group-->

                  <div class="form-group">  
                      <div class="city col-md-4">
                        <label>City</label>
                        <input class="cityInput clearMeFocus form-control" id="city" name="city" type="text" size="20" value="<?php echo $form_city ?>" placeholder="City" required>
                      </div>

                      <div class="state col-md-4">
                        <label>State</label>
                        <select class="form-control" name="state">
                          <option value="AL">Alabama</option>
                          <option value="AK">Alaska</option>
                          <option value="AZ">Arizona</option>
                          <option value="AR">Arkansas</option>
                          <option value="CA">California</option>
                          <option value="CO">Colorado</option>
                          <option value="CT">Connecticut</option>
                          <option value="DE">Delaware</option>
                          <option value="DC">District Of Columbia</option>
                          <option value="FL">Florida</option>
                          <option value="GA">Georgia</option>
                          <option value="HI">Hawaii</option>
                          <option value="ID">Idaho</option>
                          <option value="IL">Illinois</option>
                          <option value="IN">Indiana</option>
                          <option value="IA">Iowa</option>
                          <option value="KS">Kansas</option>
                          <option value="KY">Kentucky</option>
                          <option value="LA">Louisiana</option>
                          <option value="ME">Maine</option>
                          <option value="MD">Maryland</option>
                          <option value="MA">Massachusetts</option>
                          <option value="MI">Michigan</option>
                          <option value="MN">Minnesota</option>
                          <option value="MS">Mississippi</option>
                          <option value="MO">Missouri</option>
                          <option value="MT">Montana</option>
                          <option value="NE">Nebraska</option>
                          <option value="NV">Nevada</option>
                          <option value="NH">New Hampshire</option>
                          <option value="NJ">New Jersey</option>
                          <option value="NM">New Mexico</option>
                          <option value="NY">New York</option>
                          <option value="NC">North Carolina</option>
                          <option value="ND">North Dakota</option>
                          <option value="OH">Ohio</option>
                          <option value="OK">Oklahoma</option>
                          <option value="OR">Oregon</option>
                          <option value="PA">Pennsylvania</option>
                          <option value="RI">Rhode Island</option>
                          <option value="SC">South Carolina</option>
                          <option value="SD">South Dakota</option>
                          <option value="TN">Tennessee</option>
                          <option value="TX">Texas</option>
                          <option value="UT">Utah</option>
                          <option value="VT">Vermont</option>
                          <option value="VA">Virginia</option>
                          <option value="WA">Washington</option>
                          <option value="WV">West Virginia</option>
                          <option value="WI">Wisconsin</option>
                          <option value="WY">Wyoming</option>
                        </select>
                      </div>

                      <div class="zip col-md-4">
                        <label>Zip Code</label>
                        <input class="zipInput clearMeFocus form-control" id="zipCode" name="zipCode" type="text" size="20" value="<?php echo $form_zipCode ?>" placeholder="Zip Code">
                      </div>

                      <div class="clearfix"></div>

                  </div><!--END form-group-->

                  <div class="col-md-12">
                    <button type="button" class="btn btn-primary center-block" id="btn-submit1" onClick="">Continue</button>
                  </div>

                  <div class="clearfix"></div>

              </div><!--END formContent-->                              
          </div><!--END form1-->

          <div style="float:left; width:100%;" id="form2">
            <div class="formContent col-lg-5 col-md-8 col-sm-12 center-block" action="#" method="POST" >
     
              <h4 class="formTitle text-center">Send My Report Here</h4>
              <div class="text-center margin-bottom"><a id="back"><small>Back To Property Address &rarr;</small></a></div>

                <div class="form-group">
                    <div class="firstName col-md-6">
                      <label>First Name</label>
                      <input class="firstNameInput clearMeFocus form-control" id="firstName" name="firstName" type="text" size="4" value="<?php echo $form_firstName ?>" placeholder="First Name" required>
                    </div>
                    <div class="lastName col-md-6">
                      <label>Last Name</label>
                      <input class="lastNameInput clearMeFocus form-control" id="lastName" name="lastName" type="text" size="4" value="<?php echo $form_lastName ?>" placeholder="Last Name" required>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="form-group">  
                    <div class="email col-md-6">
                      <label>Email</label>
                      <input class="emailInput clearMeFocus form-control" id="email" name="email" type="text" size="20" value="<?php echo $form_email ?>" placeholder="Email" required>
                    </div>
                    <div class="phone col-md-6">
                      <label>Phone Number</label>
                      <input class="phoneInput clearMeFocus form-control" id="phoneNo" name="phoneNo"type="text" size="20" value="<?php echo $form_phoneNumber ?>" placeholder="Phone Number">
                    </div>
                    <div class="clearfix"></div>
                </div><!--END form-group-->

				<div class="checkbox form-row" class="col-md-12">
					<label>
						<input type="checkbox" align="left" id="subscribeMailChimp" name="subscribeMailChimp" value="Y" checked />Subscribe to newsletter
					</label>
				</div>
							
                <div class="col-md-12">
                  <p class="text-center small text-muted">It's possible that a Real Estate Professional will contact you to obtain more information about your home before evaluating your home's value.</p>
                </div>

				<button type="submit" class="submit-button btn btn-primary center-block" id="submitBtn">
					<div id="sendText">Send My Report!</div><img src="img/loader.gif" style="display:none" id="submitBtnImg" >
				</button>				
				
				<!--
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary center-block" id="submitBtn" onClick="">Send My Report!</button>
                </div>
				-->
				
                <div class="clearfix"></div>

              </div><!--END formContent-->

            </div><!--END form2-->
          </div><!--END submit2-->
        </div><!--END forms-->
        </form>


      <div class="footer navbar-fixed-bottom">
          <div class="container">
            <p class="text-muted text-center">© 2015 - All rights reserved. <a data-toggle="modal" data-target="#privacyModal">Privacy Policy</a> | <a data-toggle="modal" data-target="#termsModal">Terms & Conditions</a></p>
          </div>
      </div>

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

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
       
	   <script src="./libs/bootstrap/js/bootstrap.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
    </body>
</html>
