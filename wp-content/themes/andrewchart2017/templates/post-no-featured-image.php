<progress class="post-progress" value="0" max="100"></progress>
<section class="main-content post-content nohero-post-content">
  <h1><?php the_title(); ?></h1>
  <div class="post-meta-area">
    <?php accouk_display_post_meta(); ?>
    <?php accouk_display_post_last_updated(); ?>
  </div>

  <div class="post-series-area">
    <?php accouk_display_post_series(); ?>
  </div>

  <section class="excerpt"><?php accouk_post_excerpt(); ?></section>

  <?php pBr(the_content()); ?>

  <?php if(!empty(types_render_field('listening-to')))
          include_once('listening-to.php'); ?>

  <?php include_once('end-post-nav.php'); ?>

  <?php include_once('comments.php'); ?>

</section>
