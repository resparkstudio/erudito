<?php
/**
 * Content Section Block
 *
 * @package erudito
 */

$heading              = get_field( 'heading' );
$description          = get_field( 'description' );
$background_color     = get_field( 'background_color' );
$items                = get_field( 'items' );
$type                 = get_field( 'type' );
$column_count         = get_field( 'column_count' );
$bordered             = get_field( 'bordered' );
$has_shape_background = get_field( 'has_shape_background' );

$background_image = 'data:image/svg+xml,%3Csvg%20width%3D%221009%22%20height%3D%22229%22%20viewBox%3D%220%200%201009%20229%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20clip-rule%3D%22evenodd%22%20d%3D%22M872.104%20-311.921C915.784%20-374.611%20985.832%20-418.287%201067.88%20-425.718C1215.28%20-439.068%201345.59%20-330.404%201358.94%20-183.01C1372.29%20-35.6154%201263.62%2094.6934%201116.23%20108.043C1028.12%20116.024%20946.11%2080.4016%20891.546%2018.9686L828.287%20177.535L530.08%2058.5667L202.021%20228.405L0.590489%20-160.678L389.673%20-362.108L472.676%20-201.779L565.426%20-434.268L872.104%20-311.921Z%22%20fill%3D%22%23F3F5F9%22%2F%3E%3C%2Fsvg%3E';

if ( $column_count < count( $items ) ) {
	?>
	<style>
		.erd_content_section:nth-child(<?php echo esc_html( $column_count ); ?>n+<?php echo esc_html( $column_count + 1 ); ?>) {
			padding-left: 0;
		}

		.erd_content_section:nth-child(<?php echo esc_html( $column_count ); ?>n) {
			border-right: none;
		}
	</style>
	<?php
}

if ( ! function_exists( 'numbers_item' ) ) {
	function numbers_item( $index, $title, $description, $has_form_button, $modal ) {
		?>
		<div
			class="border-t border-t-gray3 first-of-type:border-t-0 py-8 lg:py-0 first-of-type:pt-0 last-of-type:pb-0 lg:border-t-0 lg:border-r lg:border-r-gray3 lg:last-of-type:border-r-0 lg:px-10 lg:first-of-type:pl-0 lg:last-of-type:pr-0 erd_content_section">
			<?php if ( $index ) : ?>
				<div class="text-title-l lg:text-title-xl mb-5 lg:mb-10 flex font-argent text-gray3">
					0<?php echo esc_html( $index ); ?>
				</div>
			<?php endif; ?>
			<p class="text-body-m-light lg:text-subtitle-mobile mb-1 lg:mb-2">
				<?php echo esc_html( $title ); ?>
			</p>
			<p><?php echo esc_html( $description ); ?></p>
			<?php if ( $has_form_button ) : ?>
				<div class="mt-6 lg:mt-8">
					<?php erd_register_button( __( 'Pildyti formą', 'erd' ) ) ?>
				</div>
			<?php endif; ?>
			<?php if ( $modal['has_modal'] ) : ?>
				<div class="mt-5 lg:mt-7" x-data="{ modalOpen: false }">
					<button class="font-semibold cursor-pointer erd_ghost" @click="modalOpen = !modalOpen">
						<?php echo esc_html( $modal['modal_content']['button_text'] ) ?>
					</button>
					<?php erd_modal( esc_html( $modal['modal_content']['heading'] ), esc_html( $modal['modal_content']['content'] ) ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'icons_item' ) ) {
	function icons_item( $icon, $title, $description, $has_form_button, $modal ) {
		?>
		<div
			class="border-t border-t-gray3 first-of-type:border-t-0 py-8 lg:py-0 first-of-type:pt-0 last-of-type:pb-0 lg:border-t-0">
			<?php if ( $icon ) : ?>
				<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>"
					class="aspect-square w-[4.5rem] lg:w-[5.5rem] mb-4 lg:mb-8" />
			<?php endif; ?>
			<h3 class="text-title-m-mobile lg:text-title-m mb-2 lg:mb-4">
				<?php echo esc_html( $title ); ?>
			</h3>
			<p><?php echo esc_html( $description ); ?></p>
			<?php if ( $has_form_button ) : ?>
				<div class="mt-6 lg:mt-8">
					<?php erd_register_button( __( 'Pildyti formą', 'erd' ) ) ?>
				</div>
			<?php endif; ?>
			<?php if ( $modal['has_modal'] ) : ?>
				<div class="mt-5 lg:mt-7 ">
					<button class="font-semibold cursor-pointer erd_ghost">
						<?php echo esc_html( $modal['modal_content']['button_text'] ) ?>
					</button>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}

?>

<div class="px-5 lg:px-20 py-12 lg:py-26"
	style="background-color: <?php echo esc_attr( $background_color ); ?>;background-image: url(<?php echo $has_shape_background ? $background_image : ''; ?>); background-repeat: no-repeat; background-size: 80%; background-position: top right;">
	<div class="">
		<div class="mb-8 lg:mb-20">

			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-l lg:max-w-[24.0625rem]">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p class="text-body-m-light mt-4 lg:mt-6 lg:max-w-[35.5rem]">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( $items ) : ?>
			<div
				class="grid grid-cols-1 lg:grid-cols-<?php echo esc_attr( $column_count ); ?> <?php echo 'icons' === $type ? 'lg:gap-16' : 'lg:gap-y-16' ?>">
				<?php foreach ( $items as $index => $item ) : ?>
					<?php if ( 'numbers' === $type ) : ?>
						<?php numbers_item( index: $index + 1, title: $item['title'], description: $item['description'], has_form_button: $item['has_form_button'], modal: $item['modal'] ); ?>
					<?php elseif ( 'icons' === $type ) : ?>
						<?php icons_item( $item['icon'], $item['title'], $item['description'], $item['has_form_button'], $item['modal'] ); ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>