<?php
/**
 * Text CTA Section Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$button      = get_field( 'button' );
$link        = get_field( 'link' );

$type = get_field( 'type' );

if ( ! $heading && ! $description && ! $button && ! $link ) {
	return;
}

if ( ! $type ) {
	$type = 'left';
}

$image = 'data:image/svg+xml,%3Csvg%20width%3D%221202%22%20height%3D%22600%22%20viewBox%3D%220%200%201202%20600%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20clip-rule%3D%22evenodd%22%20d%3D%22M1200.31%20724.317L1201.54%20256.98L922.63%20256.244L992.946%20185.61L661.744%20-144.102L377.656%20141.269C364.627%2074.8813%20322.364%2014.9171%20257.451%20-18.2658C145.133%20-75.6818%207.53594%20-31.1747%20-49.88%2081.1435C-107.296%20193.462%20-62.789%20331.058%2049.5292%20388.474C83.0136%20405.591%20118.745%20413.65%20153.928%20413.553L130.12%20477.081L482.012%20608.96L556.402%20410.462L663.233%20516.812L733.704%20446.023L732.973%20723.084L1200.31%20724.317Z%22%20fill%3D%22%23191F47%22%2F%3E%3C%2Fsvg%3E'

	?>

<div class="bg-blue py-[6.25rem]  px-5 lg:px-20 text-white <?php echo $type === 'left' ? 'lg:min-h-[37.5rem] lg:py-16' : 'lg:py-[8.625rem]' ?>"
	style="background-image: url(<?php echo $image; ?>); background-repeat: no-repeat; background-size: cover; background-position: center;">
	<div
		class="text-center h-full flex flex-col justify-between <?php echo $type === 'left' ? 'max-w-[46.125rem] lg:min-h-[37.5rem] lg:text-left' : 'items-center max-w-[46.125rem] mx-auto' ?>">
		<div>
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-xl mb-4 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<p class="text-body-m-light <?php echo $type === 'left' ? '' : 'mb-6 lg:mb-12' ?>">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
		</div>
		<div class="flex flex-col lg:flex-row gap-6 items-center">
			<?php if ( $button ) : ?>
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
					<?php echo esc_html( $button['title'] ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $link ) : ?>
				<a href="<?php echo esc_url( $link['url'] ); ?>" class="text-body-m font-semibold">
					<?php echo esc_html( $link['title'] ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>