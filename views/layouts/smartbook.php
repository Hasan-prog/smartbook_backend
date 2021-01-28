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
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="uz" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="/web/images/Icon.png" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <?= Html::csrfMetaTags();?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<!-- END: Head -->

<body class="app">

<?php $this->beginBody() ?>
    <!-- BEGIN: Mobile Menu -->
    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="<?= URL::to(['cities/'])?>" class="mr-auto">
                <img alt="Midone Tailwind HTML Admin Template" width="150" src="/web/images/Logo@1x.png">
            </a>
            <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                    class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        </div>
        <ul class="border-t border-theme-24 py-5 hidden">
            <li>
                <a href="<?= URL::to(['cities/'])?>" class="menu menu--active">
                    <div class="menu__icon"> <i data-feather="map"></i> </div>
                    <div class="menu__title"> Shaharlar </div>
                </a>
            </li>
            <li>
                <a href="<?= URL::to(['couriers/'])?>" class="menu">
                    <div class="menu__icon"> <i data-feather="users"></i> </div>
                    <div class="menu__title"> Kuryerlar
                    </div>
                </a>
            </li>
            <li>
                <a href="<?= URL::to(['products/'])?>" class="menu">
                    <div class="menu__icon"> <i data-feather="list"></i> </div>
                    <div class="menu__title"> Mahsulotlar </div>
                </a>
            </li>
            <li>
                <a href="<?= URL::to(['orders/clients'])?>" class="menu">
                    <div class="menu__icon"> <i data-feather="user-check"></i> </div>
                    <div class="menu__title"> Mijozlar </div>
                </a>
            </li>
            <li>
                <a href="<?= URL::to(['products/history'])?>" class="menu">
                    <div class="menu__icon"> <i data-feather="package"></i> </div>
                    <div class="menu__title"> Berilgan mahsulotlar </div>
                </a>
            </li>
            <li>
                <a href="<?= URL::to(['orders/add-order'])?>" class="menu">
                    <div class="menu__icon"> <i data-feather="plus"></i> </div>
                    <div class="menu__title"> Yangi buyurtma </div>
                </a>
            </li>
        </ul>
    </div>
    <!-- END: Mobile Menu -->
    <!-- BEGIN: Top Bar -->
    <div class="border-b border-theme-24 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
        <div class="top-bar-boxed flex items-center">
            <!-- BEGIN: Logo -->
            <a href="<?= URL::to(['cities/'])?>" class="-intro-x hidden md:block">
                <img alt="Midone Tailwind HTML Admin Template" width="150" src="/web/images/Logo@1x.png">
            </a>
            <!-- END: Logo -->
            <!-- BEGIN: Breadcrumb -->
            <div class="-intro-x breadcrumb breadcrumb--light mr-auto"> 
                <?php
                    //хлебные крошки
                    echo Breadcrumbs::widget([
                        'itemTemplate' => "{link}<i data-feather='chevron-right' class='breadcrumb__icon'></i>",
                        'homeLink' => [
                            'label' => 'Smartbook ',
                            'url' => URL::to(['cities/']),
                            'title' => 'Первая страница сайта мастеров по ремонту квартир',
                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        // 'options' => ['class' => 'breadcrumb', 'style' => ''],
                    ]);
                ?>
            </div>
            <!-- END: Breadcrumb -->
            <!-- BEGIN: Account Menu -->
            <div class="intro-x dropdown w-8 h-8">
                <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110">
                    <img alt="Midone Tailwind HTML Admin Template" src="/web/images/profile-13.jpg">
                </div>
                <div class="dropdown-box w-56">
                    <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                        <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                            <div class="font-medium">Xasan Shadiyarov</div>
                            <div class="text-xs text-theme-41 dark:text-gray-600">Meneger</div>
                        </div>
                        <div class="p-2">
                            <a href="<?= URL::to(['site/profile'])?>"
                                class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="user" class="w-4 h-4 mr-2"></i> Profil </a>
                            <a href="<?= URL::to(['site/reset-password'])?>"
                                class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="lock" class="w-4 h-4 mr-2"></i> Parolni tiklash </a>
                            <a href="<?= URL::to(['cities/'])?>"
                                class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Maslahatlar </a>
                        </div>
                        <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                            <a href="<?= URL::to(['site/log-out'])?>"
                                class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="log-out" class="w-4 h-4 mr-2"></i> Chiqish </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Account Menu -->
        </div>
    </div>
    <!-- END: Top Bar -->
    <!-- BEGIN: Top Menu -->
    <nav class="top-nav">
    <?php
    
        // Getting active controller and action to set the active tab
        $current_controller = Yii::$app->controller->id;
        $current_action = Yii::$app->controller->action->id;
        $cities_active = '';
        $couriers_active = '';
        $products_active = '';
        $clients_active = '';
        $hisotry_active = '';
        $add_product = '';

        if ($current_controller == 'cities') {
            $cities_active = 'top-menu--active';
        };
        if ($current_controller == 'couriers') {
            $couriers_active = 'top-menu--active';
        };
        if ($current_controller == 'products' && $current_action != 'history' && $current_action != 'add-history' && $current_action != 'edit-history') {
            $products_active = 'top-menu--active';
        };
        if ($current_controller == 'products' && $current_action == 'history') {
            $hisotry_active = 'top-menu--active';
        };
        if ($current_controller == 'products' && $current_action == 'add-history') {
            $hisotry_active = 'top-menu--active';
        };
        if ($current_controller == 'products' && $current_action == 'add-order') {
            $add_product = 'top-menu--active';
        };
        if ($current_controller == 'products' && $current_action == 'edit-history') {
            $hisotry_active = 'top-menu--active';
        };
        if ($current_controller == 'orders' && $current_action == 'clients') {
            $clients_active = 'top-menu--active';
        };
        if ($current_controller == 'orders' && $current_action == 'daily-list') {
            $clients_active = 'top-menu--active';
        };
        if ($current_controller == 'orders' && $current_action == 'edit-order') {
            $clients_active = 'top-menu--active';
        };
        if ($current_controller == 'orders' && $current_action == 'add-order') {
            $add_product = 'top-menu--active';
        };

    ?>
        <ul>
            <li>
                <a href="<?= Url::to(['cities/']); ?>" class="top-menu <?= $cities_active?>">
                    <div class="top-menu__icon"> <i data-feather="map"></i> </div>
                    <div class="top-menu__title"> Shaharlar </div>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['couriers/']); ?>" class="top-menu <?= $couriers_active?>">
                    <div class="top-menu__icon"> <i data-feather="users"></i> </div>
                    <div class="top-menu__title"> Kuryerlar </div>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['products/']); ?>" class="top-menu <?= $products_active?>">
                    <div class="top-menu__icon"> <i data-feather="list"></i> </div>
                    <div class="top-menu__title"> Mahsulotlar </div>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['orders/clients']); ?>" class="top-menu <?= $clients_active?>">
                    <div class="top-menu__icon"> <i data-feather="user-check"></i> </div>
                    <div class="top-menu__title"> Mijozlar </div>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['products/history']); ?>" class="top-menu <?= $hisotry_active?>">
                    <div class="top-menu__icon"> <i data-feather="package"></i> </div>
                    <div class="top-menu__title"> Berilgan mahsulotlar </div>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['orders/add-order']); ?>" class="top-menu <?= $add_product?>">
                    <div class="top-menu__icon"> <i data-feather="plus"></i> </div>
                    <div class="top-menu__title"> Yangi buyurtma </div>
                </a>
            </li>
        </ul>
    </nav>
    <!-- END: Top Menu -->
    <!-- BEGIN: Content -->
    <div class="content">
    <?= $content?>
    </div>
    <!-- END: Content -->
    <!-- BEGIN: JS Assets-->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
    <!-- END: JS Assets-->
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>