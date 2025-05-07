<?php
/**
 * Admission Hero Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$button      = get_field( 'button' );

$admission_classes = get_field( 'admission_classes' );
?>

<div class="px-5 lg:px-20 py-12 lg:py-26 bg-gray">
	<div class="text-center mx-auto pb-12 lg:pb-20 border-b border-b-gray3">
		<?php if ( $heading ) : ?>
			<h2 class="text-title-l-mobile lg:text-title-xl mb-4 lg:mb-6">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="text-body-m-light max-w-[31.25rem] mb-6 lg:mb-8 mx-auto">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
		<?php if ( $button ) : ?>
			<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
				<?php echo esc_html( $button['title'] ); ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="flex flex-col lg:flex-row w-full justify-between pt-8 lg:pt-20">
		<?php foreach ( $admission_classes as $admission_class ) : ?>
			<div
				class="flex flex-col first-of-type:pb-8 first-of-type:border-b first-of-type:border-b-gray3 last-of-type:pt-8 first-of-type:lg:pb-0 last-of-type:lg:pt-0 first-of-type:lg:border-b-0 first-of-type:lg:pr-20 last-of-type:lg:pl-20 first-of-type:lg:border-r first-of-type:lg:border-r-gray3">
				<?php if ( $admission_class['icon'] ) : ?>
					<img src="<?php echo esc_url( $admission_class['icon']['url'] ); ?>"
						alt="<?php echo esc_attr( $admission_class['icon']['alt'] ); ?>"
						class="w-16 aspect-square mb-5 lg:mb-8" />
				<?php endif; ?>
				<div>
					<h3 class="text-title-m-mobile lg:text-title-l mb-2 lg:mb-6">
						<?php echo esc_html( $admission_class['title'] ); ?>
					</h3>
				</div>
				<div class="text-body-m-light mb-5 lg:mb-8">
					<?php echo esc_html( $admission_class['description'] ); ?>
				</div>
				<div class="flex flex-col gap-6">
					<?php foreach ( $admission_class['steps'] as $step ) : ?>
						<div class="flex flex-col gap-1">
							<p class="text-title-s font-argent">
								<?php echo esc_html( $step['title'] ); ?>
							</p>
							<p class="text-body-m-light">
								<?php echo esc_html( $step['date'] ); ?>
							</p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>