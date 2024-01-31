<?php
/**
 * template: wp-content/plugins/wc-plugin-template/app/Views/Admin/settings/edit.php
 * @var array $products
 */
?>

<div id="link-form" class="flex absolute z-1000 left-0 top-0 w-full h-full overflow-auto items-center justify-center bg-black bg-opacity-0 hidden">
    <div class="bg-white rounded-md py-10 px-10 max-w-screen-4xl shadow-xl">
        <div>
            <span id="close-link-form" class="relative hover:cursor-pointer text-2xl font-bold float-right left-2 bottom-6"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div>
            <h2 class="text-xl font-bold"><?= __('Edit Link', 'wc-payment-link'); ?></h2>
        </div>
        <div class="pb-4 border-b-[1px] border-black-400">
            <div class="w-full grid grid-cols-[1fr_2fr_40px] gap-2 items-center">
                <div class="py-1">
                    <label><?= __('Name:', 'wc-payment-link'); ?></label>
                    <div>
                        <input class="w-full h-10 bg-white outline-0 border-none shadow-md rounded-md" aria-label="none" type="text" id="name" name="name">
                    </div>
                </div>
                <div class="py-1">
                    <label><?= __('Token:', 'wc-payment-link'); ?></label>
                    <div>
                        <input class="w-full h-10 bg-white outline-0 border-none shadow-md rounded-md" aria-label="none" readonly type="text" id="token" name="token">
                    </div>
                </div>
                <div class="py-1">
                    <div>
                        <button class="w-full text-white h-10 bg-blue-600 outline-0 mt-[20px] border-none shadow-md rounded-md hover:bg-[#316beb]"><i class="fa-solid fa-rotate-left"></i></button>
                    </div>
                </div>
            </div>
            <div class="w-full">
                <div class="py-1">
                    <label><?= __('Expire at:', 'wc-payment-link'); ?></label>
                    <div class="flex flex-row items-center justify-center gap-2 max-w-60">
                        <input class="w-full h-10 bg-white outline-0 border-none shadow-md rounded-md" aria-label="none" type="date" id="date" name="date">
                        <label><?= __('H:', 'wc-payment-link'); ?></label>
                        <input class="w-16s h-10 bg-white outline-0 border-none shadow-md rounded-md" aria-label="none" type="number" min="0" max="23" id="hour" name="hour">
                    </div>
                </div>
            </div>
        </div>
        <div class="my-4">
            <h3 class="font-600 text-lg"><?= __('Cart', 'wc-payment-link'); ?></h3>
            <div class="overflow-y-scroll max-h-48 px-8 bg-[#fafafa] rounded">
                <?php foreach ($products as $product): ?>
                    <div class="grid grid-cols-[20px_1fr_40px] gap-2 items-center my-2">
                        <div>
                            <input type="checkbox" aria-label="none"/>
                        </div>
                        <div class="flex flex-row items-center gap-2">
                            <img class="w-[40px]" src="<?= esc_url(get_the_post_thumbnail_url($product->ID, 'thumbnail')); ?>"/>
                            <label><?= esc_html($product->post_title); ?></label>
                        </div>
                        <div class="">
                            <input class="w-[60px]" type="number"/>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="my-4">
                <label><?= __('Coupon','wc-payment-link'); ?></label>
                <div>
                    <input class="w-full h-10 bg-white outline-0 border-none shadow-md rounded-md" aria-label="none" type="text" id="coupon" name="coupon">
                </div>
            </div>
        </div>
        <div>
            <button class="w-[120px] float-right text-white h-10 bg-blue-600 outline-0 mt-[20px] border-none shadow-md rounded-md hover:bg-[#316beb]"><?= __('Save','wc-payment-link'); ?></button>
        </div>
    </div>
</div>
