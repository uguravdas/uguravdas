<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<section class="page-hero">
  <div class="wrap">
    <h1><?php echo is_search() ? 'Arama sonuçları' : 'Yazılar'; ?></h1>
  </div>
</section>
<section class="entry">
  <div class="wrap entry-grid">
    <div class="entry-body">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h2 style="margin-top:0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php echo esc_html( get_the_excerpt() ); ?></p>
      <?php endwhile; else : ?>
        <p>Sonuç bulunamadı.</p>
      <?php endif; ?>
    </div>
    <?php get_template_part( 'parts/aside' ); ?>
  </div>
</section>
<?php get_footer();
