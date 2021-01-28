<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- BEGIN: Login Form -->
<div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 log-in-form">
    <div
        class="mb-auto mx-auto xl:ml-20 lg:my-auto md:my-4 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
            Kirish
        </h2>
        <div class="intro-x mt-2 text-gray-500 xl:text-left text-center">Yangi menejer hisobini ro'yxatdan o'tkazish
            uchun <br> mavjud menejer sizga yordam berishkerak</div>
        <?php $form = ActiveForm::begin()?>
        <div class="intro-x mt-8">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'intro-x login__input input input--lg border border-gray-300 block', 'placeholder' => 'Username'])->label(false) ?>
            <?= $form->field($model, 'password')->textInput(['type' => 'password', 'class' => 'intro-x login__input input input--lg border border-gray-300 block mt-4', 'placeholder' => 'Password'])->label(false) ?>
        </div>
        <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
            <div class="flex items-center mr-auto">

                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "{input} {label}",
                ])->label('Meni eslay') ?>
            </div>
        </div>
        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
            <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">Kirish</button>
        </div>
        <?php ActiveForm::end()?>
    </div>
</div>
<!-- END: Login Form -->