<?php
/**
 * Tek yazı sayfası.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();

while ( have_posts() ) : the_post();
	$ty_kat     = ty_yazi_kategori();
	$ty_foto    = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	$ty_blog_id = (int) get_option( 'page_for_posts' );
	?>

<article class="yazi">

  <section class="page-hero yazi-hero">
    <div class="wrap">
      <?php
      ty_crumb( $ty_blog_id
          ? array( 'ad' => get_the_title( $ty_blog_id ), 'url' => get_permalink( $ty_blog_id ) )
          : null );
      ?>
      <?php if ( $ty_kat ) : ?>
        <span class="eyebrow"><?php echo esc_html( $ty_kat->name ); ?></span>
      <?php endif; ?>
      <h1><?php the_title(); ?></h1>
      <div class="yazi-meta yazi-meta-buyuk">
        <span><?php echo ty_ikon( 'saat' ); ?><?php echo esc_html( ty_okuma_suresi() ); ?> dakika okuma</span>
        <span><?php echo ty_ikon( 'belge' ); ?><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
      </div>
    </div>
  </section>

  <?php if ( $ty_foto ) : ?>
    <div class="wrap yazi-kapak">
      <img src="<?php echo esc_url( $ty_foto ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" width="1180" height="620">
    </div>
  <?php endif; ?>

  <section class="entry">
    <div class="wrap yazi-wrap">
      <div class="entry-body yazi-govde"><?php the_content(); ?></div>

      <div class="yazi-kutu">
        <div>
          <span class="eyebrow">Sırada ne var</span>
          <h3>Yerinizde durum ne, birlikte bakalım</h3>
          <p>Yerinizin türünü ve m²'sini girin, yönetmeliğe göre hangi üründen kaç adet gerektiğini çıkaralım. İki dakika sürüyor, sonucu doğrudan teklife gönderiyor.</p>
        </div>
        <div class="yazi-kutu-cta">
          <a class="btn btn-primary" href="<?php echo esc_url( ty_url( 'yangin-guvenligi-ihtiyac-hesaplama' ) ); ?>" data-ty="hesap-yazi"><?php echo ty_ikon( 'hesap' ); ?>İhtiyacını hesapla</a>
          <a class="btn btn-line" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-yazi"><?php echo ty_ikon( 'telefon' ); ?><?php echo esc_html( ty_tel() ); ?></a>
        </div>
      </div>
    </div>
  </section>

</article>

<?php
$ty_ilgili = $ty_kat ? get_posts( array(
	'posts_per_page' => 3,
	'post__not_in'   => array( get_the_ID() ),
	'category'       => $ty_kat->term_id,
) ) : array();

if ( ! $ty_ilgili ) {
	$ty_ilgili = get_posts( array( 'posts_per_page' => 3, 'post__not_in' => array( get_the_ID() ) ) );
}

if ( $ty_ilgili ) : ?>
<section class="sec sec-tint">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Devamı</span>
      <h2>Bunlar da işinize yarayabilir</h2>
    </div>
    <div class="yazi-grid">
      <?php
      global $post;
      foreach ( $ty_ilgili as $post ) { setup_postdata( $post ); ty_yazi_kart(); }
      wp_reset_postdata();
      ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
endwhile;

get_template_part( 'parts/teklif', null, array(
    'baslik' => 'Sizin yerinizde durum ne?',
    'metin'  => 'Yazıyı okudunuz, şimdi kendi yerinize bakalım. Tesisinizi anlatın, yönetmeliğe göre ne gerektiğini çıkarıp fiyatlayalım. Keşif ücretsiz.',
) );

get_footer();
