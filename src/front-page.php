<?php get_header(); ?>

<!-- Wysiwug Start -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php the_content(); ?> 
<?php endwhile; else: ?>
  <p><strong>No Content yet!</strong></p>
<?php endif; ?>
<!--- Wysiwug Editor END -->

<?php get_footer(); ?>
      