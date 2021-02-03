<?php

namespace app\controllers\admin;

use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;
use app\models\Managers;
use yii\web\UploadedFile;
use app\models\LoginFormAdmin;
use app\models\Admin;
use yii\rbac\DbManager;

class AdminController extends AppAdminController {

    public function actionManagers() {
        $this->layout = 'smartbook_admin';
        $managers = Managers::find()->orderBy('id DESC')->where(['view' => 1])->asArray()->all();
        return $this->render('managers', compact('managers'));
    }

    public function actionDeleteManager() {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $manager = Managers::findOne($id);
            $manager->view = 0;
            $manager->save();
            return true;
        }
        return $this->redirect(['admin/admin/managers']);
    }

    public function actionAddManager() {
        $model = new Managers();
        $this->layout = 'smartbook_admin';
        $current_photo = $model->photo;
        
        if ($model->load(Yii::$app->request->post())) {
            $manager = Yii::$app->request->post('Managers');

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

            $model->name = $manager['name'];
            $model->phone_number = $manager['phone_number'];
            $model->login = $manager['login'];
            $model->password = Yii::$app->getSecurity()->generatePasswordHash($manager['password']);
            $model->address = $manager['address'];
            $model->email = $manager['email'];
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->save();
            return $this->redirect(['admin/admin/managers']);
        }
        return $this->render('add-manager', compact('model'));
    }

    public function actionEditManager() {
        $this->layout = 'smartbook_admin';
        $id = Yii::$app->request->get('id');
        $model = Managers::findOne($id);
        if (empty($model)) {
            return $this->goBack();
        }
        if ($model->view != 1) {
            return $this->goBack();
        }
        $current_photo = $model->photo;
        $current_password = $model->password;

        if ($model->load(Yii::$app->request->post())) {
            $manager = Yii::$app->request->post('Managers');

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

            $model->name = $manager['name'];
            $model->phone_number = $manager['phone_number'];
            $model->login = $manager['login'];
            if ($model->password != '') {
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($manager['password']);
            } else {
                $model->password = $current_password;
            }
            $model->address = $manager['address'];
            $model->email = $manager['email'];
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->save();
            return $this->redirect(['admin/admin/managers']);
        }

        return $this->render('edit-manager', compact('model'));
    }

    public function actionLogin() {
        $this->layout = 'smartbook_login';
        Yii::$app->language = 'uz';
        $session = Yii::$app->session;

        if (!Yii::$app->user->isGuest) {
            // return $this->redirect('login');
        }

        $model = new LoginFormAdmin();
        $user = new Admin();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $session['role'] = 'admin';
            // return $this->redirect('/web/admin/admin/managers');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }

    public function actionProfile() {
        $this->layout = 'smartbook_admin';
        $model = Admin::findOne(Yii::$app->user->identity['id']);
        $current_photo = $model->photo;
        $current_password = $model->password;
        if ($model->load(Yii::$app->request->post())) {
            
            $user = Yii::$app->request->post('Admin');
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
            $model->login = $user['login'];
            if ($model->password != '') {
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($user['password']);
            } else {
                $model->password = $current_password;
            }
            $model->phone_number = $user['phone_number'];
            $model->email = $user['email'];
            $model->save();
        }

        return $this->render('profile', compact('model'));
    }

}

?>