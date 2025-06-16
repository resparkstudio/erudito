<?php
function site_logo( $wp_customize ) {
	$wp_customize->add_setting( 'site_logo_light' );
	$wp_customize->add_setting( 'site_logo_dark' );

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'site_logo_light',
			array(
				'label' => 'Upload a light logo',
				'section' => 'title_tagline',
				'settings' => 'site_logo_light'
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'site_logo_dark',
			array(
				'label' => 'Upload a dark logo',
				'section' => 'title_tagline',
				'settings' => 'site_logo_dark'
			)
		)
	);
}
add_action( 'customize_register', 'site_logo' );