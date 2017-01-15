<?php
  /* Template Name: Homepage */

?>

<?php get_header(); ?>


<section class="main-content homepage-content">

  <h3 class="homepage-copy-heading">Hi, I'm Andrew.</h3>
  <p>I'm based in Surrey, South East England, and I
    work as the Head of E-commerce for one of the UK's
    most exciting retail brands. I'm also a keen runner
    and musician.</p>

  <section class="latest-posts">
    <h5>Latest Blog Posts</h5>
    <?php accouk_homepage_latest_posts(); ?>

    <div class="read-more-blog"><a href="<?php echo site_url('blog'); ?>">Read more on my blog</a></div>
  </section>

  <nav class="homepage-nav">
    <h5>Web Professional</h5>
    <ul class="post-list homepage-work-post-list">
      <li>
        <a href="<?php echo site_url('my-work/andertons'); ?>" title="Andertons">
          <div class="main-tile-part">
            <img src="<?php echo wp_get_attachment_image_src(58, 'sixteennine_s')[0]; ?>" />
            <span><h3>Andertons Music Co.</h3></span>
          </div>
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('contact-me')?>" title="Contact Me">
          <div class="main-tile-part">
            <img src="<?php echo get_the_post_thumbnail_url(6,'sixteennine_s'); ?>" />
            <span><h3>Contact Me</h3></span>
          </div>
        </a>
      </li>
    </ul>
  </nav>

</section>



<?php get_footer(); ?>
