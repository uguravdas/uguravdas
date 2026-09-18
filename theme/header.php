<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#icerik">İçeriğe geç</a>

<div class="ust-serit">
  <div class="wrap ust-serit-in">
    <span class="ust-sol"><?php echo ty_ikon( 'harita' ); ?>Tekirdağ'ın 11 ilçesine teslim ve montaj · keşif ücretsiz</span>
    <span class="ust-sag">
      <span class="ust-saat"><?php echo ty_ikon( 'saat' ); ?><?php echo esc_html( ty_op( 'ty_saat_hafta' ) ); ?></span>
      <a href="<?php echo esc_url( ty_wa_link() ); ?>" target="_blank" rel="noopener" data-ty="wa-serit"><?php echo ty_ikon( 'whatsapp' ); ?>WhatsApp</a>
    </span>
  </div>
</div>

<header class="site-header">
  <div class="wrap header-in">
    <?php ty_logo(); ?>

    <nav class="nav" id="ty-nav" aria-label="Ana menü">
      <?php
      // Menü, ürün tiplerinden (inc/tipler.php) otomatik kuruluyor.
      // Yeni bir tip eklendiğinde menüye elle dokunmak gerekmiyor.
      $ty_tup   = function_exists( 'ty_tipler' ) ? ty_tipler( 'tup' ) : array();
      $ty_dolap = function_exists( 'ty_tipler' ) ? ty_tipler( 'dolap' ) : array();
      ?>
          <ul class="nav-liste">
            <li class="menu-item-has-children">
              <a href="<?php echo esc_url( ty_url( 'urunler' ) ); ?>">Ürünler</a>
              <div class="mega">
                <div class="mega-in">
                  <div class="mega-sutun">
                    <a class="mega-baslik" href="<?php echo esc_url( ty_url( 'yangin-tupu-dolumu' ) ); ?>"><?php echo ty_ikon( 'tup' ); ?>Yangın Söndürme Tüpü</a>
                    <?php foreach ( $ty_tup as $ty_s => $ty_t ) : ?>
                      <a href="<?php echo esc_url( ty_url( $ty_s ) ); ?>"><?php echo esc_html( $ty_t['ad'] ); ?></a>
                    <?php endforeach; ?>
                  </div>
                  <div class="mega-sutun">
                    <a class="mega-baslik" href="<?php echo esc_url( ty_url( 'yangin-dolabi-hidrant' ) ); ?>"><?php echo ty_ikon( 'dolap' ); ?>Yangın Dolabı</a>
                    <?php foreach ( $ty_dolap as $ty_s => $ty_t ) : ?>
                      <a href="<?php echo esc_url( ty_url( $ty_s ) ); ?>"><?php echo esc_html( $ty_t['ad'] ); ?></a>
                    <?php endforeach; ?>
                  </div>
                  <div class="mega-sutun">
                    <span class="mega-baslik"><?php echo ty_ikon( 'ocak' ); ?>Otomatik söndürme</span>
                    <a href="<?php echo esc_url( ty_url( 'davlumbaz-sondurme' ) ); ?>">Davlumbaz Söndürme</a>
                    <a href="<?php echo esc_url( ty_url( 'pano-ici-sondurme' ) ); ?>">Pano İçi Söndürme</a>
                    <a href="<?php echo esc_url( ty_url( 'urunler' ) ); ?>">Tüm ürünler &rarr;</a>
                  </div>
                  <div class="mega-yan">
                    <span class="eyebrow">Ne gerekiyor?</span>
                    <p>Yerinizin türünü ve m²'sini girin, yönetmeliğe göre listeyi çıkaralım.</p>
                    <a class="btn btn-primary btn-sm" href="<?php echo esc_url( ty_url( 'yangin-guvenligi-ihtiyac-hesaplama' ) ); ?>" data-ty="hesap-mega"><?php echo ty_ikon( 'hesap' ); ?>İhtiyacını hesapla</a>
                  </div>
                </div>
              </div>
            </li>
            <li><a href="<?php echo esc_url( ty_url( 'sektorler' ) ); ?>">Sektörler</a></li>
            <li><a href="<?php echo esc_url( ty_url( 'hizmet-bolgesi' ) ); ?>">Hizmet Bölgesi</a></li>
            <li><a href="<?php echo esc_url( ty_url( 'rehber' ) ); ?>">Rehber</a></li>
            <li><a href="<?php echo esc_url( ty_url( 'belgelerimiz' ) ); ?>">Belgelerimiz</a></li>
            <li><a href="<?php echo esc_url( ty_url( 'iletisim' ) ); ?>">İletişim</a></li>
          </ul>

      <a class="btn btn-primary hesap-mobil" href="<?php echo esc_url( ty_url( 'yangin-guvenligi-ihtiyac-hesaplama' ) ); ?>" data-ty="hesap-mobil"><?php echo ty_ikon( 'hesap' ); ?>İhtiyacını Hesapla</a>
    </nav>

    <div class="header-cta">
      <a class="header-tel" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-header">
        <span class="header-tel-ikon"><?php echo ty_ikon( 'telefon' ); ?></span>
        <span>
          <small>Hemen ara</small>
          <strong class="num"><?php echo esc_html( ty_tel() ); ?></strong>
        </span>
      </a>
      <a class="btn btn-primary btn-sm btn-hesap" href="<?php echo esc_url( ty_url( 'yangin-guvenligi-ihtiyac-hesaplama' ) ); ?>" data-ty="hesap-header">
        <?php echo ty_ikon( 'hesap' ); ?>
        <span class="hesap-uzun">İhtiyacını Hesapla</span>
        <span class="hesap-kisa">Hesapla</span>
      </a>
    </div>

    <a class="header-tel-mini" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-header-mini" aria-label="Telefonla ara"><?php echo ty_ikon( 'telefon' ); ?></a>

    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="ty-nav" aria-label="Menü">
      <span class="menu-toggle-cizgi"></span>
    </button>
  </div>
</header>

<main id="icerik">
