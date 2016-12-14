<?php
  /* Template Name: Contact Page */

?>

<?php get_header(); ?>

<section class="main-content contact-form-content">

  <h1><?php the_title(); ?></h1>
  <p>I'd love to hear from you! Please get in touch below.</p>

  <form name="contact-form" class="contact-form">
    <div class="form-input">
      <label>Name:</label>
      <input type="text" name="name" />
    </div>

    <div class="form-input">
      <label>Email:</label>
      <input type="email" name="email" />
    </div>

    <div class="form-input">
      <label>Phone:</label>
      <input type="phone" name="phone" />
    </div>

    <div class="form-input">
      <label>Message:</label>
      <textarea name="message"></textarea>
    </div>

    <div class="submit-area">
      <input class="button button__primary" type="submit" value="Send" />
    </div>
    
  </form>

</section>

<?php get_footer(); ?>
