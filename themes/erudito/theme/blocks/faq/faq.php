<?php
/**
 * FAQ Block
 *
 * @package erudito
 */

$heading   = get_field( 'heading' );
$faq_items = get_field( 'faq_items' );
$button    = get_field( 'button' );

?>

<div class="px-5 lg:px-20 py-12 lg:py-26 bg-gray flex flex-col lg:flex-row lg:gap-[8rem]">
	<div class="max-w-[25.8125rem]">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l mb-4">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
	</div>
	<div class="w-full">
		<div>

			<?php if ( $faq_items ) : ?>
				<?php foreach ( $faq_items as $index => $item ) : ?>
					<div class="w-full border-b border-gray3 last-of-type:border-b-0 py-5 lg:py-7"
						x-data="{ open: <?php echo $index === 0 ? 'true' : 'false'; ?> }">
						<h2 id="heading-<?php echo esc_attr( $index ); ?>">
							<button
								class="text-title-s-mobile lg:text-title-s flex items-center gap-4 lg:gap-6 group cursor-pointer text-left"
								type="button" aria-controls="collapse-<?php echo esc_attr( $index ); ?>" @click="open = !open">
								<div
									class="group-hover:bg-white group-hover:rounded-full p-1 transition-all duration-300 ease-in-out">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg" x-show="open">
										<path d="M19 12L5 12" stroke="black" stroke-width="1.5" stroke-miterlimit="10"
											stroke-linecap="square" />
									</svg>

									<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg" x-show="!open">
										<path d="M19 12L5 12" stroke="black" stroke-width="1.5" stroke-miterlimit="10"
											stroke-linecap="square" />
										<path d="M12 5L12 19" stroke="black" stroke-width="1.5" stroke-miterlimit="10"
											stroke-linecap="square" />
									</svg>
								</div>
								<?php echo esc_html( $item['question'] ); ?>
							</button>
						</h2>
						<div id="collapse-<?php echo esc_attr( $index ); ?>"
							aria-labelledby="heading-<?php echo esc_attr( $index ); ?>" x-show="open">
							<div class="text-body-m-light pl-9 lg:pl-12 pt-3 lg:pt-4">
								<?php echo wp_kses_post( $item['answer'] ); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<?php if ( $button ) : ?>
			<div class="mt-8 lg:mt-12">
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
					<?php echo esc_html( $button['title'] ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>