/**
 * Sekeleton loader for products
 */

export function productSkeletonLoader(count = 4) {
	return `
            ${Array.from(
				{ length: count },
				() => `
                <li class="woocommerce-product-loop product">
                    <div class="animate-pulse">
                        <!-- Product image skeleton -->
                        <div class="w-full aspect-[284/356] bg-gray-300 mb-6"></div>
                        
                        <!-- Product title skeleton -->
                        <div class="h-2.5 bg-gray-300 mb-3"></div>
                    
                        <!-- Price skeleton -->
                        <div class="h-2.5 bg-gray-300 w-3/4"></div>
                        
                        <!-- Button skeleton -->
                        <div class="w-full h-12 bg-gray-300 rounded-full lg:hidden mt-4"></div>
                    </div>
                </li>
            `
			).join('')}
    `;
}
