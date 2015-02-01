<?php
function sendMail(){
	$firstName = trim($_GET['firstName']);
	$lastName = trim($_GET['lastName']);
	$email = trim($_GET['email']);	
	$phoneNo = trim($_GET['phoneNo']);
	$addr = trim($_GET['addr']);
	
	$str = "ERR";
	$msg .="<p>Congratulations! You have just received a new lead from your landing page. Information user entered are below:</p>";
	$msg .="<p><strong>First Name: </strong>".$firstName."</p><p><strong>Last Name: </strong>".$lastName."</p><p><strong>Phone Number: </strong>".$phoneNo."</p><p><strong>Email: </strong>".$email."</p><p><strong>Address: </strong>".$addr."</p>";
	$to = "kikix2125@gmail.com";
	$Subject = "New Lead From Your Landing Page";
	$from = "DoNotReply <donotreply@landingpageburger.com>";
	// Always set content-type when sending HTML email
	$headers .= "MIME-Version: 1.0" . " \r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: ".$from." \r\n";
	if(mail($to,$Subject,$msg,$headers)){
		$str = "OK";								   
	}
	return $str."~";exit;
}

switch($_GET['xAction']){
	case 'sendMail':
					echo sendMail();
					break;
}
?>

<!--Real Estate – Acquire Sellers Version 11.05.14-->


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Get FREE Advice for your property value</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:700,400' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css">
        <link rel="shortcut icon" href="favicon.ico">

        
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
      <div class="wrap">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="container">
            <div class="row">
                <h1 class="headline col-md-12 strong"><span class="important"><i class="fa fa-exclamation-triangle"></i> ATTENTION:</span> CASH BUYERS WANT YOUR PROPERTY</h1><!--END headline-->
            </div><!--END row-->
            <div class="mainContent row">
                <div class="description col-md-8 col-sm-12">
                    <h3 class="strong">Ever wondered how much your house is worth now?</h3>
                    <img class="productImg img-thumbnail img-responsive pull-left" src="img/house.jpg" width="450">
                    <p>House values have surged over the years, your house might be worth a lot more than you think! With overseas investors' increasing interest in the U.S. real estate market, <span class="highlight">your property might start a BIDDING WAR.</span></p> 
                    <p>There's never been a better time to investigate this potential opportunity. We’ve just come out of a recession and property prices are booming in the U.S.! It's THE place to be at the moment!</p>

                    <p>Investors are looking for properties, just like YOURS and property prices have been steadily increasing over recent months. You don't have to make any decisions right now, we’re here to help you. <span class="highlight">Fill in your details on the form and we’ll be in touch with free advice, tailor made for you.</span></p>

                    <p>Financial freedom could finally be within your grasp. Get in touch today to find out what options you have – what have you got to lose?</p> 
                    <p class="clearfix"></p>
                    <h3 class="strong">Couple signs that your property have increased in value:</h3>
                    <ul>
                      <li><span class="glyphicon glyphicon-ok important"></span> Asian population in your neighborhood increased</li>
                      <li><span class="glyphicon glyphicon-ok important"></span> High rating school district</li>
                      <li><span class="glyphicon glyphicon-ok important"></span> Increasing in corporate offices</li>
                      <li><span class="glyphicon glyphicon-ok important"></span> Rent increase</li>
                    </ul>
                    <p>If you find one or more from the above happening in your neighborhood, then it's time to get a market value estimate for your home!</p>
                </div>
                <div class="form col-md-4 col-sm-12">
                    <div class="header text-center">
                        <li class="fa fa-clock-o"></li>
                        <h2 class="offer">Is the time right for you to sell?</h2>
                        <p>Get FREE advice from real estates experts</p>
                    </div><!--END header-->

                    <div class="body">
                        <!--contact form begin-->
                        <form action="#" method="POST" id="frmForm">
                          <div id="errMsg" class="alert alert-danger"></div>
 
                          <p>Tell us something about you:</p>

                          <div class="firstName form-row">
                            <input class="firstNameInput clearMeFocus" id="firstName" type="text" size="4" value="First Name" required>
                          </div>

                          <div class="lastName form-row">
                            <input class="lastNameInput clearMeFocus" id="lastName" type="text" size="4" value="Last Name" required>
                          </div>

                          <div class="email form-row">
                            <input class="emailInput clearMeFocus" id="email" type="text" size="20" value="Email" required>
                          </div>

                          <div class="phone form-row">
                            <input class="phoneInput clearMeFocus" id="phoneNo" type="text" size="20" value="Phone Number" required>
                          </div>

                          <p>What is the address of your property?</p>

                          <div class="address form-row">
                            <input class="addressInput clearMeFocus" id="address" type="text" size="20" value="Property Address" required>
                          </div>

                          <div class="clearfix"></div>

                          <button type="button" class="btn btn-primary" id="btn-submit" onClick="sendMail()">Get FREE Advice</button>
                          
                        </form>
                        <!--stripe form end-->
                    </div><!--END body-->

                    <div class="guaranteed text-center">
                      <p>No Ads, No Spam, Just Quality Information. GUARANTEED.</p>
                        <div class="contact alert alert-info">
                          <p>Providing Premium Service Since 2006</p>
                          <h4>Call Us FREE at <strong>1(888) 444-4500</strong> For Immidiate Advice</h4>
                       </div>
                    </div> 

                </div><!--END form-->
                <div class="clearfix"></div>
            </div><!--END mainContent-->        
              
               <ul class="testimonials row" id="content-slider">
                  <li class="testi_1 col-md-12">
                    <img src="img/albert.png" class="img-circle pull-left" width="140" height="140">
                    <p>"My family have lived in the same house for over 20 years, after my children all moved out with their own families, it's been just my wife and I living in this big house. In the recent years, property tax have gone up rapidly and we found it unnecessary to be living in a house that's so expensive to maintain. I think we have made the right decision to sell this house. The price we sold it for far exceeded my expectation. Now we have the cash to move to a small town that suits our life style AND have much more money to spend on other stuff rather than maintaining the house." <br><span class="customer pull-right">-Albert, age 65, New Jersey</span></p>
                    <p class="clearfix"></p>   
                  </li>
                  <li class="testi_2 col-md-12">
                    <img src="img/mary.png" class="img-circle pull-left" width="140" height="140">
                    <p>"After my husband Frank passed away, I realised maintaining our property would be too much for me.  It was our family home and Frank was always so good at keeping everything in order.  After spending some time taking proper advice, I decided to sell up and it’s the best thing I could have done.  I was able to afford a smaller property, more suited to my needs, with cash left over.  I was thrilled to be able to help my children out financially too.  Now I live closer to them and I don’t have to worry about maintenance bills.  I can spend more time with my grandchildren and enjoy watching them grow up." <br><span class="customer pull-right">-Mary, age 69, New York</span></p>
                    <p class="clearfix"></p>  
                  </li>
                  <li class="testi_3 col-md-12">
                    <img src="img/barbara.png" class="img-circle pull-left" width="140" height="140">
                    <p>"My husband and I worked so hard all our lives, providing for our family.  When it was time for them to move on, we realised it was now time for us.  We had no idea how much our property had increased in value until we started researching the market. It seemed so pointless living in a big old house when we didn’t need the space anymore! Now, after all these years, we have the cash to do the things we dreamt of doing when we retired. After selling our house, the first thing we did was to go on a cruise. We’re now planning a golfing holiday in Europe! " <br><span class="customer pull-right">-Barbara, age 62, New York</span></p>
                    <p class="clearfix"></p>  
                  </li>
                 
              </ul>
               <p class="names text-center"><a href="#" id="albert" data-slide="0">Albert</a> • <a href="#" id="mary" data-slide="1">Mary</a> • <a href="#" id="barbara" data-slide="2">Barbara</a></p>
           
            <section class="detailsSection1 row text-center">
                <div class="col-md-12">
                    <h3>Why You Should Work With Us</h3>
                    <p>We are a group of industry experts who work with investors from various backgrounds. We have a number of cash buyers who are ready to invest in the U.S. property market. These shrewd investors like to work quickly by using locally based experts, that's where we come in.</p>

                    <p>We match buyers and sellers, it's as simple as that.</p>

                    <p>The U.S. property market is moving fast so we are on hand round the clock, offering property advice that's right for you. Our Real Estates experts will guide you through the process,step by step. You're in good hands. Get in touch today to see what we can do for you. Selling your property could completely change your life and provide the retirement of your dreams! </p>
                    <button type="button" class="backToTop btn btn-primary">Get FREE Advice Now!</button>
                </div>   
            </section>
        </div><!--END container-->
        <footer>
            <div class="container">
              <div class="social pull-right">
                <a href="#"><i class="fa fa-facebook-square"></i></a>
                <a href="#"><i class="fa fa-twitter-square"></i></a>
                <a href="#"><i class="fa fa-linkedin-square"></i></a>
              </div>
              <p class="pull-left">YourDomain.com Copyright 2014, all rights reserved. | <a data-toggle="modal" data-target="#privacyModal">Privacy Policy</a> | <a data-toggle="modal" data-target="#termsModal">Terms & Conditions</a></p>
            </div>
        </footer>

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

      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>          
      <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
      <script src="bootstrap/js/bootstrap.js"></script>
      <script src="js/plugins.js"></script>
      <script src="js/main.js"></script>
         <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.  -->
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
