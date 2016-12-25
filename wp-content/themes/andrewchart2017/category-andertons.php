<?php
  /* Template Name: Andertons Category Page */


?>

<?php get_header(); ?>

<header class="page-hero-header">

  <div class="hero-image-container"
    data-hero-image-xl="<?php echo wp_get_attachment_image_src(58, 'uncropped_xl')[0]; ?>"
    data-hero-image-l="<?php echo wp_get_attachment_image_src(58, 'uncropped_l')[0]; ?>"
    data-hero-image-m="<?php echo wp_get_attachment_image_src(58, 'uncropped_m')[0]; ?>"
    data-hero-image-s="<?php echo wp_get_attachment_image_src(58, 'uncropped_s')[0]; ?>">
    <div class="hero-fullres-container"></div>
    <div class="hero-placeholder-container" style="background-image: url('<?php echo wp_get_attachment_image_src(58, 'uncropped_tiny')[0]; ?>')"></div>
  </div>

  <div class="vignette"></div>

  <section class="post-title-area">
    <div class="title-column">
      <h1><?php single_cat_title(); ?></h1>
      <section class="excerpt"><p>As a longstanding member of the digital team,
        I have supported the growth of this family musical instrument retailer into a
        multi-million pound, international brand.</p></section>
    </div>
  </section>

  <div class="see-more"><button class="material-icons scroll-down">expand_more</button></div>

</header>

<section class="main-content category-content">

</section>

<?php get_footer(); ?>
