<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "Hozirgi Buyurtmalar";

?>

<div class="select-district">
    <div class="inline-block back-button w-full items-center justify-center bg-gray-200 mb-4"> <a href="javascript:;"
            data-collapse="closed" class="accordion__pane__toggle font-medium block collapse-districts">Manzilni
            tanlang</a>
        <div class="districts-list">
        <div class="seperator"></div>
            <?php
            foreach ($dstr_arr as $district) {
                ?>
                <a href="#" data-id="<?= $district['id']?>" data-name="<?= $district['name']?>" class="list-option">
                    <?= $district['name']?>
                    <span class="qty"><?= $district['qty']?></span>
                </a>
                <?php
            }
            ?>
            <?php
            if ($no_dstr_orders > 0) {
                ?>
                <a href="#" class="list-option others mt-2">
                    Hammalar
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
        <div class="flex pt-4 pb-2 md:pb-4 pd:pt-5 orders-list-header">
            <h2 class="font-medium md:text-2xl mr-auto"><?= $d['day'] . ' ' . getuzmonth($d['month'])?></h2>
            <?php
                if ($today == $d['day'] . ' ' . $d['month']) {
                    ?>
            <!-- <h2 class="font-medium text-gray-500 md:text-2xl ml-auto">Bugunli Buyurtmalar</h2> -->
            <?php
                }
            ?>
        </div>
        <div class="all-orders">
            <?php
                foreach ($orders as $order) {
                    $order_date = date('d M', strtotime($order['datetime']));
                    $time_left = round(((strtotime($order['datetime']) + 154800) - time()) / 60 / 60);
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
            <div class="intro-y box md:text-xl order-card pb-0 px-0 pt-1 mb-4 order-card" data-district="<?= $order['district_id']?>">
                <div class="flex items-center card-section px-3 md:px-5 pt-2 md:pt-3">
                    <h2 class="order-card__title">
                        <?= $product_format_qty['info'][1] . ' ' . $product_format_qty['info'][2] . ', ' . $product_format_qty['qty'] . ' dona'?>
                    </h2>
                    <!-- <p class="order-card__qty ml-3 text-gray-500">1 ta dona</p> -->
                </div>
                <div class="flex border-b card-section px-3 md:px-5 pb-2 md:pb-3">
                    <p class="order-card__price"><?= $order['price']?> so'm</p>
                    <p class="order-card__payment-method ml-3 text-gray-500">
                        <?= payment_method_format($order['payment_method'])?></p>
                </div>
                <div class="border-b card-section user-info px-3 md:px-5 py-3 md:py-3">
                    <div class="name-address">
                        <p class="order-card__name"><?= $order['name']?></p>
                        <p class="order-card__address"><?= $order['address']?></p>
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
                    <button data-id="<?= $order['id']?>" data-courier="<?= $order['courier_id']?>"
                        data-order-str="<?= $order['product']?>"
                        class="button w-1/2 bg-theme-9 text-white delivered">Yetkazilgan</button>
                    <button data-id="<?= $order['id']?>" data-courier="<?= $order['courier_id']?>"
                        data-order-str="<?= $order['product']?>"
                        class="button w-1/2 bg-theme-6 text-white canceled">Qaytarilgan</button>
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