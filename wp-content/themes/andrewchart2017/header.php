<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
		<base href="<?php echo get_template_directory_uri(); ?>/" />

		<?php if(accouk_is_dev()) : ?>
        <!-- Google Analytics: Indicate dev environments -->
		<script>
			// Detected in Google Tag Manager to modify traffic_type
			window.dataLayer = window.dataLayer || [];
  			window.dataLayer.push({
    			"is_dev_site": true
  			});
		</script>
		<!-- End Google Analytics: Indicate dev environments -->
		<?php endif; ?>

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-5NNT7B');</script>
		<!-- End Google Tag Manager -->

		<!-- Detect flexbox -->
		<script>
		var doc = document.body || document.documentElement;
		var style = doc.style;
		if (!(style.webkitFlexWrap == '' || style.msFlexWrap == '' || style.flexWrap == '')) {
				doc.className += (doc.className === "" ? "" : " ") + "no-flexbox";
		};
		</script>
		<!-- End Detect Flexbox -->

		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Oswald:400" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="style.css" />
		<link rel="stylesheet" href="css/prism.css" />
		<?php if(accouk_is_photography_page()) : ?>
		<link rel="stylesheet" href="css/photography.css" />
		<?php endif; ?>

		<?php if(accouk_is_photography_page() && is_single()) : ?>
		<link rel="stylesheet" href="css/photoswipe.css" />
		<?php endif; ?>
		
		<link rel="shortcut icon" href="img/f.png" type="image/x-icon" />

		<?php wp_head(); ?>

		<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/a/default-thumbnail-colour.png" />

		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body class="<?php echo accouk_body_class_list(); ?>">
		<!-- Facebook Javascript SDK -->
		<div id="fb-root"></div>
		<script 
			async 
			defer 
			crossorigin="anonymous" 
			src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v15.0&appId=176632145783407&autoLogAppEvents=1" 
			nonce="TPlJ3vSB">
		</script>
		<!-- End Facebook Javascript SDK -->

		<?php if(!is_front_page()): ?>

			<header class="site-header site-header__slim">
				<div class="logo">
					<a href="<?php echo home_url(); ?>" title="Home">Andrew Chart</a>
				</div>

				<div class="menu-button-area">
					<button class="button menu-button">Menu</button>
				</div>

				<?php include_once('nav.php'); ?>
		    </header>

	    <?php else: ?>

		    <div class="above-fold__home">
				<header class="site-header site-header__home">
					<div class="menu-button-area">
						<button class="button menu-button">Menu</button>
					</div>

					<?php include_once('nav.php'); ?>

					<?php the_content(); ?>

					<div class="logo"></div>
		    	</header>
	      		<div class="see-more"><button class="material-icons scroll-down">expand_more</button></div>
    		</div>

	    <?php endif; ?>
