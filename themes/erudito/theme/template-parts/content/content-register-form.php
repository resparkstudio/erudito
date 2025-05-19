<?php
$tabs = array(
	0 => array(
		'city' => 'Vilnius',
	),
	1 => array(
		'city' => 'Kaunas',
	),
);
?>
<div>
	<div class="relative flex flex-col items-center gap-6 lg:gap-0" x-show="registerModalOpen">
		<div class="fixed w-full h-full z-1 inset-0 bg-black/30" x-show="registerModalOpen"
			x-transition:enter="transition-opacity duration-300" x-transition:leave="transition-opacity duration-300"
			x-on:keydown.escape.window="registerModalOpen = false">
		</div>
		<div class="fixed z-50 bg-gray flex flex-col top-0 h-dvh right-0 lg:max-w-[34.9375rem] w-full  overflow-auto"
			x-on:click.away="registerModalOpen = false" x-transition:enter="transition-transform duration-300"
			x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
			x-transition:leave="transition-transform duration-300" x-transition:leave-start="translate-x-0"
			x-transition:leave-end="translate-x-full" x-show="registerModalOpen">
			<button class="absolute top-5 right-5 z-10 cursor-pointer" @click="registerModalOpen = false">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M5 19L19 5" stroke="#181B2B" stroke-miterlimit="10" stroke-linecap="square" />
					<path d="M19 19L5 5" stroke="#181B2B" stroke-miterlimit="10" stroke-linecap="square" />
				</svg>

			</button>
			<div class="pt-12">
				<div class="mb-8 lg:mb-10 px-5 lg:px-8">
					<h2 class="text-title-m-mobile lg:text-title-m mb-2 lg:mb-4">
						<?php esc_html_e( 'Registruokitės apsilankymui', 'erd' ); ?>
					</h2>
					<p class="text-body-m-light">
						<?php esc_html_e( 'Užpildykite formą ir susitarkite dėl individualaus apsilankymo „Erudito“ licėjuje. Susipasinkite su mokyklos aplinka, o mūsų komanda mielai atsakys į visus jums rūpimus klausimus!', 'erd' ); ?>
					</p>
				</div>
				<div x-data="{openTab: 0}">
					<div class="w-full flex  px-5 lg:px-8">
						<?php foreach ( $tabs as $index => $tab ) : ?>
							<?php erd_tab( $index, $tab['city'], true ); ?>
						<?php endforeach; ?>
					</div>
					<div class="bg-white pt-8 px-5 lg:px-8">
						<?php echo do_shortcode( '[contact-form-7 id="4cc7199" title="Contact form 1"]' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>