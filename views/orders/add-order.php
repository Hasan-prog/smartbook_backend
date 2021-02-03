<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Yangi Buyurtma', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Yangi Buyurtma";

?>
<!-- BEGIN: Wizard Layout -->
<div class="intro-y box pb-10 pt-3 sm:pb-20 sm:pt-3 mt-5">
    <div class="px-5 mt-10">
        <div class="font-medium text-center text-lg">Yangi Buyurtma</div>
        <div class="text-gray-600 text-center mt-2">Yangi buyurtma yaratishda kuryer uni o'z ro'yxatida ko'radi.</div>
    </div>
    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'options' => [
                'id' => 'new_order',
                'enctype' => 'multipart/form-data',
            ]
        ])?>
        <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
            <div class="intro-y col-span-12 sm:col-span-6">
                <div class="mb-2">Shahar</div>
                <select class="tail-select w-full" name="Orders[city_id]">
                    <?php
                foreach ($cities as $city) {
                    ?>
                    <option value="<?= $city['id']?>"><?= $city['name']?></option>
                    <?php
                }
                ?>
                </select>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'client_id', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("ID")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <div class="mb-2">Kuryer</div>
                <select class="tail-select w-full" name="Orders[courier_id]">
                <?php
                foreach ($couriers as $courier) {
                    ?>
                    <option value="<?= $courier['id']?>"><?= $courier['name']?></option>
                    <?php
                }
                ?>
                    <!-- When Shahar is selected only couriers from this city will be shows -->
                </select>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'name', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Ism")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <div class="mb-2">To'lov uslubi</div>
                <select class="tail-select w-full" name="Orders[payment_method]">
                    <option value="cash">Naqd</option>
                    <option value="click">Click</option>
                    <option value="click-paid">Click To'langan</option>
                </select>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'phone_number', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Telefon")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6 product-select add-product-select">
                <div class="mb-2">Mahsulotlar</div>
                <?= $form->field($model, 'product', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1 sr-only product-field'])->label('')?>
                <div class="flex first-product-select product-select-empty">
                    <select class="tail-select w-full flex-8">
                        <?php foreach ($products as $product) {
                                ?>
                        <option value="<?= $product['name']?>, <?= $product['format']?>, 1 dona"
                            data-id="<?= $product['id']?>" data-name="<?= $product['name']?>"
                            data-format="<?= $product['format']?>" data-price="<?= $product['price']?>">
                            <?= $product['name']?>, <?= $product['format']?></option>
                        <?php
                            }?>
                    </select>
                    <input type="number" class="input w-full border qty" value="1" placeholder="Miqdori...">
                    <!-- Take val of selected option and add qty to it via js  product_id:price -->
                </div>
            </div>




            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'address', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Manzil")?>
            </div>


            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'price', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['type' => 'numeric', 'class' => 'input w-full border flex-1 overall', 'value' => 123])->label("Umumiy narh (Ozi hisoblangan)")?>
            </div>
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-center mt-5">
                <button
                    class="button justify-center block bg-gray-200 text-gray-600 dark:bg-dark-1 dark:text-gray-300 clear-fields">Ochirish</button>
                <button type="submit" class="button justify-center block bg-theme-1 text-white ml-2 add-order">Buyurtma
                    berish</button>
            </div>
            <!-- Manager ID auto do -->
            <!-- Datetime auto -->
            <!-- Status auto -->
            <!-- Comment empty -->
        </div>
        <?php ActiveForm::end()?>
    </div>
</div>
<!-- END: Wizard Layout -->