<?php
/**
 * Afterschool Hero Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$times       = get_field( 'times' );
$subtitle    = get_field( 'subtitle' );
$price       = get_field( 'price' );
$tooltip     = get_field( 'tooltip' );
?>

<div
	class="px-5 lg:px-20 pt-12 lg:pt-26 pb-10 lg:pb-20 bg-gray flex flex-col gap-8 lg:flex-row w-full items-end justify-between">
	<div class="max-w-[32.625rem]">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="text-body-m-light">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
	</div>
	<div class="max-w-[32.625rem] w-full">
		<div>
			<?php if ( $times ) : ?>
				<div class="flex flex-col pb-4 lg:pb-5">
					<?php foreach ( $times as $time ) : ?>
						<div class="flex items-center gap-3">
							<?php if ( $time['icon'] ) : ?>
								<img src="<?php echo esc_url( $time['icon']['url'] ); ?>"
									alt="<?php echo esc_attr( $time['icon']['alt'] ); ?>" class="aspect-square w-3" />
							<?php endif; ?>
							<div class="flex items-center gap-1.5">
								<p class="text-body-m-light">
									<?php echo esc_html( $time['days'] ); ?>
								</p>
								<?php if ( $time['hours'] ) : ?>
									<p class="text-body-m-light">
										<?php echo esc_html( $time['hours'] ); ?>
									</p>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<div class="flex flex-col gap-2 lg:flex-row lg:gap-12 pt-4 lg:pt-5 border-t border-t-gray3">
				<?php if ( $subtitle ) : ?>
					<p class="text-body-m-light">
						<?php echo esc_html( $subtitle ); ?>
					</p>
				<?php endif; ?>
				<?php if ( $price ) : ?>
					<div class="flex items-center gap-2 w-max">
						<div class="flex items-end gap-1 font-argent w-max">
							<?php echo sprintf( '<span class="text-title-s">Nuo %s</span>', esc_html( $price ) ); ?>
							<span class="text-body-m-light">
								<?php esc_html_e( '€ / mėn.', 'erudito' ); ?>
							</span>
						</div>
						<?php if ( $tooltip ) : ?>
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M11.9984 21.6C17.3004 21.6 21.5984 17.302 21.5984 12C21.5984 6.69809 17.3004 2.40002 11.9984 2.40002C6.6965 2.40002 2.39844 6.69809 2.39844 12C2.39844 17.302 6.6965 21.6 11.9984 21.6Z"
									fill="#E6EAF2" />
								<path
									d="M9.60156 9.48413C9.79909 8.92263 10.189 8.44914 10.7021 8.14755C11.2153 7.84595 11.8187 7.7357 12.4053 7.83633C12.992 7.93696 13.5241 8.24197 13.9075 8.69735C14.2908 9.15272 14.5006 9.72906 14.4997 10.3243C14.4997 12.0046 11.9792 12.8448 11.9792 12.8448"
									stroke="#626B75" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
								<path d="M12.0469 16.2054H12.0553" stroke="#626B75" stroke-width="1.5" stroke-linecap="square"
									stroke-linejoin="round" />
							</svg>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>