<?php
  /* Template Name: Photography Category Page */


?>

<?php get_header(); ?>

<section class="main-content category-content">
  <h1 class="visually-hidden"><?php single_cat_title(); ?></h1>

  <?php if ( have_posts() ) : ?><ul class="post-list category-post-list"><?php endif; ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <li>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <div class="main-tile-part">
          <img 
            srcset="<?php the_post_thumbnail_url('uncropped_s'); ?> 768w, <?php the_post_thumbnail_url('uncropped_m'); ?> 2560w, <?php the_post_thumbnail_url('uncropped_l'); ?> 3840w"
            sizes="(max-width: 767px) 33vw, (min-width: 768px) 100vw"
            src="<?php the_post_thumbnail_url('uncropped_s'); ?>" />
          <span><h3><?php the_title(); ?></h3></span>
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
