<?php

include "./libs/MailChimp/MailChimp.php";

$MailChimp = new \Drewm\MailChimp('3e2074c3da2d0262d35926048bdc6cae-us9'); //
$MailChimpListID = "4c703dc232";//

$buyerEmail="rongxia123@gmail.com";
$firstName="Rong";
$lastName="Xia";


		//MailChimp integration, transaction success doesn't depend on this subscription
		$subscribeMailChimp = "Y";
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


?>		