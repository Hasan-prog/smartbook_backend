<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;

class AppController extends Controller {

    public function beforeAction($action) {
        if (isset($_COOKIE['role']) && Yii::$app->user->isGuest == false) {
            if ($_COOKIE['role'] == 'manager') {
                return true;
            }
            if ($_COOKIE['role'] == 'admin') {
                return $this->redirect('admin/admin/managers');
            }
            if ($_COOKIE['role'] == 'courier') {
                return $this->redirect('courier/orders');
            }
        } else {
            if (Yii::$app->controller->action->id != 'login') {
                return $this->redirect('/site/login');
            } else {
                return true;
            }
        }
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
                    ],
                ],
            ],
        ];
    }

}

?>