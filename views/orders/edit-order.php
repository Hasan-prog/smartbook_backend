<?php

use yii\helpers\Html;
use yii\helpers\Url;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Buyurtmani O\'zgartirish', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Buyurtmani O\'zgartirish";

?>
        <!-- BEGIN: Wizard Layout -->
        <div class="intro-y box pb-10 pt-3 sm:pb-20 sm:pt-3 mt-5">
            <div class="px-5 mt-10">
                <div class="font-medium text-center text-lg">Xaridni O'zgartirish</div>
                <div class="text-gray-600 text-center mt-2">Mijoz: Abdulloh Baxodirov</div>
            </div>
            <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <div class="mb-2">Ism</div>
                        <input type="text" class="input w-full border flex-1" placeholder="">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <div class="mb-2">Telefon</div>
                        <input type="text" class="input w-full border flex-1" placeholder="">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6 product-select">
                        <div class="mb-2">Mahsulotlar</div>
                        <div class="flex first-product-select product-select-empty">
                            <select class="tail-select w-full flex-8">
                                <option value="1">Arab tili</option>
                                <option value="2">Rus tili</option>
                                <option value="3">Xitoy tili</option>
                            </select>
                            <input type="number" class="input w-full border qty" value="1" placeholder="Miqdori...">
                        </div>
                        <button class="button bg-gray-200 text-gray-600 one-more flex items-center justify-center"><i class="w-5 h-5 mr-2" data-feather="plus"></i> Mahsulot</button>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <div class="mb-2">Narx</div>
                        <input type="text" class="input w-full border flex-1" placeholder="">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <div class="mb-2">Manzil</div>
                        <input type="text" class="input w-full border flex-1" placeholder="">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <div class="mb-2">To'lov uslubi</div>
                        <select class="input w-full border flex-1">
                            <option>Naqd</option>
                            <option>Click</option>
                        </select>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <div class="mb-2">Sharh</div>
                        <input type="text" class="input w-full border flex-1" placeholder="">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <div class="mb-2">Operator</div>
                        <input type="text" class="input w-full border flex-1" placeholder="">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <div class="mb-2">Berilgan vaqt</div>
                        <input type="text" class="input w-full border flex-1" placeholder="">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <div class="mb-2">To'lov uslubi</div>
                        <select class="input w-full border flex-1">
                            <option>Naqd</option>
                            <option>Click</option>
                        </select>
                    </div>
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-center mt-5">
                        <button
                            class="button justify-center block bg-gray-200 text-gray-600 dark:bg-dark-1 dark:text-gray-300">Orqaga</button>
                        <button class="button justify-center block bg-theme-1 text-white ml-2">Saqlash</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Wizard Layout -->