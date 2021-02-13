<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\controllers\AppController;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\LoginAdminForm;
use app\models\LoginCourierForm;
use app\models\ContactForm;
use app\models\Couriers;
use app\models\Managers;
use app\models\Admin;
use yii\web\UploadedFile;

class SiteController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'smartbook_error',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    // /**
    //  * Displays homepage.
    //  *
    //  * @return string
    //  */
    // public function actionIndex()
    // {
    //     $this->debug(Yii::$app);
    //     return $this->render('index');
    // }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'smartbook_login';
        Yii::$app->language = 'uz';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/cities');
        }

        $model = new LoginForm();
        $model_admin = new LoginAdminForm();
        $model_courier = new LoginCourierForm();
        $cookies = Yii::$app->request->cookies;
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $manager = Managers::find()->asArray()->where(['login' => $model['username'], 'view' => 1])->limit(1)->one();
            if ($manager['view'] != 1) {
                Yii::$app->user->logout();
                return $this->redirect(['login']);
                // Add falsh message that this account was deleted
            }
            setcookie('role', 'manager', time() + (86400 * 30), "/");
            return $this->redirect('/cities/');
        }
        if ($model_admin->load(Yii::$app->request->post()) && $model_admin->login()) {
            setcookie('role', 'admin', time() + (86400 * 30), "/");
            return $this->redirect('/admin/admin/managers');
        }
        if ($model_courier->load(Yii::$app->request->post()) && $model_courier->login()) {
            $courier = Couriers::find()->asArray()->where(['login' => $model_courier['username'], 'view' => 1])->limit(1)->one();
            if ($courier['view'] != 1) {
                Yii::$app->user->logout();
                return $this->redirect(['login']);
                // Add falsh message that this account was deleted
            }
            setcookie('role', 'courier', time() + (86400 * 30 * 12 * 2), "/");
            setcookie('courier_id', Yii::$app->user->identity['id'], time() + (86400 * 30 * 12 * 2), "/");
            return $this->redirect('/courier/orders');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
            'model_admin' => $model_admin,
            'model_courier' => $model_courier,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        setcookie("role", "", time() - 3600);

        return $this->redirect(['login']);
    }

    public function actionProfile() {
        $model = Managers::findOne(Yii::$app->user->identity['id']);
        $current_photo = $model->photo;
        if ($model->load(Yii::$app->request->post())) {
            
            $user = Yii::$app->request->post('Managers');
            // Photo upload 
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if ($model->photo != null) {
                if ($model->upload()) {
                    $photo_name = $model->photo->name;
                    $model->photo = '/web/images/' . $photo_name;
                }
            } else {
                $model->photo = $current_photo;
            }

            $model->name = $user['name'];
            $model->phone_number = $user['phone_number'];
            $model->email = $user['email'];
            $model->save();
        }
        return $this->render('profile', compact('model'));
    }


}