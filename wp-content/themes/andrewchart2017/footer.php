  <footer class="site-footer">
    Andrew Chart <?php echo date('Y'); ?>
    <nav class="social-links">
      <a class="twitter" target="_blank" title="Andrew Chart Twitter" href="https://twitter.com/@andrewchart">Twitter</a>
      <a class="linkedin" target="_blank" title="Andrew Chart LinkedIn" href="https://www.linkedin.com/in/andrew-chart-b89a9153">LinkedIn</a>
    </nav>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="js/scripts.js"></script>
  <script src="js/prism.js"></script>
  <?php if(accouk_is_photography_page() && is_single()) : ?>
  <script src="js/photoswipe.umd.min.js"></script>
  <script src="js/photoswipe-lightbox.umd.min.js"></script>
  <script type="text/javascript">
    initLightbox();
  </script>
	<?php endif; ?>
  <?php wp_footer(); ?>
</body>
</html>
