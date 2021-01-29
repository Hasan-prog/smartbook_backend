<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Profil', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Profil";

?>

<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
        <div class="intro-y box mt-5">
            <div class="relative flex items-center p-5">
                <div class="w-12 h-12 image-fit">
                    <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                        src="<?= $model->photo?>">
                </div>
                <div class="ml-4 mr-auto">
                    <div class="font-medium text-base"><?= Yii::$app->user->identity['name']?></div>
                    <div class="text-gray-600">Meneger</div>
                </div>
            </div>
            <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                <a class="flex items-center text-theme-1 dark:text-theme-10 font-medium" href="profile.html"> <svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-user w-4 h-4 mr-2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg> Profil Ma'lumot </a>
            </div>
        </div>
    </div>
    <!-- END: Profile Menu -->
    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Profil Ma'lumot
                </h2>
            </div>
            <div class="p-5">
                <?php $form = ActiveForm::begin()?>
                <div class="grid grid-cols-12 gap-5">
                    <div class="col-span-12 xl:col-span-4">
                        <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5 image-upload">
                            <div class="w-40 h-40 relative image-fit cursor-pointer mx-auto">
                                <img class="rounded-md" alt="Midone Tailwind HTML Admin Template"
                                    src="<?= $model->photo?>">
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
                            <?= $form->field($model, 'login', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1', 'disabled' => 'disabled'])->label("Login")?>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($model, 'email', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Email")?>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($model, 'phone_number', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Telefon")?>
                        </div>
                        <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">Saqlash</button>
                    </div>

                </div>
                <?php ActiveForm::end()?>
            </div>
        </div>
        <!-- END: Display Information -->
    </div>
</div>