<progress class="post-progress" value="0" max="100"></progress>
<section class="main-content post-content">
  <h1><?php the_title(); ?></h1>
  <?php pBr(the_content()); ?>

  <?php if(!empty(types_render_field('listening-to'))): ?>
  <footer class="listening-to">
    <div><?php echo types_render_field('listening-to'); ?></div>
    <blockquote><?php echo types_render_field('listening-to-quote'); ?></blockquote>
  </footer>
  <?php endif; ?>
</section>
