<?php

namespace app\controllers;


use app\models\Station;
use Yii;

use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\TrainSchedule;
use yii\rest\ActiveController;

class StationController extends ActiveController
{
    public $modelClass = 'app\models\Station';

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

    /**
     * @return array
     */
    public function actionCreate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;

        if ($request->isPost) {
            $request = $request->post();
            $name = $request["name"];
            $station = Station::find()->where(['=', 'id', $name])->one();
            if ($station != null) {
                return Yii::$app->response->statusCode = 409;
            } elseif ($name == null) {
                return Yii::$app->response->statusCode = 404;
            } else {
                $station = new Station();
                $station->name = $name;
                $station->save();

                return Yii::$app->response->statusCode = 201;
            }
        } else {
            return Yii::$app->response->statusCode = 205;
        }
    }


    /**
     * @return array
     */
    public function actionUpdate()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $name = $request->get('name');
        $model = Station::find()->where(['=', 'id', $id])->one();
        if ($request->isPut && $model != null) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model->name = $name;
            $model->save();
           return Yii::$app->response->statusCode = 200;
        } else {
           return Yii::$app->response->statusCode = 404;
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function actionDelete($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $item = Station::find()->where(['=', 'id', $id])->one();
        if ($item != null) {
            $trainShedule = TrainSchedule::find()
                ->where(['=', 'station_id', $id])
                ->one();
            if ($trainShedule == null) {
                //   $item->delete();
                return Yii::$app->response->statusCode = 200;
            } else {
                return Yii::$app->response->statusCode = 203;
            }


        } else {
            return Yii::$app->response->statusCode = 404;
        }
    }

}