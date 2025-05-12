<?php
/**
 * Activities Prices Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );
$tabs        = get_field( 'tabs' );



?>

<div class="pb-12 lg:pb-20" x-data="{openTab: 0, paymentOpen: 0}">
	<div class="px-5 lg:px-20 pt-12 lg:pt-26 bg-gray">
		<div class="max-w-[32.625rem] lg:mb-16">
			<?php if ( $heading ) : ?>
				<h2 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p class="text-body-m-light mb-12 lg:mb-0">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>
		</div>
		<div class="w-full flex">
			<?php foreach ( $tabs as $index => $tab ) : ?>
				<?php erd_tab( $index, $tab['city_name'] ); ?>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="px-5 lg:px-20 pt-10 lg:pt-20">
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<div x-show="openTab === <?php echo $index; ?>" class="flex flex-col lg:gap-10">
				<div class="flex flex-col lg:flex-row gap-20 pb-12 lg:pb-20">
					<div class=" flex-col gap-6 max-w-[40rem] w-full hidden lg:flex">
						<?php if ( $tab['image'] ) : ?>
							<img src="<?php echo esc_url( $tab['image']['url'] ); ?>"
								alt="<?php echo esc_attr( $tab['image']['alt'] ); ?>"
								class="w-full aspect-[353/235] lg:aspect-square" />
						<?php endif; ?>
					</div>
					<div class="flex flex-col justify-between">
						<div class="pb-10 lg:pb-0">
							<?php if ( $tab['heading'] ) : ?>
								<h3 class="text-title-m-mobile lg:text-title-l mb-2 lg:mb-6">
									<?php echo esc_html( $tab['heading'] ); ?>
								</h3>
							<?php endif; ?>
							<?php if ( $tab['description'] ) : ?>
								<p class="text-body-m-light mb-6 lg:mb-8">
									<?php echo esc_html( $tab['description'] ); ?>
								</p>
							<?php endif; ?>
							<?php if ( $tab['pricing_column'] ) : ?>
								<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-14 mb-8">
									<?php foreach ( $tab['pricing_column'] as $pricing_column ) : ?>
										<div>
											<p class="font-medium mb-2">
												<?php echo esc_html( $pricing_column['heading'] ); ?>
											</p>
											<?php if ( $pricing_column['pricing_rows'] ) : ?>
												<ul class="flex flex-col gap-0.5">
													<?php foreach ( $pricing_column['pricing_rows'] as $pricing_row ) : ?>
														<li class="text-body-m-light">
															<?php echo esc_html( $pricing_row['row'] ); ?>
														</li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<div class="flex items-center gap-6">
								<?php if ( $tab['button'] ) : ?>
									<a href="<?php echo esc_url( $tab['button']['url'] ); ?>" class="erd_button">
										<?php echo esc_html( $tab['button']['title'] ); ?>
									</a>
								<?php endif; ?>
								<?php if ( $tab['link'] ) : ?>
									<a href="<?php echo esc_url( $tab['link']['url'] ); ?>" class="font-semibold">
										<?php echo esc_html( $tab['link']['title'] ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
						<?php if ( $tab['discount'] ) : ?>
							<div class="flex flex-col lg:flex-row gap-4 lg:items-center border-t border-t-gray3 pt-[1.625rem]">
								<div class="shrink-0">
									<?php if ( $tab['discount']['icon'] ) : ?>
										<img src="<?php echo esc_url( $tab['discount']['icon']['url'] ); ?>"
											alt="<?php echo esc_attr( $tab['discount']['icon']['alt'] ); ?>"
											class="w-16 lg:w-[5.5rem] aspect-square" />
									<?php endif; ?>
								</div>
								<div>
									<?php if ( $tab['discount']['heading'] ) : ?>
										<h3 class="text-title-s-mobile lg:text-title-s mb-2">
											<?php echo esc_html( $tab['discount']['heading'] ); ?>
										</h3>
									<?php endif; ?>
									<?php if ( $tab['discount']['description'] ) : ?>
										<p class="text-body-m-light">
											<?php echo esc_html( $tab['discount']['description'] ); ?>
										</p>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if ( $tab['image'] ) : ?>
							<img src="<?php echo esc_url( $tab['image']['url'] ); ?>"
								alt="<?php echo esc_attr( $tab['image']['alt'] ); ?>"
								class="w-full aspect-square mt-10 lg:hidden" />
						<?php endif; ?>
					</div>
				</div>
				<?php
				$program = $tab['program'];
				if ( $program ) :
					?>
					<div
						class="lg:border-t border-t-gray3 lg:pt-20 flex flex-col lg:flex-row gap-8 lg:gap-0 w-full justify-between">
						<div class="max-w-[25.8125rem]">
							<?php if ( $program['heading'] ) : ?>
								<h3 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
									<?php echo esc_html( $program['heading'] ); ?>
								</h3>
							<?php endif; ?>
							<?php if ( $program['description'] ) : ?>
								<p class="text-body-m-light">
									<?php echo esc_html( $program['description'] ); ?>
								</p>
							<?php endif; ?>
						</div>
						<div class="max-w-[39.375rem] w-full">
							<?php if ( $program['program_rows'] ) : ?>
								<div>
									<?php foreach ( $program['program_rows'] as $program_row ) : ?>
										<div
											class="py-4 lg:py-7 first:pt-0 last:pb-0 border-b border-b-gray3 last:border-b-0 flex items-center justify-between">
											<span class="font-argent text-title-s-mobile lg:text-title-s">
												<?php echo esc_html( $program_row['time'] ); ?>
											</span>
											<span class="text-body-m-light">
												<?php echo esc_html( $program_row['title'] ); ?>
											</span>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<?php if ( $program['extra_info'] ) : ?>
								<div class="mt-8 lg:mt-12">
									<div class="flex items-start gap-4 bg-gray p-5">
										<svg class="shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M11.9984 21.5999C17.3004 21.5999 21.5984 17.3018 21.5984 11.9999C21.5984 6.69797 17.3004 2.3999 11.9984 2.3999C6.6965 2.3999 2.39844 6.69797 2.39844 11.9999C2.39844 17.3018 6.6965 21.5999 11.9984 21.5999Z"
												fill="#E1E6F0" />
											<path d="M12 8.49978L12 12.3887" stroke="#626B75" stroke-width="1.5"
												stroke-linecap="square" stroke-linejoin="round" />
											<path d="M12 15.4222L12 15.5" stroke="#626B75" stroke-width="1.5"
												stroke-linecap="square" stroke-linejoin="round" />
										</svg>
										<p>
											<?php echo esc_html( $program['extra_info'] ) ?>
										</p>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>