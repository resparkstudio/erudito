<?php
/**
 * Afterschool Tabs Block
 *
 * @package erudito
 */

$all_categories_text = get_field( 'all_categories_text' );
$tabs                = get_field( 'tabs' );

if ( ! $tabs ) {
	return;
}

if ( ! function_exists( 'afterschool_tab_button' ) ) {
	function afterschool_tab_button( $index, $title ) {
		?>
		<button class="w-[18.3125rem] h-[4.5rem] bg-gray2 rounded-t-xl text-gray5 cursor-pointer"
			x-bind:class="{ 'bg-white !text-black' : openTab === <?php echo $index; ?> }"
			@click="openTab = <?php echo $index; ?>">
			<?php echo esc_html( $title ); ?>
		</button>
		<?php
	}
}

?>

<div x-data="{openTab: 0}">
	<div class="px-5 lg:px-20 bg-gray w-full flex">
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<?php afterschool_tab_button( $index, $tab['tab_name'] ); ?>
		<?php endforeach; ?>
	</div>
	<div class="px-5 lg:px-20 py-12 lg:pt-16 lg:pb-26 ">
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<div x-data="{openCategory: 'all_categories'}" x-show="openTab === <?php echo $index; ?>">
				<button class="py-[0.625rem] px-5 rounded-full text-gray4 cursor-pointer font-medium"
					x-bind:class="{ '!text-black bg-gray' : openCategory === 'all_categories' }"
					@click="openCategory = 'all_categories'">
					<?php echo esc_html( $all_categories_text ); ?>
				</button>
				<?php foreach ( $tab['categories'] as $category ) : ?>
					<button class="py-[0.625rem] px-5 rounded-full text-gray4 cursor-pointer font-medium"
						x-bind:class="{ '!text-black !bg-gray' : openCategory === '<?php echo $category['category_name']; ?>' }"
						@click="openCategory = '<?php echo $category['category_name']; ?>'">
						<?php echo esc_html( $category['category_name'] ); ?>
					</button>
				<?php endforeach; ?>
				<div class="grid grid-cols-1 lg:grid-cols-2 gap-x-20 gap-y-12 lg:gap-y-16">
					<?php foreach ( $tab['categories'] as $category ) : ?>
						<?php if ( $category['activities'] ) : ?>
							<?php foreach ( $category['activities'] as $activity ) : ?>
								<div x-show="openCategory === '<?php echo $category['category_name']; ?>' || openCategory === 'all_categories'"
									class="mt-8 lg:mt-12">
									<?php if ( $activity['image'] ) : ?>
										<img src="<?php echo esc_url( $activity['image']['url'] ); ?>"
											alt="<?php echo esc_attr( $activity['image']['alt'] ); ?>"
											class="w-full mb-6 lg:mb-8 aspect-[600/400] object-cover" />
									<?php endif; ?>
									<div>
										<h3 class="text-title-m-mobile lg:text-title-m mb-2">
											<?php echo esc_html( $activity['title'] ); ?>
										</h3>
									</div>
									<div class="text-body-m-light">
										<?php echo esc_html( $activity['description'] ); ?>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>