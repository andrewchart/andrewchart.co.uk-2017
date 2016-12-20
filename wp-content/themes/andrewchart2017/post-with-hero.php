<header class="post-hero-header">

  <div class="hero-image-container"
    data-hero-image-xl="<?php the_post_thumbnail_url('uncropped_xl')?>"
    data-hero-image-l="<?php the_post_thumbnail_url('uncropped_l')?>"
    data-hero-image-m="<?php the_post_thumbnail_url('uncropped_m')?>"
    data-hero-image-s="<?php the_post_thumbnail_url('uncropped_s')?>">
    <div class="hero-fullres-container"></div>
    <div class="hero-placeholder-container" style="background-image: url('<?php the_post_thumbnail_url('uncropped_tiny')?>')"></div>
  </div>

  <div class="vignette"></div>

  <section class="post-title-area">
    <div class="title-column">
      <h1><?php the_title(); ?></h1>
      <section class="excerpt"><?php the_excerpt(); ?></section>
    </div>

    <div class="post-meta-area">
      <?php
        $cats = get_the_category();
        foreach($cats as $cat) {
          echo '&nbsp;<span class="breadcrumb"><a href="' . get_category_link($cat) . '">' . $cat->cat_name . '</a></span>';
        }
      ?><br />Published on <?php the_date(); ?>
    </div>
  </section>



  <div class="see-more"><button class="material-icons scroll-down">expand_more</button></div>
</header>

<progress class="post-progress" value="0" max="100"></progress>

<section class="main-content post-content">

  <?php pBr(the_content()); ?>

  <?php if(!empty(types_render_field('listening-to'))): ?>
  <footer class="listening-to">
    <div><?php echo types_render_field('listening-to'); ?></div>
    <blockquote><?php echo types_render_field('listening-to-quote'); ?></blockquote>
  </footer>
  <?php endif; ?>

</section>
