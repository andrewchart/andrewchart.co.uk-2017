<?php
  /* Template Name: Contact Page */

?>

<?php get_header(); ?>

<section class="main-content contact-form-content">

  <h1><?php the_title(); ?></h1>
  <?php accouk_contact_form_handler(); ?>

</section>

<?php get_footer(); ?>
