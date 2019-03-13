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
    public $modelClass='app\models\Schedule';

    /* Declare actions supported by APIs (Added in api/modules/v1/components/controller.php too) */
    public function actions(){
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


/*

    public function actionIndex()
    {
        $items = Schedule::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


        return $items;

    }
*/

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


        }

    }


    public function actionUpdate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $post = $request->post();
        $model = Schedule::find()->where(['=', 'id', $post["id"]])->one();
        if ($request->isPost && $model != null) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model->name = $post["name"];
            $days = $post["days"];
            $model->deleteAllDays();  //очияашем текущие установленные дни для этого экзмпляра
            $days = explode(',', $days);
            foreach ($days as $day) {
                $item = Day::find()->where(['=', 'id', intval($day)])->one();
                if ($item != null) {
                    $model->saveDay($item);
                }
            }

            $model->save();

            return ["ok"];
        }

        return ["fail"];
    }

    public function actionDelete($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $trainSchedule = Schedule::find()->where(['=', 'id', $id])->one();
        if ($trainSchedule != null) {
            $trainSchedule->delete();

            return ["ok"];
        } else {
            return ["fail"];
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
            return null;
        }
    }


}