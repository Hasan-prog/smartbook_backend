<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

// echo Yii::$app->getSecurity()->generatePasswordHash('123');
?>

<!-- BEGIN: Login Form -->
<div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 log-in-form">
    <div
        class="mb-auto mx-auto xl:ml-20 lg:my-auto md:my-4 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
        <div class="forms-tabs border-b mt-4 mb-5 pb-5">
            <button style="flex: 1;" class="button xl:w-32 bg-theme-1 text-white managers-form-toggle form-toggle">Menejer</button>
            <button style="flex: 1;" class="button xl:w-32 bg-gray-200 admins-form-toggle form-toggle">Admin</button>
            <button style="flex: 1;" class="button xl:w-32 bg-gray-200 courier-form-toggle form-toggle">Kuryer</button>
        </div>
        <div class="managers-form login-form">
            <h2 class=" font-bold text-2xl xl:text-3xl text-center xl:text-left">
            Menejer Kirish
            </h2>
            <div class=" mt-2 text-gray-500 xl:text-left text-center">Yangi menejerni ro'yxatdan o'tkazish uchun <br> administrator sizga yordam berishi kerak</div>

            <?php $form = ActiveForm::begin()?>
            <div class=" mt-8">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => ' login__input input input--lg border border-gray-300 block', 'placeholder' => 'Login'])->label(false) ?>
                <?= $form->field($model, 'password')->textInput(['type' => 'password', 'class' => ' login__input input input--lg border border-gray-300 block mt-4', 'placeholder' => 'Parol'])->label(false) ?>
            </div>
            <div class=" flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                <div class="flex items-center mr-auto">

                    <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "{input} {label}",
                ])->label('Meni eslab qol') ?>
                </div>
            </div>
            <div class=" mt-5 xl:mt-8 text-center xl:text-left">
                <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">Kirish</button>
            </div>
            <?php ActiveForm::end()?>
        </div>
        <div class="admins-form login-form">
        <h2 class=" font-bold text-2xl xl:text-3xl text-center xl:text-left">
            Admin Kirish
            </h2>
            <div class=" mt-2 text-gray-500 xl:text-left text-center">Bu faqat administrator uchun kirish, <br> menejer hisobi bilan kirishga urinmang.</div>

            <?php $form = ActiveForm::begin()?>
            <div class=" mt-8">
                <?= $form->field($model_admin, 'username')->textInput(['autofocus' => true, 'class' => ' login__input input input--lg border border-gray-300 block', 'placeholder' => 'Login'])->label(false) ?>
                <?= $form->field($model_admin, 'password')->textInput(['type' => 'password', 'class' => ' login__input input input--lg border border-gray-300 block mt-4', 'placeholder' => 'Parol'])->label(false) ?>
            </div>
            <div class=" flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                <div class="flex items-center mr-auto">

                    <?= $form->field($model_admin, 'rememberMe')->checkbox([
                    'template' => "{input} {label}",
                ])->label('Meni eslab qol') ?>
                </div>
            </div>
            <div class=" mt-5 xl:mt-8 text-center xl:text-left">
                <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">Kirish</button>
            </div>
            <?php ActiveForm::end()?>
        </div>
        <div class="courier-form login-form">
        <h2 class=" font-bold text-2xl xl:text-3xl text-center xl:text-left">
            Kuryer Kirish
            </h2>
            <div class=" mt-2 text-gray-500 xl:text-left text-center">Agar siz akkauntingizga kira olmasangiz, <br> <a class="text-gray-700" target="_blank" href="https://t.me/joinchat/H1Q2I3Qfpgx2qbBJ">Texnik Yordamiga</a> yozing.</div>

            <?php $form = ActiveForm::begin()?>
            <div class=" mt-8">
                <?= $form->field($model_courier, 'username')->textInput(['autofocus' => true, 'class' => ' login__input input input--lg border border-gray-300 block', 'placeholder' => 'Login'])->label(false) ?>
                <?= $form->field($model_courier, 'password')->textInput(['type' => 'password', 'class' => ' login__input input input--lg border border-gray-300 block mt-4', 'placeholder' => 'Parol'])->label(false) ?>
            </div>
            <div class=" flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                <div class="flex items-center mr-auto">

                    <?= $form->field($model_courier, 'rememberMe')->checkbox([
                    'template' => "{input} {label}",
                ])->label('Meni eslab qol') ?>
                </div>
            </div>
            <div class=" mt-5 xl:mt-8 text-center xl:text-left">
                <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">Kirish</button>
            </div>
            <?php ActiveForm::end()?>
        </div>
    </div>
</div>
<!-- END: Login Form -->