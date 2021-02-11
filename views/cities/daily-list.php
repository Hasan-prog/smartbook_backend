<?php

use yii\helpers\Html;
use yii\helpers\Url;
//$articleName и $articleAlias передаем из экшена
if ($city != '') {
    $this->params['breadcrumbs'][] = array(
        'label'=> $city, 
        'url'=>URL::to(['cities/monthly-list' . $courier_routing . '?city=' . $city_id . '&courier=' . $courier_id]),
    );
}
if ($courier['name'] != '') {
    $this->params['breadcrumbs'][] = array(
        'label'=> $courier['name'], 
        'url'=>URL::to(['cities/monthly-list' . $courier_routing . '?city=' . $city_id . '&courier=' . $courier_id]),
    );
}
$this->params['breadcrumbs'][] = array(
    'label'=> date('d M, Y', strtotime($date)) . ' yil', 
    'url'=>'#',
    'template' => "{link}",
);


$this->title = "Smartbook DMS – " . date('d M, Y', strtotime($date));

?>

<div class="flex mt-5">
<a href="">
        <div class="courier-card mr-4 courier-card-active <?= $courier['id']?>">
            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table class="table table-report sm:mt-2 lg:col-span-6">
                    <tbody>
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="image-fit profile-image-row">
                                    <img alt="" class="rounded-full" src="<?= $courier['photo']?>"
                                        style="box-shadow: none">
                                </div>
                            </td>
                            <td>
                                <span href=""
                                    class="text-gray-500 whitespace-no-wrap"><?= $city?></span>
                                <br>
                                <span href="" class="font-medium whitespace-no-wrap"><?= $courier['name']?></span>
                                <div class="text-gray-600 text-xs whitespace-no-wrap"><?= $courier['phone_number']?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </a>
</div>

