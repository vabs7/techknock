<?php
$errors = '';
$myemail = 'info@techknock.in';//<-----Put Your email address here.
$name="TechKnock";

$Name;
$Email;
$Message;
$Number;
$contactSubject;
$captcha;

if(isset($_POST['t_name']))
    $tk_name=$_POST['t_name'];
if(isset($_POST['t_mail']))
    $tk_mail=$_POST['t_mail'];
if(isset($_POST['t_ph']))
    $tk_ph=$_POST['t_ph'];
if(isset($_POST['t_message']))
    $tk_message=$_POST['t_message'];
if(isset($_POST['t_sub']))
    $tk_sub=$_POST['t_sub'];
if(isset($_POST['g-recaptcha-response']))
    $tk_captcha=$_POST['g-recaptcha-response'];

if(!$tk_captcha){
    echo '<h2>Please check the the captcha form.</h2>';
}
else{
$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdPQ3EUAAAAAKAkKKlLAfTDy823jnsTMxfnq2FZ&response=".$tk_captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

}

if($response['success'] == false)
{
    echo '<h2>You are spammer !!!</h2>';
}
else
{
   

    $to = $myemail; 
    $email_subject = "Enquiry from Website: $tk_sub";
    $email_body = "You have received a new message. ".
	" Here are the details:\r\n  Name: $tk_name\r\n  Email: $tk_mail \r\n  Phone : $tk_ph \r\n  Message: $tk_message";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: admin@techknock.in\r\n"; 
    $headers .= "Reply-To: $Email \r\n";
    $headers .= "X-Mailer: PHP/".phpversion();
    
    $result = mail($to,$email_subject,$email_body,$headers);
    
    //redirect to the 'thank you' page
    header('Location: thankyou.php');
}
?>
