<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Mahsulotlar', 
    'url'=>URL::to(['cities/']),
);
$this->params['breadcrumbs'][] = array(
    'label'=> $model->name . ', ' . $model->format, 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – " . $model->name . ', ' . $model->format;

?>
<div class="col-span-12 lg:col-span-8 xxl:col-span-9">
    <!-- BEGIN: Display Information -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Mahsulot o'zgarishi
            </h2>
        </div>
        <div class="p-5">
            <?php $form = ActiveForm::begin([
            'method' => 'post',
            'options' => [
                'id' => 'edit_product',
                'enctype' => 'multipart/form-data',
                ]
            ])?>
            <div class="grid grid-cols-12 gap-5">
                <div class="col-span-12 xl:col-span-4">
                    <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5 image-upload">
                        <div class="w-40 h-40 relative image-fit cursor-pointer mx-auto">
                            <img class="rounded-md" alt="photo" src="<?= $model->photo?>">
                            <div class="w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2 remove-photo"
                                style="display: none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-x w-4 h-4">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </div>
                        </div>
                        <div class="w-40 mx-auto cursor-pointer relative mt-5 zoom-in">
                            <button type="button" class="button w-full bg-theme-1 text-white">Boshqa rasm</button>
                            <?= $form->field($model, 'photo')->fileInput(['class' => 'w-full h-full top-0 left-0 absolute opacity-0 select-image', 'onchange' => 'readURL(this)', 'value' => $model->photo])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-8">
                    <div class="mb-4">
                        <?= $form->field($model, 'name', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['class' => 'input w-full border flex-1'])->label("Ism")?>
                    </div>
                    <div class="mb-4">
                        <?= $form->field($model, 'price', ['labelOptions' => ['class' => 'mb-2 block']])->textInput(['type' => 'number', 'class' => 'input w-full border flex-1'])->label("Narx")?>
                    </div>
                    <?php
                    if ($model->parent_id == 0) {
                        ?>
                        <div class="mb-4">
                            <label>Format</label>
                            <select class="tail-select w-full" name="Products[format]">
                                <option value="kiril" <?= $model->format == 'kiril' ? 'selected="selected"' : ''?>>Kiril</option>
                                <option value="lotin" <?= $model->format == 'lotin' ? 'selected="selected"' : ''?>>Lotin</option>
                                <option value="-" <?= $model->format != 'lotin' && $model->format != 'kiril' ? 'selected="selected"' : ''?>>-</option>
                            </select>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="mb-4 hidden">
                            <label>Format</label>
                            <select class="tail-select w-full" name="Products[format]">
                                <option value="kiril">Kiril</option>
                                <option value="lotin">Lotin</option>
                                <option selected="selected" value="-">-</option>
                            </select>
                        </div>
                        <?php
                    }
                    ?>
                    <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">Saqlash</button>
                </div>
            </div>
            <?php ActiveForm::end()?>
        </div>
    </div>
    <!-- END: Display Information -->
    <?php
    if ($model['parent_id'] == 0) {
        ?>
        <!-- BEGIN: Striped Rows -->
        <div class="intro-y box mt-5">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">
                    Ichidagi mahsulotlar
                </h2>
                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <a href="<?= Url::to(['products/add-product?parent_id=' . $model->id])?>" class="button ml-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                        <i data-feather="plus" class="w-4 h-4 mr-2"></i> Yangisini qoshish </a>
                </div>
            </div>
            <?php
            if (!empty($model['subprods'])) {
                ?>
                <div class="p-5" id="striped-rows-table">
                    <div class="preview" style="display: block; opacity: 1;">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">ID</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Rasm</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Ism</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Narx</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Format</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap">Dona Qogan</th>
                                        <th class="border-b-2 dark:border-dark-4 whitespace-no-wrap text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($model['subprods'] as $product) {
                                        $formated_price = number_format ($product['price'], 0, ',', ' ');
                                    ?>
                                    <tr class="bg-gray-100 dark:bg-dark-1 product-row subproduct-row">
                                        <td class="border-b dark:border-dark-5"><?= $product['id']?></td>
                                        <td class="border-b dark:border-dark-5" width="100">
                                            <div class="w-10 h-10 image-fit">
                                                <img alt="" src="<?= $product['photo']?>">
                                            </div>
                                        </td>
                                        <td class="border-b dark:border-dark-5"><?= $product['name']?></td>
                                        <td class="border-b dark:border-dark-5"><?= $formated_price?> so'm</td>
                                        <td class="border-b dark:border-dark-5"><?= $product['format']?></td>
                                        <td class="border-b dark:border-dark-5"><?= $product['in_stock']?> ta</td>
                                        <td class="border-b dark:border-dark-5 md:w-80">
                                            <div class="flex items-center justify-center">
                                                <a class="flex items-center mr-5" href="<?= Url::to(['products/edit-product?id=' . $product['id']])?>"> <i class="w-4 h-4 mr-2"
                                                        data-feather="edit"></i> Ozgartirish </a>
                                                <a class="flex items-center text-theme-6 delete-subject" href="" data-url="<?= Url::to(['products/'])?>" data-id="<?= $product['id']?>" data-parent="product-row" data-msg="Ushbu mahsulotni o'chirmoqchimisiz?"><i class="w-4 h-4 mr-2" data-feather="trash-2"></i> O'chirish </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- END: Striped Rows -->
        <?php
    }
    ?>
    <?php
    if ($model->parent_id > 0) {
        ?>
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5" id="new-arrival">
            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Yangi postavka
                </h2>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-12 gap-5">
                    <div class="col-span-12 xl:col-span-12">
                        <div class="mb-4">
                            <?php $form = ActiveForm::begin()?>
                            <div class="flex items-center">
                                <input type="number" name="new_arrival" class="input w-full border mt-2"
                                    placeholder="Nechta dona kegan...">
                                <button
                                    class="md:w-36 sm:w-auto button ml-2 mt-2 border text-white bg-theme-1 flex items-center justify-center">Qo'shish
                                </button>
                            </div>
                            <?php ActiveForm::end()?>
                            <span class="text-gray-500 flex items-center mt-5"><i data-feather="alert-circle"></i> <span
                                    class="pl-3 xl:w-1/4 md:w-auto">Bu ombordagi mahsulotlar miqdorida haqida qilingan.
                                    Muayyan miqdor kuryerga o'tkazilganda, ombordagi miqdor kamayadi.</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Display Information -->
        <?php
    }
    ?>
</div>