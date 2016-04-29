<?php 
include_once 'inc/header.php';
require_once 'vendor/autoload.php';

$post = array();
$errors = array();
$errorsExist = false;

if(!empty($_POST)) {
	foreach ($_POST as $key => $value) {
		$post[$key] = trim(strip_tags($value));
	}

	if(empty($post['name']) || strlen($post['name']) < 3 || strlen($post['name']) > 50) {
		$errors[] = "Votre prénom ne doit pas etre vide et doit contenir entre 3 et 50 characteres.";
	}

	if(empty($post['subject'])) {
		$errors[] = "Subject ne doit pas etre vide.";
	}

	if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Veillez inserer un email correct';
	}

	if(empty($post['msg'])) {
		$errors[] = 'N\'oubliez pas remplir le champs de message';
	}

	if(count($errors) > 0) {

		$errorsExist = true;
		echo '<div class="error-list"><ul>';
		foreach ($errors as $val) {
			echo '<li>' . $val . '</li>';
		}
		echo '</ul></div>';

	}
	else {

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'postmaster@wf3.axw.ovh';                 // SMTP username
		$mail->Password = 'WF3sessionPhilo2';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('from@mywebsite.com', 'Nastia');
		$mail->addAddress($post['email'], 'Coco');     // Add a recipient

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $post['subject'];
		$mail->Body    = $post['msg'];
		$mail->AltBody = $post['msg'];

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo '<div class="message message-success">Message has been sent</div>';
		}
	}

}

?>

	<h2 class="page-title">Ecrivez-moi, svp</h2>
	<form id="contact-form" method="post">
		<table>
			<tr>
				<td class="form-label"><label for="name">Comment vous vous appellez?</label></td>
				<td><input type="text" name="name" id="name" placeholder="Votre prénom"></td>
			</tr>

			<tr>
				<td class="form-label"><label for="email">Votre email</label></td>
				<td><input type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Votre email"></td>
			</tr>

			<tr>
				<td class="form-label"><label for="subject">Subject</label></td>
				<td><input type="text" name="subject" id="subject" placeholder="Subject"></td>
			</tr>

			<tr>
				<td class="form-label label-textarea"><label for="msg">Un petit message pour moi?</label></td>
				<td><textarea name="msg" id="msg" placeholder="Votre message"></textarea></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit"></td>
			</tr>
		</table>
	</form>
	

<?php 


include_once 'inc/sidebar.php'; 
include_once 'inc/footer.php'; 
?>
		