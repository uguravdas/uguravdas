<?php
/**
 * Blog listeleme sayfası (Ayarlar → Okuma → Yazılar sayfası).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();

$ty_blog_id = (int) get_option( 'page_for_posts' );
$ty_baslik  = $ty_blog_id ? get_the_title( $ty_blog_id ) : 'Yangın güvenliği rehberi';
$ty_ozet    = $ty_blog_id && has_excerpt( $ty_blog_id )
	? get_the_excerpt( $ty_blog_id )
	: 'Yönetmelik ne diyor, hangi cihaz nerede kullanılır, denetimde ne soruluyor — sahada en çok karşılaştığımız soruların cevapları.';
$ty_katlar  = get_categories( array( 'hide_empty' => true, 'number' => 8 ) );
?>

<section class="page-hero">
  <div class="wrap">
    <?php ty_crumb(); ?>
    <h1><?php echo esc_html( $ty_baslik ); ?></h1>
    <p class="page-lead"><?php echo esc_html( $ty_ozet ); ?></p>
    <?php if ( $ty_katlar ) : ?>
      <div class="yazi-filtre">
        <?php foreach ( $ty_katlar as $ty_k ) : ?>
          <a href="<?php echo esc_url( get_category_link( $ty_k->term_id ) ); ?>"><?php echo esc_html( $ty_k->name ); ?></a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php if ( have_posts() ) : ?>

<section class="sec">
  <div class="wrap">
    <?php
    $ty_sira = 0;
    $ty_grid_acik = false;
    while ( have_posts() ) : the_post();
      $ty_sira++;
      if ( 1 === $ty_sira && ! is_paged() ) {
          ty_yazi_kart( true );
          continue;
      }
      if ( ! $ty_grid_acik ) { echo '<div class="yazi-grid">'; $ty_grid_acik = true; }
      ty_yazi_kart();
    endwhile;
    if ( $ty_grid_acik ) { echo '</div>'; }
    ?>

    <?php
    $ty_sayfalar = paginate_links( array(
        'type'      => 'array',
        'prev_text' => '&larr; Önceki',
        'next_text' => 'Sonraki &rarr;',
    ) );
    if ( $ty_sayfalar ) : ?>
      <nav class="sayfalama" aria-label="Sayfalar">
        <?php foreach ( $ty_sayfalar as $ty_b ) { echo wp_kses_post( $ty_b ); } ?>
      </nav>
    <?php endif; ?>
  </div>
</section>

<?php else : ?>

<?php
/* Yazı yoksa sayfayı boş bırakmıyoruz: sahada en çok sorulan sorular
   zaten ürün ve sektör sayfalarında yazılı — burada tek yerde topluyoruz. */
$ty_rehber = ty_rehber_sorular();
?>

<?php if ( $ty_rehber ) : ?>
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Sahadan</span>
      <h2>En çok sorulanlar</h2>
      <p>Aşağıdakiler bize telefonda en sık gelen sorular. Cevapları ilgili ürün ve
         sektör sayfalarından derledik; aradığınızı bulamazsanız arayın, konuşarak halledelim.</p>
    </div>

    <?php foreach ( $ty_rehber as $ty_baslik_grup => $ty_sorular ) : ?>
      <div class="rehber-grup">
        <h3 class="rehber-grup-baslik"><?php echo esc_html( $ty_baslik_grup ); ?></h3>
        <div class="sss">
          <?php foreach ( $ty_sorular as $ty_q ) : ?>
            <details>
              <summary><?php echo esc_html( $ty_q['s'] ); ?></summary>
              <div>
                <p><?php echo esc_html( $ty_q['c'] ); ?></p>
                <?php if ( ! empty( $ty_q['url'] ) ) : ?>
                  <p><a href="<?php echo esc_url( $ty_q['url'] ); ?>">
                    <?php echo esc_html( $ty_q['kaynak'] ); ?> sayfasına git &rarr;</a></p>
                <?php endif; ?>
              </div>
            </details>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php else : ?>
<section class="sec">
  <div class="wrap">
    <div class="sec-head orta">
      <h2>Aradığınızı bulamadınız mı?</h2>
      <p>Yerinizi anlatın, yönetmeliğe göre neyin gerektiğini telefonda söyleyelim.</p>
      <a class="btn btn-primary" href="<?php echo esc_attr( ty_tel_link() ); ?>"><?php echo ty_ikon( 'telefon' ); ?><?php echo esc_html( ty_tel() ); ?></a>
    </div>
  </div>
</section>
<?php endif; ?>

<?php endif; ?>

<?php get_template_part( 'parts/teklif', null, array(
    'baslik' => 'Okumaya vaktiniz yoksa arayın',
    'metin'  => 'Yerinizi anlatın, yönetmeliğe göre neyin gerektiğini telefonda söyleyelim. Keşif ücretsiz.',
) ); ?>

<?php get_footer(); ?>
