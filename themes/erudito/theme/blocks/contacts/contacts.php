<?php
/**
 * Contacts Block
 *
 * @package erudito
 */

$heading = get_field( 'heading' );
$tabs    = get_field( 'tabs' );


?>

<div x-data="{ openTab: 0 }" class="relative">
	<div class="bg-gray px-5 lg:px-20 pt-12 lg:pt-26">
		<?php if ( $heading ) : ?>
			<h2 class="text-tile-l lg:text-title-xl">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>
		<div class="w-full flex mt-16">
			<?php foreach ( $tabs as $index => $tab ) : ?>
				<?php erd_tab( $index, $tab['city'] ); ?>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="">
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<div x-show="openTab === <?php echo esc_html( $index ); ?>" class="">
				<?php $school_info = $tab['school_info'];
				?>
				<div class="flex flex-col-reverse lg:flex-row gap-8 lg:gap-20 py-12 lg:py-26 px-5 lg:px-20">
					<div class="max-w-[40rem] w-full">
						<img src="<?php echo esc_url( $school_info['image']['url'] ) ?>" alt=""
							class="w-full aspect-[640/436] object-cover">
					</div>
					<div class="flex flex-col justify-between">
						<div class="pb-6 mb-6 lg:mb-0 lg:pb-0 border-b lg:border-b-0 border-b-gray3">
							<h3 class="text-title-m lg:text-title-l mb-3 lg:mb-6">
								<?php echo esc_html( $school_info['name'] ); ?>
							</h3>
							<div class="flex items-center gap-2">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path
										d="M10.0084 2.5C13.257 2.5 15.8918 5.13354 15.8918 8.38341C15.8918 13.8354 10.0084 17.5 10.0084 17.5C10.0084 17.5 4.125 13.8354 4.125 8.38341C4.125 5.13354 6.75854 2.5 10.0084 2.5Z"
										stroke="#181B2B" stroke-miterlimit="10" />
									<path
										d="M10.0086 10.371C11.1659 10.371 12.1041 9.43279 12.1041 8.27546C12.1041 7.11813 11.1659 6.17993 10.0086 6.17993C8.85129 6.17993 7.91309 7.11813 7.91309 8.27546C7.91309 9.43279 8.85129 10.371 10.0086 10.371Z"
										stroke="#181B2B" stroke-miterlimit="10" />
								</svg>
								<span>
									<?php echo esc_html( $school_info['address'] ); ?>
								</span>
							</div>
						</div>
						<div>
							<div class="flex flex-col lg:flex-row gap-6 lg:gap-12 pb-6 lg:pb-10 text-body-m-medium">
								<?php foreach ( $school_info['contact_info'] as $info ) : ?>
									<div>
										<p>
											<?php echo esc_html( $info['title'] ); ?>
										</p>
										<div class="flex flex-col gap-1">
											<?php foreach ( $info['info_row'] as $item ) : ?>
												<a href="<?php echo esc_url( $item['Info row']['url'] ); ?>" class="underline">
													<?php echo esc_html( $item['Info row']['title'] ); ?>
												</a>
											<?php endforeach; ?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="lg:pt-10 lg:border-t border-t-gray3">
								<?php foreach ( $school_info['work_hours'] as $work_hours ) : ?>
									<div class="flex items-center">

										<img src="<?php echo $work_hours['image']['url'] ?>" alt=""
											class="w-[0.875rem] h-[1.25rem] mr-3">
										<span class="mr-1.5">
											<?php echo esc_html( $work_hours['days'] ); ?>
										</span>
										<span>
											<?php echo esc_html( $work_hours['hours'] ); ?>
										</span>
									</div>
								<?php endforeach; ?>
							</div>
						</div>

					</div>
				</div>
				<?php $contact_people = $tab['contact_people']; ?>
				<div class="bg-gray px-5 lg:px-20 py-12 lg:py-26">
					<h3 class="text-title-l-mobile lg:text-title-l mb-8 lg:mb-16">
						<?php echo esc_html( $contact_people['heading'] ); ?>
					</h3>
					<div class="flex flex-col lg:flex-row w-full justify-between gap-12">
						<div class="grid grid-cols-2 gap-x-4 gap-y-8 lg:gap-16">
							<?php foreach ( $contact_people['people'] as $person ) : ?>
								<div class="flex flex-col lg:flex-row gap-5 lg:gap-8">
									<img src="<?php echo esc_url( $person['image']['url'] ) ?>" alt=""
										class="w-[8.75rem] h-[8.75rem] object-cover">
									<div>
										<p class="text-body-s-medium lg:text-body-m-medium mb-0.5">
											<?php echo esc_html( $person['name'] ); ?>
										</p>
										<p class="text-body-s-light lg:text-body-m-light mb-1">
											<?php echo esc_html( $person['position'] ); ?>
										</p>
										<?php if ( $person['contact_info'] ) : ?>
											<?php foreach ( $person['contact_info'] as $info ) : ?>
												<a href="<?php echo esc_url( $info['info_row']['url'] ); ?>" class="underline">
													<?php echo esc_html( $info['info_row']['title'] ); ?>
												</a>
											<?php endforeach; ?>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="max-w-[13.6875rem]">
							<p class="font-argent text-title-s mb-6">
								<?php echo esc_html( $contact_people['details_heading'] ) ?>
							</p>
							<div class="erd_rich_content">
								<?php echo $contact_people['details_text'] ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>