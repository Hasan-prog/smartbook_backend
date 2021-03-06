<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\Orders;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Mijozlar', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Mijozlar";

?>
<!-- BEGIN: Striped Rows -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto">
            Mijozlar
        </h2>
        <span class="text-gray-500 flex items-center"><i data-feather="alert-circle"></i> <span class="pl-3">Yangi
                buyurtma yaratishda ushbu buyurtma yangi mijozni yaratadi yoki mavjudiga qo'shiladi.</span></span>
    </div>
    <div class="p-5" id="striped-rows-table">
        <div class="filters mb-6">
            <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">

                <!-- <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Vaqt</label>
                    <select class="input w-full border col-span-4" name="worker_id" id="tabulator-html-filter-field">
                        <option value="monthly" selected="">Birinchisi yangi</option>
                        <option value="yearly">Birinchisi eskisi</option>
                        <option value="dayli">Ko'pro sotib oganla</option>
                    </select>
                </div> -->
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label style="width: 110px" class="flex-none xl:w-auto xl:flex-initial mr-2">Qidirmoq</label>
                    <input data-element="client-row" type="number" class="input w-full sm:w-40 xxl:w-full mt-2 sm:mt-0 border filter-search-pagination"
                        id="tabulator-html-filter-value" placeholder="Mijozlar">
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
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Telefon</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Manzil</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Xaridlar</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Oxirgi xarid</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // debug($clients);
                    // die;
                    $i = 0;
                    $pagination_i = 1;
                    $page_i = 1;
                    $client_qty = count($clients);
                    foreach ($clients as $client) {
                    if ($pagination_i <= 30) { // Wanna change rows quantity on one page? Change this number <---
                    ?>
                        <tr data-city="<?= $client['city_id']?>" data-page="<?= $page_i?>" class="client-row <?= $page_i > 1 ? 'hidden' : ''?>">
                            <td class="border-b dark:border-dark-5"><?= $client['client_id']?></td>
                            <td class="border-b dark:border-dark-5"><?= $client['name']?></td>
                            <td class="border-b dark:border-dark-5">
                                <?php 
                                $phones_arr = explode(',', $client['phone_number']);
                                $i = 1;
                                if (count($phones_arr) == 1) {
                                    ?>
                                        <a href="tel:<?= $phones_arr[0]?>"><?= $phones_arr[0]?></a>
                                    <?php
                                } else {
                                    foreach ($phones_arr as $phone_number) {
                                        ?>
                                            <a href="tel:<?= $phone_number?>"><?= $phone_number?></a> <?= count($phones_arr) > $i ? ',' : ''?>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </td>
                            <td class="border-b dark:border-dark-5"><?= $client['address']?></td>
                            <td class="border-b dark:border-dark-5">
                            <?php 
                            $id_array = explode(',', $client['orders_id']);
                            $order_qty = 0;
                            // debug($id_array);
                            foreach ($orders as $order) {
                                if (in_array($order['id'], $id_array)) {
                                    $order_qty++;
                                    $last_order_datetime = end($orders)['datetime'];
                                    $date = strtotime($last_order_datetime);
                                }
                            }
                            echo $order_qty;
                            ?>
                            </td>
                            <td class="border-b dark:border-dark-5"><?= isset($date) ? date('d M, Y', $date) : '-'?></td>
                            <td class="border-b dark:border-dark-5 md:w-80">
                                <div class="flex items-center justify-center">
                                    <a class="flex items-center mr-5" href="<?= Url::to(['orders/client-list?client=' . $client['id']])?>"> <i
                                            class="w-4 h-4 mr-2" data-feather="list"></i> Xaridlar </a>
                                    <a class="flex items-center text-theme-6 delete-subject" href="" data-url="<?= Url::to(['orders/clients'])?>" data-id="<?= $client['id']?>" data-parent="client-row" data-msg="Ushbu klientni o'chirmoqchimisiz?"><i class="w-4 h-4 mr-2" data-feather="trash-2"></i> O'chirish </a>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        $pagination_i++;
                        } else {
                            $pagination_i = 1;
                            $page_i++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <?php
                $client_qty_pages = $client_qty / 30; // Wanna change rows quantity on one page? Change this number <---
                $page_i = 1;
                if ($client_qty_pages >= 1) {
                    ?>
                    <!-- BEGIN: Pagination -->
                    <div class="intro-y flex flex-wrap sm:flex-row sm:flex-no-wrap items-center mt-6">
                        <ul class="pagination">
                            <li>
                                <a data-action="prev" data-pages="<?= $page_i?>" data-element="client-row" class="pagination__link pagination_arrow"> <svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-chevron-left w-4 h-4">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg> </a>
                            </li>
                            <?php
                            while ($client_qty_pages > 1) {
                                ?>
                                    <li> <a data-page="<?= $page_i?>" data-element="client-row" class="pagination__link page__button <?= $client_qty_pages == $client_qty / 30 ? 'pagination__link--active' : ''?>"><?= $page_i?></a> </li>
                                <?php
                                $client_qty_pages--;
                                $page_i++;
                            }
                            ?>
                            <li>
                                <a data-action="next" data-pages="<?= $page_i?>" data-element="client-row" class="pagination__link pagination_arrow"> <svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-chevron-right w-4 h-4">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg> </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END: Pagination -->
                    <?php
                }
                 ?>
            </div>
        </div>
    </div>
</div>
<!-- END: Striped Rows -->