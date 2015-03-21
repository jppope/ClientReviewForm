<?php
// use actual sendgrid username and password in this section
$url = 'https://api.sendgrid.com/'; 
$user = '<here>'; // place SG username here
$pass = '<here>'; // place SG password here


$loadtime = $_POST["loadtime"];

$totaltime = time() - $loadtime;

if($totaltime < 7) {
    echo("Please fill in the form before submitting!");
    exit;
}


// grabs HTML form's post data; if you customize the form.html parameters then you will need to reference their new new names here
$name = $_POST['name']; 
$email = $_POST['email']; 
$ideas = $_POST['ideas'];
$content1  = $_POST['content1'];
$content2  = $_POST['content2'];
$content3  = $_POST['content3'];
$content4  = $_POST['content4'];
$content5 = $_POST['content5'];
$content6  = $_POST['content6'];
$design1  = $_POST['design1'];
$design2  = $_POST['design2'];
$design3  = $_POST['design3'];
$design4  = $_POST['design4'];
$design5  = $_POST['design5'];
$design6  = $_POST['design6'];
$design7  = $_POST['design7'];
$ux1  = $_POST['ux1'];
$ux2	= $_POST['ux2'];
$ux3  = $_POST['ux3'];
$other1  = $_POST['other1'];
$other2  = $_POST['other2'];


// note the above parameters now referenced in the 'subject', 'html', and 'text' sections
// make the to email be your own address or where ever you would like the contact form info sent
$params = array(
    'api_user'  => "$user",
    'api_key'   => "$pass",
    'to'        => "<email address>", // set TO address to have the contact form's email content sent to
    'subject'   => "Content Form Submission", // Either give a subject for each submission, or set to $subject
    'html'      => "<html><head><title> Contact Form</title><body>
    Name: $name\n<br><br>
    Email: $email\n<br><br>
    Subject: $subject\n<br><br>
    Message: $message \n<br><br>
    Ideas: $ideas\n<br><br>
	Do you feel this site accurately tells what you do and your story? Please explain what we can do to make it better.: $content1\n<br><br>
	Were there any links that were dead or went to the wrong destination that you noticed?: $content2\n<br>
	Please list any content errors you found (grammar, spelling, syntax)?: $content3\n<br><br>
	Are there any pieces of data that need to be changed: $content4\n<br><br>
	Are their any major pieces of content that you would like added? please copy and paste them into this field and explain where they should go: $content5\n<br><br>
	Are their any images that you would like changed, added, modified? If so please list the URL, and a description: $content6\n<br><br>
	Any notes on the Navigation Menu?: $design1\n<br><br>
	Any Notes on the Footer?: $design2\n<br><br>
	Any notes on Layout?: $design3\n<br><br>
	Does the spacing look good?: $design4\n<br><br>
	typography?: $design5\n<br><br>
	Color palate?: $design6\n<br><br>
	Images/ photography: $design7\n<br><br>
	Describe any difficulty you have getting around the site… is there any information that you wish was easier to get?: $ux1\n<br><br>
	Do you feel the contact info is easy to get?: $ux2\n<br><br>
	Do you feel that the site is accessible to all the users that will be using your site? Are there any updates we should make to make the site more accessible?: $ux3\n<br><br>
	What, at this point would, keep this site from accomplishing its goal (generate more revenue, improve company image, etc): $other1\n<br><br>
	$other2<body></title></head></html>", 
    
    
    // Set HTML here.  Will still need to make sure to reference post data names
    'text'      => "
    Name: $name\n
    Email: $email\n
    Subject: $subject\n
    Ideas $ideas\n
	$content1\n
	$content2\n
    $content3\n
	$content4\n
	$content5\n
	$content6\n
	$design1\n
	$design2\n
	$design3\n
	$design4\n
	$design5\n
	$design6\n
	$design7\n
	$ux1\n
	$ux2\n
	$ux3\n
	$other1\n
	$other2",
    'from'      => "jonpaul.uritis@thestormcloudgroup.com", // set from address here, it can really be anything
  );




// Don't mess with this crap below

$request =  $url.'api/mail.send.json';
// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);


// Redirect to thank you page upon successfull completion, will want to build one if you don't alreday have one available
header('Location: thanks.html'); // feel free to use whatever title you wish for thank you landing page, but will need to reference that file name in place of the present 'thanks.html'
exit();

// print everything out
print_r($response);

?>
