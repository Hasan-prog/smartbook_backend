<?php

namespace app\controllers\courier;

use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;

class AppCourierController extends Controller {

    public function debug($arr) {
        echo '<pre>' . print_r($arr, true) . '</pre>';
    }

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