<nav class="main-nav">

  <div class="dismiss">
    <button class="material-icons close-icon">close</button>
  </div>

  <ul>
    <li class="home-item"><a href="<?php echo home_url(); ?>" title="Home">Home</a></li>
    <?php wp_list_categories(array('hide_empty' => 0, 'exclude' => 1, 'depth' => 2, 'order' => 'DESC', 'title_li' => null)); ?>
    <?php wp_list_pages(array('title_li' => null)); ?>
  </ul>

</nav>
