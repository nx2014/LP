<?php
include "./libs/MailChimp/MailChimp.php";
$MailChimp = new \Drewm\MailChimp('3e2074c3da2d0262d35926048bdc6cae-us9'); //Change MailChimp API Key here
$mc = $MailChimp->call('lists/list');
$curr_sub_count = $mc[data][1][stats][member_count];

$result = $MailChimp->call('lists/subscribe', array(
                'id'            => '4c703dc232',  //Change list ID here, e.g 4c703dc232 for "TestGroup"
                'email'         => array('email'=>'andy2003_67@hotmail.com'),
                'merge_vars'    => array('FNAME'=>'Rong', 'LNAME'=>'XiaHM'),
				'double_optin'  => false  
            ));
//print_r($mc);	
print_r("<br>");
print_r($result);	
//error_log("token:adsfasdf");

?>
<BR>
<?PHP 
echo $curr_sub_count
?>
<BR>
adsfadsf


