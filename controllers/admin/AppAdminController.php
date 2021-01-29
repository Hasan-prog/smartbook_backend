<?php

namespace app\controllers\admin;

use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;

class AppAdminController extends Controller {

    // public function beforeAction($action) {

    //     $session = Yii::$app->session;
    //     if ($session['role'] != "admin" && Yii::$app->user->isGuest == false) {
    //         return $this->redirect('/web/cities/');
    //     }
    //     return parent::beforeAction($action);

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