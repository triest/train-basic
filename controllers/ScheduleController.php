<?php

namespace app\controllers;

use app\models\Company;
use app\models\Day;
use app\models\Schedule;
use app\models\Station;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\TrainSchedule;
use yii\rest\ActiveController;

class ScheduleController extends ActiveController
{
    public $modelClass = 'app\models\Schedule';

    /* Declare actions supported by APIs (Added in api/modules/v1/components/controller.php too) */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        //   unset($actions['delete']);
        //   unset($actions['view']);
        //   unset($actions['index']);
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
                    'update' => ['put'],
                    'delete' => ['delete'],
                    'deleteall' => ['post'],
                    'search' => ['get'],
                ],

            ],
        ];
    }

    public function actionCreate()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;

        if ($request->isPost) {

            $request = $request->post();
            $shedule = new Schedule();
            $shedule->name = $request["name"];
            $days = $request["days"];
            $days = explode(',', $days);
            $shedule->save(false);
            foreach ($days as $day) {
                $day = Day::find()->where(['=', 'name', $day])->one();
                if ($day != null) {
                    $shedule->saveDay($day);
                }
            }
            return Yii::$app->response->statusCode = 200;


        }

    }


    public function actionUpdate()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $name = $request->get('name');
        $days = $request->get('days');
        $model = Schedule::find()->where(['=', 'id', $id])->one();
        if ($request->isPut && $model != null) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model->name = $name;
            $model->deleteAllDays();  //очияашем текущие установленные дни для этого экзмпляра
            $days = explode(',', $days);//парсим
            foreach ($days as $day) {
                $item = Day::find()->where(['=', 'id', intval($day)])->one();
                if ($item != null) {
                    $model->saveDay($item);
                }
            }
            $model->save();
            return Yii::$app->response->statusCode = 200;
        }
        return Yii::$app->response->statusCode = 404;
    }

    public function actionDelete($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $trainSchedule = Schedule::find()->where(['=', 'id', $id])->one();
        if ($trainSchedule != null) {
            $trainSchedule->delete();
            return Yii::$app->response->statusCode = 200;
        } else {
            return Yii::$app->response->statusCode = 404;
        }
    }


    public function actionGetdays($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $items = Schedule::find()->where(['=', 'id', $id])->one();
        if ($items != null) {
            $days = $items->getDays()->all();
            $days2 = ArrayHelper::toArray($days, [
                'app\models\Day' => [
                    'id',
                ],
            ]);
            $days2 = ArrayHelper::getColumn($days2, 'id');

            return $days2;
        } else {
            return Yii::$app->response->statusCode = 404;
        }
    }


}