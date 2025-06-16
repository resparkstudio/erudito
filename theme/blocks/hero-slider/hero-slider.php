<?php
$heading       = get_field( 'heading' );
$description   = get_field( 'description' );
$link          = get_field( 'link' );
$bottom_images = get_field( 'bottom_images' );
$slides        = get_field( 'slides' );
?>
<div class="w-full text-white pt-[4.875rem]">
	<div>
		<div class="swiper hero-slider !static" style="position: static;">
			<div class="swiper-wrapper !static" style="position: static;">
				<?php foreach ( $slides as $slide ) : ?>
					<div class="swiper-slide !static px-5 lg:px-20 " style="position: static; ">

						<div class=" max-w-[46.125rem] text-center lg:text-left z-10">
							<?php if ( $slide['heading'] ) : ?>
								<h1 class="text-title-l-mobile lg:text-title-xl mb-6">
									<?php echo esc_html( $slide['heading'] ); ?>
								</h1>
							<?php endif; ?>
							<?php if ( $slide['description'] ) : ?>
								<p class="text-body-m-light mb-6 lg:mb-10 max-w-[25.8125rem]">
									<?php echo esc_html( $slide['description'] ); ?>
								</p>
							<?php endif; ?>
							<?php if ( $slide['button'] ) : ?>
								<a href="<?php echo esc_url( $slide['button']['url'] ); ?>" class="erd_button">
									<?php echo esc_html( $slide['button']['title'] ); ?>
								</a>
							<?php endif; ?>
							<?php if ( $bottom_images ) : ?>
								<div
									class="hidden lg:flex justify-center lg:justify-start gap-10 mt-10 lg:mt-28 border-y border-[#FFFFFF26] py-6 lg:py-0 lg:border-0">
									<?php foreach ( $bottom_images as $image ) : ?>
										<img src="<?php echo esc_url( $image['url'] ); ?>"
											alt="<?php echo esc_attr( $image['alt'] ); ?>"
											class="w-auto max-h-[2.75rem] object-contain" />
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
						<?php if ( $slide['image'] ) : ?>
							<div class="pt-12 lg:py-26">
								<img src="<?php echo esc_url( $slide['image']['url'] ); ?>"
									alt="<?php echo esc_attr( $slide['image']['alt'] ); ?>"
									class="w-full lg:absolute top-0 right-0 max-w-[50.9375rem]" />
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="px-5 lg:px-20 lg:hidden">
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
</div>