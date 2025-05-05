<?php
$heading       = get_field( 'heading' );
$description   = get_field( 'description' );
$link          = get_field( 'link' );
$bottom_images = get_field( 'bottom_images' );
?>
<div class="w-full text-white pt-[4.875rem] pb-40 px-5 lg:px-20">
	<div>
		<div class="hero-slider">
			<div class="max-w-[46.125rem] text-center lg:text-left">
				<?php if ( $heading ) : ?>
					<h1 class="text-title-l-mobile lg:text-title-xl mb-6"><?php echo esc_html( $heading ); ?></h1>
				<?php endif; ?>
				<?php if ( $description ) : ?>
					<p class="text-body-m-light mb-10"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
				<?php if ( $link ) : ?>
					<a href="<?php echo esc_url( $link['url'] ); ?>" class="erd_button">
						<?php echo esc_html( $link['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
			<?php if ( $bottom_images ) : ?>
				<div
					class="flex justify-center lg:justify-start gap-10 mt-10 lg:mt-28 border-y border-[#FFFFFF26] py-6 lg:py-0 lg:border-0">
					<?php foreach ( $bottom_images as $image ) : ?>
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"
							class="w-auto max-h-[2.75rem] object-contain" />
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>