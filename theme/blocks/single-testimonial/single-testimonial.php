<?php
/**
 * Single Testimonial Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$text        = get_field( 'text' );
$person      = get_field( 'person' );

$type = get_field( 'type' );

if ( ! $type ) {
	$type = 'dark';
}

?>

<div
	class="px-5 lg:px-20 py-12 lg:pt-[8.75rem] lg:pb-[9.5rem] flex flex-col gap-8 lg:flex-row relative <?php echo $type === 'dark' ? 'bg-blue text-white' : 'bg-gray text-black'; ?>">
	<?php if ( $heading || $description ) : ?>
		<div class="max-w-[25.8125rem] w-full">
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-l mb-2 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p class="text-body-m-light">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div
		class="ml-auto relative z-10 <?php echo $heading || $description ? 'max-w-[42.9375rem]' : 'max-w-[52.9375rem]' ?>">
		<?php if ( $text ) : ?>
			<div class="mb-8 lg:mb-20 font-argent text-title-m-mobile lg:text-title-m"><?php echo $text; ?></div>
		<?php endif; ?>
		<?php if ( $person ) : ?>
			<div class="flex items-center gap-6 lg:gap-8">
				<?php if ( ! empty( $person['image'] ) ) : ?>
					<img src="<?php echo esc_url( $person['image']['url'] ); ?>"
						alt="<?php echo esc_attr( $person['image']['alt'] ); ?>"
						class="shrink-0 object-cover w-16 h-16 lg:w-20 lg:h-20 rounded-full" />
				<?php endif; ?>
				<div class="flex flex-col">
					<span class="font-semibold"><?php echo esc_html( $person['name'] ); ?></span>
					<?php if ( ! empty( $person['position'] ) ) : ?>
						<span class="text-body-m-light">
							<?php echo esc_html( $person['position'] ); ?></span>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php if ( $type === 'dark' ) : ?>
		<div class="absolute top-0 left-[30%]">
			<svg width="212" height="161" viewBox="0 0 212 161" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M162.444 157.167C160.181 159.431 157.917 160.562 155.654 160.562C153.391 160.562 151.41 159.431 149.713 157.167L142.923 148.68C151.41 140.192 158.483 129.724 164.142 117.276C169.234 105.394 171.78 93.7939 171.78 82.4772C171.78 78.5163 171.215 75.6872 170.083 73.9896C164.425 75.1213 159.898 75.6872 156.503 75.6872C145.186 75.6872 135.567 71.4434 127.645 62.9558C119.158 55.0341 114.914 45.132 114.914 33.2495C114.914 19.1036 119.158 7.78686 127.645 -0.700691C136.133 -9.18822 147.167 -13.432 160.747 -13.432C176.59 -13.432 189.038 -7.49066 198.092 4.39189C207.145 16.8403 211.672 31.8349 211.672 49.3758C211.672 69.1801 207.145 88.7014 198.092 107.94C189.038 127.744 177.156 144.153 162.444 157.167ZM47.9035 157.167C45.6402 159.431 43.3768 160.562 41.1135 160.562C38.8501 160.562 36.8697 159.431 35.1722 157.167L28.3822 148.68C36.8697 140.192 43.9427 129.724 49.601 117.276C54.6935 105.394 57.2398 93.7939 57.2398 82.4772C57.2398 78.5163 56.674 75.6871 55.5423 73.9896C49.8839 75.1213 45.3573 75.6872 41.9622 75.6872C30.6455 75.6872 21.0263 71.4434 13.1046 62.9558C4.61707 55.0341 0.373301 45.132 0.373302 33.2495C0.373303 19.1036 4.61708 7.78685 13.1046 -0.700701C21.5922 -9.18823 32.626 -13.432 46.206 -13.432C62.0494 -13.432 74.4978 -7.49067 83.5512 4.39188C92.6046 16.8403 97.1312 31.8349 97.1312 49.3758C97.1312 69.18 92.6045 88.7014 83.5512 107.94C74.4978 127.744 62.6152 144.153 47.9035 157.167Z"
					fill="#191F47" />
			</svg>
		</div>
		<div class="absolute bottom-0 left-0">
			<svg width="1115" height="628" viewBox="0 0 1115 628" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd"
					d="M1115 529.892L902.669 111.802L653.154 238.523L683.715 143.309L237.232 -3.83686e-05L156.947 250.129C114.034 213.2 58.1907 190.878 -2.86573 190.878C-138.25 190.878 -248.001 300.629 -248.001 436.013C-248.001 571.398 -138.25 681.148 -2.86575 681.148C7.50473 681.148 17.7248 680.504 27.7567 679.254L39.0236 777.666L443.065 731.408L422.52 551.954L540.406 589.793L571.035 494.368L696.914 742.226L1115 529.892Z"
					fill="#191F47" />
			</svg>
		</div>
	<?php else : ?>
		<div class="absolute bottom-0 right-0">

			<svg width="278" height="217" viewBox="0 0 278 217" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path
					d="M83.6041 51.0153C86.3643 48.2551 89.1245 46.875 91.8846 46.875C94.6448 46.875 97.06 48.2551 99.1301 51.0153L107.411 61.3659C97.0599 71.7166 88.4344 84.4824 81.534 99.6633C75.3236 114.154 72.2184 128.3 72.2184 142.101C72.2184 146.931 72.9084 150.382 74.2885 152.452C81.1889 151.072 86.7093 150.381 90.8496 150.381C104.65 150.381 116.381 155.557 126.042 165.908C136.392 175.568 141.568 187.644 141.568 202.135C141.568 219.386 136.392 233.187 126.042 243.537C115.691 253.888 102.235 259.063 85.6742 259.063C66.353 259.063 51.172 251.818 40.1313 237.327C29.0906 222.146 23.5703 203.86 23.5703 182.469C23.5703 158.317 29.0907 134.51 40.1314 111.049C51.172 86.8975 65.663 66.8863 83.6041 51.0153ZM223.288 51.0153C226.048 48.2551 228.808 46.875 231.568 46.875C234.329 46.875 236.744 48.2551 238.814 51.0153L247.094 61.3659C236.744 71.7166 228.118 84.4824 221.218 99.6634C215.007 114.154 211.902 128.3 211.902 142.101C211.902 146.931 212.592 150.382 213.972 152.452C220.873 151.072 226.393 150.381 230.533 150.381C244.334 150.381 256.065 155.557 265.725 165.908C276.076 175.568 281.251 187.644 281.251 202.135C281.251 219.386 276.076 233.187 265.725 243.537C255.375 253.888 241.919 259.063 225.358 259.063C206.037 259.063 190.856 251.818 179.815 237.327C168.774 222.146 163.254 203.86 163.254 182.469C163.254 158.317 168.774 134.511 179.815 111.049C190.856 86.8975 205.347 66.8863 223.288 51.0153Z"
					fill="white" />
			</svg>

		</div>
	<?php endif; ?>

</div>