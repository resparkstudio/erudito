<?php
/**
 * Admission Pricing Block
 *
 * @package erudito
 */

$heading     = get_field( 'heading' );
$description = get_field( 'description' );

$tabs = get_field( 'tabs' );

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
				<?php erd_tab( $index, $tab['city'] ); ?>
			<?php endforeach; ?>
		</div>
	</div>
	<div>
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<?php if ( $tab['payments'] ) : ?>
				<div x-show="openTab === <?php echo $index; ?>"
					class="flex items-center mt-20 justify-center bg-gray w-max mx-auto rounded-md p-[3px]">
					<?php foreach ( $tab['payments'] as $paymentIndex => $payment ) : ?>
						<button class="py-3 px-6 rounded-md cursor-pointer flex items-center gap-2 font-medium text-gray5"
							x-bind:class="{ 'bg-white !text-black' : paymentOpen === <?php echo $paymentIndex; ?> }"
							@click="paymentOpen = <?php echo $paymentIndex; ?>">
							<span>
								<?php echo esc_html( $payment['text'] ); ?>
							</span>
							<?php if ( $payment['discount'] ) : ?>
								<svg width="37" height="18" viewBox="0 0 37 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd"
										d="M2.12109 6.87913C2.6837 6.31652 2.99977 5.55346 2.99977 4.75781V6.00045L3 6.00023L3 12.0002L2.99977 12V13.2426C2.99977 12.4473 2.68393 11.6845 2.12169 11.1219L2.12109 11.1213L0 9.00023L2.12109 6.87913Z"
										fill="#F0CB69" />
									<rect x="3" width="34" height="18" rx="4" fill="#F0CB69" />
									<path
										d="M7.61 10.88V9.97L10.25 9.965V10.875L7.61 10.88ZM11.9295 13V7.43H10.5895V6.705C11.0129 6.705 11.3479 6.67 11.5945 6.6C11.8445 6.52667 12.0262 6.42 12.1395 6.28C12.2562 6.14 12.3229 5.97 12.3395 5.77H13.1695V13H11.9295ZM17.734 13.11C17.274 13.11 16.8457 13.035 16.449 12.885C16.0557 12.7317 15.7157 12.5217 15.429 12.255C15.1457 11.9883 14.934 11.6833 14.794 11.34L15.779 10.82C15.9023 11.0667 16.049 11.2883 16.219 11.485C16.3923 11.6817 16.594 11.8367 16.824 11.95C17.0573 12.06 17.324 12.115 17.624 12.115C18.094 12.115 18.4707 11.985 18.754 11.725C19.0407 11.4617 19.184 11.1117 19.184 10.675C19.184 10.405 19.1173 10.165 18.984 9.955C18.854 9.745 18.6757 9.58167 18.449 9.465C18.2257 9.345 17.9707 9.285 17.684 9.285C17.514 9.285 17.354 9.3 17.204 9.33C17.0573 9.36 16.909 9.41667 16.759 9.5C16.609 9.58 16.4473 9.70167 16.274 9.865C16.2407 9.88167 16.2157 9.89 16.199 9.89C16.1857 9.88667 16.1607 9.87667 16.124 9.86L15.189 9.48L15.519 5.77H20.014L19.969 6.785H16.509L16.344 8.795C16.6007 8.615 16.859 8.485 17.119 8.405C17.379 8.325 17.6657 8.285 17.979 8.285C18.439 8.285 18.8573 8.375 19.234 8.555C19.6107 8.735 19.9107 9 20.134 9.35C20.3573 9.7 20.469 10.1283 20.469 10.635C20.469 11.1417 20.3557 11.58 20.129 11.95C19.9057 12.32 19.589 12.6067 19.179 12.81C18.7723 13.01 18.2907 13.11 17.734 13.11ZM24.9848 13.04L29.8698 5.69H30.7148L25.8548 13.04H24.9848ZM25.5548 9.76C25.2081 9.76 24.8964 9.67 24.6198 9.49C24.3431 9.30667 24.1248 9.06167 23.9648 8.755C23.8048 8.44833 23.7248 8.10667 23.7248 7.73C23.7248 7.34667 23.8048 6.99833 23.9648 6.685C24.1281 6.37167 24.3481 6.12333 24.6248 5.94C24.9014 5.75333 25.2114 5.66 25.5548 5.66C25.8981 5.66 26.2064 5.75333 26.4798 5.94C26.7531 6.12333 26.9698 6.37167 27.1298 6.685C27.2898 6.99833 27.3698 7.34667 27.3698 7.73C27.3698 8.10667 27.2914 8.44833 27.1348 8.755C26.9781 9.06167 26.7614 9.30667 26.4848 9.49C26.2114 9.67 25.9014 9.76 25.5548 9.76ZM25.5448 9.02C25.8081 9.02 25.9998 8.91167 26.1198 8.695C26.2398 8.475 26.2998 8.15333 26.2998 7.73C26.2998 7.29333 26.2381 6.96167 26.1148 6.735C25.9914 6.50833 25.8014 6.395 25.5448 6.395C25.2914 6.395 25.1031 6.51 24.9798 6.74C24.8564 6.96667 24.7948 7.29667 24.7948 7.73C24.7948 8.15 24.8548 8.47 24.9748 8.69C25.0981 8.91 25.2881 9.02 25.5448 9.02ZM30.2998 13.1C29.9498 13.1 29.6364 13.01 29.3598 12.83C29.0831 12.65 28.8648 12.4067 28.7048 12.1C28.5448 11.79 28.4648 11.4433 28.4648 11.06C28.4648 10.6767 28.5448 10.3283 28.7048 10.015C28.8681 9.70167 29.0881 9.45333 29.3648 9.27C29.6448 9.08333 29.9564 8.99 30.2998 8.99C30.6431 8.99 30.9514 9.08333 31.2248 9.27C31.5014 9.45333 31.7198 9.70167 31.8798 10.015C32.0398 10.3283 32.1198 10.6767 32.1198 11.06C32.1198 11.4433 32.0414 11.79 31.8848 12.1C31.7281 12.4067 31.5114 12.65 31.2348 12.83C30.9614 13.01 30.6498 13.1 30.2998 13.1ZM30.2898 12.35C30.5498 12.35 30.7398 12.2417 30.8598 12.025C30.9798 11.805 31.0398 11.4867 31.0398 11.07C31.0398 10.6333 30.9781 10.3017 30.8548 10.075C30.7314 9.84833 30.5431 9.735 30.2898 9.735C30.0364 9.735 29.8481 9.85 29.7248 10.08C29.6048 10.3067 29.5448 10.6367 29.5448 11.07C29.5448 11.4833 29.6048 11.8 29.7248 12.02C29.8448 12.24 30.0331 12.35 30.2898 12.35Z"
										fill="#181B2B" />
								</svg>
							<?php endif; ?>
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<?php if ( $tab['payments'] ) : ?>
				<?php foreach ( $tab['payments'] as $paymentIndex => $payment ) : ?>
					<div class="px-5 lg:px-20 mt-12"
						x-show="openTab === <?php echo $index; ?> && paymentOpen === <?php echo $paymentIndex; ?>">
						<?php if ( $payment['prices'] ) : ?>
							<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
								<?php foreach ( $payment['prices'] as $price ) : ?>
									<div class="bg-gray rounded-b-lg">
										<div class="min-h-[9.25rem] lg:min-h-[16.25rem] bg-blue flex items-end p-5 lg:p-8 rounded-t-lg">
											<div class="flex items-center gap-2">
												<div class="font-argent text-title-m-mobile lg:text-title-m text-white">
													<?php echo esc_html( $price['title'] ) ?>
												</div>
												<?php if ( $price['tooltip'] ) : ?>
													<div data-tooltip="<?php echo esc_attr( $price['tooltip'] ) ?>">
														<svg width="28" height="28" viewBox="0 0 28 28" fill="none"
															xmlns="http://www.w3.org/2000/svg">
															<path
																d="M14.0008 25.2001C20.1864 25.2001 25.2008 20.1856 25.2008 14C25.2008 7.81446 20.1864 2.80005 14.0008 2.80005C7.81519 2.80005 2.80078 7.81446 2.80078 14C2.80078 20.1856 7.81519 25.2001 14.0008 25.2001Z"
																fill="#626A98" />
															<path
																d="M11.1992 11.0649C11.4297 10.4098 11.8845 9.85738 12.4832 9.50551C13.0819 9.15365 13.7858 9.02503 14.4703 9.14243C15.1547 9.25983 15.7755 9.61568 16.2228 10.1469C16.67 10.6782 16.9148 11.3506 16.9137 12.0451C16.9137 14.0054 13.9732 14.9856 13.9732 14.9856"
																stroke="white" stroke-width="1.5" stroke-linecap="square"
																stroke-linejoin="round" />
															<path d="M14.0508 18.9065H14.0606" stroke="white" stroke-width="1.5"
																stroke-linecap="square" stroke-linejoin="round" />
														</svg>
													</div>
												<?php endif; ?>
											</div>
										</div>
										<div class="p-5 lg:p-8 flex items-end justify-between w-full">
											<div class="flex items-end gap-1 font-argent w-max">
												<?php echo sprintf( '<span class="text-title-m-mobile lg:text-title-l">%s</span>', esc_html( $price['price_per_month'] ) ); ?>
												<span class="text-title-s">
													<?php esc_html_e( '€ / mėn.', 'erd' ); ?>
												</span>
											</div>
											<div class="text-gray5 text-body-s-light lg:text-body-m-light">
												<?php echo esc_html( $price['price_per_year'] ); ?>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if ( $tab['discount_info'] ) : ?>
				<div class="px-5 lg:px-20 mt-20" x-show="openTab === <?php echo $index; ?>">
					<div class="border-b border-b-gray3 pb-12 lg:pb-26">
						<div class="flex flex-col items-center w-full max-w-[32.5rem] mx-auto text-center">

							<?php if ( $tab['discount_info']['icon'] ) : ?>
								<img src="<?php echo esc_url( $tab['discount_info']['icon']['url'] ) ?>"
									alt="<?php echo esc_attr( $tab['discount_info']['icon']['alt'] ) ?>"
									class="max-w-[5.5rem] w-full mb-6">
							<?php endif; ?>
							<?php if ( $tab['discount_info']['heading'] ) : ?>
								<h3 class="text-title-s-mobile lg:text-title-s mb-2">
									<?php echo esc_html( $tab['discount_info']['heading'] ) ?>
								</h3>
							<?php endif; ?>
							<?php if ( $tab['discount_info']['description'] ) : ?>
								<p class="text-body-m-light">
									<?php echo esc_html( $tab['discount_info']['description'] ) ?>
								</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( $tab['extra_taxes'] ) : ?>
				<div class="px-5 pt-12 lg:px-20 lg:pt-26 flex flex-col gap-8 lg:flex-row w-full justify-between"
					x-show="openTab === <?php echo $index; ?>">
					<div class="max-w-[25.8125rem]">
						<?php if ( $tab['extra_taxes']['heading'] ) : ?>
							<h3 class="text-title-l-mobile lg:text-title-l mb-4 lg:mb-6">
								<?php echo esc_html( $tab['extra_taxes']['heading'] ) ?>
							</h3>
						<?php endif; ?>
						<?php if ( $tab['extra_taxes']['description'] ) : ?>
							<p class="text-body-m-light">
								<?php echo esc_html( $tab['extra_taxes']['description'] ) ?>
							</p>
						<?php endif; ?>
					</div>
					<div class="max-w-[39.375rem] w-full">
						<h4 class="text-title-m-mobile lg:text-title-s mb-5">
							<?php esc_html_e( 'Mokymuisi', 'erd' ) ?>
						</h4>
						<table class="w-full">
							<?php foreach ( $tab['extra_taxes']['taxes'] as $index => $tax ) : ?>
								<tr
									class="border-gray3 first:border-t last:border-b-0 <?php echo $tax['extra_info'] ? '' : 'border-b' ?> <?php echo $tax['is_last_row'] ? '!border-b-0 !pb-4 font-argent text-title-s' : ' text-body-m-light' ?>">
									<td class="py-4 lg:py-5">
										<div class="flex items-center gap-1.5">
											<span>
												<?php echo esc_html( $tax['title'] ) ?>
											</span>
											<?php if ( $tax['tooltip'] ) : ?>
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path
														d="M11.9984 21.5999C17.3004 21.5999 21.5984 17.3018 21.5984 11.9999C21.5984 6.69797 17.3004 2.3999 11.9984 2.3999C6.6965 2.3999 2.39844 6.69797 2.39844 11.9999C2.39844 17.3018 6.6965 21.5999 11.9984 21.5999Z"
														fill="#E6EAF2" />
													<path
														d="M9.59766 9.48389C9.79518 8.92238 10.1851 8.4489 10.6982 8.1473C11.2114 7.84571 11.8148 7.73546 12.4014 7.83609C12.9881 7.93672 13.5202 8.24173 13.9036 8.6971C14.2869 9.15247 14.4967 9.72882 14.4958 10.3241C14.4958 12.0044 11.9753 12.8445 11.9753 12.8445"
														stroke="#626B75" stroke-width="1.5" stroke-linecap="square"
														stroke-linejoin="round" />
													<path d="M12.043 16.2051H12.0514" stroke="#626B75" stroke-width="1.5"
														stroke-linecap="square" stroke-linejoin="round" />
												</svg>
											<?php endif; ?>
										</div>
										<div class="mt-2 lg:hidden">
											<?php if ( $tax['description'] ) : ?>
												<p class="text-body-m-light font-public mb-2">
													<?php echo esc_html( $tax['description'] ) ?>
												</p>
											<?php endif; ?>
											<div class="font-argent flex items-end gap-1">
												<span class="text-title-s">
													<?php echo esc_html( $tax['price'] ) ?>
												</span>
												<span>
													<?php echo esc_html( $tax['price_suffix'] ) ?>
												</span>
											</div>
										</div>
									</td>
									<td class="hidden lg:block py-5" align="right">
										<div class="font-argent flex items-end gap-1 justify-end">
											<span class="text-title-s">
												<?php echo esc_html( $tax['price'] ) ?>
											</span>
											<span>
												<?php echo esc_html( $tax['price_suffix'] ) ?>
											</span>
										</div>
									</td>
								</tr>
								<?php if ( $tax['extra_info'] ) : ?>
									<tr class="border-b border-gray3 first:border-t last:border-b-0">
										<td colspan="2" class="text-body-m-light pb-5">
											<div class="flex items-start gap-4 bg-gray px-5 py-4 lg:px-6 lg:py-5">
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
													<?php echo esc_html( $tax['extra_info'] ) ?>
												</p>
											</div>
										</td>
									</tr>
								<?php endif; ?>
								<?php if ( $tax['description'] ) : ?>
									<tr class="hidden lg:table-row">
										<td class="text-body-m-light max-w-[28.25rem]">
											<p>
												<?php echo esc_html( $tax['description'] ) ?>
											</p>
										</td>
									</tr>
								<?php endif; ?>
							<?php endforeach; ?>
						</table>
						<?php if ( $tab['extra_taxes']['button'] ) : ?>
							<a href="<?php echo esc_url( $tab['extra_taxes']['button']['url'] ) ?>" class="erd_button mt-2 lg:mt-8">
								<?php echo esc_html( $tab['extra_taxes']['button']['title'] ) ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>