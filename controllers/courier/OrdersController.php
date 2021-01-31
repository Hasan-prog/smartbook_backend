<?php

namespace app\controllers\courier;

// use app\controllers\AppController;
use yii\web\Controller;
use Yii;
use app\models\Orders;
use app\models\Couriers;

class OrdersController extends AppCourierController
{

    public function actionIndex() {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $status = Yii::$app->request->post('status');
            $model = Orders::findOne($id);
            $model->status = $status;
            $model->comment = Yii::$app->request->post('comment');
            $model->last_changed_time = date('Y-m-d h:m:s');
            $model->last_changed_user = Yii::$app->user->identity['name'];
            $model->save();
            return;
        }
        $this->layout = 'smartbook_courier';
        Yii::$app->language = 'uz';
        if (isset($_COOKIE['courier_id'])) {
            $courier_id = $_COOKIE['courier_id'];
        } else {
            return $this->redirect('/courier/orders/logout');
        }

        $orders = Orders::find()->asArray()->where(['courier_id' => $courier_id])->where(['status' => 'not-delivered'])->all();
        $d_arr = [];
        function move_to_top(&$array, $key) {
            $temp = array($key => $array[$key]);
            unset($array[$key]);
            $array = $temp + $array;
        }
        foreach ($orders as $order) {
            if ($order['status'] == 'not-delivered') {
                $d['day'] = date('d', strtotime($order['datetime']));
                $d['month'] = date('M', strtotime($order['datetime']));
                $d['month_i'] = date('m', strtotime($order['datetime']));
                $d['year_i'] = date('Y', strtotime($order['datetime']));
                $d['datetime'] = $order['datetime'];
                array_push($d_arr, $d);
            }
        }

        // Clear repeated days
        // if (!empty($d_arr)) {
        //     foreach ($d_arr as $key => $data) {
        //         $day = $data['day'];
        //         $taken_key = $key;
        //         foreach ($d_arr as $key_2 => $data_2) {
        //             if ($data_2['day'] == $day && $taken_key != $key_2) {
        //                 unset($d_arr[$key_2]);
        //             }
        //         }
        //     }
        // }


        usort($d_arr, function($a, $b) {
        $ad = $a['datetime'];
        $bd = $b['datetime'];

        if ($ad == $bd) {
            return 0;
        }

        return $ad < $bd ? -1 : 1;
        });
        // debug($d_arr); die;


        return $this->render('current-orders', compact('orders', 'd_arr'));
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        setcookie("role", "", time() - 3600);
        setcookie("courier_id", "", time() - 3600);

        return $this->redirect(['/site/login']);
    }

}
