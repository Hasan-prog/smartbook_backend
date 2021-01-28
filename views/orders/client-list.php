<?php

use yii\helpers\Html;
use yii\helpers\Url;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> $client['name'], 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – " . $client['name'];

?>
<!-- BEGIN: Striped Rows -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto">
            <?= $client['name']?>
        </h2>
        <div class="flex text-gray-700">
            <div class="mr-6 flex items-center">
                <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> <?= $delivered_qty?> Yetkazilgan
            </div>
            <div class="mr-6 flex items-center">
                <div class="w-2 h-2 bg-theme-12 rounded-full mr-2"></div> <?= $not_delivered_qty?> Yetkazilmagan
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
                <span class="text-gray-500 mr-2">Umumiy:</span> <?= price_format($overall)?> so'm
            </div>
        </div>
        <button class="button px-2 mr-1 text-gray-700 bg-gray-200 dark:text-gray-300">
            <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="printer"
                    class="w-5 h-5"></i> </span>
        </button>
    </div>
    <div class="p-5" id="striped-rows-table">
        <div class="filters mb-6">
            <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">
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
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($orders as $order) {
                        ?>
                        <tr>
                            <td class="border-b dark:border-dark-5"><?= $order['id']?></td>
                            <td class="border-b dark:border-dark-5"><?= $order['name']?></td>
                            <td class="border-b dark:border-dark-5"><?= $order['product']?></td>
                            <td class="border-b dark:border-dark-5"><?= $order['address']?></td>
                            <td class="border-b dark:border-dark-5"><a href="tel:<?= $order['phone_number']?>"><?= $order['phone_number']?></a></td>
                            <td class="border-b dark:border-dark-5"><?= price_format($order['price'])?> so'm</td>
                            <td class="border-b dark:border-dark-5"><?= payment_method_format($order['payment_method'])?></td>
                            <td class="border-b dark:border-dark-5"><?= $order['comment']?></td>
                            <td class="border-b dark:border-dark-5"><?= $order['manager']['name']?></td>
                            <td class="border-b dark:border-dark-5"><?= date('d M, Y – h:m', strtotime($order['datetime']))?></td>
                            <td class="border-b dark:border-dark-5">
                                <div class="dropdown flex justify-end"> 
                                    <?= order_actions($order['status']);?>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END: Striped Rows -->