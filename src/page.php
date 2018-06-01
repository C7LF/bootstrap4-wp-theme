<?php get_header(); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <!-- Wysiwug Start -->
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; endif;?>
        <!--- Wysiwug Editor END -->
      </div>
      <div class="col-md-3">
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
<?php get_footer(); ?>
      