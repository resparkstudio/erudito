<?php

$top_image        = get_field( 'top_image' );
$heading          = get_field( 'heading' );
$description      = get_field( 'description' );
$button           = get_field( 'button' );
$link             = get_field( 'link' );
$image            = get_field( 'image' );
$background_color = get_field( 'background_color' );
$text_centered    = get_field( 'text_centered' );

$type = get_field( 'type' );

if ( ! function_exists( 'cta_image_left' ) ) {
	function cta_image_left( $top_image, $heading, $description, $button, $link, $image, $background_color, $text_centered ) {
		?>
		<div class="w-full py-12 lg:py-26 px-5 lg:px-20"
			style="background-color: <?php echo esc_attr( $background_color ); ?>;">
			<div class="flex flex-col-reverse lg:items-center lg:justify-center lg:flex-row gap-6 lg:gap-35 w-full">
				<?php if ( $image ) : ?>
					<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"
						class="w-full max-w-[28.75rem]" />
				<?php endif; ?>
				<div class="max-w-[31.375rem]"
					style="text-align: <?php echo esc_attr( $text_centered ? 'center' : 'left' ); ?>;">
					<?php if ( $top_image ) : ?>
						<img src="<?php echo esc_url( $top_image['url'] ); ?>" alt="<?php echo esc_attr( $top_image['alt'] ); ?>"
							class="w-auto h-[4rem] mb-6 lg:mb-10 mx-auto" />
					<?php endif; ?>
					<?php if ( $heading ) : ?>
						<h1 class="text-title-l-mobile lg:text-title-l mb-4"><?php echo esc_html( $heading ); ?></h1>
					<?php endif; ?>
					<?php if ( $description ) : ?>
						<p class="text-body-m-light mb-6 lg:mb-8"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
					<div class="flex items-center justify-center">
						<?php if ( $button ) : ?>
							<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
								<?php echo esc_html( $button['title'] ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'cta_image_right' ) ) {
	function cta_image_right( $top_image, $heading, $description, $button, $link, $image, $background_color, $text_centered ) {
		?>
		<div class="w-full py-12 lg:py-26 px-5 lg:px-20"
			style="background-color: <?php echo esc_attr( $background_color ); ?>;">
			<div class="flex flex-col lg:items-center lg:justify-center lg:flex-row gap-6 lg:gap-42 w-full">
				<div class="max-w-[26.75rem]"
					style="text-align: <?php echo esc_attr( $text_centered ? 'center' : 'left' ); ?>;">
					<?php if ( $top_image ) : ?>
						<img src="<?php echo esc_url( $top_image['url'] ); ?>" alt="<?php echo esc_attr( $top_image['alt'] ); ?>"
							class="w-auto h-[2.25rem] mb-6 lg:mb-12" />
					<?php endif; ?>
					<?php if ( $heading ) : ?>
						<h1 class="text-title-m-mobile lg:text-title-l mb-4"><?php echo esc_html( $heading ); ?></h1>
					<?php endif; ?>
					<?php if ( $description ) : ?>
						<p class="text-body-m-light mb-6 lg:mb-8"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
					<div class="flex gap-6 items-center">
						<?php if ( $button ) : ?>
							<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
								<?php echo esc_html( $button['title'] ); ?>
							</a>
						<?php endif; ?>
						<?php if ( $link ) : ?>
							<a href="<?php echo esc_url( $link['url'] ); ?>" class="cta-section__link">
								<?php echo esc_html( $link['title'] ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>

				<?php if ( $image ) : ?>
					<div class="max-w-[32rem] w-full">
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"
							class="w-full" />
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'get_cta_section' ) ) {
	function get_cta_section( $type, $top_image, $heading, $description, $button, $link, $image, $background_color, $text_centered ) {
		if ( 'image_left' === $type ) {
			cta_image_left( $top_image, $heading, $description, $button, $link, $image, $background_color, $text_centered );
		} elseif ( 'image_right' === $type ) {
			cta_image_right( $top_image, $heading, $description, $button, $link, $image, $background_color, $text_centered );
		}
	}
}

if ( $type ) {
	get_cta_section( $type, $top_image, $heading, $description, $button, $link, $image, $background_color, $text_centered );
} else {
	cta_image_left( $top_image, $heading, $description, $button, $link, $image, $background_color, $text_centered );
}
?>