<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Kuryerni O\'zgartirish', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Kuryerni O'zgartirish";

?>

<!-- BEGIN: Wizard Layout -->
<div class="intro-y box pb-10 pt-3 sm:pb-20 sm:pt-3 mt-5">
    <div class="px-5 mt-10">
        <div class="font-medium text-center text-lg">Kuryerni O'zgartirish</div>
        <div class="flex justify-center">
            <div class="text-gray-600 text-center mt-2 md:w-1/3">Kuryer hisobidagi o'zgarishlar ro'yxatdan o'tishda
                bo'lgani kabi.</div>
        </div>
    </div>
    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'options' => [
                'id' => 'new_courier',
                'enctype' => 'multipart/form-data',
            ]
        ])?>
        <div class="col-span-12 xl:col-span-4">
            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5 image-upload">
                <div class="w-40 h-40 relative image-fit mx-auto">
                    <img class="rounded-md" alt="Midone Tailwind HTML Admin Template"
                        src="<?= $courier_page['photo']?>">
                    <div class="w-5 h-5 flex items-center justify-center absolute rounded-full text-white cursor-pointer zoom-in bg-theme-6 right-0 top-0 -mr-2 -mt-2 remove-photo"
                        style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-x w-4 h-4">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </div>
                <div class="w-40 mx-auto cursor-pointer relative mt-5 zoom-in">
                    <button type="button" class="button w-full bg-theme-1 text-white select-photo">Boshqa
                        rasm</button>
                    <!-- <input type="file" id="photo-input" name="Couriers[photo]" class="w-full h-full top-0 left-0 absolute opacity-0"> -->
                    <?= $form->field($model, 'photo')->fileInput(['class' => 'w-full h-full top-0 left-0 absolute opacity-0 select-image', 'onchange' => 'readURL(this)'])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'name', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("To'liq ism")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'login', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Login")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'password', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['value' => '', 'class' => 'input w-full border flex-1'])->label("Yangi parol")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'phone_number', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Telefon")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'address', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Manzil")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <div class="mb-2">Ishlaydigan shahri va manzillar</div>
                <div class="city-district-select">
                    <select class="tail-select w-full city-select" name="Couriers[city_id]">
                        <?php
                        foreach ($cities as $city) {
                            if ($courier_page['cities']['id'] == $city['id']) {
                                ?>
                                <option selected value="<?= $city['id']?>"><?= $city['name']?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?= $city['id']?>"><?= $city['name']?></option>
                                <?php
                            }

                        }
                        ?>
                    </select>
                    <select data-placeholder="Hamma tumanlar..." id="equipments"
                        class="tail-select w-full district-select" id="couriers-equipment"
                        name="Couriers[districts_id][]" multiple>
                        <?php
                        foreach ($districts as $district) {
                        ?>
                            <option value="<?= $district['id']?>" <?= $courier_page['districts_id'] == $district['id'] ? 'selected' : ''?> data-city="<?= $district['city_id']?>">
                                <?= $district['name']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <div class="intro-y col-span-12 sm:col-span-6" style="z-index: 50">
                    <div class="mb-2">Uskunalar</div>
                    <select data-placeholder="Kuryerga nima berilgan" id="equipments" class="tail-select w-full"
                        id="couriers-equipment" name="Couriers[equipment][]" multiple>
                        <?php
                        $all_equip = ['Planshet', 'JPS', 'Moshina'];
                        ?>
                        <option <?= in_array('Planshet', $equip_arr) ? 'selected' : ''?> value="Planshet">Planshet
                        </option>
                        <option <?= in_array('JPS', $equip_arr) ? 'selected' : ''?> value="JPS">JPS</option>
                        <option <?= in_array('Moshina', $equip_arr) ? 'selected' : ''?> value="Moshina">Moshina</option>
                        <option <?= in_array('SIM', $equip_arr) ? 'selected' : ''?> value="Moshina">SIM</option>
                        <?php
                        ?>
                    </select>
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'salary', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Oylik")?>
            </div>
            <?php
            if ($no_items == false) {
                ?>
                <div class="intro-y col-span-12 sm:col-span-12 product-select mb-10 mt-10 p-10 bg-gray-200 border-radius-normal change-qty_left">
                <label class="mb-2 block" for="couriers-password">Dona qogan</label>
                    <?php
                    $i = 0;
                    $courier_items = explode('/', $model['qty_left']);
                    foreach ($courier_items as $key => $item) {
                        $item = explode(':', $item);
                        $item['info'] = explode(',', $item[0]);
                        $item['qty'] = $item[1];
                        unset($item[0]);
                        unset($item[1]);
                        ?>
                        <div data-show="true" class="flex item <?= $i == 0 ? 'first-product-select' : ''?><?= $i == count($courier_items) - 1 ? 'last-product-select' : ''?>">
                            <input data-str-info="<?= $item['info'][0] . ',' . $item['info'][1] . ',' . $item['info'][2]?>" disabled type="text" class="input w-full border flex-8 select-label info bg-gray-100 disabled" name="" value="<?= $item['info'][1] . ', ' . $item['info'][2]?>">
                            <input type="number" value="<?= $item['qty']?>" class="input w-full border qty" placeholder="Miqdori...">
                            <div class="remove-product-select"><i data-feather="trash-2" class="w-5 h-5"></i> </div>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                    <div class="flex hidden-select">
                        <input value="<?= $model['qty_left']?>" type="text" class="input w-full border items-left-str" name="Couriers[qty_left]" placeholder="Miqdori...">
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-center mt-5">
                <button
                    class="button justify-center block bg-gray-200 text-gray-600 dark:bg-dark-1 dark:text-gray-300 clear-fields">O'chirish</button>
                <button type="submit"
                    class="button justify-center block bg-theme-1 text-white ml-2 add-courier">Qo'shish</button>
            </div>
            <?php ActiveForm::end()?>
        </div>
    </div>
</div>
<!-- END: Wizard Layout -->