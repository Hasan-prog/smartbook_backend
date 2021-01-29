<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;

class AppController extends Controller {

    public function debug($arr) {
        echo '<pre>' . print_r($arr, true) . '</pre>';
    }

    // public function beforeAction($action) {
    //     return Yii::$app->user->identityClass = "app\models\Admin";
    // }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
        ];
    }

}

?>