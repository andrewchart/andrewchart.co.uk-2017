<?php
  /* Template Name: Category Page */


?>

<?php get_header(); ?>

<section class="main-content category-content">
  <h1><?php single_cat_title(); ?></h1>

  <?php if ( have_posts() ) : ?><ul class="post-list category-post-list"><?php endif; ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <li>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <div class="main-tile-part">
          <?php echo accouk_post_tile_image(); ?>
          <span><h3><?php the_title(); ?></h3></span>
        </div>
        <div class="sub-tile-part">
          <span class="excerpt"><?php the_excerpt(); ?></span>
          <span class="date"><?php echo get_the_date(); ?></span>
          <span class="cta">Read Now</span>
        </div>
      </a>
    </li>


  <?php endwhile; else : ?>
  	<p><?php _e( 'Sorry, there are no posts in this category yet.' ); ?></p>
  <?php endif; ?>

  <?php if ( have_posts() ): ?>
  </ul>
  <div class="pagination"><?php echo paginate_links(); ?></div>
  <?php endif; ?>

</section>

<?php get_footer(); ?>
