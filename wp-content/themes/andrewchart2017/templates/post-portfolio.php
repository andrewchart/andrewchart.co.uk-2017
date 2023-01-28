<progress class="post-progress" value="0" max="100"></progress>
<section class="main-content post-content nohero-post-content">
  <h1><?php the_title(); ?></h1>

  <div class="post-series-area">
    <?php accouk_display_post_series(); ?>
  </div>

  <?php 
    if(accouk_is_photography_page()) {
      $img_prefix = "uncropped";
    } else {
      $img_prefix = "sixteennine";
    }
  ?>

  <div class="hero-image-container" 
    role="img" 
    aria-label="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>"
    data-hero-image-xl="<?php the_post_thumbnail_url($img_prefix . '_m')?>"
    data-hero-image-l="<?php the_post_thumbnail_url($img_prefix . '_m')?>"
    data-hero-image-m="<?php the_post_thumbnail_url($img_prefix . '_s')?>"
    data-hero-image-s="<?php the_post_thumbnail_url($img_prefix . '_s')?>">
    <div class="hero-fullres-container"></div>
    <div class="hero-placeholder-container"><img src="<?php the_post_thumbnail_url($img_prefix . '_tiny')?>" /></div>
  </div>

  <?php pBr(the_content()); ?>

  <?php if(!empty(types_render_field('listening-to')))
          include_once('listening-to.php'); ?>

  <?php include_once('end-post-nav.php'); ?>

</section>
