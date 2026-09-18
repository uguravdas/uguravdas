<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
</main>

<footer class="site-footer">
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <?php ty_logo(); ?>
        <p style="margin-top:.9rem;max-width:38ch">Tekirdağ genelinde yangın söndürme cihazı, yangın dolabı ve hidrant, davlumbaz ve pano içi otomatik söndürme.</p>
        <p style="margin-top:1rem"><a class="num" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-footer"><?php echo esc_html( ty_tel() ); ?></a></p>
        <p style="margin-top:.3rem">
          <?php
          $ty_f_adres = trim( ty_op( 'ty_adres_tam' ) );
          echo esc_html( $ty_f_adres ? $ty_f_adres . ' · ' . ty_op( 'ty_adres' ) : ty_op( 'ty_adres' ) );
          ?>
        </p>
        <p style="margin-top:.3rem"><a href="mailto:<?php echo esc_attr( ty_op( 'ty_email' ) ); ?>"><?php echo esc_html( ty_op( 'ty_email' ) ); ?></a></p>
        <p class="foot-saat">
          <?php echo esc_html( ty_op( 'ty_saat_hafta' ) ); ?><br>
          <?php echo esc_html( ty_op( 'ty_saat_cmt' ) ); ?> · Pazar kapalı
        </p>
      </div>

      <div>
        <h4>Hizmetler</h4>
        <?php if ( has_nav_menu( 'footer_hizmetler' ) ) {
            wp_nav_menu( array( 'theme_location' => 'footer_hizmetler', 'container' => false, 'menu_class' => '', 'depth' => 1 ) );
        } else { ?>
          <ul>
            <?php foreach ( ty_hizmetler() as $slug => $h ) : ?>
              <li><a href="<?php echo esc_url( ty_url( $slug ) ); ?>"><?php echo esc_html( $h['baslik'] ); ?></a></li>
            <?php endforeach; ?>
          </ul>
        <?php } ?>
      </div>

      <div>
        <h4>Kurumsal</h4>
        <?php if ( has_nav_menu( 'footer_kurumsal' ) ) {
            wp_nav_menu( array( 'theme_location' => 'footer_kurumsal', 'container' => false, 'menu_class' => '', 'depth' => 1 ) );
        } else { ?>
          <ul>
            <li><a href="<?php echo esc_url( ty_url( 'hakkimizda' ) ); ?>">Hakkımızda</a></li>
            <li><a href="<?php echo esc_url( ty_url( 'belgelerimiz' ) ); ?>">Belgelerimiz</a></li>
            <li><a href="<?php echo esc_url( ty_url( 'hizmet-bolgesi' ) ); ?>">Hizmet bölgesi</a></li>
            <li><a href="<?php echo esc_url( ty_url( 'iletisim' ) ); ?>">İletişim</a></li>
          </ul>
        <?php } ?>
      </div>
    </div>

    <div class="foot-bottom">
      <span>
        &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php echo esc_html( ty_op( 'ty_unvan' ) ); ?>
        <?php
        $ty_f_yil = ty_kac_yil();
        if ( $ty_f_yil ) { echo ' · ' . esc_html( $ty_f_yil ) . ' yıldır Tekirdağ\'da'; }
        $ty_f_kisi = trim( ty_op( 'ty_yetkili_ad' ) );
        if ( $ty_f_kisi ) { echo ' · Sorumlu: ' . esc_html( $ty_f_kisi ); }
        ?>
      </span>
      <span><a href="<?php echo esc_url( ty_url( 'kvkk-aydinlatma-metni' ) ); ?>">KVKK Aydınlatma Metni</a></span>
    </div>
  </div>
</footer>

<div class="callbar">
  <a class="cb-tel" href="<?php echo esc_attr( ty_tel_link() ); ?>" data-ty="tel-mobil">
    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .3 1.9.6 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.5 2.8.6a2 2 0 0 1 1.7 2z"/></svg>
    Hemen Ara
  </a>
  <a class="cb-wa" href="<?php echo esc_url( ty_wa_link() ); ?>" target="_blank" rel="noopener" data-ty="whatsapp-mobil">
    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.4 8.4 0 0 1-9 8.5 8.5 8.5 0 0 1-3.8-.9L3 21l1.9-5.1A8.4 8.4 0 0 1 4 11.5a8.4 8.4 0 0 1 8.5-8.5 8.4 8.4 0 0 1 8.5 8.5z"/></svg>
    WhatsApp
  </a>
</div>

<?php wp_footer(); ?>
</body>
</html>
