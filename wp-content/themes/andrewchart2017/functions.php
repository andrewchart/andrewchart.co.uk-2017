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
}


/* 2) Display Post Content with correct format template */
function accouk_display_post_content() {

  $post_formats = get_the_terms(get_the_id(), 'post-format');

  switch($post_formats[0]->slug) {

    case 'post-with-hero':
      include_once('templates/post-with-hero.php');
      break;

    case 'portfolio':
      include_once('templates/post-portfolio.php');
      break;

    case 'portfolio-item-with-hero':
      include_once('templates/post-portfolio-with-hero.php');
      break;

    case 'default':
      include_once('templates/post-default.php');
      break;

    case 'no-featured-image':
      include_once('templates/post-no-featured-image.php');
      break;

    default:
      include_once('templates/post-default.php');
      break;

  }

}


/* 3) Set a global $main_category array on single posts for use in components */
function accouk_set_global_main_cat() {

  //Requires Yoast SEO
  $yoast_primary_cat = new WPSEO_Primary_Term('category', get_the_ID());
  $yoast_primary_cat = $yoast_primary_cat->get_primary_term();

  $cat = get_category($yoast_primary_cat);
  $name = $cat->cat_name;
  $slug = $cat->slug;
  $link = get_term_link($yoast_primary_cat);

  $GLOBALS['main_category'] = array('name' => $name, 'link' => $link, 'slug' => $slug);

}

/* 3) Form the <body> class list */
function accouk_body_class_list() {

  $class_array = array();

  // Include category slug to style based on category
  if(is_single() && isset($GLOBALS['main_category'])) {
    array_push($class_array, "category-" . $GLOBALS['main_category']['slug']);
  } else if(is_category()) {
    array_push($class_array, "category-" . get_queried_object()->slug);
  }
  
  return implode(" ", $class_array);

}

/* 3) Display Post Meta Information */
function accouk_display_post_meta() {

  global $main_category;
  echo '<div class="published-date">Published on '; the_date();
  echo ' in <a href="' . $main_category['link'] . '" class="breadcrumb">' . $main_category['name'] . '</a></div>';

}

/* 3) Display Last Updated Date for chosen primary categories */
function accouk_display_post_last_updated() {

  $show_last_updated = array(
    'web',
    'ecommerce',
    'development'
  );

  global $main_category;

  if(!in_array($main_category['slug'], $show_last_updated))
    return;

  if(get_the_date('d-m-Y') === get_the_modified_date('d-m-Y'))
    return;

  echo '<div class="last-updated-date">Last updated '; the_modified_date();  echo '</div>';

}

