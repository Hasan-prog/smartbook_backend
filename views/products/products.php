<?php

use yii\helpers\Html;
use yii\helpers\Url;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Mahsulotlar', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Mahsulotlar";

?>

<!-- BEGIN: Striped Rows -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto">
            Mahsulotlar
        </h2>
        <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
            <a href="<?= Url::to(['products/add-product'])?>" class="button ml-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                <i data-feather="plus" class="w-4 h-4 mr-2"></i> Yangi mahsulot </a>
        </div>
    </div>
    <div class="p-5" id="striped-rows-table">
        <div class="filters mb-6">
            <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Qidirmoq</label>
                    <input data-element="product-row" type="text" class="input w-full sm:w-40 xxl:w-full mt-2 sm:mt-0 border filter-search"
                        id="tabulator-html-filter-value" placeholder="Mahsulot...">
                </div>
            </form>
        </div>
        <div class="preview" style="display: block; opacity: 1;">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">ID</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Rasm</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Ism</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Narx</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Format</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Dona Qogan</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products as $product) {
                            $formated_price = number_format ($product['price'], 0, ',', ' ');
                        ?>
                        <tr class="bg-gray-100 dark:bg-dark-1 product-row">
                            <td class="border-b dark:border-dark-5"><?= $product['id']?></td>
                            <td class="border-b dark:border-dark-5" width="100">
                                <div class="w-20 h-20 image-fit">
                                    <img alt="" src="<?= $product['photo']?>">
                                </div>
                            </td>
                            <td class="border-b dark:border-dark-5"><?= $product['name']?></td>
                            <td class="border-b dark:border-dark-5"><?= $formated_price?> so'm</td>
                            <td class="border-b dark:border-dark-5"><?= $product['format']?></td>
                            <td class="border-b dark:border-dark-5"><?= $product['in_stock']?> ta</td>
                            <td class="border-b dark:border-dark-5 md:w-80">
                                <div class="flex items-center justify-center">
                                    <a class="flex items-center mr-5" href="<?= Url::to(['products/edit-product?id=' . $product['id']])?>"> <i class="w-4 h-4 mr-2"
                                            data-feather="edit"></i> Ozgartirish </a>
                                    <a class="flex items-center text-theme-6 delete-subject" href="" data-url="<?= Url::to(['products/'])?>" data-id="<?= $product['id']?>" data-parent="product-row" data-msg="Ushbu mahsulotni o'chirmoqchimisiz?"><i class="w-4 h-4 mr-2" data-feather="trash-2"></i> O'chirish </a>
                                </div>
                            </td>
                        </tr>
                        <?php
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END: Striped Rows -->