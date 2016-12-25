<?php

/* 1) Post Imagery */
add_theme_support('post-thumbnails');
if(function_exists('add_image_size')) {
  add_image_size('uncropped_xl',3840,9999);
  add_image_size('uncropped_l',1920,9999);
  add_image_size('uncropped_m',1280,9999);
  add_image_size('uncropped_s',640,9999);
	add_image_size('uncropped_tiny',28,9999);

	//add_image_size('widget-thumbnail-large',310,174,true);
}


/* 2) Display Post Content with correct format template */
function accouk_display_post_content() {

  $main_post_format = array_values(get_terms('post-format'));

  switch($main_post_format[0]->slug) {

    case 'post-with-hero':
      include_once('post-with-hero.php');
      break;

    case 'default':
      include_once('post-default.php');
      break;

    default:
      include_once('post-default.php');
      break;

  }

}

/* 3) Don't use the_content in place of the_excerpt */
add_action( 'init', 'wpse17478_init' );
function wpse17478_init() {
  remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
}

/* 4) Contact Form -- Render or Handle */
function accouk_contact_form_handler() {


  if(isset($_POST['message'])):

    $name = $_POST['your_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    //Check recaptcha is OK
    if( ! reCaptchaOk($_POST['g-recaptcha-response']) ) {
      $prompt = "<p class='error'>Sorry, you're a very lovely ROBOT. Please try again.</p>";
      include_once('forms/contact-form.php');
      return;
    }

    ob_start();
    include_once('templates/email/contact.php');
    $html = ob_get_contents();
    ob_end_clean();

    $to = "andrew@andrewchart.co.uk";
    $subject = "AndrewChart.co.uk Contact Form";
    $headers = "From: $name <$email>" . "\r\n";
    $headers .= "Reply-To: $name <$email>" . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    $mailsent = mail($to, $subject, $html, $headers);

    if(!$mailsent) {
      $prompt = "<p class='error'>Sorry, your email couldn't be sent. Please try again.</p>";
      include_once('forms/contact-form.php');
    } else {
      echo "<p class='success'>Thank you! Speak soon.</p>";
    }

    return;

  endif;

  $name; $email; $message;
  $prompt = "<p>I'd love to hear from you! Please get in touch below.</p>";
  include_once('forms/contact-form.php');

}

/* 2) Check Recaptcha Response */
function reCaptchaOk($response) {

  //cURL api
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_POST, 2);
  curl_setopt($ch,CURLOPT_POSTFIELDS, "secret=6Lcd5Q4UAAAAADhwp5umjPCmnFg7RUxhnXCIUO53&response=$response");

  $result = json_decode(curl_exec($ch));

  if($result && $result->success) {
    return $result->success;
  } else {
    return false;
  }

}



// 6c -- Inserts paragraph and break tags upon pulling text data into a page
function pBr($in) {
	$in = "<p>" . str_replace(array("\r\n","\r","\n","<br /><br />"),array("<br />","<br />","<br />","</p><p>"),$in);
	$in .= "</p>";
	return $in;
}


?>
