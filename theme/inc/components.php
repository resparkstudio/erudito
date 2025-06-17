<?php

/**
 * Reusable UI Components
 * These functions generate HTML components used across the theme
 */

/**
 * Render ERD Custom Dropdown
 *
 * @param array $config {
 *     @type string $id           Unique identifier
 *     @type string $placeholder  Display text when nothing selected
 *     @type array  $options     Key-value pairs [value => label]
 *     @type string $selected    Currently selected value
 *     @type string $class       Additional CSS classes
 *     @type array $attr         Key-value pairs [name => value]
 * }
 */

function erd_render_dropdown($config = []) {
	$defaults = [
		'id' => '',
		'placeholder' => __('Select an option...', 'erudito'),
		'options' => [],
		'selected' => '',
		'class' => '',
		'attr' => [],
		'error' => '',
		'show_preorder_msg' => false
	];

	$config = wp_parse_args($config, $defaults);

	// Prepare data for Alpine
	$alpine_data = [
		'open' => false,
		'error' => false,
		'selected' => $config['selected'],
		'selectedText' => $config['selected'] ? $config['options'][$config['selected']] : $config['placeholder'],
		'dropdownId' => $config['id'],
		'attr' => $config['attr'],

	];

	// Build attributes string from the attr array
	$attributes_html = '';
	foreach ($config['attr'] as $attr_name => $attr_value) {
		$attributes_html .= ' ' . esc_attr($attr_name) . '="' . esc_attr($attr_value) . '"';
	}

?>

	<div class="relative <?php echo esc_attr($config['class']); ?>" id="<?php echo esc_attr($config['id']); ?>"
		x-data="erdDropdown(<?php echo esc_attr(json_encode($alpine_data)); ?>)" @click.away="open = false" <?php echo $attributes_html; ?>>

		<button type="button"
			class="w-full flex items-center justify-between cursor-pointer px-4 py-3.5 text-black text-body-m-light text-left border rounded-lg bg-gray hover:border-gray3 transition-colors duration-100"
			:class="{
        'border-gray3': open && !error,
        'border-gray': !open && !error,
        '!border-red2': error
    }"
			@click="open = !open" :aria-expanded="open"
			aria-haspopup="listbox">
			<span :class="!isAvailable(selected) ? 'line-through' : ''" x-text="selectedText"></span>
			<svg class="w-6 h-6 text-black transition-transform duration-200"
				:class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M18 10.5L12.0005 14.25L6 10.5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
					stroke-linecap="square" />
			</svg>
		</button>

		<?php
		if (! empty($config['error'])) : ?>
			<div x-cloak x-show="error" class="mt-1 text-label-m text-red2"><?php echo esc_html($config['error']); ?></div>
		<?php endif; ?>

		<div class="absolute z-10 w-full mt-2 overflow-hidden transition-all duration-200 bg-white border rounded-lg erd-dropdown-menu border-gray3"
			x-show="open" x-transition role="listbox">

			<?php foreach ($config['options'] as $value => $label) : ?>
				<a href="#" class="flex items-center justify-between px-4 py-3 group transition-color hover:bg-gray text-body-m-light"
					:class="{
     'bg-gray': selected === '<?php echo esc_js($value); ?>',
   }"
					@click.prevent="selectOption('<?php echo esc_js($value); ?>', '<?php echo esc_js($label); ?>')"
					data-value="<?php echo esc_attr($value); ?>" role="option"
					:aria-selected="selected === '<?php echo esc_js($value); ?>'">
					<span class="group-hover:text-black" :class="{
					'line-through': !isAvailable('<?php echo esc_js($value); ?>'),
					'text-black': selected === '<?php echo esc_js($value); ?>',
					'text-gray4': selected !== '<?php echo esc_js($value); ?>',
					}">
						<?php echo esc_html($label); ?>
					</span>
					<svg class="w-6 h-6 text-black"
						x-show="selected === '<?php echo esc_js($value); ?>' && isAvailable('<?php echo esc_js($value); ?>')"
						viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M5 12.2L9.3335 16L18.8335 8" stroke="currentColor" stroke-width="1.5" />
					</svg>
					<?php
					if ($config['show_preorder_msg']) : ?>
						<div x-cloak x-show="!isAvailable('<?php echo esc_js($value); ?>')" class="flex items-center gap-2 text-gray5">
							<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M20 6H4V18H20V6Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
								<path d="M20 8.02856L12 13.1714L4 8.02856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
							</svg>
							<span class="text-caption-semibold"><?php echo esc_html__('Notify when in stock', 'erudito'); ?></span>
						</div>
					<?php endif; ?>
				</a>
			<?php endforeach; ?>

		</div>
	</div>

	<?php
}

/**
 * WooCommerce product labels
 */
function erd_render_product_labels() {
	global $product;

	if (! $product)
		return;

	// Get product creation date to determine if it's new
	$product_id            = $product->get_id();
	$product_creation_date = get_post_time('U', false, $product_id);
	$days_since_creation   = (time() - $product_creation_date) / DAY_IN_SECONDS;
	$is_new                = $days_since_creation < 7;

	// Determine if product is on sale and calculate discount percentage
	$is_on_sale          = $product->is_on_sale();
	$discount_percentage = 0;

	if ($is_on_sale && $product->get_regular_price()) {
		$regular_price = (float) $product->get_regular_price();
		$sale_price    = (float) $product->get_sale_price();

		if ($regular_price > 0) {
			$discount_percentage = round(100 - ($sale_price / $regular_price * 100));
		}
	}

	// Check if product is out of stock
	$stock_status    = $product->get_stock_status();
	$is_out_of_stock = $stock_status === 'outofstock' ? true : false;

	ob_start();

	// Display labels container - positioned in top left with spacing between labels
	if ($is_new || $is_on_sale || $is_out_of_stock) :
		// New label if product is new
		if ($is_new) : ?>
			<div class="bg-blue text-white text-label-s py-1 px-1.5">
				<?php echo esc_html__('New', 'erudito'); ?>
			</div>
		<?php endif; ?>

		<?php
		// Discount label if product is on sale
		if ($is_on_sale && $discount_percentage > 0) : ?>
			<div class="bg-yellow text-black text-label-s py-1 px-1.5">
				<?php echo sprintf(esc_html__('-%d%%', 'erudito'), $discount_percentage); ?>
			</div>
		<?php endif; ?>

		<?php
		// Out of stock label
		if ($is_out_of_stock) : ?>
			<div class="bg-gray2 text-gray5 text-label-s py-1 px-1.5">
				<?php echo esc_html__('Out of stock', 'erudito'); ?>
			</div>
		<?php endif; ?>
<?php endif;

	return ob_get_clean();
}