/* 3) Display Post Series Information */
function accouk_display_post_series() {

  $first_post_series = get_the_terms(get_the_id(), 'post-series')[0]; //Only displays one post series
  if(empty($first_post_series)) return;

  $link = get_category_link($first_post_series->term_id);
  $series = $first_post_series->name;
  $html = 'Part of the &ldquo;<a href="' . $link . '">' . $series . '</a>&rdquo; post series';

  echo $html;
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

/* 4) Guitar Tab Formatting and Download */
function accouk_guitar_tab($atts) {

  $tab_content = '';
  $file_path_relative = '';
  $file_path_full = '';
  $downloadable = false;

  $a = shortcode_atts(array(
    'file' => null,
		'download' => null
	), $atts);

  $file_path_full = $_SERVER['DOCUMENT_ROOT'] . "/" . $a['file'];
  $valid_text_file = accouk_is_valid_text_file($file_path_full);

  // Only process the file contents if we're confident it's a .txt file
  if($valid_text_file === true) {
    $tab_content = file_get_contents($file_path_full);
  }

  // Only show download link if the text file is valid and the user has specified the link
  if($valid_text_file && $a['download'] === "yes") {
    $downloadable = true;
    $file_path_relative = $a['file'];
  }

  // Output with template
  ob_start();
  include('templates/guitar-tab.php');
  $element = ob_get_contents();
  ob_end_clean();

	return $element;
}
add_shortcode( 'guitar_tab', 'accouk_guitar_tab' );

/* 4a) Make sure that all that can be rendered or downloaded is valid .txt files */
function accouk_is_valid_text_file($path) {

  // Use finfo to detect mime type
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime = finfo_file($finfo, $path);
  finfo_close($finfo);
  if($mime !== "text/plain") return false;

  // Check file extension
  $filename_length = strlen($path);
  if(substr($path, $filename_length-4, $filename_length) !== ".txt") return false;

  return true;
}

/* 4) Photography category and post pages */
function accouk_is_photography_page() {
  if( is_category('photography') || 
      (isset($GLOBALS['main_category']) && 
      $GLOBALS['main_category']['slug'] === "photography")
  ) {
    return true;
  }

  return false;
}

/* 4) Photography info block for post pages */
function accouk_photo_info($atts) {

  $camera = null;
  $lens = null;
  $date_taken = null;
  $focal_length = null;
  $aperture = null;
  $shutter_speed = null;
  $iso = null;

  // Read EXIF data
  $exif = exif_read_data( wp_get_original_image_path( get_post_thumbnail_id() ) );

  // Calculate properties from EXIF data
  if(isset($exif['Make']) && isset($exif['Model'])) {
    $camera = $exif['Make'] . " " . $exif['Model'];
  }

  if(isset($exif['UndefinedTag:0xA434'])) { 
    $lens = $exif['UndefinedTag:0xA434'];
  }

  if(isset($exif['DateTimeOriginal'])) {
    $exif_date_as_obj = date_create_from_format("Y:m:d H:i:s", $exif['DateTimeOriginal']);
    if($exif_date_as_obj) {
      $date_taken = date_format($exif_date_as_obj, "d/m/Y H:i");
    }
  }

  if(isset($exif['FocalLength'])) {
    $exp = explode("/", $exif['FocalLength']);
    $focal_length  = $exp[0] / $exp[1];
    $focal_length .= "mm";
  }

  if(isset($exif['COMPUTED']['ApertureFNumber'])) {
    $aperture = $exif['COMPUTED']['ApertureFNumber'];
  } else if(isset($exif['FNumber'])) {
    $exp = explode("/", $exif['FNumber']);
    $aperture  = "f/";
    $aperture .= number_format($exp[0] / $exp[1], 1);
  }

  if(isset($exif['ExposureTime'])) {
    $exp = explode("/", $exif['ExposureTime']);
    $time  = $exp[0] / $exp[1];
    if($time < 1) {
      $shutter_speed = $exif['ExposureTime'] . " second";
    } else if ($time === 1) {
      $shutter_speed = "1 second";
    } else {
      $shutter_speed = round($time, 2) . " seconds";
    }
  }

  if(isset($exif['ISOSpeedRatings'])) {
    $iso = $exif['ISOSpeedRatings'];
  } 

  // Override with user supplied
  $img_meta = shortcode_atts(array(
    'camera' => $camera,
		'lens' => $lens,
    'date_taken' => $date_taken,
    'focal_length' => $focal_length,
    'aperture' => $aperture,
    'shutter_speed' => $shutter_speed,
    'iso' => $iso,
    'lat' => $lat,
    'lng' => $lng
	), $atts);


  // Work out if a map could be shown.
  $map_url = null;

  include_once('svc/map-svcs.php');
  $ms = new MapSvcs;

  // Manual co-ordinates supplied
  if(isset($img_meta['lat']) && isset($img_meta['lng'])) {
    $lat_lng = array($img_meta['lat'], $img_meta['lng']);
    $map_url = $ms->get_map_url(wp_upload_dir(), $lat_lng);
  } 
  
  // Otherwise look at the EXIF data
  else if(isset($exif['GPSLatitude'])) {

    $lat_dms = $exif['GPSLatitude'];
    $lat_ref = $exif['GPSLatitudeRef'];
    $lng_dms = $exif['GPSLongitude'];
    $lng_ref = $exif['GPSLongitudeRef'];

    $lat_lng = $ms->exif_dms_to_decimal_degrees($lat_dms, $lat_ref, $lng_dms, $lng_ref);

    $map_url = $ms->get_map_url(wp_upload_dir(), $lat_lng);

  }

  // Output with template
  ob_start();
  include('templates/photo-info.php');
  $element = ob_get_contents();
  ob_end_clean();

	return $element;
}
add_shortcode( 'photo_info', 'accouk_photo_info' );

/* 4) Photography gallery for post pages */
function accouk_photo_gallery($atts) {

  $thumbnails_html = "";
  $i = 0;

  // Get image IDs
  $args = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'posts_per_page' => -1,
    'post_parent' => get_the_ID(),
    'order' => 'ASC',
    'fields' => 'ids'
  ); 

  // Option to hide thumbnails and just have an open gallery button
  $a = shortcode_atts(array(
    'hide_thumbnails' => false
	), $atts);

  if($a['hide_thumbnails']) {
    $hide_thumbnails = true;
  }

  $attachment_ids = get_posts($args);

  // Render the thumbnail gallery
  foreach($attachment_ids as $attachment_id) {

    $thumbnail = wp_get_attachment_image_src($attachment_id, 'uncropped_s', false);
    $full_img  = wp_get_attachment_image_src($attachment_id, 'uncropped_xl', false);
    $img_meta  = wp_get_attachment_metadata($attachment_id);

    $thumbnail_src = $thumbnail[0];
    $full_img_src = $full_img[0];
    $full_img_w = $full_img[1];
    $full_img_h = $full_img[2];

    $id = "pg-img-" . $i;
    $alt = trim(strip_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)));
    $caption = wp_get_attachment_caption($attachment_id);

    $srcset = "";

    if(is_array($img_meta)) {
      $size_array = array(absint($full_img_w), absint($full_img_h));
      $srcset     = wp_calculate_image_srcset($size_array, $full_img_src, $img_meta, $attachment_id);
    }

    ob_start();
    include('templates/photo-gallery-thumbnail.php');
    $thumbnails_html .= ob_get_contents();
    ob_end_clean();

    $i++;

  }

  // Output with template
  ob_start();
  include('templates/photo-gallery.php');
  $element = ob_get_contents();
  ob_end_clean();

	return $element;
}
add_shortcode( 'photo_gallery', 'accouk_photo_gallery' );


