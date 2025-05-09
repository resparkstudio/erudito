<?php
/**
 * The template for displaying single camp posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package erudito
 */

get_header();

$name           = get_the_title();
$featured_image = get_the_post_thumbnail_url();
$position       = get_field( 'position' );
$location       = get_field( 'location' );
$email          = get_field( 'email' );
?>

<div class="px-5 lg:px-20 py-12 lg:py-26 flex justify-between">
	<div class="shrink-0">
		<img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( $name ); ?>"
			class="w-full max-w-[25.8125rem] lg:aspect-square hidden lg:block shrink-0" />
	</div>
	<div class="max-w-[46.125rem] w-full">
		<div class="lg:border-b border-b-gray3 pb-8 lg:pb-12">
			<h1 class="text-title-l-mobile lg:text-title-xl mb-6 lg:mb-20">
				<?php echo esc_html( $name ); ?>
			</h1>
			<div class="flex flex-col gap-2 lg:gap-0 lg:flex-row w-full justify-between">
				<div class="flex gap-3 items-center">
					<span class="text-body-m-light">
						<?php echo esc_html( $position ); ?>
					</span>
					<span class="w-[4px] h-[4px] bg-violet rounded-full"></span>
					<span>
						<?php echo esc_html( $location ); ?>
					</span>
				</div>
				<div class="flex items-center gap-2 pb-8">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="4" y="7" width="16" height="12" stroke="#181B2B" />
						<path
							d="M20 9L12.824 13.7532C12.577 13.9145 12.2915 14 12 14C11.7085 14 11.423 13.9145 11.176 13.7532L4 9"
							stroke="#181B2B" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					<a class="underline" href="mailto:<?php echo esc_html( $email ); ?>">
						<?php echo esc_html( $email ) ?>
					</a>
				</div>
				<img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( $name ); ?>"
					class="w-full max-w-[25.8125rem] lg:aspect-square lg:hidden shrink-0" />
			</div>
		</div>
		<div class="lg:pt-12">
			<?php the_content(); ?>
		</div>
	</div>
</div>

<?php
get_footer();
?>