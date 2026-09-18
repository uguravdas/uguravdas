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

/**
 * "Arkasında insan var" alanları.
 * Doldurulmayan alan siteye hiç basılmaz — yarım görünen bir bölüm kalmaz.
 */
function ty_kisi_ayarlari() {
	return array(
		'ty_yetkili_ad'    => array( 'label' => 'Yetkili adı soyadı', 'default' => '' ),
		'ty_yetkili_unvan' => array( 'label' => 'Yetkili ünvanı (ör. Kurucu · Yangın güvenlik uzmanı)', 'default' => '' ),
		'ty_kurulus'       => array( 'label' => 'Kuruluş yılı (ör. 2016)',            'default' => '' ),
		'ty_adres_tam'     => array( 'label' => 'Açık adres (sokak, no, mahalle)',    'default' => '' ),
		'ty_harita'        => array( 'label' => 'Harita gömme adresi (Google Maps / OpenStreetMap "embed" linki)', 'default' => '' ),
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

	/* --- Firma ve kişi bilgileri --- */
	$wp_customize->add_section( 'ty_kisi', array(
		'title'       => 'Firma ve Yetkili',
		'priority'    => 26,
		'description' => 'Bu alanlar siteye "arkasında gerçek biri var" hissi verir. Boş bıraktığınız alan hiç görünmez.',
	) );

	foreach ( ty_kisi_ayarlari() as $key => $cfg ) {
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg['default'],
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg['label'],
			'section' => 'ty_kisi',
			'type'    => 'ty_harita' === $key ? 'textarea' : 'text',
		) );
	}

	/* Yetkili fotoğrafı */
	$wp_customize->add_setting( 'ty_yetkili_foto', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ty_yetkili_foto', array(
		'label'       => 'Yetkili fotoğrafı (kare, en az 200x200)',
		'description' => 'Yüzü görünen sade bir fotoğraf yeterli. Telefon kamerası olur.',
		'section'     => 'ty_kisi',
	) ) );
} );

/** Ayar oku. */
function ty_op( $key ) {
	$ayarlar = array_merge( ty_ayarlar(), ty_kisi_ayarlari() );
	$default = isset( $ayarlar[ $key ] ) ? $ayarlar[ $key ]['default'] : '';
	return get_theme_mod( $key, $default );
}

function ty_tel()      { return ty_op( 'ty_tel' ); }
function ty_tel_link() { return 'tel:' . preg_replace( '/[^0-9+]/', '', ty_op( 'ty_tel_raw' ) ); }
function ty_wa_link()  { return 'https://wa.me/' . preg_replace( '/[^0-9]/', '', ty_op( 'ty_whatsapp' ) ); }