/* 5) YouTube Video Embed */
function accouk_youtube_embed($atts) {

  $a = shortcode_atts(array(
    'id' => null
	), $atts);

  $yt_id = $a['id'];

  // Dumb validation of youtube ID
  if(strlen($yt_id) !== 11) return;

  // Output with template
  ob_start();
  include('templates/youtube-video.php');
  $element = ob_get_contents();
  ob_end_clean();

	return $element;
}
add_shortcode( 'youtube', 'accouk_youtube_embed' );


/* 5) Unlimited posts per page on category "andertons" */
function accouk_mywork_andertons_rpp($query) {
  if (!is_admin() && $query->is_main_query() && is_category('andertons')) {
    $query->set( 'posts_per_page', '-1' );
  }
}
add_action( 'pre_get_posts', 'accouk_mywork_andertons_rpp' );


/* 5) Increased posts per page on category "photography" */
function accouk_blog_photography_rpp($query) {
  if (!is_admin() && $query->is_main_query() && is_category('photography')) {
    $query->set( 'posts_per_page', '20' );
  }
}
add_action( 'pre_get_posts', 'accouk_blog_photography_rpp' );


/* 6) Render latest posts on homepage */
function accouk_homepage_latest_posts() {

  $args = array('post_type' => 'post', 'category_name' => 'blog', 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC');
  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {

    echo '<ul class="post-list homepage-post-list">';

  	while ( $query->have_posts() ) {
  		$query->the_post(); ?>

      <li>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
          <div class="main-tile-part">
            <?php echo accouk_post_tile_image(); ?>
            <span><h3><?php the_title(); ?></h3></span>
          </div>
          <div class="sub-tile-part">
            <span class="excerpt"><?php the_excerpt(); ?></span>
            <span class="date"><?php echo get_the_date(); ?></span>
            <span class="cta">Read Now</span>
          </div>
        </a>
      </li>
      <?php
  	}

  	echo '</ul>';

  } else {
  	echo "<p>Sorry, an error has occurred</p>";
  }

}

/* 7) Echo the post thumbnail image or a default */
function accouk_post_tile_image($size = 'sixteennine_s') {

  $thumb = get_the_post_thumbnail_url(null, $size);

  if(empty($thumb)) {

    $col = "#";
    $i=0;
    while($i<3) {
      $col .= str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
      $i++;
    }

    return '<img style="background-color: ' . $col . '" src="img/a/default-thumbnail.png" />';

  } else {
    return '<img src="'.$thumb.'" />';
  }
}


/* 6) Contact Form -- Render or Handle */
function accouk_contact_form_handler() {

  if(isset($_POST['message'])):

    $ini = parse_ini_file('forms/contact-form.ini');

    $name = $_POST['your_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $to = $ini['TO_EMAIL'];
    $recaptcha_secret = $ini['RECAPTCHA_SECRET'];

    //Check recaptcha is OK
    if( ! reCaptchaOk($recaptcha_secret, $_POST['g-recaptcha-response']) ) {
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

    $mailsent = wp_mail($to, $subject, $html, $headers);

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

/* 7) Check Recaptcha Response */
function reCaptchaOk($secret, $response) {

  //cURL api
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 2);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "secret=$secret&response=$response");

  $result = json_decode(curl_exec($ch));

  if($result && $result->success) {
    return $result->success;
  } else {
    return false;
  }

}


/* 8 -- Inserts paragraph and break tags upon pulling text data into a page */
function pBr($in) {
	$in = "<p>" . str_replace(array("\r\n","\r","\n","<br /><br />"),array("<br />","<br />","<br />","</p><p>"),$in);
	$in .= "</p>";
	return $in;
}


/* 9 -- Exclude 'pages' from search results */
function accouk_exclude_pages_from_search_results($query) {

  if ($query->is_search) {
    $query->set('post_type', 'post');
  }

  return $query;

}
add_filter('pre_get_posts','accouk_exclude_pages_from_search_results');


/* 10 -- Function that returns true in non-prod environments */
function accouk_is_dev() {
  if(get_site_url(null,null,'https') === "https://www.andrewchart.co.uk") {
    return false;
  } else { 
    return true;
  }
}

?>
