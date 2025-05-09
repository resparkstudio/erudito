<?php
/**
 * Team Hero Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$image_left  = get_field( 'image_left' );
$image_right = get_field( 'image_right' );

$text       = get_field( 'text' );
$statistics = get_field( 'statistics' );
?>

<div class="py-12 lg:pt-20 lg:pb-26">
	<div class="relative">
		<?php if ( $image_left ) : ?>
			<img src="<?php echo esc_url( $image_left['url'] ); ?>" alt="<?php echo esc_attr( $image_left['alt'] ); ?>"
				class="absolute top-[2.125rem] left-0 w-full h-auto max-w-[18.75rem] hidden lg:block" />
		<?php endif; ?>
		<?php if ( $image_right ) : ?>
			<img src="<?php echo esc_url( $image_right['url'] ); ?>" alt="<?php echo esc_attr( $image_right['alt'] ); ?>"
				class="absolute bottom-0 right-0 w-full h-auto max-w-[21.875rem] hidden lg:block" />
		<?php endif; ?>
		<div class="px-5 lg:px-20 lg:pb-[12.8125rem]">
			<?php erd_hero_text( $heading, $description, '40.5rem' ); ?>
		</div>
		<?php if ( $image_left ) : ?>
			<img src="<?php echo esc_url( $image_left['url'] ); ?>" alt="<?php echo esc_attr( $image_left['alt'] ); ?>"
				class="w-full lg:hidden" />
		<?php endif; ?>
	</div>
	<div class="px-5 lg:px-20 pt-12 lg:pt-16">
		<div class="lg:border-t border-t-white/15 lg:pt-26">
			<?php if ( $text ) : ?>
				<h3
					class="text-title-m-mobile lg:text-[2.5rem] lg:leading-[3rem] max-w-[52.875rem] mx-auto lg:text-center mb-8 lg:mb-20">
					<?php echo esc_html( $text ); ?>
				</h3>
			<?php endif; ?>
		</div>
		<div class="grid grid-cols-2 gap-y-8 lg:grid-cols-4 mx-auto">
			<?php if ( $statistics ) : ?>
				<?php foreach ( $statistics as $statistic ) : ?>
					<div
						class="flex flex-col justify-between gap-4 lg:gap-0 lg:min-h-[13.25rem] lg:border-x border-x-white/15 first:border-l-0 last:border-r-0 lg:px-12 first:pl-0 last:pr-0">
						<span class=" text-caption lg:text-body-m-light">
							<?php echo esc_html( $statistic['title'] ); ?>
						</span>
						<span class="font-argent text-title-l lg:text-[5.5rem] lg:leading-[5.5rem]">
							<?php echo esc_html( $statistic['number'] ); ?>
						</span>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>