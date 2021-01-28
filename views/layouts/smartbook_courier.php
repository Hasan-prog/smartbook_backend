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
    <script src="dist/js/app.js"></script>
    <script>
        // When the user scrolls the page, execute headersTrigger 
        window.onscroll = function () { headersTrigger() };

        // Get the day
        var day = document.getElementById('1');
        next_header_offset = 0;

        // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function headersTrigger() {
            // Get the day's props
            var orders = day.getElementsByClassName('order-card'),
                last_order = orders[orders.length - 1],
                first_order = orders[0],
                last_order_offset = last_order.offsetTop + last_order.clientHeight,
                first_order_offset = first_order.offsetTop;

            // Get the header
            var header = day.querySelector('.orders-list-header');

            // Get the offset position of the navbar
            var sticky = header.offsetTop;

            var scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop
            if (window.innerWidth <= 480) {
                if (window.pageYOffset < 72) {
                    header.classList.remove("sticky");
                    document.querySelector('.all-orders .order-card').classList.remove("m-48px");
                    return;
                }
                if (window.pageYOffset > sticky && scrollTop < last_order_offset + 16) {
                    header.classList.add("sticky");
                    document.querySelector('.all-orders .order-card').classList.add("m-48px");
                    if (scrollTop + 48 < next_header_offset && parseInt(day.id) > 1) {
                        var prev_day_id = parseInt(day.id) - 1;
                        var prev_day = document.getElementById('' + prev_day_id + '');
                        header.classList.remove("sticky");
                        // document.querySelector('.all-orders .order-card').classList.remove("m-48px");
                        day = prev_day;
                    }
                } else {
                    if (scrollTop > last_order_offset + 48) {
                        var next_day_id = parseInt(day.id) + 1;
                        var next_day = document.getElementById('' + next_day_id + '');
                        header.classList.remove("sticky");
                        document.querySelector('.all-orders .order-card').classList.remove("m-48px");
                        next_header_offset = next_day.querySelector('.orders-list-header').offsetTop;
                        day = next_day;
                    }
                    header.classList.remove("sticky");
                    document.querySelector('.all-orders .order-card').classList.remove("m-48px");
                }
            } else {
                if (window.pageYOffset < 111) {
                    header.classList.remove("sticky");
                    document.querySelector('.all-orders .order-card').classList.remove("m-69px");
                    return;
                }
                if (window.pageYOffset > sticky && scrollTop < last_order_offset + 16) {
                    header.classList.add("sticky");
                    document.querySelector('.all-orders .order-card').classList.add("m-69px");
                    if (scrollTop + 69 < next_header_offset && parseInt(day.id) > 1) {
                        var prev_day_id = parseInt(day.id) - 1;
                        var prev_day = document.getElementById('' + prev_day_id + '');
                        header.classList.remove("sticky");
                        // document.querySelector('.all-orders .order-card').classList.remove("m-69px");
                        day = prev_day;
                    }
                } else {
                    if (scrollTop > last_order_offset + 69) {
                        var next_day_id = parseInt(day.id) + 1;
                        var next_day = document.getElementById('' + next_day_id + '');
                        header.classList.remove("sticky");
                        document.querySelector('.all-orders .order-card').classList.remove("m-48px");
                        next_header_offset = next_day.querySelector('.orders-list-header').offsetTop;
                        day = next_day;
                    }
                    header.classList.remove("sticky");
                    document.querySelector('.all-orders .order-card').classList.remove("m-69px");
                }
            }
        }
    </script>
    <!-- END: JS Assets-->
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>