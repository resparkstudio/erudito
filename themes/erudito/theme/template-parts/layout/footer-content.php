<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package erudito
 */

// $footer_content = get_field( 'footer', 'option' );
$logo        = get_field( 'logo', 'option' );
$images      = get_field( 'images', 'option' );
$description = get_field( 'description', 'option' );
$socials     = get_field( 'socials', 'option' );
$cities      = get_field( 'cities', 'option' );
?>

<footer id="colophon" class="">
	<div class="lg:px-20 pt-12 lg:py-10 border-t border-t-gray3">
		<div
			class="px-5 lg:px-0 flex flex-col gap-8 lg:gap-0 lg:flex-row w-full lg:justify-between lg:items-center border-b border-b-gray3 pb-10">
			<?php if ( $logo ) : ?>
				<img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>"
					class="w-max h-[3.75rem] lg:h-20 shrink-0" />
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<div class="max-w-[25.8125rem] lg:hidden">
					<?php echo esc_html( $description ); ?>
				</div>
			<?php endif; ?>
			<div>
				<?php if ( $images ) : ?>
					<div class="flex items-center gap-10 flex-wrap">
						<?php foreach ( $images as $image ) : ?>
							<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"
								class="w-auto h-[2.6875rem] lg:h-[3.125rem] shrink-0" />
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="px-5 lg:px-0 pt-10">
			<?php if ( $description ) : ?>
				<div class="max-w-[25.8125rem] hidden lg:block">
					<?php echo esc_html( $description ); ?>
				</div>
			<?php endif; ?>
			<?php if ( $socials ) : ?>
				<div>
					<?php if ( $socials['heading'] ) : ?>
						<h3 class="text-title-s-mobile mb-4 hidden lg:block">
							<?php echo esc_html( $socials['heading'] ); ?>
						</h3>
					<?php endif; ?>
					<div class="flex items-center gap-5">
						<?php foreach ( $socials['items'] as $social ) : ?>
							<a href="<?php echo esc_url( $social['link']['url'] ); ?>" target="_blank" rel="noopener noreferrer"
								class="bg-gray rounded-full p-3">
								<img src="<?php echo esc_url( $social['icon']['url'] ); ?>"
									alt="<?php echo esc_attr( $social['icon']['alt'] ); ?>" class="w-auto h-5" />
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( $cities ) : ?>
			<div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-1 pt-10">
				<?php foreach ( $cities as $city ) : ?>
					<div
						class="bg-gray px-5 py-6 lg:p-10 flex justify-between border-b border-b-gray3 last-of-type:border-b-0 lg:border-b-0">
						<div class="flex flex-col gap-6 lg:gap-0 lg:flex-row w-full">
							<div class="flex lg:flex-col justify-between w-full">
								<h3 class="text-title-m-mobile lg:text-title-m">
									<?php echo esc_html( $city['name'] ); ?>
								</h3>
								<div class="flex items-center gap-2">
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M10.0084 2.5C13.257 2.5 15.8918 5.13354 15.8918 8.38341C15.8918 13.8354 10.0084 17.5 10.0084 17.5C10.0084 17.5 4.125 13.8354 4.125 8.38341C4.125 5.13354 6.75854 2.5 10.0084 2.5Z"
											stroke="#181B2B" stroke-miterlimit="10" />
										<path
											d="M10.0096 10.3708C11.1669 10.3708 12.1051 9.43255 12.1051 8.27522C12.1051 7.11789 11.1669 6.17969 10.0096 6.17969C8.85226 6.17969 7.91406 7.11789 7.91406 8.27522C7.91406 9.43255 8.85226 10.3708 10.0096 10.3708Z"
											stroke="#181B2B" stroke-miterlimit="10" />
									</svg>
									<span>
										<?php echo esc_html( $city['address'] ); ?>
									</span>
								</div>
							</div>
							<div class="lg:max-w-[16.125rem] w-full">
								<?php echo $city['info'] ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="bg-gray lg:bg-white px-5 lg:px-20 lg:border-t lg:border-t-gray3">
		<div class="border-t border-t-gray3 flex w-full justify-between items-center py-4 lg:border-t-0">
			<div class="flex flex-col gap-1 lg:gap-4 lg:flex-row lg:items-center">
				<span class="text-label-m">
					© Erudito Licėjus 2025. Visos teisės saugomos.
				</span>
				<a href="#" class="text-label-m">
					Privatumo politika
				</a>
			</div>
			<div>
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M15.4616 17.3887L11.4133 10.3787L18.3103 6.39593L17.2748 4.60309L12.8284 7.17165L15.395 2.7233L13.6022 1.68874L11.0345 6.13611V1H8.96449V6.13611L6.39593 1.68874L4.60309 2.7233L7.17165 7.17165L2.7233 4.60309L1.68778 6.39593L6.13515 8.96449H1V11.0345H6.13515L1.68778 13.6022L2.7233 15.395L7.17165 12.8274L4.60309 17.2748L6.39593 18.3103L8.96449 13.8629V18.9981H11.0345V13.8629L14.0001 19H17.5317V9.80583H15.4616"
						fill="#9EADBE" />
				</svg>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->