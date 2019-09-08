<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class CabinetController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['common', 'admin'],
                'rules' => [
                    [
                        'actions' => ['common'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['admin'],
                        'matchCallback' => function ($rule, $action) {
                            $is_authorized = !Yii::$app->user->isGuest;
                            $is_admin = $is_authorized ? Yii::$app->user->identity->isAdmin() : false;
                            return $is_admin;
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionCommon()
    {
        return $this->render('common_cabinet');
    }

    public function actionAdmin()
    {
        return $this->render('admin_cabinet');
    }
}
