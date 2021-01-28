<?php

use yii\helpers\Html;
use yii\helpers\Url;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Kuryerlar', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Kuryerlar";

?>

<!-- BEGIN: Striped Rows -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto">
            Kuryerlar
        </h2>
        <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
            <a href="<?= Url::to(['couriers/add-courier'])?>" class="button ml-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                <i data-feather="user-plus" class="w-4 h-4 mr-2"></i> Yangi kuryer </a>
        </div>
    </div>
    <div class="p-5" id="striped-rows-table">
        <div class="filters mb-6">
            <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Qidirmoq</label>
                    <input type="text" class="input w-full sm:w-40 xxl:w-full mt-2 sm:mt-0 border"
                        id="tabulator-html-filter-value" placeholder="Kuryer...">
                </div>
            </form>
        </div>
        <div class="preview" style="display: block; opacity: 1;">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Photo</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Ism va Telefon</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Shahar</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Bugun sotilgan</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Oyli sotilgan</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // debug($couriers); die;
                        foreach ($couriers as $courier) {
                            ?>
                        <tr class="bg-gray-100 dark:bg-dark-1">
                            <td class="border-b dark:border-dark-5" width="100">
                                <div class="image-fit profile-image-row">
                                    <img alt="" class="rounded-full" src="<?= $courier['photo']?>">
                                </div>
                            </td>
                            <td class="border-b dark:border-dark-5">
                                <span href="" class="font-medium whitespace-no-wrap"><?= $courier['name']?></span>
                                <a href="tel: +998 (97) 444-67-17">
                                    <div class="text-gray-600 text-xs whitespace-no-wrap"><?= $courier['phone_number']?></div>
                                </a>
                            </td>
                            <td class="border-b dark:border-dark-5"><?= $courier['cities']['name']?></td>
                            <td class="border-b dark:border-dark-5">
                                <div class="flex text-gray-700">
                                    <div class="mr-6 flex items-center">
                                        <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> 
                                        <?php 
                                        // Working with time and analytics for day and current month
                                        $daily_count = 0;
                                        $monthly_count = 0;
                                        $daily_delivered = 0;
                                        $monthly_canceled = 0;
                                        foreach ($courier['orders'] as $order) {
                                            $currentDatetime = date("Y-m-d h:m:s");
                                            $current_month = date("m");
                                            $month = date("m", strtotime($order['datetime']));
                                            // debug($current_month . "<br>" . $month); die;
                                            $currentDatetime_seconds = strtotime($currentDatetime);
                                            $orderDatetime_seconds = strtotime($order['datetime']);
                                            if ($currentDatetime_seconds + 1700 > $orderDatetime_seconds && $currentDatetime_seconds - 86400 <= $orderDatetime_seconds) {
                                                $daily_count++;
                                                if ($order['status'] == 'delivered') {
                                                    $daily_delivered++;
                                                }
                                            } 
                                            if ($currentDatetime_seconds + 1700 > $orderDatetime_seconds && $currentDatetime_seconds - 2592000 <= $orderDatetime_seconds && $current_month == $month) {
                                                $monthly_count++;
                                                if ($order['status'] == 'canceled') {
                                                    $monthly_canceled++;
                                                }
                                            }
                                        }
                                        echo $daily_count;
                                        ?> yetkazildi
                                    </div>
                                    <div class="mr-6 flex items-center">
                                        <div class="w-2 h-2 bg-theme-12 rounded-full mr-2"></div> 
                                        <?= $daily_count?> buyurtma
                                    </div>
                                </div>
                            </td>
                            <td class="border-b dark:border-dark-5">
                                <div class="flex text-gray-700">
                                    <div class="mr-6 flex items-center">
                                        <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> <?= $monthly_count?> yetkazildi
                                    </div>
                                    <div class="mr-6 flex items-center">
                                        <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> <?= $monthly_canceled?> qaytargan
                                    </div>
                                </div>
                            </td>
                            <td class="border-b dark:border-dark-5 md:w-80">
                                <div class="flex items-center justify-center">
                                    <a class="flex items-center mr-5" href="<?= Url::to(['couriers/edit-courier?id=' . $courier['id']])?>"> <i class="w-4 h-4 mr-2"
                                            data-feather="edit"></i> Ozgartirish </a>
                                    <a class="flex items-center text-theme-6" href=""> <i class="w-4 h-4 mr-2"
                                            data-feather="trash-2"></i> O'chirish </a>
                                </div>
                            </td>
                        </tr>
                        <?php }
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END: Striped Rows -->