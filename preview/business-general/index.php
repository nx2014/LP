<?php
if ($_POST) {
	$firstName = trim($_POST['firstName']);
	$lastName = trim($_POST['lastName']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$message = trim($_POST['message']);
	
	$Subject="New message from user ".$firstName." ".$lastName;
	
	//$from = "DoNotReply <donotreply@landingpageburger.com>";
	//$from = "aaa bbb <aa@bb.com>";//working
	$from = $firstName." ".$lastName."<".$email.">";
	$fromTest = $firstName." ".$lastName."<".$email.">";
	//$fromTest = $email;
	$to="rongxia2014@gmail.com";
	
	$headers .= "MIME-Version: 1.0" . " \r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: ".$from." \r\n";
	
	$emailSent = mail($to,$Subject,$message,$headers);
	//to show confirmation modal
	if($emailSent){
		$isSuccess = 'email sent successfully';						   
	}
	
} else {
	$isSuccess = "post is empty";
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
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="dist/css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
        <link rel="shortcut icon" href="favicon.ico">

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button class="navbar-toggle" aria-controls="navbar" aria-expanded="true" data-target="#navbar" data-toggle="collapse" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-tree-deciduous"></span> Your Company Name</a>
            </div><!--END navbar-header-->
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li class="active">
                  <a href="#">Home</a>
                </li>
                <li>
                  <a href="#">About</a>
                </li>
                <li>
                  <a href="#">Services</a>
                </li>
                <li>
                  <a href="#">Team</a>
                </li>
                <li>
                  <a href="#">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <section class="main">
          <div class="container">
            <div class="row">
              <div class="col-md-5">
                <img class="img-responsive img-rounded" src="img/hero.png" width="500">
              </div>
              <div class="col-md-7">
                <h1>Aliquam hendrerit elementum.</h1>
                <p>Praesent tempor, est a aliquam molestie, nunc nisl facilisis elit, quis efficitur nisl enim ac mi. Aenean tincidunt maximus arcu, eget posuere neque rhoncus et. Sed eros nisi, ultrices eu est non, ultrices pharetra nisl. Duis venenatis mauris massa, nec auctor ipsum faucibus in. Donec sem nibh, congue vitae semper nec, malesuada sit amet mi. In luctus ligula et dignissim fringilla. Nullam consectetur a est ut fringilla.</p>
                <button type="button" class="btn btn-warning btn-lg">Get In Touch</button>
              </div>
            </div>
          </div>
        </section>

        <section class="section1 gray">
          <div class="container">
            <div class="row">
              <div class="col-md-3 col-xs-12 text-center">
                <img class="img-responsive center-block" src="img/experience_150.png" width="150">
                <h3>Years Of Experience</h3>
                <p>Praesent tempor, est a aliquam molestie, nunc nisl facilisis elit, quis efficitur nisl enim ac mi. Aenean tincidunt maximus arcu, eget posuere neque rhoncus et. Sed eros nisi, ultrices eu est non, ultrices pharetra nisl. Duis venenatis mauris massa, nec auctor ipsum faucibus in.</p>
                <a href="#" class="btn btn-default">More</a>
              </div>
              <div class="col-md-3 col-xs-12 text-center">
                <img class="img-responsive center-block" src="img/time_150.png" width="150">
                <h3>Time Efficient</h3>
                <p>Praesent tempor, est a aliquam molestie, nunc nisl facilisis elit, quis efficitur nisl enim ac mi. Aenean tincidunt maximus arcu, eget posuere neque rhoncus et. Sed eros nisi, ultrices eu est non, ultrices pharetra nisl. Duis venenatis mauris massa, nec auctor ipsum faucibus in.</p>
                <a href="#" class="btn btn-default">More</a>
              </div>
              <div class="col-md-3 col-xs-12 text-center">
                <img class="img-responsive center-block" src="img/thumbUp_150.png" width="150">
                <h3>Quality Assured</h3>
                <p>Praesent tempor, est a aliquam molestie, nunc nisl facilisis elit, quis efficitur nisl enim ac mi. Aenean tincidunt maximus arcu, eget posuere neque rhoncus et. Sed eros nisi, ultrices eu est non, ultrices pharetra nisl. Duis venenatis mauris massa, nec auctor ipsum faucibus in.</p>
                <a href="#" class="btn btn-default">More</a>
              </div>
              <div class="col-md-3 col-xs-12 text-center">
                <img class="img-responsive center-block" src="img/friendly_150.png" width="150">
                <h3>Friendly Staffs</h3>
                <p>Praesent tempor, est a aliquam molestie, nunc nisl facilisis elit, quis efficitur nisl enim ac mi. Aenean tincidunt maximus arcu, eget posuere neque rhoncus et. Sed eros nisi, ultrices eu est non, ultrices pharetra nisl. Duis venenatis mauris massa, nec auctor ipsum faucibus in.</p>
                <a href="#" class="btn btn-default">More</a>
              </div>
            </div>
          </div>
        </section>

        <section class="section2">
          <div class="container">
            <h1 class="text-center margin-bottom">Services Menu</h1>
            <table class="table table-responsive">
              <tr>
                <td class="title service1"><img src="img/services1.png" class="img-responsive img-rounded" width="100%"></td>
                <td class="description">
                  <h4 align="right">Service Name</h4>
                  <p align="right">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus elementum est ligula, nec finibus augue pellentesque id. Maecenas purus turpis, volutpat at diam a, luctus gravida mauris. Suspendisse potenti. Pellentesque at sem id ligula eleifend tincidunt. Morbi mattis metus at neque faucibus, id auctor ex lacinia. Proin fringilla tempus turpis vel laoreet. Phasellus sagittis imperdiet felis quis viverra. Etiam interdum mauris magna, in faucibus turpis auctor id. Aenean facilisis ligula sed euismod euismod.</p>
                </td>
              </tr>
            </table>
            <table class="table table-responsive">
              <tr>
                <td class="description">
                  <h4>Service Name</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus elementum est ligula, nec finibus augue pellentesque id. Maecenas purus turpis, volutpat at diam a, luctus gravida mauris. Suspendisse potenti. Pellentesque at sem id ligula eleifend tincidunt. Morbi mattis metus at neque faucibus, id auctor ex lacinia. Proin fringilla tempus turpis vel laoreet. Phasellus sagittis imperdiet felis quis viverra. Etiam interdum mauris magna, in faucibus turpis auctor id. Aenean facilisis ligula sed euismod euismod.</p>
                </td>
                <td class="title service2"><img src="img/services2.png" class="img-responsive img-rounded" width="100%"></td>
              </tr>
            </table>
            <table class="table table-responsive">
              <tr>
                <td class="title service3"><img src="img/services3.png" class="img-responsive img-rounded" width="100%"></td>
                <td class="description">
                  <h4 align="right">Service Name</h4>
                  <p align="right">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus elementum est ligula, nec finibus augue pellentesque id. Maecenas purus turpis, volutpat at diam a, luctus gravida mauris. Suspendisse potenti. Pellentesque at sem id ligula eleifend tincidunt. Morbi mattis metus at neque faucibus, id auctor ex lacinia. Proin fringilla tempus turpis vel laoreet. Phasellus sagittis imperdiet felis quis viverra. Etiam interdum mauris magna, in faucibus turpis auctor id. Aenean facilisis ligula sed euismod euismod.</p>
                </td>
              </tr>
            </table>
            <table class="table table-responsive">
              <tr>
                <td class="description">
                  <h4>Service Name</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus elementum est ligula, nec finibus augue pellentesque id. Maecenas purus turpis, volutpat at diam a, luctus gravida mauris. Suspendisse potenti. Pellentesque at sem id ligula eleifend tincidunt. Morbi mattis metus at neque faucibus, id auctor ex lacinia. Proin fringilla tempus turpis vel laoreet. Phasellus sagittis imperdiet felis quis viverra. Etiam interdum mauris magna, in faucibus turpis auctor id. Aenean facilisis ligula sed euismod euismod.</p>
                </td>
                <td class="title service4"><img src="img/services4.png" class="img-responsive img-rounded" width="100%"></td>
              </tr>
            </table>
          </div><!--END container-->
        </section><!--END section2-->

        <section class="section3 gray">
          <div class="container">
            <h1 class="text-center margin-bottom">Meet Our Team</h1>
            <div class="row">
              <div class="col-sm-6 col-md-4 text-center">
                <div class="thumbnail">
                  <img class="img-responsive" src="img/ceo.gif" width="350">
                  <div class="caption">
                    <h3 class="text-primary">Robert Johnson</h3>
                    <h4>CEO & Founder</h4>
                    <p>Vivamus ut felis pulvinar arcu scelerisque placerat eget vel tellus. In sit amet lacinia odio, fringilla mattis sapien. Curabitur ut quam nisi. Etiam ac dui arcu. Curabitur in mauris in dolor iaculis ultrices. Mauris vitae leo ante. Phasellus convallis non nibh a feugiat. Suspendisse nulla quam, tristique a tincidunt non, malesuada fringilla nulla. Vivamus consectetur laoreet arcu, vel pharetra lacus volutpat ac. Vivamus placerat consequat iaculis. </p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4 text-center">
                <div class="thumbnail">
                  <img class="img-responsive" src="img/coo.gif" width="350">
                  <div class="caption">
                    <h3 class="text-primary">Mary Jones</h3>
                    <h4>COO</h4>
                    <p>Vivamus ut felis pulvinar arcu scelerisque placerat eget vel tellus. In sit amet lacinia odio, fringilla mattis sapien. Curabitur ut quam nisi. Etiam ac dui arcu. Curabitur in mauris in dolor iaculis ultrices. Mauris vitae leo ante. Phasellus convallis non nibh a feugiat. Suspendisse nulla quam, tristique a tincidunt non, malesuada fringilla nulla. Vivamus consectetur laoreet arcu, vel pharetra lacus volutpat ac. Vivamus placerat consequat iaculis. </p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4 text-center">
                <div class="thumbnail">
                  <img class="img-responsive" src="img/cfo.gif" width="350">
                  <div class="caption">
                    <h3 class="text-primary">Kimberly White</h3>
                    <h4>CFO</h4>
                    <p>Vivamus ut felis pulvinar arcu scelerisque placerat eget vel tellus. In sit amet lacinia odio, fringilla mattis sapien. Curabitur ut quam nisi. Etiam ac dui arcu. Curabitur in mauris in dolor iaculis ultrices. Mauris vitae leo ante. Phasellus convallis non nibh a feugiat. Suspendisse nulla quam, tristique a tincidunt non, malesuada fringilla nulla. Vivamus consectetur laoreet arcu, vel pharetra lacus volutpat ac. Vivamus placerat consequat iaculis. </p>
                  </div>
                </div>
              </div>
            </div><!--END row-->
          </div>
        </section>

        <section class="section4">
          <div class="container">
            <h1 class="text-center margin-bottom">Contact Us</h1>
            <div class="row">
              <div class="col-md-6">
                <address>
                  <strong>Your Company Name</strong><br>
                  795 Folsom Ave, Suite 600<br>
                  San Francisco, CA 94107<br>
                  <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
                <div id="map-canvas"></div>
              </div>
              <form class="col-md-6" action="" method="POST" id="mainForm">
				<!-- to display errors returned by createToken -->
				<div id="errMsg" class="payment-errors alert alert-danger" style="display:none"></div>
			  <div class="row">
                  <div class="form-group col-md-6">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control firstNameInput clearMeFocus" id="firstName" placeholder="John" name="firstName" value="aaa">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control lastNameInput clearMeFocus" id="lastName" placeholder="Doe" name="lastName"  value="bbb">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control emailInput clearMeFocus" id="email" placeholder="Enter Email" name="email"  value="aa@bb.com">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="phone">Phone Number</label>
                    <input type="phone" class="form-control phoneInput clearMeFocus" id="phone" placeholder="Phone Number" name="phone" value="1234565" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Message</label>
                  <textarea class="form-control" rows="10" name="message">aa comment</textarea>
                </div>
                <button type="submit" class="submit-button btn btn-primary btn-lg" id="submitBtn">Send<img src="" style="visibility:hidden" id="submitBtnImg" width="16" height="11"></button>
				<div><?php  echo $isSuccess; ?></div>
              </form>
            </div>
          </div>
        </section>

        <footer>
          <p class="text-muted text-center">YourDomain.com, 2014. All Rights Reserved. <a data-toggle="modal" data-target="#privacyModal">Privacy Policy</a> | <a data-toggle="modal" data-target="#termsModal">Terms & Conditions</a></p>
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
                <h4 class="modal-title" id="myModalLabel">Terms And Conditions</h4>
              </div>
              <div class="modal-body">
                <p>Your terms and conditions here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean elementum, nulla in pulvinar consectetur, urna lectus egestas tortor, mollis hendrerit ipsum neque ut dui. Integer faucibus nec libero et tempus. Sed pharetra tincidunt lacinia. Integer non risus iaculis, fermentum dolor sed, hendrerit mi. Vivamus quis elit purus. Cras laoreet, neque vel convallis scelerisque, tellus purus fringilla erat, et iaculis nisi sapien ut ipsum. Etiam eget lacus lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque viverra ultricies velit semper tincidunt. Nullam a lobortis lacus. Integer pulvinar erat non tortor iaculis facilisis.</p>

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
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="dist/js/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Map -->
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script>
          function initialize() {
            var mapCanvas = document.getElementById('map-canvas');
            var mapOptions = {
              center: new google.maps.LatLng(44.5403, -78.5463),
              zoom: 8,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(mapCanvas, mapOptions);
          }
          google.maps.event.addDomListener(window, 'load', initialize);
        </script>


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






