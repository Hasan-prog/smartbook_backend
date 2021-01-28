<?php

use yii\helpers\Html;
use yii\helpers\Url;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Shaharlar', 
    'url'=>'#',
    'template' => "{link}",
);
$this->title = "Smartbook DMS – Shaharlar";

// debug($cities);

?>

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <!-- BEGIN: General Report -->
        <div class="col-span-12 mt-8">
            <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">
                    <div class="sm:flex items-center sm:mr-4">
                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Natija</label>
                        <select class="input w-full border col-span-4" name="worker_id"
                            id="tabulator-html-filter-field">
                            <option value="monthly" selected="">Oyli</option>
                            <option value="dayli">Kunli</option>
                            <option value="yearly">Yillik</option>
                            <option value="overall">Jami</option>
                        </select>
                    </div>
                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Qidirmoq</label>
                        <input type="text" class="input w-full sm:w-40 xxl:w-full mt-2 sm:mt-0 border"
                            id="tabulator-html-filter-value" placeholder="Shahar...">
                    </div>
                </form>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <?php 
                // debug($cities);
                // die;
                foreach ($cities as $city) {
                    $couriers = $city['couriers'];
                    if (count($couriers) > 1) {
                        $couriers_routing = '-courier';
                        $courier_id = '&courier=' . $couriers[0]['id'];
                    } else {
                        $couriers_routing = '';
                        $courier_id = '';
                    } ?>
                <a href="<?= Url::to(['cities/monthly-list' . $couriers_routing . '?city=' . $city['id']]) . $courier_id?>" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="home" class="report-box__icon text-theme-10"></i>
                                <div class="ml-auto">
                                    <div
                                        class="py-1 pl-1 pr-2 rounded-full text-xs text-gray-600 bg-gray-100 font-medium flex items-center">
                                        <?php
                                        foreach ($city['couriers'] as $courier) {
                                        ?>
                                        <span class="rounded-full courier-label mr-2"><img src="<?= $courier['photo']?>"
                                                alt="<?= $courier['name']?>"></span>
                                        <?php }
                                        ?>
                                        <?= count($city['couriers'])?> kuryer
                                    </div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6"><?= $city['name']?></div>
                            <div class="text-md text-gray-600 mt-2 flex items-center">
                                <div class="flex text-gray-700">
                                    <div class="mr-4 flex items-center">
                                        <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div>
                                        <?php 
                                        $i = 0;
                                        $o = 0;
                                        foreach ($city['orders'] as $order) {
                                            if ($order['status'] == 'delivered') {
                                                $i++;
                                            }
                                            $o++;
                                        }
                                        echo $i;
                                        ?> yetkazildi
                                    </div>
                                    <div class="mr-4 flex items-center">
                                        <div class="w-2 h-2 bg-theme-12 rounded-full mr-2"></div>
                                        <?= $o?> buyurtma
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <?php }
                ?>
            </div>
        </div>
        <!-- END: General Report -->
    </div>
    <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
        <div class="xxl:pl-6 grid grid-cols-12 gap-6">
            <!-- BEGIN: Important Notes -->
            <div
                class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-auto">
                        Maslahatlar
                    </h2>
                    <button data-carousel="important-notes" data-target="prev"
                        class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600 mr-2">
                        <i data-feather="chevron-left" class="w-4 h-4"></i> </button>
                    <button data-carousel="important-notes" data-target="next"
                        class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600">
                        <i data-feather="chevron-right" class="w-4 h-4"></i> </button>
                </div>
                <div class="mt-5 intro-x">
                    <div class="box zoom-in">
                        <div class="tiny-slider" id="important-notes">
                            <div class="p-5">
                                <div class="text-base font-medium truncate">Menejer nima qilishi mumkin?
                                </div>
                                <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of
                                    the printing and typesetting industry. Lorem Ipsum has been the industry's
                                    standard dummy text ever since the 1500s.</div>
                            </div>
                            <div class="p-5">
                                <div class="font-medium truncate">Qanday qilib yangi buyurtma yaratish mumkin?
                                </div>
                                <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of
                                    the printing and typesetting industry. Lorem Ipsum has been the industry's
                                    standard dummy text ever since the 1500s.</div>
                            </div>
                            <div class="p-5">
                                <div class="font-medium truncate">Sayt navigatsiyasi qanday ishlaydi?</div>
                                <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of
                                    the printing and typesetting industry. Lorem Ipsum has been the industry's
                                    standard dummy text ever since the 1500s.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Important Notes -->
        </div>
    </div>
</div>