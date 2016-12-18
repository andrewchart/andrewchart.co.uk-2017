<header class="post-hero-header">
  <div class="vignette"></div>

  <section class="post-title-area">

    <div class="title-column">
      <h1><?php the_title(); ?></h1>
      <section class="excerpt"><?php the_excerpt(); ?></section>
    </div>

    <div class="meta-column">

    </div>

  </section>
</header>

<progress class="post-progress" value="0" max="100"></progress>

<section class="main-content post-content">

  <?php pBr(the_content()); ?>
</section>
