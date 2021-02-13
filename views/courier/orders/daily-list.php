<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "Kunli Buyurtmalar";

$rand = array_rand($orders);
// debug($orders[$rand]['datetime']); die;
$date = date('d', strtotime($orders[$rand]['datetime'])) . ' ' . getUzMonth(date('M', strtotime($orders[$rand]['datetime'])));

?>
<!-- BEGIN: Content -->
    <a href="<?= Url::to('/courier/orders/monthly-list')?>" class="button back-button w-full flex items-center justify-center bg-gray-200 mb-4"> <i data-feather="corner-up-left" class="mr-2 w-4 h-4"></i> Oylarga qaytish </a>
    <div class="content orders-list">
        <div id="1" class="day-list">
            <div class="pb-2 py-5 date-daily-list">
                <h2 class="font-medium"><?= $date?></h2>
                <p class="text-gray-600 mt-1 mb-3">Bu <?= $date?> uchun buyurtmalar, ularni ko'rib chiqishingiz va keyinroq qaytarib berilgan bo'lsa, mahsulotni qaytarishingiz mumkin.</p>
            </div>
            <div class="all-orders">
            <?php
            foreach ($orders as $order) {
                $order_date = date('d M', strtotime($order['datetime']));

                // Explode name on values
                $product_qty = explode(':', $order['product']);
                $product_format_qty['qty'] = $product_qty[1];
                $product_format_qty['info'] = explode(',', $product_qty[0]);
                $label_style = '';
                $label_text = '';
                if ($order['status'] == 'delivered') {
                    $label_style = 'not-late';
                    $label_text = 'Yetkazilgan';
                }
                if ($order['status'] == 'not-delivered') {
                    $label_style = 'becoming-late';
                    $label_text = 'Yetkazilmagan';
                }
                if ($order['status'] == 'canceled') {
                    $label_style = 'late';
                    $label_text = 'Qaytarvorgan';
                }
                ?>
                <div class="intro-y box md:text-xl order-card pb-0 px-0 pt-1 mb-4">
                    <div class="flex items-center card-section px-3 md:px-5 pt-2 md:pt-3">
                        <h2 class="order-card__title"><?= $product_format_qty['info'][1] . ' <span style="text-decoration: underline">' . $product_format_qty['info'][2] . '</span>, ' . $product_format_qty['qty'] . ' dona'?></h2>
                    </div>
                    <div class="flex border-b card-section px-3 md:px-5 pb-2 md:pb-3">
                        <p class="order-card__price"><?= $order['price']?> so'm</p>
                        <p class="order-card__payment-method ml-3 text-gray-500">
                            <?= payment_method_format($order['payment_method'])?>
                        </p>
                    </div>
                    <div class="border-b card-section user-info px-3 md:px-5 py-3 md:py-3">
                        <div class="name-address">
                        <div class="flex">
                            <p class="order-card__name"><?= $order['name']?></p>
                            <p class="order-card__payment-method ml-3 text-gray-500">ID: <?= $order['client_id']?></p>
                        </div>
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
                                <p class="text-gray-500">Shu mahsulot: </p>
                                <div class="order-card__time-left font-medium flex items-0 text-white flex justify-center items-center <?= $label_style?> p-1 px-2">
                                    <?= $label_text?>
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
                </div>
                <?php
            }
            ?>
            </div>
        </div>
    </div>
    <!-- END: Content -->