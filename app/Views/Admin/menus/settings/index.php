<?php
/**
 * template: wp-content/plugins/wc-plugin-template/app/Views/Admin/settings/index.php
 */

$links = [
    [
        'name' => 'Teste',
        'cart_items' => 2,
        'expire_at' => '10/02/2023',
        'token' => 'a21f4ab5-2293-44fb-8df0-25393cbe8e77',
        'cart_total' => 100.00
    ],
    [
        'name' => 'Teste',
        'cart_items' => 2,
        'expire_at' => '10/02/2023',
        'token' => 'a21f4ab5-2293-44fb-8df0-25393cbe8e77',
        'cart_total' => 100.00
    ]
];
?>
<div class="wrap wpl-wrap px-8">
    <div class="my-4 flex align-middle">
        <h1 id="table-desc" class="text-3xl"><?= __('Payment Links', 'wc-payment-link'); ?></h1>
        <button id="" class="ml-4 p-8 pt-1 pb-1 bg-blue-600 text-white rounded justify-center hover:bg-[#316beb]">
            <?= __('New payment link', 'wc-payment-link'); ?>
        </button>
    </div>
    <hr class="mb-5"/>
    <div class="mb-5 w-1/2">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search"
                   name="search"
                   id="default-search"
                   class="block w-full !p-4 !ps-10 !text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="<?= __('Search for links', 'wc-payment-link'); ?>"
                   value="<?=esc_attr($search)?>"
            >
        </div>
        </form>
    </div>
    <div  class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table aria-describedby="table-desc" class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <?= __('Link Name', 'wc-payment-link'); ?>
                </th>
                <th scope="col" class="px-6 py-3">
                    <?= __('Cart Items', 'wc-payment-link'); ?>
                </th>
                <th scope="col" class="px-6 py-3">
                    <?= __('Expire at', 'wc-payment-link'); ?>
                </th>
                <th scope="col" class="px-6 py-3">
                    <?= __('Token', 'wc-payment-link'); ?>
                </th>
                <th scope="col" class="px-6 py-3">
                    <?= __('Cart Total', 'wc-payment-link'); ?>
                </th>
                <th scope="col" class="px-6 py-3">
                    <?= __('Actions', 'wc-payment-link'); ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($links as $link): ?>
                <tr class="bg-white hover:bg-gray-100 border-b">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        <?= esc_html($link['name']) ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= esc_html($link['cart_items']) ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= esc_html($link['expire_at']) ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= esc_html($link['token']) ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= esc_html($link['cart_total']) ?>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 no-underline"><?= __('Edit', 'wc-payment-link'); ?></a>
                        <span>|</span>
                        <a href="#" class="font-medium text-blue-600 no-underline"><?= __('Remove', 'wc-payment-link'); ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($pagination['pages'] > 1) : ?>
        <div>
            <nav aria-label="Page navigation example" class="mt-4 shadow-md rounded-md float-right">
                <ul class="inline-flex -space-x-px text-base h-10">
                    <li>
                        <a class="ml-0 rounded-l-lg wp-atlas-pagination" data-page="<?= $pagination['page'] - 1 ?: 1 ?>">
                            Anterior
                        </a>
                    </li>
                    <?php for($i = 1; $i <= $pagination['pages']; $i++): ?>
                        <li>
                            <a class="wp-atlas-pagination" data-page="<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <li>
                    <li>
                        <a class="rounded-r-lg wp-atlas-pagination" data-page="<?= min( $pagination['page'] + 1, $pagination['pages']) ?>">
                            Próxima
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php endif; ?>
</div>