<!-- BEGIN: Striped Rows -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto">
            <?= date('d M, Y', strtotime($date))?> yil
        </h2>
        <div class="flex text-gray-700">
            <div class="mr-6 flex items-center">
                <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> <?= $delivered_qty?> Yetkazilgan
            </div>
            <div class="mr-6 flex items-center">
                <div class="w-2 h-2 bg-theme-12 rounded-full mr-2"></div> <?= $not_delivered_qty?> Yetkazilmagan
            </div>
            <div class="mr-6 flex items-center">
                <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> <?= $canceled_qty?> Qaytarilgan
            </div>
            <div class="mr-6 flex items-center border-l pl-6">
                <span class="text-gray-500 mr-2">Naqd:</span> <?= $cash?> so'm
            </div>
            <div class="mr-6 flex items-center">
                <span class="text-gray-500 mr-2">Click:</span> <?= $click?> so'm
            </div>
            <div class="mr-6 flex items-center border-l pl-6">
                <span class="text-gray-500 mr-2">Umumiy:</span> <?= $overall?> so'm
            </div>
        </div>
        <button class="button px-2 mr-1 text-gray-700 bg-gray-200 dark:text-gray-300 collapse-accounting-info">
            <span class="w-5 h-5 flex items-center justify-center"> 
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="10" stroke="#4A5568" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <line x1="12.0249" y1="10.494" x2="12.0249" y2="18.2678" stroke="#4A5568" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="11.9997" cy="6.76183" r="0.952381" fill="#4A5568"/>
            </svg>
            </span>
        </button>
    </div>
    <div class="accounting-info">
        <div class="grid grid-cols-12 gap-6 p-10 border-b bg-gray-100 border-gray-200">
        <div class="col-span-12 sm:col-span-4 xl:col-span-3 intro-y">
            <div class="text-md font-medium truncate mb-5">Buyurtmalar</div>
            <div class="mr-6 flex items-center mb-3 border-b pb-3">
                <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> <span class="info-delivered mr-1"><?= $delivered_qty?></span> Yetkazilgan
            </div>
            <div class="mr-6 flex items-center mb-3 border-b pb-3">
                <div class="w-2 h-2 bg-theme-12 rounded-full mr-2"></div> <span class="info-not-delivered mr-1"><?= $not_delivered_qty?></span> Yetkazilmagan
            </div>
            <div class="mr-6 flex items-center mb-3 border-b pb-3">
                <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> <span class="info-canceled mr-1"><?= $canceled_qty?></span> Qaytarilgan
            </div>
            <div class="mr-6 flex items-center mb-3">
                <div class="w-2 h-2 bg-theme-11 rounded-full mr-2"></div> <span class="info-overall mr-1"><?= $delivered_qty + $not_delivered_qty + $canceled_qty?></span> Buyurtma
            </div>
        </div>
        <div class="col-span-12 sm:col-span-4 xl:col-span-3 intro-y">
            <div class="text-md font-medium truncate mb-5 flex justify-between">
            To'lov ma'lumot
            </div>
            <div class="mr-6 flex items-center mb-3 border-b pb-3">
                <span class="text-gray-500 mr-2">Naqd:</span> <?= $cash?> so'm
            </div>
            <div class="mr-6 flex items-center mb-3 border-b pb-3">
                <span class="text-gray-500 mr-2">Click:</span> <?= $click?> so'm
            </div>
            <div class="mr-6 flex items-center mb-3">
                <span class="text-gray-500 mr-2">Umumiy:</span> <?= $overall?> so'm
            </div>
        </div>
        <div class="col-span-12 sm:col-span-4 xl:col-span-3 intro-y">
            <div class="text-md font-medium truncate mb-5 flex justify-between">
            Bugalteriya
            <span class="date text-gray-500 font-normal flex"><i data-feather="calendar" class="w-4 h-4 mr-2"></i><?= date('d M, Y', strtotime($date))?> yil</span>
            </div>
            <div class="mr-6 flex items-center mb-3 border-b pb-3">
                <span class="text-gray-500 mr-2">Berilgan:</span> <span class="accounting-paid mr-1"><?= $accounting_paid?></span> so'm
            </div>
            <div class="mr-6 flex items-center mb-3 border-b pb-3">
                <span class="text-gray-500 mr-2">Olish kerak:</span> <span class="accounting-debt mr-1"><?= $accounting_debt?></span> so'm
            </div>
            <div class="mr-6 flex items-center mb-3">
                <span class="text-gray-500 mr-2"><?= $courier['name']?>dan shu kundan <span class="accounting-debt-2 mr-1"><?= $accounting_debt?></span> so'm olishimiz kerak. Qo'ngiroq qilishiz boladi: <a class="underline text-gray-600" href="tel:<?= $courier['phone_number']?>"><?= $courier['phone_number']?></a></span>
            </div>
        </div>
        </div>
    </div>
    <div class="p-5" id="striped-rows-table">
        <div class="filters mb-6">
            <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Qidirmoq</label>
                    <input data-element="order-row" type="text" class="input w-full sm:w-40 xxl:w-full mt-2 sm:mt-0 border filter-search"
                        id="tabulator-html-filter-value" placeholder="Kunli info">
                </div>
            </form>
        </div>
        <div class="preview" style="display: block; opacity: 1;">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">ID</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Ism</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Mahsulot</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Mazil</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Telefon</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Narx</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">To'lov turi</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Sharh</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Operator</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Berilgan vaqt</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right">Status va Bugalteriya</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($orders as $order) {
                            if ($order['courier_id'] == $courier_id) {
                                // Explode name on values
                                $product_qty = explode(':', $order['product']);
                                $product_format_qty['qty'] = $product_qty[1];
                                $product_format_qty['info'] = explode(',', $product_qty[0]);
                                ?>
                                <tr class="order-row">
                                    <td class="border-b dark:border-dark-5"><?= $order['id']?></td>
                                    <td class="border-b dark:border-dark-5"><?= $order['name']?></td>
                                    <td class="border-b dark:border-dark-5"><?= $product_format_qty['info'][1] . ' ' . $product_format_qty['info'][2] . ', ' . $product_format_qty['qty'] . ' dona'?></td>
                                    <td class="border-b dark:border-dark-5"><?= $order['address']?></td>
                                    <td class="border-b dark:border-dark-5">
                                        <?php 
                                        foreach (explode(',', $order['phone_number']) as $phone_number) {
                                            ?>
                                                <a href="tel:<?= $phone_number?>"><?= $phone_number?></a>, 
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="border-b dark:border-dark-5"><?= price_format($order['price'])?> so'm</td>
                                    <td class="border-b dark:border-dark-5"><?= payment_method_format($order['payment_method']);?></td>
                                    <td class="border-b dark:border-dark-5"><?= $order['comment']?></td>
                                    <td class="border-b dark:border-dark-5"><?= isset($order['operator']) ? $order['operator']['name'] : ''?></td>
                                    <td class="border-b dark:border-dark-5"><?= date('Y-m-d H:i', strtotime($order['datetime']))?></td>
                                    <td class="border-b dark:border-dark-5 flex justify-end">
                                        <div class="dropdown flex justify-end status-dropdown"> 
                                        <?php
                                            if ($order['status'] == 'delivered') {
                                                ?>
                                                <button id="<?= $order['id']?>" data-price="<?= $order['price']?>" data-order-str="<?= $order['product']?>" data-courier-id="<?= $courier_id?>" data-status="delivered" data-style="bg-theme-9" class="dropdown-toggle button button--sm inline-block bg-theme-9 text-white flex items-center w-32 justify-center">Yetkazilgan <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                                                <div class="dropdown-box w-32">
                                                    <div class="dropdown-box__content box dark:bg-dark-1"> 
                                                        <button data-id="<?= $order['id']?>" data-price="<?= $order['price']?>" data-order-str="<?= $order['product']?>" data-courier-id="<?= $courier_id?>" data-status="not-delivered" data-style="bg-theme-12" class="button button--sm inline-block bg-theme-12 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Yetkazilmagan</button>
                                                        <button data-id="<?= $order['id']?>" data-price="<?= $order['price']?>" data-order-str="<?= $order['product']?>" data-courier-id="<?= $courier_id?>" data-status="canceled" data-style="bg-theme-6" class="button button--sm inline-block bg-theme-6 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Qaytarilgan</button>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            if ($order['status'] == 'not-delivered') {
                                                ?>
                                                <button id="<?= $order['id']?>" data-price="<?= $order['price']?>" data-order-str="<?= $order['product']?>" data-courier-id="<?= $courier_id?>" data-status="not-delivered" data-style="bg-theme-12" class="dropdown-toggle button button--sm inline-block bg-theme-12 text-white flex items-center w-32 justify-center">Yetkazilmagan <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                                                <div class="dropdown-box w-32">
                                                    <div class="dropdown-box__content box dark:bg-dark-1"> 
                                                        <button data-id="<?= $order['id']?>" data-price="<?= $order['price']?>" data-order-str="<?= $order['product']?>" data-courier-id="<?= $courier_id?>" data-status="delivered" data-style="bg-theme-9" class="button button--sm inline-block bg-theme-9 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Yetkazilgan</button>
                                                        <button data-id="<?= $order['id']?>" data-price="<?= $order['price']?>" data-order-str="<?= $order['product']?>" data-courier-id="<?= $courier_id?>" data-status="canceled" data-style="bg-theme-6" class="button button--sm inline-block bg-theme-6 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Qaytarilgan</button>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            if ($order['status'] == 'canceled') {
                                                ?>
                                                <button id="<?= $order['id']?>" data-price="<?= $order['price']?>" data-order-str="<?= $order['product']?>" data-courier-id="<?= $courier_id?>" data-status="canceled" data-style="bg-theme-6" class="dropdown-toggle button button--sm inline-block bg-theme-6 w-32 text-white flex items-center justify-center">Qaytarilgan <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                                                <div class="dropdown-box w-32">
                                                    <div class="dropdown-box__content box dark:bg-dark-1"> 
                                                        <button data-id="<?= $order['id']?>" data-price="<?= $order['price']?>" data-order-str="<?= $order['product']?>" data-courier-id="<?= $courier_id?>" data-status="not-delivered" data-style="bg-theme-12" class="button button--sm inline-block bg-theme-12 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Yetkazilmagan</button>
                                                        <button data-id="<?= $order['id']?>" data-price="<?= $order['price']?>" data-order-str="<?= $order['product']?>" data-courier-id="<?= $courier_id?>" data-status="delivered" data-style="bg-theme-9" class="button button--sm inline-block bg-theme-9 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Yetkazilgan</button>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                        </div>
                                        <button data-id="<?= $order['id']?>" data-price="<?= $order['price']?>" data-accounting="<?= $order['accounting']?>" data-accounting-done="0" class="button button--sm inline-block <?= $order['accounting'] == 0 ? 'bg-theme-6' : 'bg-theme-9'?> text-white flex items-center w-24 justify-center ml-2 accounting-toggle"><?= $order['accounting'] == 0 ? 'Berilmagan' : 'Berilgan'?></button>
                                    </td>
                                    <td class="border-b dark:border-dark-5 md:w-80">
                                        <div class="flex items-center justify-center">
                                            <a class="flex items-center mr-5" href="<?= Url::to(['order/edit-order?id=' . $order['id']])?>"> <i class="w-4 h-4 mr-2"
                                                    data-feather="edit"></i> Ozgartirish </a>
                                            <a class="flex items-center text-theme-6 delete-subject" href="" data-url="<?= Url::to('/cities/daily-list')?>" data-id="<?= $order['id']?>" data-parent="order-row" data-msg="Ushbu buyurtmani o'chirmoqchimisiz?"> <i class="w-4 h-4 mr-2"
                                                    data-feather="trash-2"></i> O'chirish </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END: Striped Rows -->