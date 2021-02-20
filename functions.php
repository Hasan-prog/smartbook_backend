<?php

    date_default_timezone_set('Asia/Tashkent');
    setlocale(LC_ALL, 'uz_UZ');

    function debug($arr) {
        echo '<pre>' . print_r($arr, true) . '</pre>';
    }

    function price_format($price) {
        return number_format ($price, 0, ',', ' ');
    }

    function cutMonth($datetime) {
        return date('m', strtotime($datetime));
    }

    function cutDay($datetime) {
        return date('d', strtotime($datetime));
    }

    function payment_method_format($payment_method) {
        if ($payment_method == 'cash') {
            return 'Naqd';
        } 
        if ($payment_method == 'click') {
            return 'Click';
        }
        if ($payment_method == 'click-paid') {
            return 'Click to\'langan';
        }
    }

    function compareByName($a, $b) {
        return strcmp($a["name"], $b["name"]);
    }

    function order_actions($status) {
        if ($status == 'delivered') {
            ?>
            <button data-status="delivered" data-style="bg-theme-9" class="dropdown-toggle button button--sm inline-block bg-theme-9 text-white flex items-center w-32 justify-center">Yetkazilgan <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
            <div class="dropdown-box w-32">
                <div class="dropdown-box__content box dark:bg-dark-1"> 
                    <button data-status="not-delivered" data-style="bg-theme-12" class="button button--sm inline-block bg-theme-12 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Yetkazilmagan</button>
                    <button data-status="canceled" data-style="bg-theme-6" class="button button--sm inline-block bg-theme-6 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Qaytarilgan</button>
                </div>
            </div>
            <?php
        }
        if ($status == 'not-delivered') {
            ?>
            <button data-status="not-delivered" data-style="bg-theme-12" class="dropdown-toggle button button--sm inline-block bg-theme-12 text-white flex items-center w-32 justify-center">Yetkazilmagan <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
            <div class="dropdown-box w-32">
                <div class="dropdown-box__content box dark:bg-dark-1"> 
                    <button data-status="delivered" data-style="bg-theme-9" class="button button--sm inline-block bg-theme-9 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Yetkazilgan</button>
                    <button data-status="canceled" data-style="bg-theme-6" class="button button--sm inline-block bg-theme-6 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Qaytarilgan</button>
                </div>
            </div>
            <?php
        }
        if ($status == 'canceled') {
            ?>
            <button data-status="canceled" data-style="bg-theme-6" class="dropdown-toggle button button--sm inline-block bg-theme-6 w-32 text-white flex items-center justify-center">Qaytarilgan <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
            <div class="dropdown-box w-32">
                <div class="dropdown-box__content box dark:bg-dark-1"> 
                    <button data-status="not-delivered" data-style="bg-theme-12" class="button button--sm inline-block bg-theme-12 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Yetkazilmagan</button>
                    <button data-status="delivered" data-style="bg-theme-9" class="button button--sm inline-block bg-theme-9 text-white mx-auto w-32 text-center flex items-center justify-center mb-1">Yetkazilgan</button>
                </div>
            </div>
            <?php
        }
    }

    function getUzMonth($m) {
        if ($m == 'Dec') {
            return 'Dekabr';
        }
        if ($m == 'Jan') {
            return 'Yanvar';
        }
        if ($m == 'Feb') {
            return 'Fevral';
        }
        if ($m == 'Mar') {
            return 'Mart';
        }
        if ($m == 'Apr') {
            return 'Aprel';
        }
        if ($m == 'May') {
            return 'May';
        }
        if ($m == 'Jun') {
            return 'Iyun';
        }
        if ($m == 'Jul') {
            return 'Iyul';
        }
        if ($m == 'Aug') {
            return 'Avgust';
        }
        if ($m == 'Sep') {
            return 'Sentabr';
        }
        if ($m == 'Okt') {
            return 'Oktabr';
        }
        if ($m == 'Nov') {
            return 'Noyabr';
        }
    }

?>