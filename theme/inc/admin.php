<?php
/**
 * Yönetim paneli ve giriş sayfası markalaması.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ---- Giriş (login) sayfası ---- */
add_action( 'login_enqueue_scripts', function () { ?>
<style>
  body.login{background:#2F343C;font-family:-apple-system,"Segoe UI",Roboto,Arial,sans-serif}
  body.login #login{padding-top:6%;width:340px}
  body.login h1{text-align:center;margin-bottom:22px}
  body.login h1 a{
    background:none!important;width:auto;height:auto;text-indent:0;font-size:23px;line-height:1.2;
    font-weight:800;letter-spacing:-.02em;color:#F4F4F5;text-decoration:none;
  }
  body.login h1 a::after{content:"YANGIN";color:#FF4D3D;margin-left:6px}
  body.login form{
    background:#3A414B;border:1px solid #4A515C;border-radius:4px;box-shadow:none;
    padding:26px 24px 24px;margin-top:16px;
  }
  body.login form label{color:#B7BCC4;font-size:13px}
  body.login input[type=text],body.login input[type=password]{
    background:#2F343C;border:1px solid #4A515C;border-radius:4px;color:#F4F4F5;
    box-shadow:none;padding:9px 10px;font-size:15px;
  }
  body.login input[type=text]:focus,body.login input[type=password]:focus{
    border-color:#FF4D3D;box-shadow:0 0 0 1px #FF4D3D;outline:0;
  }
  body.login .wp-pwd button.button .dashicons{color:#B7BCC4}
  body.login .button-primary{
    background:#D2281C!important;border:0!important;border-radius:4px!important;
    box-shadow:none!important;text-shadow:none!important;font-weight:600;height:38px;line-height:36px;
  }
  body.login .button-primary:hover{background:#97180F!important}
  body.login #nav,body.login #backtoblog{text-align:center;padding:0;margin-top:14px}
  body.login #nav a,body.login #backtoblog a{color:#B7BCC4!important;font-size:13px}
  body.login #nav a:hover,body.login #backtoblog a:hover{color:#F4F4F5!important}
  body.login .language-switcher{display:none}
  body.login .privacy-policy-page-link{display:none}
</style>
<?php } );

add_filter( 'login_headerurl', function () { return home_url( '/' ); } );
add_filter( 'login_headertext', function () { return 'TEKİRDAĞ'; } );

/* Giriş hatasında kullanıcı adı mı şifre mi yanlış belli olmasın. */
add_filter( 'login_errors', function () { return 'Kullanıcı adı veya şifre hatalı.'; } );

/* ---- Yönetim paneli ---- */

/* Gereksiz gösterge paneli kutularını kaldır. */
add_action( 'wp_dashboard_setup', function () {
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );   // WordPress Etkinlikleri ve Haberleri
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Hızlı Taslak
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
}, 20 );

/* Panele küçük bir marka dokunuşu ve okunabilirlik. */
add_action( 'admin_head', function () { ?>
<style>
  #wpadminbar .ab-item .ab-label{font-weight:500}
  .wp-core-ui .button-primary{background:#D2281C;border-color:#97180F;box-shadow:none;text-shadow:none}
  .wp-core-ui .button-primary:hover,.wp-core-ui .button-primary:focus{background:#97180F;border-color:#97180F;box-shadow:none}
  .wp-core-ui .button-primary:focus{box-shadow:0 0 0 1px #fff,0 0 0 3px #D2281C}
  #adminmenu .wp-menu-image img{opacity:.9}
  .ty-not{
    border-left:4px solid #D2281C;background:#fff;padding:12px 16px;margin:16px 0;
    font-size:13px;line-height:1.6;
  }
</style>
<?php } );

/* Panel altbilgisi. */
add_filter( 'admin_footer_text', function () {
	return 'Tekirdağ Yangın — tema: <strong>Tekirdağ Yangın</strong> v' . wp_get_theme()->get( 'Version' );
} );
add_filter( 'update_footer', '__return_empty_string', 11 );

/* Yönetici olmayanlara üst çubuğu gösterme. */
add_action( 'after_setup_theme', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		show_admin_bar( false );
	}
} );

/* Blog açık — sadece yorum menüsü kapalı (yorum kullanmıyoruz). */
add_action( 'admin_menu', function () {
	remove_menu_page( 'edit-comments.php' );
} );

/* Yazı listesinde öne çıkan görsel sütunu. */
add_filter( 'manage_posts_columns', function ( $c ) {
	$yeni = array();
	foreach ( $c as $k => $v ) {
		if ( 'title' === $k ) { $yeni['ty_foto'] = 'Görsel'; }
		$yeni[ $k ] = $v;
	}
	return $yeni;
} );
add_action( 'manage_posts_custom_column', function ( $col, $post_id ) {
	if ( 'ty_foto' !== $col ) { return; }
	echo has_post_thumbnail( $post_id )
		? get_the_post_thumbnail( $post_id, array( 60, 45 ), array( 'style' => 'border-radius:4px;object-fit:cover' ) )
		: '<span style="color:#b32d2e">yok</span>';
}, 10, 2 );

/* Sayfa listesinde hangi şablonun kullanıldığını göster. */
add_filter( 'manage_pages_columns', function ( $cols ) {
	$cols['ty_sablon'] = 'Şablon';
	return $cols;
} );
add_action( 'manage_pages_custom_column', function ( $col, $post_id ) {
	if ( 'ty_sablon' !== $col ) { return; }
	$tpl = get_page_template_slug( $post_id );
	$adlar = array(
		''                     => 'Varsayılan sayfa',
		'template-hizmet.php'  => 'Hizmet sayfası',
		'template-sektor.php'  => 'Sektör sayfası',
		'template-ilce.php'    => 'İlçe sayfası',
		'template-tup.php'     => 'Yangın tüpü LP',
		'template-iletisim.php'=> 'İletişim',
	);
	echo esc_html( isset( $adlar[ $tpl ] ) ? $adlar[ $tpl ] : $tpl );
}, 10, 2 );

/* ---- Temizlik ---- */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
add_filter( 'xmlrpc_enabled', '__return_false' );

/* Emoji betiklerini kaldır (hız). */
add_action( 'init', function () {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
} );
