<?php echo $prompt; ?>
<form name="contact-form" id="contact-form" class="contact-form" method="post">
  <div class="form-input">
    <label>Name:</label>
    <input type="text" name="your_name" value="<?php echo $name; ?>" />
    <div class="error validation-error">Please provide your name</div>
  </div>

  <div class="form-input">
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $email; ?>" />
    <div class="error validation-error">Please provide your email</div>
  </div>

  <div class="form-input">
    <label>Message:</label>
    <textarea name="message"><?php echo $message; ?></textarea>
    <div class="error validation-error">Please write a message</div>
  </div>

  <div class="submit-area">
    <div class="g-recaptcha" data-sitekey="6LdzEgkjAAAAAJudHAZP46uCyDrn1jQSmjwt1AZx"></div>
    <button class="button button__primary" type="submit" />Send</button>
  </div>

</form>
