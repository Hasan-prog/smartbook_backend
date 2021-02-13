<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="uz" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="/web/images/Icon.png" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <meta name="mobile-web-app-capable" content="yes">
        <?= Html::csrfMetaTags();?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
        <script type='text/javascript' charset='utf-8'>
            // Hides mobile browser's address bar when page is done loading.
              window.addEventListener('load', function(e) {
                setTimeout(function() { window.scrollTo(0, 1); }, 1);
              }, false);
        </script>
    </head>
    <!-- END: Head -->
    <body class="app" id="body">
    <?php $this->beginBody() ?>
    <!-- BEGIN: Mobile Menu -->
    <div class="mobile-menu md:hidden flex align-center">
        <div class="mobile-menu-bar border-b-0">
            <a href="<?= Url::to('/courier/orders/monthly-list')?>" class="menu-item" style="">
                <i data-feather="calendar" class="w-5 h-5"></i>
            </a>
            <a href="<?= Url::to('/courier/orders')?>" class="mr-auto logo">
                <img alt="" width="150" src="/web/images/Logo@1x.png">
            </a>
            <a href="#" class="menu-item profile" style="">
                <img src="<?= Yii::$app->user->identity['photo']?>" alt="">
            </a>
        </div>
    </div>
    <!-- END: Mobile Menu -->
    <!-- BEGIN: Top Bar -->
    <div class="-mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 py-5 top-bar-menu">
        <div class="top-bar-boxed flex items-center justify-center">
            <!-- BEGIN: Logo -->
            <a href="<?= Url::to('/courier/orders')?>" class="-intro-x hidden md:block">
                <img alt="Midone Tailwind HTML Admin Template" width="220" src="/web/images/Logo@1x.png">
            </a>
            <!-- END: Logo -->
        </div>
    </div>
    <!-- END: Top Bar -->
    <!-- BEGIN: Content -->
    <?= $content?>
    <!-- END: Content -->
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>