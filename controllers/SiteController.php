<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\controllers\AppController;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Managers;
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
            return $this->redirect('login');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/web/cities/');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
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