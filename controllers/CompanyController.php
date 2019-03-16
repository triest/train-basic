<?php

namespace app\controllers;

use app\models\Company;
use app\models\Schedule;
use app\models\Station;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\TrainSchedule;
use yii\rest\ActiveController;

class CompanyController extends ActiveController
{
    public $modelClass = 'app\models\Company';

    public function actions()
    {
        $actions = parent::actions();
        //  unset($actions['index']);
        unset($actions['create']);
        //  unset($actions['delete']);
        unset($actions['update']);

        //     unset($actions['view']);

        return $actions;
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['index', 'view', 'create', 'update', 'search'],
                'formats' => ['application/json' => Response::FORMAT_JSON,],

            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'view' => ['get'],
                    'create' => ['post'],
                    'update' => ['patch', 'put'],

                    'delete' => ['delete'],
                    'deleteall' => ['post'],
                    'search' => ['get'],
                ],

            ],
        ];
    }


    public function actionView($id)
    {
        $items = Company::find()->where(['id' => $id])->one();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $items;
    }


    public function actionCreate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;

        if ($request->isPost) {
            $request = $request->post();
            $name = $request["name"];
            $station = Company::find()->where(['=', 'id', $name])->one();
            if ($station != null) {
                return Yii::$app->response->statusCode = 409;
            } else {
                $station = new Company();
                $station->name = $name;
                $station->save();

                return Yii::$app->response->statusCode = 200;
            }
        } else {
            return Yii::$app->response->statusCode = 405;
        }
    }


    public function actionUpdate()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $name = $request->get('name');
        $model = Company::find()->where(['=', 'id', $id])->one();
        if ($request->isPut && $model != null) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model->name = $name;
            $model->save();

            return Yii::$app->response->statusCode = 200;
        }

        return Yii::$app->response->statusCode = 404;
    }

    public function actionDelete($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $item = Company::find()->where(['=', 'id', $id])->one();
        if ($item != null) {
            $trainShedule = TrainSchedule::find()
                ->where(['=', 'transport_company_id', $id])
                ->one();
            if ($trainShedule == null) {
                //   $item->delete();
                return Yii::$app->response->statusCode = 200;
            } else {
                return Yii::$app->response->statusCode = 409;
            }


        } else {
            return Yii::$app->response->statusCode = 404;
        }
    }


}