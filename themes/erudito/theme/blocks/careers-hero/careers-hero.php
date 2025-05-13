<?php
/**
 * Careers hero Block
 *
 * @package erudito
 */

$heading          = get_field( 'heading' );
$description      = get_field( 'description' );
$button           = get_field( 'button' );
$secondary_button = get_field( 'secondary_button' );
$hero_bottom      = get_field( 'hero_bottom' );
$image_left       = get_field( 'image_left' );
$image_right      = get_field( 'image_right' );
$mobile_image     = get_field( 'mobile_image' );
?>

<div class="bg-gray">
	<div class="lg:px-20 pt-12 lg:pt-20 text-black">
		<div class="px-5 lg:px-0 mb-10 lg:mb-16 max-w-[40.5rem] mx-auto">
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-xl text-center mb-4 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p class="max-w-[31.25rem] mx-auto text-body-m-light text-center mb-6 lg:mb-8">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
			<?php if ( $button ) : ?>
				<div class="justify-center flex">
					<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
						<?php echo esc_html( $button['title'] ); ?>
					</a>
				</div>
			<?php endif; ?>
			<?php if ( $secondary_button ) : ?>
				<div class="justify-center flex mt-3">
					<a href="<?php echo esc_url( $secondary_button['url'] ); ?>"
						class="erd_button before:bg-white bg-gray2">
						<?php echo esc_html( $secondary_button['title'] ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( $mobile_image ) : ?>
			<img src="<?php echo esc_url( $mobile_image['url'] ); ?>" alt="<?php echo esc_attr( $mobile_image['alt'] ); ?>"
				class="w-full lg:hidden aspect-[393/300] object-cover" />
		<?php endif; ?>

	</div>
	<div class="px-5 lg:px-20">
		<div class="pt-12 lg:pt-20 lg:border-t border-t-gray3 pb-12 lg:pb-26">
			<div class="flex flex-col lg:flex-row justify-between gap-12">
				<div class="max-w-[25.8125rem] w-full">
					<?php if ( $hero_bottom['heading'] ) : ?>
						<h2 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
							<?php echo esc_html( $hero_bottom['heading'] ); ?>
						</h2>
					<?php endif; ?>
					<?php if ( $hero_bottom['description'] ) : ?>
						<p class="text-body-m-light mb-6 lg:mb-8">
							<?php echo esc_html( $hero_bottom['description'] ); ?>
						</p>
					<?php endif; ?>
					<?php if ( $hero_bottom['button'] ) : ?>
						<div class="">
							<a href="<?php echo esc_url( $hero_bottom['button']['url'] ); ?>" class="erd_button">
								<?php echo esc_html( $hero_bottom['button']['title'] ); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
				<div class="max-w-[39.375rem] flex flex-col justify-center">
					<?php if ( $hero_bottom['info_rows'] ) : ?>
						<div class="flex flex-col">
							<?php foreach ( $hero_bottom['info_rows'] as $row ) : ?>
								<div
									class="flex flex-col gap-2 lg:gap-4 py-6 lg:py-8 first:pt-0 last:pb-0 border-b border-b-gray3 last:border-b-0">
									<?php if ( $row['heading'] ) : ?>
										<h3 class="text-title-m-mobile lg:text-title-s">
											<?php echo esc_html( $row['heading'] ); ?>
										</h3>
									<?php endif; ?>
									<?php if ( $row['description'] ) : ?>
										<p class="text-body-m-light">
											<?php echo esc_html( $row['description'] ); ?>
										</p>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>