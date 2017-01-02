<progress class="post-progress" value="0" max="100"></progress>
<section class="main-content post-content nohero-post-content">
  <h1><?php the_title(); ?></h1>
  <div class="post-meta-area">
    Published on <?php the_date(); ?> in
    <?php
      $cats = get_the_category();

      foreach ($cats as $cat) {
        $last_cat_link = get_category_link($cat);
        $last_cat_name = $cat->cat_name;
        echo '&nbsp;<span class="breadcrumb"><a href="' . $last_cat_link . '">' . $last_cat_name . '</a></span>';
      }
    ?>
  </div>

  <div class="post-series-area">
    <?php accouk_display_post_series(); ?>
  </div>

  <section class="excerpt"><?php accouk_post_excerpt(); ?></section>

  <?php pBr(the_content()); ?>

  <?php if(!empty(types_render_field('listening-to'))): ?>
  <footer class="listening-to">
    <div><?php echo types_render_field('listening-to'); ?></div>
    <blockquote><?php echo types_render_field('listening-to-quote'); ?></blockquote>
  </footer>
  <?php endif; ?>

  <nav class="end-post-nav">
    <a class="back-to-category" href="<?php echo $last_cat_link; ?>">Return to &ldquo;<?php echo $last_cat_name; ?>&rdquo;</a>
    <section class="tags"><?php the_tags("<span>Tags: </span>", " "); ?></section>
  </nav>

  <?php include_once('comments.php'); ?>

</section>
