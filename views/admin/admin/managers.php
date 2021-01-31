<?php

use yii\helpers\Html;
use yii\helpers\Url;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Menejerlar', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Kuryerlar";

?>

<!-- BEGIN: Striped Rows -->
<div class="intro-y box mt-5">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto">
            Menejerlar
        </h2>
        <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
            <a href="<?= Url::to(['admin/admin/add-manager'])?>" class="button ml-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                <i data-feather="user-plus" class="w-4 h-4 mr-2"></i> Yangi menejer </a>
        </div>
    </div>
    <div class="p-5" id="striped-rows-table">
        <div class="filters mb-6">
            <form class="xl:flex sm:mr-auto" id="tabulator-html-filter-form">
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Qidirmoq</label>
                    <input data-element="manager-row" type="text" class="input w-full sm:w-40 xxl:w-full mt-2 sm:mt-0 border filter-search"
                        id="tabulator-html-filter-value" placeholder="Kuryer...">
                </div>
            </form>
        </div>
        <div class="preview" style="display: block; opacity: 1;">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">ID</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Rasm</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Ism va Telefon</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Login</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Manzil</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Email</th>
                            <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($managers as $manager) {
                            ?>
                        <tr class="bg-gray-100 dark:bg-dark-1 manager-row">
                        <td class="border-b dark:border-dark-5"><?= $manager['id']?></td>
                            <td class="border-b dark:border-dark-5" width="100">
                                <div class="image-fit profile-image-row">
                                    <img alt="" class="rounded-full" src="<?= $manager['photo']?>">
                                </div>
                            </td>
                            <td class="border-b dark:border-dark-5">
                                <span href="" class="font-medium whitespace-no-wrap"><?= $manager['name']?></span>
                                <a href="tel: +998 (97) 444-67-17">
                                    <div class="text-gray-600 text-xs whitespace-no-wrap"><?= $manager['phone_number']?></div>
                                </a>
                            </td>
                            <td class="border-b dark:border-dark-5"><?= $manager['login']?></td>
                            <td class="border-b dark:border-dark-5"><?= $manager['address']?></td>
                            <td class="border-b dark:border-dark-5">
                                <a href="mailto: <?= $manager['email']?>"><?= $manager['email']?></a>
                            </td>
                            <td class="border-b dark:border-dark-5 md:w-80">
                                <div class="flex items-center justify-center">
                                    <a class="flex items-center mr-5" href="<?= Url::to(['admin/admin/edit-manager?id=' . $manager['id']])?>"> <i class="w-4 h-4 mr-2"
                                            data-feather="edit"></i> Ozgartirish </a>
                                    <a class="flex items-center text-theme-6 delete-subject" data-parent="manager-row" data-msg="Ushbu menejerni o'chirmoqchimisiz?" data-url="<?= Url::to(['admin/admin/delete-manager'])?>" data-id="<?= $manager['id']?>" href=""> <i class="w-4 h-4 mr-2"
                                            data-feather="trash-2"></i> O'chirish </a>
                                </div>
                            </td>
                        </tr>
                        <?php }
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END: Striped Rows -->