<?php
  /* Template Name: Tag Results Page */

?>

<?php get_header(); ?>

<section class="main-content search-results-content">

  <h1>Post Series: &ldquo;<?php single_term_title(); ?>&rdquo;</h1>

  <div class="archive-description"><?php echo term_description(); ?></div>

  <?php if ( have_posts() ) : ?><ul class="post-list search-results-post-list"><?php endif; ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <li>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <div class="main-tile-part">
          <img src="<?php the_post_thumbnail_url('sixteennine_s'); ?>" />
          <span><h3><?php the_title(); ?></h3></span>
        </div>
        <div class="sub-tile-part">
          <span class="excerpt"><?php the_excerpt(); ?></span>
          <span class="date"><?php the_date(); ?></span>
          <span class="cta">Read Now</span>
        </div>
      </a>
    </li>


  <?php endwhile; else : ?>
    <p><?php _e( 'Sorry, we could not find any results for your search.' ); ?></p>
  <?php endif; ?>

  <?php if ( have_posts() ): ?>
  </ul>
  <div class="pagination"><?php echo paginate_links(); ?></div>
  <?php endif; ?>

</section>

<?php get_footer(); ?>
