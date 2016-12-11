<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <base href="<?php echo get_template_directory_uri(); ?>/" />
    <link rel="shortcut icon" href="img/f.png" type="image/x-icon" />

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-5NNT7B');</script>
		<!-- End Google Tag Manager -->

    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />

    <?php wp_head(); ?>
	</head>
	<body>

    <?php if(!is_home()): ?>
    <header class="site-header site-header__slim">

      <div class="logo">
        <a href="<?php echo home_url(); ?>" title="Home">Andrew Chart</a>
      </div>

      <div class="menu-button-area">
        <button class="button menu-button">Menu</button>
      </div>


      <?php include_once('nav.php'); ?>


    </header>
    <?php endif; ?>
