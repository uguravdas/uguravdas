<?php
/**
 * Özelleştirici: iletişim bilgileri.
 * Görünüm → Özelleştir → İletişim Bilgileri
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function ty_ayarlar() {
	return array(
		'ty_tel'        => array( 'label' => 'Telefon (görünen)',        'default' => '0544 866 19 99' ),
		'ty_tel_raw'    => array( 'label' => 'Telefon (tıklanan, +90…)', 'default' => '+905448661999' ),
		'ty_whatsapp'   => array( 'label' => 'WhatsApp numarası (90…)',  'default' => '905448661999' ),
		'ty_email'      => array( 'label' => 'E-posta',                  'default' => 'info@tekirdagyangin.com' ),
		'ty_adres'      => array( 'label' => 'Adres',                    'default' => 'Süleymanpaşa / Tekirdağ' ),
		'ty_saat_hafta' => array( 'label' => 'Çalışma saati (hafta içi)','default' => 'Hafta içi 08:30 – 18:30' ),
		'ty_saat_cmt'   => array( 'label' => 'Çalışma saati (cumartesi)','default' => 'Cumartesi 09:00 – 14:00' ),
		'ty_unvan'      => array( 'label' => 'Firma resmi ünvanı',       'default' => 'Tekirdağ Yangın' ),
		'ty_form_kod'   => array( 'label' => 'Teklif formu kısa kodu',   'default' => '' ),
	);
}

add_action( 'customize_register', function ( $wp_customize ) {
	$wp_customize->add_section( 'ty_iletisim', array(
		'title'    => 'İletişim Bilgileri',
		'priority' => 25,
	) );

	foreach ( ty_ayarlar() as $key => $cfg ) {
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg['default'],
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg['label'],
			'section' => 'ty_iletisim',
			'type'    => 'text',
		) );
	}
} );

/** Ayar oku. */
function ty_op( $key ) {
	$ayarlar = ty_ayarlar();
	$default = isset( $ayarlar[ $key ] ) ? $ayarlar[ $key ]['default'] : '';
	return get_theme_mod( $key, $default );
}

function ty_tel()      { return ty_op( 'ty_tel' ); }
function ty_tel_link() { return 'tel:' . preg_replace( '/[^0-9+]/', '', ty_op( 'ty_tel_raw' ) ); }
function ty_wa_link()  { return 'https://wa.me/' . preg_replace( '/[^0-9]/', '', ty_op( 'ty_whatsapp' ) ); }
