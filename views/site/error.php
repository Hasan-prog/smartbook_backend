<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<!-- BEGIN: Error Page -->
<div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
    <div class="-intro-x lg:mr-20">
        <img alt="Midone Tailwind HTML Admin Template" class="h-48 lg:h-auto" src="/web/images/error-illustration.svg">
    </div>
    <div class="text-white mt-10 lg:mt-0">
        <div class="intro-x text-6xl font-medium">Oups...</div>
        <div class="intro-x text-xl lg:text-3xl font-medium"><?= Html::encode($this->title)?></div>
        <div class="intro-x text-lg mt-3"><?= nl2br(Html::encode($message))?> Shu hato nimaga chiqkan tushunmasez, <br> iltimos telegramdagi <a style="text-decoration: underline" target="_blank" href="https://t.me/joinchat/H1Q2I3Qfpgx2qbBJ">Texnik Yordamiga</a> yozing. </div>
        <a href="<?= Url::home()?>" class="intro-x button button--lg border bg-white text-theme-1 border-white dark:border-dark-5 dark:text-gray-300 mt-10 inline-block">Bosh Sahifa</a>
        <a target="_blank" href="https://t.me/joinchat/H1Q2I3Qfpgx2qbBJ" class="intro-x button button--lg border border-white dark:border-dark-5 dark:text-gray-300 mt-10 inline-block ml-2">Texni Yordam</a>
    </div>
</div>
<!-- END: Error Page -->