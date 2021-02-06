<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "Oyli Buyurtmalar";

?>
    <!-- BEGIN: Content -->
    <div class="content">
        <div class="filters mb-6 py-4">
            <form class="xl:flex md:mr-auto" id="tabulator-html-filter-form">
                <div class="md:flex items-center">
                    <label class="w-full flex-1 xl:w-auto xl:flex-initial mr-2">Oyni tanlang</label>
                    <select class="input w-full border col-span-4" name="worker_id" id="tabulator-html-filter-field">
                        <?php
                        $i = 0;
                        foreach ($months_list as $month_option) {
                            ?>
                            <option value="<?= $month_option?>" <?= $i == 0 ? 'selected' : ''?>><?= $month_option?></option>
                            <?php
                            $i++;
                        }
                        ?>
                    </select>
                </div>
            </form>
        </div>
        <?php
        foreach ($months as $month) {
            ?>
            <!-- BEGIN: Striped Rows -->
            <div class="box mt-5">
                <div class="flex flex-col md:flex-row items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium mr-auto">
                        <?php 
                        $random_order = array_rand($month);
                        $month_name = date('M', strtotime($month[$random_order]['datetime']));
                        ?>
                        <?= getUzMonth($month_name)?>, <?= date('Y', strtotime($month[$random_order]['datetime']))?> yil
                    </h2>
                </div>
                <div class="text-gray-700 month-info px-5 py-4">
                    <div class="flex items-center py-2">
                        <div class="w-2 h-2 bg-theme-12 rounded-full mr-2"></div> 490 Umumiy
                    </div>
                    <div class="flex items-center py-2">
                        <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> 0 Qaytarilgan
                    </div>
                    <div class="flex items-center py-2">
                        <span class="text-gray-500 mr-2">Naqd:</span> 274 561 000 so'm
                    </div>
                    <div class="flex items-center py-2">
                        <span class="text-gray-500 mr-2">Click:</span> 22 663 000 so'm
                    </div>
                    <div class="flex items-center py-2">
                        <span class="text-gray-500 mr-2">Umumiy:</span> 297 224 000 so'm
                    </div>
                </div>
                <div class="" id="striped-rows-table">
                    <div class="preview" style="display: block; opacity: 1;">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 w-16 dark:border-dark-4 whitespace-no-wrap">Sana</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Sotish</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Naqd</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Click</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Umumiy</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cursor-pointer" onclick="window.location.href = '_daily-list.html';">
                                        <td class="border-b dark:border-dark-5 font-medium">14 Yanvar</td>
                                        <td class="border-b dark:border-dark-5">
                                            <div class="flex text-gray-700">
                                                <div class="mr-6 flex items-center">
                                                    <div class="w-2 h-2 bg-theme-9 rounded-full mr-2"></div> 20 Yetkazildi
                                                </div>
                                                <div class="mr-6 flex items-center">
                                                    <div class="w-2 h-2 bg-theme-6 rounded-full mr-2"></div> 0 Qaytarilgan
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-b dark:border-dark-5">4 093 000 so'm</td>
                                        <td class="border-b dark:border-dark-5">599 000 so'm</td>
                                        <td class="border-b dark:border-dark-5">4 692 000 so'm</td>
                                        <td class="border-b dark:border-dark-5">
                                            <div class="flex items-center justify-center">
                                                <a class="flex items-center mr-5" href="_daily-list.html"> <i
                                                        class="w-4 h-4 mr-2" data-feather="list"></i> Xaridlar </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Striped Rows -->
            <?php
        }
        ?>
    </div>
    <!-- END: Content -->