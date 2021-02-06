<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Operatorlar', 
    'url'=>URL::to(['operators/']),
);
$this->params['breadcrumbs'][] = array(
    'label'=> 'Yangi Operator', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Operatorni O'zgartirish";

?>
<!-- BEGIN: Wizard Layout -->
<div class="intro-y box pb-10 pt-3 sm:pb-20 sm:pt-3 mt-5">
    <div class="px-5 mt-10">
        <div class="font-medium text-center text-lg">Operatorni O'zgartirish</div>
        <div class="flex justify-center">
            <div class="text-gray-600 text-center mt-2 md:w-1/3">Operatorlarda ushbu tizimda hisob qaydnomalari yo'q, ularni ro'yxatdan o'tkazish buyurtmalarni ularga bog'lash uchun amalga oshiriladi.</div>
        </div>
    </div>
    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'options' => [
                'id' => 'new_operator',
                'enctype' => 'multipart/form-data',
            ]
        ])?>
        <div class="col-span-12 xl:col-span-4">
            <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5 image-upload">
                <div class="w-40 h-40 relative image-fit mx-auto">
                    <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="<?= $model->photo?>">
                    <div
                        class="w-5 h-5 flex items-center justify-center absolute rounded-full text-white cursor-pointer zoom-in bg-theme-6 right-0 top-0 -mr-2 -mt-2 remove-photo" style="display: none">
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
                <?= $form->field($model, 'name', ['labelOptions' => ['class' => 'mb-2 block']])-> textInput(['class' => 'input w-full border flex-1'])->label("To'liq ism")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'phone_number', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Telefon")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'address', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Manzil")?>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <?= $form->field($model, 'email', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Email")?>
            </div>
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-center mt-5">
                <button class="button justify-center block bg-gray-200 text-gray-600 dark:bg-dark-1 dark:text-gray-300 clear-fields">O'chirish</button>
                <button type="submit"
                    class="button justify-center block bg-theme-1 text-white ml-2 add-courier">Qo'shish</button>
            </div>
            <?php ActiveForm::end()?>
        </div>
    </div>
</div>
</div>
<!-- END: Wizard Layout -->