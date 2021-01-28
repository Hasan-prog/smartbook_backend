<?php

use yii\helpers\Html;
use yii\helpers\Url;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Shaharlar', 
    'url'=>URL::to(['cities/']),
);
$this->params['breadcrumbs'][] = array(
    'label'=> 'Toshekent', 
    'url'=>URL::to(['cities/monthly-list-courier']),
);
$this->params['breadcrumbs'][] = array(
    'label'=> 'Ulugbek Sobirov', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – " . $city['name'];

?>

<!-- BEGIN: Couriers -->
<div class="flex mt-5">
    <?php 
    foreach ($couriers as $courier) {
        ?>
    <a href="">
        <div class="courier-card mr-4 <?= $courier['id'] == $courier_id ? 'courier-card-active' : ''?>">
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
                                    class="text-gray-400 whitespace-no-wrap"><?= $courier['cities']['name']?></span>
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
    <?php
    }
    ?>
</div>
<!-- END: Couriers -->

<?php 
// Count monthly stats
$delivered_qty = 0;
$not_delivered_qty = 0;
$canceled_qty = 0;
$cash = 0;
$click = 0;

$orders_by_days = [];
foreach ($orders as $order) {
    $order_month = date('m', strtotime($order['datetime']));
    $order_day = date('d', strtotime($order['datetime']));
    if ($order_month == $current_month) {
        if (in_array($order_day, $current_month_days)) {
            $orders_by_days[cutDay($order['datetime'])] = $order;
        }
    }

    // Count monthly stats
    if (cutMonth($order['datetime']) == date('m')) {
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
// debug($orders_by_days);
?>

<!-- BEGIN: Striped Rows -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto"><?= date('M, Y')?> yil</h2>
        <div class="flex text-gray-700">
            <div class="mr-6 flex items-center">
                <div class="w-2 h-2 bg-theme-12 rounded-full mr-2"></div> <?= $delivered_qty + $not_delivered_qty?> Umumiy
            </div>
            <div class="mr-6 flex items-center">
                <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> <?= $canceled_qty?> Qaytargan
            </div>
            <div class="mr-6 flex items-center border-l pl-6">
                <span class="text-gray-500 mr-2">Naqd:</span> <?= price_format($cash)?> so'm
            </div>
            <div class="mr-6 flex items-center">
                <span class="text-gray-500 mr-2">Click:</span> <?= price_format($click)?> so'm
            </div>
            <div class="mr-6 flex items-center border-l pl-6">
                <span class="text-gray-500 mr-2">Umumiy:</span> <?= price_format($cash + $click)?> so'm
            </div>
        </div>
        <button class="button px-2 mr-1 text-gray-700 bg-gray-200 dark:text-gray-300">
            <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="minimize-2" class="w-5 h-5"></i>
            </span>
        </button>
    </div>
    <div class="p-5" id="striped-rows-table">
        <div class="filters mb-6">
            <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">
                <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Saralash</label>
                    <select class="input w-full border col-span-4" name="worker_id" id="tabulator-html-filter-field">
                        <option value="monthly">1 - 31</option>
                        <option value="yearly" selected="">31 - 1</option>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Qidirmoq</label>
                    <input type="text" class="input w-full sm:w-40 xxl:w-full mt-2 sm:mt-0 border"
                        id="tabulator-html-filter-value" placeholder="Kunli info">
                </div>
            </form>
        </div>
        <div class="preview" style="display: block; opacity: 1;">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>

                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Sana</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Sotish</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Naqd</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Click</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Umumiy</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php // Current month
                    foreach ($current_month_days as $day) {
                        if ($day == date('d')) {
                            ?>
                        <tr>
                            <td class="border-b dark:border-dark-5 font-medium"><?= $day?> <?= $current_month_word?>
                            </td>
                            <td class="border-b dark:border-dark-5"><span class="text-gray-500">Bugun...</span>
                            </td>
                            <td class="border-b dark:border-dark-5"><span class="text-gray-500">Bugun...</span>
                            </td>
                            <td class="border-b dark:border-dark-5"><span class="text-gray-500">Bugun...</span>
                            </td>
                            <td class="border-b dark:border-dark-5"><span class="text-gray-500">Bugun...</span>
                            </td>
                            <td class="border-b dark:border-dark-5 text-center">
                                <span class="text-gray-500">Bugun...</span>
                            </td>
                        </tr>
                        <?php
                        } else {
                            if (array_key_exists($day, $orders_by_days)) {
                                // Count stats
                                $delivered_qty = 0;
                                $not_delivered_qty = 0;
                                $canceled_qty = 0;
                                $cash = 0;
                                $click = 0;
                                $datetime = '';
                                
                                foreach ($orders as $order) {
                                    // debug(cutDay($order['datetime']) . ' / ' . $day);
                                    if (cutDay($order['datetime']) == $day) {
                                        $datetime = $order['datetime'];
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
                                ?>
                        <tr>
                            <td class="border-b dark:border-dark-5 font-medium"><?= $day?> <?= $current_month_word?>
                            </td>
                            <td class="border-b dark:border-dark-5">
                                <div class="flex text-gray-700">
                                    <div class="mr-6 flex items-center">
                                        <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> <?= $delivered_qty?>
                                        Yetkazildi
                                    </div>
                                    <div class="mr-6 flex items-center">
                                        <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> <?= $canceled_qty?>
                                        Qaytargan
                                    </div>
                                </div>
                            </td>
                            <td class="border-b dark:border-dark-5"><?= price_format($cash)?> so'm</td>
                            <td class="border-b dark:border-dark-5"><?= price_format($click)?> so'm</td>
                            <td class="border-b dark:border-dark-5"><?= price_format($cash + $click)?> so'm</td>
                            <td class="border-b dark:border-dark-5">
                                <div class="flex items-center justify-center">
                                    <a class="flex items-center mr-5" href="<?= $day?>"> <i class="w-4 h-4 mr-2"
                                            data-feather="list"></i> Xaridlar </a>
                                </div>
                            </td>
                        </tr>
                        <?php
                            } else {
                            ?>
                        <tr>
                            <td class="border-b dark:border-dark-5 font-medium"><?= $day?> <?= $current_month_word?>
                            </td>
                            <td class="border-b dark:border-dark-5">
                                <div class="flex text-gray-700">
                                    <div class="mr-6 flex items-center">
                                        <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> 0 Yetkazildi
                                    </div>
                                    <div class="mr-6 flex items-center">
                                        <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> 0 Qaytargan
                                    </div>
                                </div>
                            </td>
                            <td class="border-b dark:border-dark-5">0 so'm</td>
                            <td class="border-b dark:border-dark-5">0 so'm</td>
                            <td class="border-b dark:border-dark-5">0 so'm</td>
                            <td class="border-b dark:border-dark-5">
                                <div class="flex items-center justify-center">
                                    <a class="flex items-center mr-5" href="<?= $day?>"> <i class="w-4 h-4 mr-2"
                                            data-feather="list"></i> Xaridlar </a>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
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

<?php 
foreach ($months_with_orders as $month) {
    // Count monthly stats
    $delivered_qty = 0;
    $not_delivered_qty = 0;
    $canceled_qty = 0;
    $cash = 0;
    $click = 0;

    foreach ($month as $order) {
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

    $random_order = array_rand($month);
    $days_qty = date('t', strtotime($month[$random_order]['datetime']));
    ?>
<!-- BEGIN: Striped Rows -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto">
            <?= date('M, Y', strtotime($month[$random_order]['datetime']))?> yil
        </h2>
        <div class="flex text-gray-700">
            <div class="mr-6 flex items-center">
                <div class="w-2 h-2 bg-theme-12 rounded-full mr-2"></div> <?= $delivered_qty + $not_delivered_qty?> Umumiy
            </div>
            <div class="mr-6 flex items-center">
                <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> <?= $canceled_qty?> Qaytargan
            </div>
            <div class="mr-6 flex items-center border-l pl-6">
                <span class="text-gray-500 mr-2">Naqd:</span> <?= price_format($cash)?> so'm
            </div>
            <div class="mr-6 flex items-center">
                <span class="text-gray-500 mr-2">Click:</span> <?= price_format($click)?> so'm
            </div>
            <div class="mr-6 flex items-center border-l pl-6">
                <span class="text-gray-500 mr-2">Umumiy:</span> <?= price_format($cash + $click)?> so'm
            </div>
        </div>
        <button class="button px-2 mr-1 mb-2 text-gray-700 bg-gray-200 dark:text-gray-300">
            <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="maximize-2" class="w-5 h-5"></i>
            </span>
        </button>
    </div>
    <div class="p-5" id="striped-rows-table">
        <div class="filters mb-6">
            <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">
                <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Saralash</label>
                    <select class="input w-full border col-span-4" name="worker_id" id="tabulator-html-filter-field">
                        <option value="monthly">1 - 31</option>
                        <option value="yearly" selected="">31 - 1</option>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Qidirmoq</label>
                    <input type="text" class="input w-full sm:w-40 xxl:w-full mt-2 sm:mt-0 border"
                        id="tabulator-html-filter-value" placeholder="Kunli info">
                </div>
            </form>
        </div>
        <div class="preview" style="display: block; opacity: 1;">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Sana</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Sotish</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Naqd</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Click</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Umumiy</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($days_qty > 0) {
                            $datetime = '';
                            foreach ($month as $order) {
                                $datetime = $order['datetime'];
                                if ($days_qty == cutDay($order['datetime'])) {
                                    // Count stats
                                    $delivered_qty = 0;
                                    $not_delivered_qty = 0;
                                    $canceled_qty = 0;
                                    $cash = 0;
                                    $click = 0;
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
                                        ?>
                                    <tr>
                                        <td class="border-b dark:border-dark-5 font-medium"><?= cutDay($order['datetime'])?> <?= date('M', strtotime($order['datetime']))?></td>
                                        <td class="border-b dark:border-dark-5">
                                            <div class="flex text-gray-700">
                                                <div class="mr-6 flex items-center">
                                                    <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> <?= $delivered_qty?> Yetkazildi
                                                </div>
                                                <div class="mr-6 flex items-center">
                                                    <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> <?= $canceled_qty?> Qaytargan
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-b dark:border-dark-5"><?= price_format($cash)?> so'm</td>
                                        <td class="border-b dark:border-dark-5"><?= price_format($click)?> so'm</td>
                                        <td class="border-b dark:border-dark-5"><?= price_format($cash + $click)?> so'm</td>
                                        <td class="border-b dark:border-dark-5">
                                            <div class="flex items-center justify-center">
                                                <a class="flex items-center mr-5" href=""> <i class="w-4 h-4 mr-2"
                                                        data-feather="list"></i> Xaridlar </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                if ($days_qty != cutDay($order['datetime'])) {
                                    ?>
                                    <tr>
                                        <td class="border-b dark:border-dark-5 font-medium"><?= $days_qty?> <?= date('M', strtotime($order['datetime']))?></td>
                                        <td class="border-b dark:border-dark-5">
                                            <div class="flex text-gray-700">
                                                <div class="mr-6 flex items-center">
                                                    <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> 0 Yetkazildi
                                                </div>
                                                <div class="mr-6 flex items-center">
                                                    <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> 0 Qaytargan
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-b dark:border-dark-5">0 so'm</td>
                                        <td class="border-b dark:border-dark-5">0 so'm</td>
                                        <td class="border-b dark:border-dark-5">0 so'm</td>
                                        <td class="border-b dark:border-dark-5">
                                            <div class="flex items-center justify-center">
                                                <a class="flex items-center mr-5" href=""> <i class="w-4 h-4 mr-2"
                                                        data-feather="list"></i> Xaridlar </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        <?php
                            $days_qty--;
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