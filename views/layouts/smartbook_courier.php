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
        <?= Html::csrfMetaTags();?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <!-- END: Head -->
    <body class="app">
    <?php $this->beginBody() ?>
    <!-- BEGIN: Mobile Menu -->
    <div class="mobile-menu md:hidden flex justify-center">
        <div class="mobile-menu-bar border-b-0">
            <a href="index.html" class="mr-auto">
                <img alt="" width="150" src="/web/images/Logo@1x.png">
            </a>
        </div>
    </div>
    <!-- END: Mobile Menu -->
    <!-- BEGIN: Top Bar -->
    <div class="-mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 py-5 top-bar-menu">
        <div class="top-bar-boxed flex items-center justify-center">
            <!-- BEGIN: Logo -->
            <a href="index.html" class="-intro-x hidden md:block">
                <img alt="Midone Tailwind HTML Admin Template" width="220" src="/web/images/Logo@1x.png">
            </a>
            <!-- END: Logo -->
        </div>
    </div>
    <!-- END: Top Bar -->
    <!-- BEGIN: Content -->
    <?= $content?>
    <!-- END: Content -->
    <!-- BEGIN: JS Assets-->
    <script
        src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
    <!-- END: JS Assets-->
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>