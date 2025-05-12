<?php
/**
 * About Hero Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );

$image = get_field( 'image' );

$bottom_image = 'data:image/svg+xml,%3Csvg%20width%3D%221440%22%20height%3D%22817%22%20viewBox%3D%220%200%201440%20817%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20width%3D%22417.341%22%20height%3D%22417.341%22%20transform%3D%22matrix(0.226223%20-0.974076%20-0.974076%20-0.226223%201577.83%20501.141)%22%20fill%3D%22%23191F47%22%2F%3E%3Crect%20width%3D%22417.341%22%20height%3D%22417.341%22%20transform%3D%22matrix(0.708698%20-0.705512%20-0.705512%20-0.708698%201148.95%20816.966)%22%20fill%3D%22%23191F47%22%2F%3E%3Crect%20x%3D%22227.613%22%20y%3D%22410.488%22%20width%3D%22375.792%22%20height%3D%22375.792%22%20transform%3D%22rotate(158.435%20227.613%20410.488)%22%20fill%3D%22%23191F47%22%2F%3E%3Ccircle%20cx%3D%22336.333%22%20cy%3D%22438.333%22%20r%3D%22228.402%22%20transform%3D%22rotate(117.076%20336.333%20438.333)%22%20fill%3D%22%23191F47%22%2F%3E%3C%2Fsvg%3E';
?>

<div>
	<div style="background-image: url('<?php echo $bottom_image; ?>'); background-repeat: no-repeat; background-position: bottom right; background-size: 100% 100%;"
		class="px-5 lg:px-20 py-12 lg:py-26 min-h-[75rem] bg-blue text-white relative after:content-[''] after:absolute after:w-full after:bottom-0 after:left-0 after:h-[28.125rem] after:bg-blue2">
		<div class="flex flex-col items-center gap-6 lg:gap-20 w-full">
			<div>
				<?php erd_hero_text( $heading, $description, '40.5rem', '31.3125rem' ); ?>
			</div>
			<?php if ( $image ) : ?>
				<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"
					class="w-full max-w-[28.75rem]" />
			<?php endif; ?>
		</div>

	</div>
</div>