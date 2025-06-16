<?php
/**
 * Team Simple Block
 *
 * @package erudito
 */


$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$button      = get_field( 'button' );
$gallery     = get_field( 'gallery' );

$gallery_left  = array_slice( $gallery, 0, ceil( count( $gallery ) / 2 ) );
$gallery_right = array_slice( $gallery, ceil( count( $gallery ) / 2 ) );
?>

<div class="px-5 lg:px-20 py-12 lg:py-26">
	<div class="text-center max-w-[36.125rem] mx-auto mb-12 lg:mb-20">
		<?php erd_section_text( $heading, $description ); ?>
		<?php if ( $button ) : ?>
			<div class="text-center mt-6 lg:mt-8">
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="erd_button">
					<?php echo esc_html( $button['title'] ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
	<div>
		<div class="hidden lg:grid grid-cols-5 gap-12">
			<?php foreach ( $gallery as $image ) : ?>

				<img src='<?php echo esc_url( $image['url'] ) ?>' alt='<?php echo esc_attr( $image['alt'] ) ?>'
					class=' w-full'>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="lg:hidden">
		<div
			class="mb-2 relative flex overflow-hidden space-x-3 items-center after:content-[''] after:absolute after:top-0 after:right-0 after:bottom-0 before:z-10 after:block after:bg-gradientRight  before:content-[''] before:absolute before:top-0 before:left-0  before:bottom-0 before:block before:bg-gradientLeft before:w-14 after:w-14">
			<div class='flex space-x-3 items-center animate-loop-scroll'>
				<?php foreach ( $gallery_left as $image ) : ?>
					<img src='<?php echo esc_url( $image['url'] ) ?>' alt='<?php echo esc_attr( $image['alt'] ) ?>'
						class='max-w-none object-contain gs h-[6.75rem]'>
				<?php endforeach; ?>
			</div>
			<div class='flex space-x-3 items-center animate-loop-scroll>' aria-hidden='true'>
				<?php foreach ( $gallery_left as $image ) : ?>
					<img src='<?php echo esc_url( $image['url'] ) ?>' alt='<?php echo esc_attr( $image['alt'] ) ?>'
						class='max-w-none object-contain gs h-[6.75rem]'>
				<?php endforeach; ?>
			</div>
		</div>
		<div
			class="relative flex overflow-hidden space-x-3 items-center after:content-[''] after:absolute after:top-0 after:right-0 after:bottom-0 before:z-10 after:block after:bg-gradientRight  before:content-[''] before:absolute before:top-0 before:left-0  before:bottom-0 before:block before:bg-gradientLeft before:w-14 after:w-14">
			<div class='flex space-x-3 items-center animate-loop-scroll2'>
				<?php foreach ( $gallery_right as $image ) : ?>
					<img src='<?php echo esc_url( $image['url'] ) ?>' alt='<?php echo esc_attr( $image['alt'] ) ?>'
						class='max-w-none object-contain gs h-[6.75rem]'>
				<?php endforeach; ?>
			</div>
			<div class='flex space-x-3 items-center animate-loop-scroll2' aria-hidden='true'>
				<?php foreach ( $gallery_right as $image ) : ?>
					<img src='<?php echo esc_url( $image['url'] ) ?>' alt='<?php echo esc_attr( $image['alt'] ) ?>'
						class='max-w-none object-contain gs h-[6.75rem]'>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

</div>