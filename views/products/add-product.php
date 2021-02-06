<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Mahsulotlar', 
    'url'=>URL::to(['products/']),
);
$this->params['breadcrumbs'][] = array(
    'label'=> 'Yangi Buyurtma', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Yangi Buyurtma";

?>
<div class="col-span-12 lg:col-span-8 xxl:col-span-9">
    <!-- BEGIN: Display Information -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Yangi Mahsulot
            </h2>
        </div>
        <div class="p-5">
            <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'options' => [
                        'id' => 'add_product',
                        'enctype' => 'multipart/form-data',
                    ]
                ])?>
            <div class="grid grid-cols-12 gap-5">
                <div class="col-span-12 xl:col-span-4">
                    <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5 image-upload">
                        <div class="w-40 h-40 relative image-fit cursor-pointer mx-auto">
                            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template"
                                src="/web/images/placeholder.jpg">
                            <div class="w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2 remove-photo"
                                style="display: none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-x w-4 h-4">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </div>
                        </div>
                        <div class="w-40 mx-auto cursor-pointer relative mt-5 zoom-in">
                            <button type="button" class="button w-full bg-theme-1 text-white">Boshqa
                                rasm</button>
                            <?= $form->field($model, 'photo')->fileInput(['class' => 'w-full h-full top-0 left-0 absolute opacity-0 select-image', 'onchange' => 'readURL(this)'])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-8">
                    <div class="mb-4">
                        <?= $form->field($model, 'name', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Ism")?>
                    </div>
                    <div class="mb-4">
                        <?= $form->field($model, 'price', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['type' => 'number', 'class' => 'input w-full border flex-1'])->label("Narx")?>
                    </div>
                    <div class="mb-4">
                        <label>Format</label>
                        <select class="tail-select w-full" name="Products[format]">
                            <option value="kiril">Kiril</option>
                            <option value="lotin">Lotin</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <?= $form->field($model, 'in_stock', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['type' => 'number', 'class' => 'input w-full border flex-1'])->label("Dona Bor")?>
                    </div>
                    <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">Qo'shish</button>
                </div>
            </div>
            <?php ActiveForm::end()?>
        </div>
    </div>
    <!-- END: Display Information -->
</div>
<span class="text-gray-500 flex items-center mt-4 xl:w-1/3 md:w-1/2 sm:w-full"><svg class="w-12 h-12"
        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
    </svg> <span class="pl-3">Siz butunlay yangi mahsulotni yoki mavjud mahsulot turini qo'shishingiz mumkin, ammo yangi
        mahsulot sifatida. Faqat yuqori rahbarlarning ruxsati bilan yangi mahsulotni qo'shish.</span></span>