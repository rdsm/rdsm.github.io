<title>Send Email - Robert S Dixon</title>
<?php  
$to = $_REQUEST['email'] ;  
$subject = $_REQUEST['subject'] ; 
$email = $_REQUEST['from'] ;  
$message = $_REQUEST['message'] ;  
$headers = "From: $email";  
$sent = mail($to, $subject, $message, $headers) ;  
if($sent)  {
print "Your message was sent successfully! Have a nice day!"; 
} 
else  {
print "We encountered an error sending your message! Please try again!"; 
} 
?>
<noscript>