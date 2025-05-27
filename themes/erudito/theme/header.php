<?php
/**
 * The header for our theme
 *
 * This is the template that displays the `head` element and everything up
 * until the `#content` element.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package erudito
 */

?><!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel=“stylesheet” href=“https://use.typekit.net/wgs5aed.css”>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> x-data="{ registerModalOpen: false }">
	<?php get_template_part( 'template-parts/content/content-register-form' ); ?>
	<?php wp_body_open(); ?>

	<div id="page" class="not-prose relative">
		<a href="#content" class="sr-only"><?php esc_html_e( 'Skip to content', 'erd' ); ?></a>

		<?php get_template_part( 'template-parts/layout/header', 'content' ); ?>

		<div id="content">