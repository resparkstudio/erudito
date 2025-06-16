<form role="search" method="get" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>"
	class="input-group w-full">
	<div class="input-group w-full !relative">
		<svg class="absolute top-[0.875rem] left-4 w-6 h-6" width="24" height="24" viewBox="0 0 24 24" fill="none"
			xmlns="http://www.w3.org/2000/svg">
			<path
				d="M11.3619 19.7239C15.9801 19.7239 19.7239 15.9801 19.7239 11.3619C19.7239 6.74377 15.9801 3 11.3619 3C6.74377 3 3 6.74377 3 11.3619C3 15.9801 6.74377 19.7239 11.3619 19.7239Z"
				stroke="#7F8994" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
			<path d="M17.2734 17.2739L20.9996 21" stroke="#7F8994" stroke-width="1.5" stroke-linecap="square"
				stroke-linejoin="round" />
		</svg>
		<input type="search"
			class="form-control text-black w-full py-[0.875rem] px-12 bg-gray border border-gray3 rounded-lg focus:outline-none"
			placeholder="<?php esc_html_e( 'Paieška', 'erd' ) ?>" aria-label="search nico" name="s" id="search-input"
			value="<?php echo esc_attr( get_search_query() ); ?>">
	</div>
</form>