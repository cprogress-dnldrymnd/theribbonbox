<script src='https://www.google.com/recaptcha/api.js'></script>

<?php
if(isset($_POST['submit'])):
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):

		//your site secret key
        $secret = '6Ldmdo4UAAAAAPIzuA7xXrBku3prLqPtBXiOzwDu';
		//get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
		
		$cname = !empty($_POST['cname'])?$_POST['cname']:'';
		$cemail = !empty($_POST['cemail'])?$_POST['cemail']:'';
		$cmessage = !empty($_POST['cmessage'])?$_POST['cmessage']:'';

		$cont = true;

		$rtnMsg = '';

		if($cname == ''){ $cont = false;  $rtnMsg .= "<p>Please enter contact name.</p>"; }
		if($cemail == ''){ $cont = false;  $rtnMsg .= "<p>Please enter email address.</p>"; }
		if($cmessage == ''){ $cont = false;  $rtnMsg .= "<p>Please enter messsage.</p>"; }


		if ($cont):
	        if($responseData->success):
				//contact form submission code
				//$to = "info@beoffices.com";//get_option('admin_email');
			$to = "info@carestaff24.co.uk";//get_option('admin_email');

			$listContent = "Name: ".$cname. " - Email: ".$cemail;
				$subject = 'New contact form have been submitted | Care Staff 24';
				$htmlContent = "
					<h2>Contact request details</h2>
					<p class='date'><b>Name: </b>".$cname."</p>
					<p class='email'><b>Email: </b>".$cemail."</p>
				";

				if ($cdate != "") {$htmlContent .= "<p><b>Date: </b>".$cdate."</p>";}
				if ($clocation != "") {$htmlContent .= "<p><b>Location: </b>".$clocation."</p>";}
				if ($ctheme != "") {$htmlContent .= "<p><b>Theme: </b>".$ctheme."</p>";}

				$htmlContent .= "
					<p class='cmessage'><b>Message: </b>".$cmessage."</p>
				";
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// More headers
				//$headers .= 'From:'.$cname.' <'.$cemail.'>' . "\r\n";
				//send email
				//mail($to, $subject, $message, $headers);
				$mailResult = wp_mail($to,$subject,$htmlContent,$headers);

				//$status = $htmlContent;
				
	            //$succMsg = 'Your contact request has been submitted successfully.';

	            $post_id = wp_insert_post(array (
				   'post_type' => 'contact-submissions',
				   'post_title' => $listContent,
				   'post_content' => $htmlContent,
				   'post_status' => 'publish',
				   'comment_status' => 'closed',   // if you prefer
				   'ping_status' => 'closed',      // if you prefer
				));

	            if ($mailResult == '1'){
	            	$succMsg = 'Your contact request has been submitted successfully.';


	            } else{
	            	$succMsg = 'Unable to send contact request. Please try again later.';
	            }

	            //$succMsg = $mailResult;

	    		$cname = '';
				$cemail = '';
				$cdate = '';
				$clocation = '';
				$ctheme = '';
				$cmessage = '';

	        else:
	            $errMsg = 'Robot verification failed, please try again.';
	        endif;

		else:
			$errMsg = $rtnMsg;
		endif;
    else:
        $errMsg = 'Please click on the reCAPTCHA box.';
    endif;
else:
    $errMsg = '';
    $succMsg = '';
	$name = '';
	$email = '';
	$message = '';
endif;
?>

<style>
.errMsg {
	color:red;
	width:100%;
	padding:2%;
	border:1px solid red;
	margin-bottom: 20px;
}
.succMsg {
	color:green;
	width:100%;
	padding:2%;
	border:1px solid green;
	margin-bottom: 20px;
}
</style>

		<?php echo $status; ?>
        <?php if(!empty($errMsg)): ?><div class="errMsg"><?php echo $errMsg; ?></div><?php endif; ?>
        <?php if(!empty($succMsg)): ?><div class="succMsg"><?php echo $succMsg; ?></div><?php endif; ?>
<form method="POST" action="" style="max-width: 300px; margin: 0 auto;">
	<div id="name_row" class="form-row">
		<div class="form-label"><label for="cname">Your name *</label></div>
		<div class="form-field"><input id="cname" name="cname" type="text" placeholder="Your name *" value="<?php echo !empty($cname)?$cname:''; ?>" data-required="1" />
		<i class="fm fm-user"><img src="/wp-content/themes/lighttheme/images/icons/contact.png"></i></div>
		<div id="name_state" class="form-state"></div>
	</div>
	<div id="email_row" class="form-row">
		<div class="form-label"><label for="cemail">Email *</label></div>
		<div class="form-field"><input id="cemail" name="cemail" type="email" placeholder="Email *" value="<?php echo !empty($cemail)?$cemail:''; ?>" data-required="1" />
		<i class="fm fm-envelope"><img src="/wp-content/themes/lighttheme/images/icons/email.png"></i></i></div>
		<div id="email_state" class="form-state"></div>
	</div>
	<div id="message_row" class="form-row">
		<div class="form-label"><label for="cmessage">Message *</label></div>
		<div class="form-field"><textarea id="cmessage" style="margin-top: 0px; margin-bottom: 0px; height: 70px !important;" cols="30" name="cmessage" rows="10" placeholder="Message *" data-required="1"><?php echo !empty($cmessage)?$cmessage:''; ?></textarea>
		<i class="fm fm-pencil"><img src="/wp-content/themes/lighttheme/images/icons/message.png"></i></i></div>
		<div id="message_state" class="w-form-state"></div>
	</div>
	<div class="g-recaptcha form-row" data-sitekey="6Ldmdo4UAAAAANoQDkvqlkn9xai9WQlVS5BSG28K"></div>
	<input class="index-btn-middle" type="submit" name="submit" value="SUBMIT">
</form>

