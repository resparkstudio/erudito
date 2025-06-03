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

$mask_svg_1 = 'data:image/svg+xml,%3Csvg%20width%3D%22709%22%20height%3D%22642%22%20viewBox%3D%220%200%20709%20642%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20x%3D%22607.627%22%20y%3D%22159.575%22%20width%3D%22399.5%22%20height%3D%22374.899%22%20transform%3D%22rotate(75.3006%20607.627%20159.575)%22%20fill%3D%22white%22%2F%3E%3Ccircle%20cx%3D%22273.052%22%20cy%3D%22273.052%22%20r%3D%22215.465%22%20transform%3D%22rotate(71.3506%20273.052%20273.052)%22%20fill%3D%22white%22%2F%3E%3C%2Fsvg%3E';
$mask_svg_2 = 'data:image/svg+xml,%3Csvg%20width%3D%22458%22%20height%3D%22458%22%20viewBox%3D%220%200%20458%20458%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20x%3D%22360.535%22%20y%3D%22457.14%22%20width%3D%22373.253%22%20height%3D%22373.253%22%20transform%3D%22rotate(-165%20360.535%20457.14)%22%20fill%3D%22white%22%2F%3E%3C%2Fsvg%3E';
?>

<div class="bg-gray">
	<div class=" pt-12 lg:pt-20 text-black">
		<div class="px-5 lg:px-20">

			<div class=" mb-10 lg:mb-16 max-w-[40.5rem] mx-auto">
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
		</div>

		<div class="h-[300vh] flex ">
			<div class="career-svg-mask-1 h-screen w-1/2 top-0 sticky"
				style="mask-image: url('<?php echo $mask_svg_1; ?>'); -webkit-mask-image: url('<?php echo $mask_svg_1; ?>'); mask-size: 100%; -webkit-mask-size: cover; mask-repeat: no-repeat; mask-position: -10em center;">
				<div id="player1" class="scale-[1.15] w-full h-full object-cover fixed inset-0"></div>
			</div>
			<div class="career-svg-mask-2 h-screen w-1/2 top-0 sticky"
				style="mask-image: url('<?php echo $mask_svg_2; ?>'); -webkit-mask-image: url('<?php echo $mask_svg_2; ?>'); mask-size: 80%; -webkit-mask-size: cover; mask-repeat: no-repeat; mask-position: 20em center;">
				<div id="player2" class="scale-[1.15] w-full h-full object-cover fixed inset-0"></div>
			</div>
		</div>
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


<script>
	// 2. This code loads the IFrame Player API code asynchronously.
	var tag = document.createElement('script');

	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	// 3. This function creates an <iframe> (and YouTube player)
	//    after the API code downloads.
	var player;
	function onYouTubeIframeAPIReady() {
		player = new YT.Player('player1', {
			height: '100%',
			width: '100%',
			videoId: 'sijBQH6clLI',
			playerVars: {
				playsinline: 1,
				mute: 1,
				autoplay: 1,
				loop: 1,
			},
			events: {
				'onReady': onPlayerReady,

			}
		});

		player2 = new YT.Player('player2', {
			height: '100%',
			width: '100%',
			videoId: 'sijBQH6clLI',
			playerVars: {
				playsinline: 1,
				mute: 1,
				autoplay: 1,
				loop: 1,
			},
			events: {
				'onReady': onPlayerReady,

			}
		});
	}

	// 4. The API will call this function when the video player is ready.
	function onPlayerReady(event) {
		event.target.playVideo();
	}

	// 5. The API calls this function when the player's state changes.
	//    The function indicates that when playing a video (state=1),
	//    the player should play for six seconds and then stop.
	var done = false;
	function stopVideo() {
		player.stopVideo();
	}
</script>