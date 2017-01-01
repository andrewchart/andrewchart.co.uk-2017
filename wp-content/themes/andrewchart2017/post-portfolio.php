<progress class="post-progress" value="0" max="100"></progress>
<section class="main-content post-content nohero-post-content">
  <h1><?php the_title(); ?></h1>

  <div class="hero-image-container"
    data-hero-image-xl="<?php the_post_thumbnail_url('sixteennine_m')?>"
    data-hero-image-l="<?php the_post_thumbnail_url('sixteennine_m')?>"
    data-hero-image-m="<?php the_post_thumbnail_url('sixteennine_s')?>"
    data-hero-image-s="<?php the_post_thumbnail_url('sixteennine_s')?>">
    <div class="hero-fullres-container"></div>
    <div class="hero-placeholder-container"><img src="<?php the_post_thumbnail_url('sixteennine_tiny')?>" /></div>
  </div>

  <?php pBr(the_content()); ?>

  <nav class="end-post-nav">
    <?php $cats = get_the_category(); ?>
    <a class="back-to-category" href="<?php echo get_category_link($cats[0]); ?>">
      Return to &ldquo;<?php echo $cats[0]->cat_name; ?>&rdquo;
    </a>
  </nav>

</section>
