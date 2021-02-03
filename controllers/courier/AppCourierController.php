<?php

namespace app\controllers\courier;

use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;

class AppCourierController extends Controller {

    public function beforeAction($action) {
        if (isset($_COOKIE['role']) && Yii::$app->user->isGuest == false) {
            if ($_COOKIE['role'] == 'courier') {
                return true;
            }
            if ($_COOKIE['role'] == 'manager') {
                return $this->redirect('/web/cities');
            }
            if ($_COOKIE['role'] == 'admin') {
                return $this->redirect('admin/admin/managers');
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
                    ]
                ],
            ],
        ];
    }

}

?>