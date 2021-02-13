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
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
        <script type='text/javascript' charset='utf-8'>
            // Hides mobile browser's address bar when page is done loading.
              window.addEventListener('load', function(e) {
                setTimeout(function() { window.scrollTo(0, 1); }, 1);
              }, false);
        </script>
        <?php $this->head() ?>
    </head>
    <!-- END: Head -->
    <body class="login">
    <?php $this->beginBody() ?>
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Smartbook" width="150" src="/web/images/Logo@1x.png">
                    </a>
                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="/web/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            Smartbook DMS <br> <span style="opacity: 0.4;">Delivery Management System</span>
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white dark:text-gray-500">Kurerlarning ishini tashkil etish</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <?= $content?>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>