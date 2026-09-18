<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<section class="page-hero">
  <div class="wrap">
    <span class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Ana sayfa</a> / Arama</span>
    <h1>"<?php echo esc_html( get_search_query() ); ?>" için sonuçlar</h1>
  </div>
</section>
<section class="sec">
  <div class="wrap">
    <?php if ( have_posts() ) : ?>
      <div class="grid-3">
        <?php while ( have_posts() ) : the_post(); ?>
          <a class="card" href="<?php the_permalink(); ?>">
            <h3><?php the_title(); ?></h3>
            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
            <span class="more">Aç &rarr;</span>
          </a>
        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <div class="sec-alt">
        <p>Sonuç bulunamadı. Aradığınız ürünü yazın, biz bulalım.</p>
        <a class="btn btn-primary" href="#teklif">Teklif iste</a>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php get_template_part( 'parts/teklif' ); get_footer();
