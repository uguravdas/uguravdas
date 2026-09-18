<?php
/**
 * Template Name: İletişim sayfası
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) : the_post(); ?>

<section class="page-hero">
  <div class="wrap">
    <?php ty_crumb(); ?>
    <h1><?php the_title(); ?></h1>
    <?php if ( has_excerpt() ) : ?><p class="page-lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="grid-3">
      <a class="card" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-iletisim">
        <span class="chip"><?php echo ty_ikon( 'telefon' ); ?></span>
        <h3>Telefon</h3>
        <p class="num" style="font-size:1.1rem;color:var(--ink);font-weight:600"><?php echo esc_html( ty_tel() ); ?></p>
        <span class="urun-yer"><?php echo esc_html( ty_op( 'ty_saat_hafta' ) ); ?></span>
      </a>
      <a class="card" href="<?php echo esc_url( ty_wa_link() ); ?>" target="_blank" rel="noopener" data-ty="whatsapp-iletisim">
        <span class="chip chip-safe"><?php echo ty_ikon( 'whatsapp' ); ?></span>
        <h3>WhatsApp</h3>
        <p>Fotoğraf gönderin, ne gerektiğini söyleyelim.</p>
        <span class="more">Mesaj gönder &rarr;</span>
      </a>
      <a class="card" href="mailto:<?php echo esc_attr( ty_op( 'ty_email' ) ); ?>">
        <span class="chip"><?php echo ty_ikon( 'belge' ); ?></span>
        <h3>E-posta</h3>
        <p><?php echo esc_html( ty_op( 'ty_email' ) ); ?></p>
        <span class="urun-yer">Teklif ve fatura yazışmaları</span>
      </a>
    </div>

    <?php if ( trim( get_the_content() ) ) : ?>
      <div class="entry-body" style="max-width:70ch;margin-top:48px"><?php the_content(); ?></div>
    <?php endif; ?>
  </div>
</section>

<?php
$ty_adres_tam = trim( ty_op( 'ty_adres_tam' ) );
$ty_harita    = trim( ty_op( 'ty_harita' ) );
$ty_imza_html = ty_imza();
$ty_yil       = ty_kac_yil();
?>
<section class="sec sec-tint">
  <div class="wrap iletisim-grid">
    <div>
      <span class="eyebrow">Künye</span>
      <h2 style="margin-top:1rem"><span class="el-alti">Kiminle</span> konuşuyorsunuz</h2>

      <ul class="bilgi-liste" style="margin-top:1.8rem">
        <li>
          <span class="bilgi-etiket">Firma</span>
          <span class="bilgi-deger">
            <?php echo esc_html( ty_op( 'ty_unvan' ) ); ?>
            <?php if ( $ty_yil ) : ?>
              <span class="bilgi-not"><?php echo esc_html( $ty_yil ); ?> yıldır Tekirdağ'da</span>
            <?php endif; ?>
          </span>
        </li>
        <li>
          <span class="bilgi-etiket">Adres</span>
          <span class="bilgi-deger">
            <?php echo $ty_adres_tam ? esc_html( $ty_adres_tam ) : esc_html( ty_op( 'ty_adres' ) ); ?>
            <?php if ( $ty_adres_tam ) : ?>
              <span class="bilgi-not"><?php echo esc_html( ty_op( 'ty_adres' ) ); ?></span>
            <?php endif; ?>
          </span>
        </li>
        <li>
          <span class="bilgi-etiket">Telefon</span>
          <span class="bilgi-deger">
            <a class="num" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-kunye"><?php echo esc_html( ty_tel() ); ?></a>
            <span class="bilgi-not">Aramaya cevap veremezsek geri döneriz.</span>
          </span>
        </li>
        <li>
          <span class="bilgi-etiket">E-posta</span>
          <span class="bilgi-deger">
            <a href="mailto:<?php echo esc_attr( ty_op( 'ty_email' ) ); ?>"><?php echo esc_html( ty_op( 'ty_email' ) ); ?></a>
          </span>
        </li>
        <li>
          <span class="bilgi-etiket">Çalışma saatleri</span>
          <span class="bilgi-deger">
            <?php echo esc_html( ty_op( 'ty_saat_hafta' ) ); ?><br>
            <?php echo esc_html( ty_op( 'ty_saat_cmt' ) ); ?>
            <span class="bilgi-not">Pazar kapalıyız. Acil durumlarda WhatsApp'tan yazın.</span>
          </span>
        </li>
        <li>
          <span class="bilgi-etiket">Hizmet bölgesi</span>
          <span class="bilgi-deger">
            Tekirdağ'ın 11 ilçesi
            <span class="bilgi-not">Çorlu, Çerkezköy ve Ergene hattına haftalık düzenli servis.</span>
          </span>
        </li>
      </ul>

      <?php echo $ty_imza_html; // ty_imza() içinde kaçışlandı ?>
    </div>

    <div>
      <?php if ( $ty_harita ) : ?>
        <div class="harita"><?php echo wp_kses( $ty_harita, array( 'iframe' => array(
          'src' => true, 'width' => true, 'height' => true, 'style' => true,
          'loading' => true, 'allowfullscreen' => true, 'referrerpolicy' => true,
          'title' => true, 'frameborder' => true,
        ) ) ); ?></div>
      <?php else : ?>
        <div class="aside-card">
          <h3>Nerede çalışıyoruz</h3>
          <p>Tekirdağ'ın 11 ilçesine teslim ve montaj yapıyoruz. Bulunduğunuz ilçeyi söyleyin, o hafta içinde yerinizdeyiz.</p>
          <div class="ilce" style="margin-top:1rem">
            <?php foreach ( ty_ilceler() as $ty_is => $ty_id ) : ?>
              <a href="<?php echo esc_url( ty_url( $ty_is ) ); ?>"><?php echo esc_html( $ty_id['ad'] ); ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php endwhile;
get_template_part( 'parts/teklif' );
get_footer();
