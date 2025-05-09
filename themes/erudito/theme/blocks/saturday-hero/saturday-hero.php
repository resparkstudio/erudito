<?php
/**
 * Saturday Hero Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$cities      = get_field( 'cities' );
?>

<div class="px-5 lg:px-20 py-12 lg:py-26">
	<div class=" pb-12 lg:pb-20 border-b border-b-gray3 ">
		<div class="max-w-[40.5rem] text-center mx-auto">
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-xl text-center mb-4 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p class="text-body-m-light text-center mb-6 lg:mb-8">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
		</div>
	</div>
	<div class="flex flex-col lg:flex-row w-full justify-between pt-8 lg:pt-20">
		<?php foreach ( $cities as $city ) : ?>
			<div
				class="flex flex-col first-of-type:pb-8 first-of-type:border-b first-of-type:border-b-gray3 last-of-type:pt-8 first-of-type:lg:pb-0 last-of-type:lg:pt-0 first-of-type:lg:border-b-0 first-of-type:lg:pr-20 last-of-type:lg:pl-20 first-of-type:lg:border-r first-of-type:lg:border-r-gray3">
				<?php if ( $city['name'] ) : ?>
					<h3 class="text-title-m-mobile lg:text-title-l mb-2 lg:mb-4">
						<?php echo esc_html( $city['name'] ); ?>
					</h3>
				<?php endif; ?>
				<?php if ( $city['ages'] ) : ?>
					<span class="text-title-s-mobile lg:text-title-s font-argent mb-4 lg:mb-6">
						<?php echo esc_html( $city['ages'] ); ?>
					</span>
				<?php endif; ?>
				<?php if ( $city['description'] ) : ?>
					<div class="text-body-m-light mb-6 lg:mb-8">
						<?php echo esc_html( $city['description'] ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $city['button'] ) : ?>
					<div class="mb-8 lg:mb-12">
						<a href="<?php echo esc_url( $city['button']['url'] ); ?>" class="erd_button">
							<?php echo esc_html( $city['button']['title'] ); ?>
						</a>
					</div>
				<?php endif; ?>
				<?php if ( $city['image'] ) : ?>
					<img src="<?php echo esc_url( $city['image']['url'] ); ?>"
						alt="<?php echo esc_attr( $city['image']['alt'] ); ?>"
						class="w-full aspect-[353/235] lg:aspect-[560/372]" />
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>