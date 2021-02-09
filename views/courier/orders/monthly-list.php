<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "Oyli Buyurtmalar";

?>
    <!-- BEGIN: Content -->
    <div class="content">
        <div class="filters mb-2 py-4">
            <form class="xl:flex md:mr-auto" id="tabulator-html-filter-form">
                <div class="md:flex items-center">
                    <label class="w-full flex-1 xl:w-auto xl:flex-initial mr-2">Oyni tanlang</label>
                    <select class="input w-full border col-span-4 move-month" name="worker_id" id="tabulator-html-filter-field">
                        <?php
                        $i = 0;
                        foreach ($months_list as $month_option) {
                            $month_info_arr = explode(',', $month_option);
                            $month_i = date_parse($month_info_arr[0])['month'];
                            if (strlen($month_i) == 1) {
                                $month_i = 0 . $month_i;
                            }
                            ?>
                            <option data-id="<?= $month_i?>" value="<?= $month_option?>"><?= $month_option?></option>
                            <?php
                            $i++;
                        }
                        ?>
                    </select>
                </div>
            </form>
        </div>
        <?php
        foreach ($months as $month) {
            $random_order = array_rand($month);
            $month_name = date('M', strtotime($month[$random_order]['datetime']));
            $month_i = date('m', strtotime($month[$random_order]['datetime']));
            $year_i = date('Y', strtotime($month[$random_order]['datetime']));
            ?>
            <!-- BEGIN: Striped Rows -->
            <div class="box" id="<?= $month_i?>">
                <div class="flex flex-col md:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium mr-auto">
                        <?= getUzMonth($month_name)?>, <?= date('Y', strtotime($month[$random_order]['datetime']))?> yil
                    </h2>
                </div>
                <div class="text-gray-700 month-info px-5 py-4">
                    <div class="flex items-center py-2">
                        <div class="w-2 h-2 bg-theme-12 rounded-full mr-2"></div> 490 Umumiy
                    </div>
                    <div class="flex items-center py-2">
                        <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> 0 Qaytarilgan
                    </div>
                    <div class="flex items-center py-2">
                        <span class="text-gray-500 mr-2">Naqd:</span> 274 561 000 so'm
                    </div>
                    <div class="flex items-center py-2">
                        <span class="text-gray-500 mr-2">Click:</span> 22 663 000 so'm
                    </div>
                    <div class="flex items-center py-2">
                        <span class="text-gray-500 mr-2">Umumiy:</span> 297 224 000 so'm
                    </div>
                </div>
                <div class="" id="striped-rows-table">
                    <div class="preview" style="display: block; opacity: 1;">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 w-16 dark:border-dark-4 whitespace-no-wrap">Sana</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Sotish</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Naqd</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Click</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Umumiy</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $days_qty = date('t', strtotime($month[$random_order]['datetime']));
                                while ($days_qty > 0) {
                                    // Count daily stats
                                    $delivered_qty = 0;
                                    $not_delivered_qty = 0;
                                    $canceled_qty = 0;
                                    $overall_qty = 0;
                                    $cash = 0;
                                    $click = 0;
                                    $loop_day = '';
                                    $year = '';
                                    foreach ($month as $order) {
                                        if ($days_qty == cutDay($order['datetime'])) {
                                            $loop_day = cutDay($order['datetime']);
                                            $overall_qty++;
                                            if ($order['status'] == 'delivered') {
                                                $delivered_qty++;
                                            } else if ($order['status'] == 'not-delivered') {
                                                $not_delivered_qty++;
                                            } else if ($order['status'] == 'canceled') {
                                                $canceled_qty++;
                                            }
                                            if ($order['payment_method'] == 'cash') {
                                                $cash += $order['price'];
                                                $payment_label = 'Naqd';
                                            } else {
                                                $click += $order['price'];
                                                $payment_label = 'Click';
                                            }
                                        }
                                    }
                                    if ($days_qty == $loop_day) {
                                        ?>
                                        <tr class="cursor-pointer" onclick="window.location.href = '<?= Url::to('/courier/orders/daily-list?d=' . date('Y-m-d', strtotime($loop_day . '-' . $month_i . '-' . $year_i)))?>';">
                                            <td class="border-b dark:border-dark-5 font-medium"><?= $loop_day?>
                                        <?= date('M', strtotime($order['datetime']))?></td>
                                            <td class="border-b dark:border-dark-5">
                                                <div class="flex text-gray-700">
                                                    <div class="mr-6 flex items-center">
                                                        <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> <?= $delivered_qty?> Yetkazildi
                                                    </div>
                                                    <div class="mr-6 flex items-center">
                                                        <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> <?= $canceled_qty?> Qaytargan
                                                    </div>
                                                    <div class="mr-6 flex items-center">
                                                        <div class="w-2 h-2 bg-theme-12 rounded-full mr-2"></div> <?= $overall_qty?> Umumiy
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-b dark:border-dark-5"><?= price_format($cash)?> so'm</td>
                                            <td class="border-b dark:border-dark-5"><?= price_format($click)?> so'm</td>
                                            <td class="border-b dark:border-dark-5"><?= price_format($cash + $click)?> so'm</td>
                                            <td class="border-b dark:border-dark-5">
                                                <div class="flex items-center justify-center">
                                                    <a class="flex items-center mr-5" href="<?= Url::to('/courier/orders/daily-list?d=' . date('Y-m-d', strtotime($loop_day . '-' . $month_i . '-' . $year_i)))?>"> <i
                                                            class="w-4 h-4 mr-2" data-feather="list"></i> Xaridlar </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                            <tr class="cursor-pointer" onclick="window.location.href = '<?= Url::to('/courier/orders/daily-list?d=' . date('Y-m-d', strtotime($days_qty . '-' . $month_i . '-' . $year_i)))?>';">
                                                <td class="border-b dark:border-dark-5 font-medium"><?= $days_qty?>
                                        <?= date('M', strtotime($order['datetime']))?></td>
                                                <td class="border-b dark:border-dark-5">
                                                    <div class="flex text-gray-700">
                                                        <div class="mr-6 flex items-center">
                                                            <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> 0 Yetkazildi
                                                        </div>
                                                        <div class="mr-6 flex items-center">
                                                            <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> 0 Qaytargan
                                                        </div>
                                                        <div class="mr-6 flex items-center">
                                                        <div class="w-2 h-2 bg-theme-12 rounded-full mr-2"></div> 0 Umumiy
                                                    </div>
                                                    </div>
                                                </td>
                                                <td class="border-b dark:border-dark-5">0 so'm</td>
                                                <td class="border-b dark:border-dark-5">0 so'm</td>
                                                <td class="border-b dark:border-dark-5">0 so'm</td>
                                                <td class="border-b dark:border-dark-5">
                                                    <div class="flex items-center justify-center">
                                                        <a class="flex items-center mr-5" href="<?= Url::to('/courier/orders/daily-list?d=' . date('Y-m-d', strtotime($days_qty . '-' . $month_i . '-' . $year_i)))?>"> <i
                                                                class="w-4 h-4 mr-2" data-feather="list"></i> Xaridlar </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                    $days_qty--;
                                    continue;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Striped Rows -->
            <?php
        }
        ?>
    </div>
    <!-- END: Content -->