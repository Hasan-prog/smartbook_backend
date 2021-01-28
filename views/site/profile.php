<?php

use yii\helpers\Html;
use yii\helpers\Url;
//$articleName и $articleAlias передаем из экшена
$this->params['breadcrumbs'][] = array(
    'label'=> 'Profil', 
    'url'=>'#',
    'template' => "{link}",
);

$this->title = "Smartbook DMS – Profil";

?>

<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
        <div class="intro-y box mt-5">
            <div class="relative flex items-center p-5">
                <div class="w-12 h-12 image-fit">
                    <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="/web/images/placeholder.jpg">
                </div>
                <div class="ml-4 mr-auto">
                    <div class="font-medium text-base">Xasan Shadiyarov</div>
                    <div class="text-gray-600">Meneger</div>
                </div>
            </div>
            <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                <a class="flex items-center text-theme-1 dark:text-theme-10 font-medium" href="profile.html"> <svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-user w-4 h-4 mr-2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg> Profil Ma'lumot </a>
                <a class="flex items-center mt-5" href="<?= Url::to(['site/reset-password'])?>"> <svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock w-4 h-4 mr-2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg> Parolni tiklash </a>
            </div>
        </div>
    </div>
    <!-- END: Profile Menu -->
    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Profil Ma'lumot
                </h2>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-12 gap-5">
                    <div class="col-span-12 xl:col-span-4">
                        <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                            <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                <img class="rounded-md" alt="Midone Tailwind HTML Admin Template"
                                    src="/web/images/placeholder.jpg">
                                <div
                                    class="w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-x w-4 h-4">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </div>
                            </div>
                            <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                <button type="button" class="button w-full bg-theme-1 text-white">Boshqa
                                    rasm</button>
                                <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 xl:col-span-8">
                        <div class="mb-4">
                            <label>Ism</label>
                            <input type="text" class="input w-full border mt-2" value="Xasan Shadiyarov"
                                placeholder="Sizning ismiz">
                        </div>
                        <div class="mb-4">
                            <label>Login</label>
                            <input type="text" class="input w-full border mt-2  bg-gray-100 cursor-not-allowed" disabled
                                value="xasan1702" placeholder="login">
                        </div>
                        <div class="mb-4">
                            <label>Email <span class="text-gray-600">(Ixtiyoriy)</span></label>
                            <input type="text" class="input w-full border mt-2" placeholder="Sizning email">
                        </div>
                        <div class="mb-4">
                            <label>Telefon</label>
                            <input type="text" class="input w-full border mt-2" value="+998 (97) 444-67-17"
                                placeholder="Sizning telefon">
                        </div>
                        <button type="button" class="button w-20 bg-theme-1 text-white mt-3">Saqlash</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Display Information -->
    </div>
</div>