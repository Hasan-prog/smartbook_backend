<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Products;
use yii\widgets\ActiveForm;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Berilgan Mahsulotlar', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Berilgan Mahsulotlar";

?>

<!-- BEGIN: Striped Rows -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto">
            Berilgan Mahsulotlar
        </h2>
        <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
            <!-- <button
                class="button ml-2 mb-2 border text-gray-700 dark:bg-dark-5 dark:text-gray-300 flex items-center justify-center"><i
                    data-feather="file-text" class="w-4 h-4 mr-2"></i> Excel export </button> -->
            <div class="text-center"> <a href="javascript:;" data-toggle="modal"
                    data-target="#header-footer-modal-preview"
                    class="button ml-2 mb-2 flex items-center justify-center bg-theme-1 text-white"><i
                        data-feather="plus" class="w-4 h-4 mr-2"></i> Yangi o'tkazish</a> </div>
            <div class="modal" id="header-footer-modal-preview">
                <div class="modal__content relative">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">Yangi o'tkazish</h2>
                        <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3"> <svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-x w-6 h-6 text-gray-500">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg> </a>
                    </div>
                    <?php $form = ActiveForm::begin()?>
                    <?= $form->field($model, 'products_id')->textInput(['class' => 'sr-only products_id'])->label('')?>
                    <div class="p-5">
                        <div class="intro-y col-span-12 sm:col-span-6 product-select add-history mb-4">
                            <div class="mb-2">Mahsulotlar</div>
                            <?php
                            $prods_qty = count($products_db);
                            $i = $prods_qty;
                            while ($prods_qty >= 1) {
                                if ($prods_qty == $i) {
                                    ?>
                                    <div class="flex first-product-select">
                                        <select class="tail-select w-full flex-8">
                                            <?php foreach ($products_db as $product) {
                                            ?>
                                            <option value="<?= $product['id']?>,<?= $product['name']?>,<?= $product['format']?>:1" data-id="<?= $product['id']?>"
                                                data-name="<?= $product['name']?>" data-format="<?= $product['format']?>"
                                                data-price="<?= $product['price']?>"><?= $product['name']?>,
                                                <?= $product['format']?></option>
                                            <?php
                                            }?>
                                        </select>
                                        <input type="number" value="1" class="input w-full border qty" placeholder="Miqdori...">
                                        <div class="remove-product-select"><i data-feather="trash-2" class="w-5 h-5"></i> </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="flex hidden-select">
                                        <select class="tail-select w-full flex-8">
                                            <?php foreach ($products_db as $product) {
                                            ?>
                                            <option value="<?= $product['name']?>:1" data-id="<?= $product['id']?>"
                                                data-name="<?= $product['name']?>" data-format="<?= $product['format']?>"
                                                data-price="<?= $product['price']?>"><?= $product['name']?>,
                                                <?= $product['format']?></option>
                                            <?php
                                            }?>
                                        </select>
                                        <input type="number" value="1" class="input w-full border qty" placeholder="Miqdori...">
                                        <div class="remove-product-select"><i data-feather="trash-2" class="w-5 h-5"></i> </div>
                                    </div>
                                    <?php
                                    } 
                                    $prods_qty--;
                                }
                                ?>
                            <button
                                class="button bg-gray-200 text-gray-600 one-more flex items-center justify-center"><i
                                    class="w-5 h-5 mr-2" data-feather="plus"></i> Mahsulot</button>
                        </div>
                        <div class="mb-4">
                            <label>Shahar</label>
                            <div class="mt-2">
                                <select data-search="false" class="tail-select w-full city-select" name="History[city_id]">
                                <?php
                                foreach ($cities as $city) {
                                    ?>
                                    <option value="<?= $city['id']?>" data-id="<?= $city['id']?>"><?= $city['name']?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label>Kuryer</label>
                            <div class="mt-2">
                                <select data-search="false" class="tail-select w-full courier-select" name="History[courier_id]">
                                <?php
                                foreach ($couriers as $courier) {
                                    ?>
                                    <option value="<?= $courier['id']?>" data-city="<?= $courier['city_id']?>"><?= $courier['name']?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                        <button type="submit" class="button bg-theme-1 text-white add-history">Qo'shish</button>
                    </div>
                    <?php ActiveForm::end()?>
                </div>
            </div>


        </div>
    </div>
    <div class="p-5" id="striped-rows-table">
        <div class="filters mb-6">
            <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">
                <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Shahar</label>
                    <select data-element="history-row" class="input w-full border col-span-4 filter-dropdown-db" name="worker_id" id="tabulator-html-filter-field">
                        <option value="all" selected="">Hamma</option>
                        <?php
                        foreach ($cities as $city) {
                            ?>
                                <option value="<?= $city['name']?>"><?= $city['name']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Kuryer</label>
                    <select data-element="history-row" class="input w-full border col-span-4 filter-dropdown-db" name="worker_id" id="tabulator-html-filter-field">
                    <option value="all" selected="">Hamma</option>
                        <?php
                        foreach ($couriers as $courier) {
                            ?>
                                <option value="<?= $courier['name']?>"><?= $courier['name']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Qidirmoq</label>
                    <input data-element="history-row" type="text" class="input w-full sm:w-40 xxl:w-full mt-2 sm:mt-0 border filter-search"
                        id="tabulator-html-filter-value" placeholder="Mahsolotlar...">
                </div>
            </form>
        </div>
        <div class="preview" style="display: block; opacity: 1;">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">ID</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Mahsulotlar</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Qachon berilgan</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Kuryer</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Qaysi shaharga</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    foreach ($history as $transfer) {
                        // debug($transfer); die;
                        // Get products and their quantity
                        $products = explode('/', $transfer['products_id']);
                        $timestamp = strtotime($transfer['datetime']);

                        ?>
                        <tr class="bg-gray-100 dark:bg-dark-1 history-row">
                            <td class="border-b dark:border-dark-5"><?= $transfer['id']?></td>
                            <td class="border-b dark:border-dark-5">
                                <?php
                            foreach ($products as $product) {
                                $product_explode = explode(':', $product);
                                $product_explode['info'] = explode(',', $product_explode[0]);
                                unset($product_explode[0]);
                                $product_explode['qty'] = $product_explode[1];
                                unset($product_explode[1]);
                                // debug($product_explode); die;
                                ?>
                                <div class="select-handle-single my-3" data-key="3" data-group="#">
                                    <?= $product_explode['info'][1]?> ·
                                    <?= $product_explode['qty']?> <?= $product_explode['info'][2]?></div>
                                <?php
                            }
                            ?>
                            </td>
                            <td class="border-b dark:border-dark-5"><?= date('d M, Y – h:i', $timestamp)?></td>
                            <td class="border-b dark:border-dark-5"><a
                                    href="edit-courier.html"><?= $transfer['courier']['name']?></a></td>
                            <td class="border-b dark:border-dark-5"><?= $transfer['city']['name']?></td>
                            <td class="border-b dark:border-dark-5 md:w-80">
                                <div class="flex items-center justify-center">
                                    <!-- <a class="flex items-center mr-5"
                                        href="<?= Url::to(['products/edit-history?id=' . $transfer['id']])?>"> <i
                                            class="w-4 h-4 mr-2" data-feather="edit"></i> Ozgartirish </a> -->
                                    <a class="flex items-center text-theme-6 delete-subject" href="" data-url="<?= Url::to(['products/history'])?>" data-id="<?= $transfer['id']?>" data-parent="history-row" data-msg="Ushbu berilgan mahsulotlarni o'chirmoqchimisiz?"><i class="w-4 h-4 mr-2" data-feather="trash-2"></i> O'chirish </a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <!-- BEGIN: Pagination -->
                <!-- <div class="intro-y flex flex-wrap sm:flex-row sm:flex-no-wrap items-center mt-6">
                    <ul class="pagination">
                        <li>
                            <a class="pagination__link" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-chevron-left w-4 h-4">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg> </a>
                        </li>
                        <li> <a class="pagination__link pagination__link--active" href="">1</a> </li>
                        <li> <a class="pagination__link" href="">2</a> </li>
                        <li> <a class="pagination__link" href="">3</a> </li>
                        <li>
                            <a class="pagination__link" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-chevron-right w-4 h-4">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg> </a>
                        </li>
                    </ul>
                </div> -->
                <!-- END: Pagination -->
            </div>
        </div>
    </div>
</div>
<!-- END: Striped Rows -->