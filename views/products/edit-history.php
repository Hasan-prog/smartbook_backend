<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Berilgan Mahsulotlar', 
    'url'=>URL::to(['products/history']),
);
$this->params['breadcrumbs'][] = array(
    'label'=> 'Berilgan Mahsulotlarni Ozgartirish', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Berilgan Mahsulotlarni Ozgartirish";

?>
<!-- BEGIN: Wizard Layout -->
<div class="intro-y box pb-10 pt-3 sm:pb-20 sm:pt-3 mt-5">
    <div class="px-5 mt-10">
        <div class="font-medium text-center text-lg">Berilgan Mahsulotlarni Ozgartirish</div>
        <div class="text-gray-600 text-center mt-2">ID: <?= $model->id?> | Berilgan: <?= date('d M, Y – h:m', strtotime($model->datetime))?></div>
    </div>
    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <?php $form = ActiveForm::begin()?>
        <?= $form->field($model, 'products_id')->textInput(['class' => 'sr-only products_id'])->label('')?>
        <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
            <div class="intro-y col-span-12 sm:col-span-6 product-select add-history">
                <div class="mb-2">Mahsulotlar</div>
                <?php
                $i = 0;
                foreach ($products as $product) {
                    if ($i == 0) {
                        ?>
                        <div class="flex first-product-select">
                            <select class="tail-select w-full flex-8">
                                <?php
                                foreach ($products_db as $prod) {
                                    ?>
                                    <option <?= $prod['name'] == $product['name'] ? 'selected="selected"' : ''?> value="<?= $prod['id'] . ':' . $product['qty']?>" data-id="<?= $prod['id']?>" data-name="<?= $prod['name']?>" data-format="<?= $prod['format']?>" data-price="<?= $prod['price']?>"><?= $prod['name']?>,<?= $prod['format']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="number" class="input w-full border qty" value="<?= $product['qty']?>" placeholder="Miqdori...">
                            <div class="remove-product-select"><i data-feather="trash-2" class="w-5 h-5"></i> </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="flex">
                            <select class="tail-select w-full flex-8">
                            <?php
                                foreach ($products_db as $prod) {
                                    ?>
                                    <option <?= $prod['name'] == $product['name'] ? 'selected="selected"' : ''?> value="<?= $prod['id'] . ':' . $product['qty']?>" data-id="<?= $prod['id']?>" data-name="<?= $prod['name']?>" data-format="<?= $prod['format']?>" data-price="<?= $prod['price']?>"><?= $prod['name']?>,<?= $prod['format']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="number" class="input w-full border qty" value="<?= $product['qty']?>" placeholder="Miqdori...">
                            <div class="remove-product-select"><i data-feather="trash-2" class="w-5 h-5"></i> </div>
                        </div>
                        <?php
                    }
                    $i++;
                }
                ?>
                <button class="button bg-gray-200 text-gray-600 one-more flex items-center justify-center"><i
                        class="w-5 h-5 mr-2" data-feather="plus"></i> Mahsulot</button>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'datetime', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Qachon berilgan")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <div class="mb-2">Kuryer</div>
                <select class="tail-select w-full" name="History[courier_id]">
                    <?php
                    foreach ($couriers as $courier) {
                        ?>
                        <option <?= $courier['id'] == $model->courier_id ? 'selected="selected"' : ''?> value="<?= $courier['id']?>"><?= $courier['name']?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <div class="mb-2">Qaysi shaharga</div>
                <select class="tail-select w-full" name="History[city_id]">
                    <?php
                    foreach ($cities as $city) {
                        ?>
                        <option <?= $city['id'] == $model->city_id ? 'selected="selected"' : ''?> value="<?= $city['id']?>"><?= $city['name']?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-center mt-5">
                <a href="javascript:;" data-toggle="modal" data-target="#delete-modal-preview"
                    class="button justify-center block bg-theme-6 text-white">O'chirish</a>
                <div class="modal" id="delete-modal-preview">
                    <div class="modal__content">
                        <div class="p-5 text-center"> <i data-feather="x-circle"
                                class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">O'chirish?</div>
                            <div class="text-gray-600 mt-2">Shu berilgan mahsulotlar tarixi butunlay o'chiriladi! <br>
                                Ishonchingiz komilmi?</div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal"
                                class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Yo'q</button>
                            <!-- Button Form -->
                            <!-- <button type="button" class="button w-24 bg-theme-6 text-white">O'chirish</button>  -->
                            <a href="history.html"
                                class="button w-24 inline-block mr-1 mb-2 bg-theme-6 text-white">O'chirish</a>
                        </div>
                    </div>
                </div>
                <!-- Button Form -->
                <button data-dismiss="modal" type="submit" class="button justify-center block bg-theme-1 text-white ml-2 add-history">Saqlash</button>
            </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
</div>
<!-- END: Wizard Layout -->