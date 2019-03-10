<?php

namespace app\controllers;

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

class ApiController extends Controller
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
                    'logout' => ['post'],
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

    public function actionIndex()
    {
     /*   $trainsTchedule = TrainSchedule::find()
            ->with('ArrivalStation')
            ->all();*/

        /*    $trainsTchedule = TrainSchedule::find()
            ->select('train_schedule.*')
            ->leftJoin('stations', '\'stations.id\'=\'train_schedule.departute_station_id\'')
            ->leftJoin('stations', '\'stations.id\'=\'train_schedule.arrival_station_id\'')
            ->all();*/
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT train.id,train.name,departion.id as 'departion_id',departion.name as 'departion_name'
                            
                          , arraval.id as 'arraval_id' ,
                          arraval.name as 'arraval_name',
                          departion.name as 'departition' FROM train_schedule as train
	                      left JOIN stations as departion on train.departute_station_id=departion.id
	                      left JOIN stations as arraval on train.arrival_station_id=arraval.id
	                      ");
        $result = $command->queryAll();



        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $result;
    }

    public function actionGetstation($id)
    {
        $request = Yii::$app->request;
        $post = $request->post();
        $station = Station::find()->where(['=', 'id', $id])->one();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $station;

    }

}