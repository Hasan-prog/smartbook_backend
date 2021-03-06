<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "Hozirgi Buyurtmalar";

?>

<div class="select-district">
    <div class="inline-block back-button districts-button w-full items-center justify-center bg-gray-200 mb-4"> <a href="javascript:;"
            data-collapse="closed" class="accordion__pane__toggle font-medium block collapse-districts">Manzilni
            tanlang</a>
        <div class="districts-list">
        <div class="seperator mb-2"></div>
            <?php
            foreach ($dstr_arr as $district) {
                ?>
                <a href="#" data-id="<?= $district['id']?>" data-name="<?= $district['name']?>" class="list-option">
                    <?= $district['name']?>
                    <svg class="ml-2 w-5 h-5 text-theme-1 inline ml-1 hidden" width="24" height="17" viewBox="0 0 24 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 7.5L9 15L23 1" stroke="#09389D" stroke-width="2"/>
                    </svg>
                    <span class="qty"><?= $district['qty']?></span>
                </a>
                <?php
            }
            ?>
            <?php
            if ($no_dstr_orders > 0) {
                ?>
                <a href="#" class="list-option others mt-2">
                    Barchasi
                    <span class="qty"><?= $no_dstr_orders?></span>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="content orders-list">
    <?php
    $today = date('d M');
    $used_days = [];
    $i = 1;
foreach ($d_arr as $d) {
    
     if (!in_array($d['day'], $used_days)) {
    ?>
    <div id="<?= $i?>" class="day-list">
        <a href="<?= Url::to('/courier/orders/daily-list?d=' . date('Y-m-d', strtotime($d['datetime'])))?>">
            <div class="flex pt-4 pb-2 md:pb-4 pd:pt-5 orders-list-header">
                <h2 class="font-medium md:text-2xl mr-auto"><?= $d['day'] . ' ' . getuzmonth($d['month'])?></h2>
            </div>
        </a>
        <div class="all-orders">
            <?php
                foreach ($orders as $order) {
                    $order_date = date('d M', strtotime($order['datetime']));
                    $time_left = round(((strtotime($order['datetime']) + 172800) - time()) / 60 / 60);
                    $label_style = 'not-late';

                    // Explode name on values
                    $product_qty = explode(':', $order['product']);
                    $product_format_qty['qty'] = $product_qty[1];
                    $product_format_qty['info'] = explode(',', $product_qty[0]);

                    if ($time_left < 12) {
                        $label_style = 'late';
                    }
                    if ($time_left > 12 && $time_left < 24) {
                        $label_style = 'becoming-late';
                    }
                    if ($order_date == $d['day'] . ' ' . $d['month']) {
                    ?>
            <div class="intro-y box md:text-xl pb-0 px-0 pt-1 mb-4 order-card" data-district="<?= $order['district_id']?>">
                <div class="flex items-center card-section px-3 md:px-5 pt-2 md:pt-3">
                    <h2 class="order-card__title">
                        <?= $product_format_qty['info'][1] . ' <span style="text-decoration: underline">' . $product_format_qty['info'][2] . '</span>, ' . $product_format_qty['qty'] . ' dona'?>
                    </h2>
                    <button style="margin-left: auto" class="button px-2 text-gray-700 bg-gray-200 dark:text-gray-300 open-note">
                        <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="message-circle" class="w-5 h-5"></i>
                        </span>
                    </button>
                </div>
                <div class="flex border-b card-section px-3 md:px-5 pb-2 md:pb-3">
                    <p class="order-card__price"><?= $order['price']?> so'm</p>
                    <p class="order-card__payment-method ml-3 text-gray-500">
                        <?= payment_method_format($order['payment_method'])?>
                    </p>
                </div>
                <div class="border-b card-section card-note <?= $order['comment'] == '' ? 'hidden' : ''?>">
                    <input class="px-3 md:px-5 py-3 md:py-3" type="text" data-id="<?= $order['id']?>" value="<?= $order['comment']?>" placeholder="Sizning eslatmangiz...">
                </div>
                <div class="border-b card-section user-info px-3 md:px-5 py-3 md:py-3">
                    <div class="name-address">
                        <div class="flex">
                            <p class="order-card__name flex-1"><?= $order['name']?></p>
                            <p class="order-card__payment-method ml-3 text-gray-500">ID: <?= $order['client_id']?></p>
                        </div>
                        <div class="flex">
                            <p class="order-card__address"><?= $order['address']?></p>
                            <?php
                                if (isset($order['district']['name'])) {
                                    $dstr_name = $order['district']['name'];
                                } else {
                                    $dstr_name = '';
                                }
                            ?>
                            <p class="order-card__payment-method text-gray-500 ml-3"><?= $dstr_name?></p>
                        </div>
                    </div>
                    <div class="flex mt-2 order-card__phone">
                        <?php
                    $phone_numbers = explode(',', $order['phone_number']);
                    foreach ($phone_numbers as $phone_number) {
                    ?>
                        <a href="tel:<?= $phone_number?>"
                            class="button flex items-center justify-center bg-gray-200 text-gray-600 ml-3"><i
                                class="w-4 h-4 mr-2" data-feather="phone-call"></i> <?= $phone_number?> </a>
                        <?php
                    }
                    ?>
                    </div>
                </div>
                <div class="card-section px-3 md:px-5 pt-3 md:pt-3 pb-5 md:pb-5">
                    <div class="flex items-center">
                        <div class="time-left">
                            <p class="text-gray-500">Yetkazish kerak: </p>
                            <div
                                class="order-card__time-left font-medium flex items-0 text-white flex justify-center items-center <?= $label_style?> p-1 px-2">
                                <i class="w-4 h-4 mr-2" data-feather="truck"></i> <?= $time_left?> soat
                            </div>
                        </div>
                        <div class="time text-right ml-auto">
                            <p class="text-gray-500">Berilgan vaqt:</p>
                            <?php
                            $order_d = date('d', strtotime($order['datetime']));
                            $order_m = getUzMonth(date('M', strtotime($order['datetime'])));
                            $order_y = date('Y', strtotime($order['datetime']));
                            $order_hm = date('h:i', strtotime($order['datetime']));
                            ?>
                            <p class="order-card__placed">
                                <?= $order_d . ' ' . $order_m . ' ' . $order_y . ' – ' . $order_hm?></p>
                        </div>
                    </div>
                </div>
                <div class="card-section card-actions flex">
                    <button data-id="<?= $order['id']?>" data-district="<?= $order['district_id']?>" data-courier="<?= $order['courier_id']?>"
                        data-order-str="<?= $order['product']?>"
                        class="button w-1/2 bg-theme-9 text-white delivered">Yetkazildi</button>
                    <button data-id="<?= $order['id']?>" data-district="<?= $order['district_id']?>" data-courier="<?= $order['courier_id']?>"
                        data-order-str="<?= $order['product']?>"
                        class="button w-1/2 bg-theme-6 text-white canceled">Qaytarildi</button>
                </div>
            </div>
            <?php
                }
            }
                ?>
        </div>
    </div>
    <?php
    $used_days[$d['day']] = $d['day'];
    $i++;
     }
     
}
?>
</div>