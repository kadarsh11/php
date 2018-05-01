<?php
include("./function.php");
if($_POST['sendmail'])
{
	extract($_POST);
	ob_start();
	error_reporting(0);
	include("../phpmailer/class.phpmailer.php");
	$package='';
			$message = html_entity_decode($msg_package_description);
			$proposal_data=$_POST;
			$affected_rows=insert('proposal',$proposal_data);
			if($affected_rows)
		$email_t = explode(',',$msg_to);
					//Set who the message is to be sent from
					
					$mail = new PHPMailer();
					$mail->SetFrom($msg_from,'Metaphor IT');
					$mail->Subject = $msg_sub;
					$mail->MsgHTML($message);
					$mail->AltBody = '';
					
				foreach($email_t as $key=>$index){
				$to = $email_t[$key]; // note the comma
			
					$mail->AddAddress($to);
					}
					$q=$mail->Send();
					$mail->ClearAllRecipients();
	ob_end_flush();
	
	
		if($q)
		echo 'ok';
		exit();
	
}
else
	echo 'Invalid Request';