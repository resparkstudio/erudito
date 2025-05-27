<?php
/**
 * Simple CTA Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );

$gallery = get_field( 'gallery' );

?>
<div class="bg-blue px-5 lg:px-20 pt-12 pb-[3.75rem] lg:pt-26 lg:pb-[11.5rem] text-white">
	<div class="text-center mb-8 lg:mb-20">
		<?php if ( $heading ) : ?>
			<h2 class="max-w-[40.5rem] mx-auto text-title-l-mobile lg:text-title-xl mb-4 lg:mb-6">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="max-w-[31.25rem] mx-auto text-body-m-light">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
	</div>
	<div
		class="gallery-shapes grid grid-cols-3 grid-rows-3 lg:grid-cols-5 lg:grid-rows-2 gap-[0.625rem] lg:gap-6 max-h-[22.0625rem] lg:max-h-[33.125rem]">
		<div class="div1 bg-violet aspect-square">
		</div>
		<div class="div2 rounded-full">
			<?php if ( ! empty( $gallery[0] ) ) : ?>
				<img src="<?php echo esc_url( $gallery[0]['url'] ); ?>" alt="<?php echo esc_attr( $gallery[0]['alt'] ); ?>"
					class="rounded-full" />
			<?php endif; ?>
		</div>
		<div class="div3">
			<?php if ( ! empty( $gallery[1] ) ) : ?>
				<img src="<?php echo esc_url( $gallery[1]['url'] ); ?>"
					alt="<?php echo esc_attr( $gallery[1]['alt'] ); ?>" />
			<?php endif; ?>
		</div>
		<div class="div4 rounded-full">
			<?php if ( ! empty( $gallery[2] ) ) : ?>
				<img src="<?php echo esc_url( $gallery[2]['url'] ); ?>" alt="<?php echo esc_attr( $gallery[2]['alt'] ); ?>"
					class="rounded-full" />
			<?php endif; ?>
		</div>
		<div class="div5">
			<?php if ( ! empty( $gallery[3] ) ) : ?>
				<img src="<?php echo esc_url( $gallery[3]['url'] ); ?>"
					alt="<?php echo esc_attr( $gallery[3]['alt'] ); ?>" />
			<?php endif; ?>
		</div>
		<div class="div6">
			<?php if ( ! empty( $gallery[4] ) ) : ?>
				<img src="<?php echo esc_url( $gallery[4]['url'] ); ?>"
					alt="<?php echo esc_attr( $gallery[4]['alt'] ); ?>" />
			<?php endif; ?>
		</div>
		<div class="div7 bg-yellow rounded-full"></div>
		<div class="div8">
			<?php if ( ! empty( $gallery[5] ) ) : ?>
				<img src="<?php echo esc_url( $gallery[5]['url'] ); ?>"
					alt="<?php echo esc_attr( $gallery[5]['alt'] ); ?>" />
			<?php endif; ?>
		</div>
	</div>
</div>