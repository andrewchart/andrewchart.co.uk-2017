<header class="post-hero-header">

  <div class="vignette"></div>
  <section class="post-title-area">
    <div class="title-column">
      <h1><?php the_title(); ?></h1>
      <section class="excerpt"><?php the_excerpt(); ?></section>
    </div>

    <div class="meta-column">
      Published on <?php the_date(); ?> in <?php the_category(); ?>
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
