<?php get_header(); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="page-header">
          <h1><?php wp_title(''); ?></h1>
        </div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <article>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><em><?php echo the_time('l, F jS, Y'); ?></em></p>
            in <?php the_category(', '); ?>
            <?php the_excerpt(); ?>
            <hr>
          </article>
        <?php endwhile; endif; ?>
      </div>
      <div class="col-md-3">
        <?php get_sidebar('blog'); ?>
      </div>
    </div>
  </div>
<?php get_footer(); ?>
      