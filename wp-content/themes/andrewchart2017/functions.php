<?php

/* 1) Post Imagery */
add_theme_support('post-thumbnails');
if(function_exists('add_image_size')) {
  add_image_size('uncropped_xl',3840,9999);
  add_image_size('uncropped_l',1920,9999);
  add_image_size('uncropped_m',1280,9999);
  add_image_size('sixteennine_m',1280,720,true);
  add_image_size('uncropped_s',640,9999);
  add_image_size('sixteennine_s',640,360, true);
	add_image_size('uncropped_tiny',32,9999);
  add_image_size('sixteennine_tiny',32,18,true);

	//add_image_size('widget-thumbnail-large',310,174,true);
}


/* 2) Display Post Content with correct format template */
function accouk_display_post_content() {

  $post_formats = get_the_terms(get_the_id(), 'post-format');

  switch($post_formats[0]->slug) {

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

/* 3) Excerpt Length and Ellipsis */
add_filter( 'excerpt_length', function() { return 23; } );
add_filter( 'excerpt_more', function() { return "..."; } );

/* 4) Only manual excerpts on post pages */
function accouk_post_excerpt() {
  if(has_excerpt()) {
    the_excerpt();
  }
}

/* 5) Unlimited posts per page on category "andertons" */
function accouk_mywork_andertons_rpp($query) {
  if (!is_admin() && $query->is_main_query() && is_category('andertons')) {
    $query->set( 'posts_per_page', '-1' );
  }
}
add_action( 'pre_get_posts', 'accouk_mywork_andertons_rpp' );

/* 6) Contact Form -- Render or Handle */
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
