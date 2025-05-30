<?php
/**
 * About Hero Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );

$image = get_field( 'image' );

$mask_svg     = 'data:image/svg+xml,%3Csvg%20width%3D%22950%22%20height%3D%22666%22%20viewBox%3D%220%200%20950%20666%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20x%3D%22346.457%22%20y%3D%22648.732%22%20width%3D%22412.17%22%20height%3D%22412.17%22%20transform%3D%22rotate(-147.2%20346.457%20648.732)%22%20fill%3D%22white%22%2F%3E%3Crect%20x%3D%22242%22%20y%3D%22338.086%22%20width%3D%22357.46%22%20height%3D%22357.46%22%20transform%3D%22rotate(-71.05%20242%20338.086)%22%20fill%3D%22white%22%2F%3E%3Ccircle%20cx%3D%22685.89%22%20cy%3D%22401.89%22%20r%3D%22215.465%22%20transform%3D%22rotate(-75%20685.89%20401.89)%22%20fill%3D%22white%22%2F%3E%3C%2Fsvg%3E';
$bottom_image = 'data:image/svg+xml,%3Csvg%20width%3D%221440%22%20height%3D%22817%22%20viewBox%3D%220%200%201440%20817%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20width%3D%22417.341%22%20height%3D%22417.341%22%20transform%3D%22matrix(0.226223%20-0.974076%20-0.974076%20-0.226223%201577.83%20501.141)%22%20fill%3D%22%23191F47%22%2F%3E%3Crect%20width%3D%22417.341%22%20height%3D%22417.341%22%20transform%3D%22matrix(0.708698%20-0.705512%20-0.705512%20-0.708698%201148.95%20816.966)%22%20fill%3D%22%23191F47%22%2F%3E%3Crect%20x%3D%22227.613%22%20y%3D%22410.488%22%20width%3D%22375.792%22%20height%3D%22375.792%22%20transform%3D%22rotate(158.435%20227.613%20410.488)%22%20fill%3D%22%23191F47%22%2F%3E%3Ccircle%20cx%3D%22336.333%22%20cy%3D%22438.333%22%20r%3D%22228.402%22%20transform%3D%22rotate(117.076%20336.333%20438.333)%22%20fill%3D%22%23191F47%22%2F%3E%3C%2Fsvg%3E';

?>

<div style="background-image: url('<?php echo $bottom_image; ?>'); background-repeat: no-repeat; background-position: bottom right; background-size: 100% 100%;"
	class="px-5 lg:px-20 py-12 lg:py-26 min-h-[75rem] bg-blue text-white ">
	<div class="flex flex-col items-center gap-6 lg:gap-20 w-full relative h-[300vh]">
		<div>
			<?php erd_hero_text( $heading, $description, '40.5rem', '31.3125rem' ); ?>
		</div>
		<!-- SVG is now used as a mask for the image below -->
		<?php if ( $image ) : ?>
			<div class="svg-mask h-screen w-full sticky top-0"
				style="mask-image: url('<?php echo $mask_svg; ?>'); -webkit-mask-image:
						url('<?php echo $mask_svg; ?>'); mask-size: 30%; -webkit-mask-size: cover; mask-repeat: no-repeat; mask-position:center top;">
				<div id="player" class="w-full h-full object-cover"></div>
			</div>
		<?php endif; ?>
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
		player = new YT.Player('player', {
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