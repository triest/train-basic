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
        $command = $connection->createCommand("SELECT 
                      train.id,train.name,
                      departion.id as 'departion_id',
                      departion.name as 'departion_name',
                        train.departut_time as 'departut_time',
                        train.arrival_time as 'arrival_time',
                        train.ticket_price as 'ticket_price',
                         arraval.id as 'arraval_id' ,
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

    public function actionDelstation($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $trainSchedule = TrainSchedule::find()->where(['=', 'id', $id])->one();
        if ($trainSchedule != null) {
            $trainSchedule->delete();

            return ["ok"];
        } else {
            return ["fail"];
        }

    }

    public function actionGetstations()
    {
        $stations = Station::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $stations;
    }

    public function actionGettransporters()
    {
        $transporters = Company::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $transporters;
    }

    public function actionCreate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model = new TrainSchedule();
            $post = $request->post();
            dump($post);
            $name = $post["name"];
            $model->name = $name;
            $temp = Station::find()->where(['=', 'id', $post["departute_station"]])->one();
            $model->saveDepartion($temp);
            $temp = $request->post("arrival_station");
            $temp = Station::find()->where(['=', 'id', $temp])->one();
            $model->saveArrived($temp);
            $temp = $request->post("transportCompyny");
            $temp = Company::find()->where(['=', 'id', $temp])->one();
            $model->ticket_price = $post["price"];
            $model->saveCompany($temp);
            $model->save();

            /* $model->name = $request->name;
              $model->save(false);
              $temp = $request->post("departure_station");
              $temp = Station::find()->where(['=', 'id', $temp])->one();*/


            return ["ok"];
        }

        return ["ok"];
    }

}