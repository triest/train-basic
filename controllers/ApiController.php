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
                         company.id as 'company_id',
                         company.name as 'company_name',
                         train.schedule_id as 'schedule_id',
                          departion.name as 'departition' FROM train_schedule as train
	                      left JOIN stations as departion on train.departute_station_id=departion.id
	                      left JOIN stations as arraval on train.arrival_station_id=arraval.id
	                      left join companies as company on company.id=train.transport_company_id
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

        $trainSchedule = Station::find()->where(['=', 'id', $id])->one();
        if ($trainSchedule != null) {
            $trainSchedule->delete();

            return ["ok"];
        } else {
            return ["fail"];
        }
    }

    public function actionDelcompany($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $trainSchedule = Company::find()->where(['=', 'id', $id])->one();
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
            $model->departut_time = $post["despatchtime"];
            $model->arrival_time = $post["arrivaltime"];
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

    public function actionUpdate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $post = $request->post();
        $model = TrainSchedule::find()->where(['=', 'id', $post["id"]])->one();
        if ($request->isPost && $model!=null) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model->name=$post["name"];
            $model->departute_station_id=$post["departute_station_id"];
            $model->arrival_station_id=$post["arrival_station_id"];
            $model->departut_time=$post["departut_time"];
            $model->arrival_time=$post["arrival_time"];
            $model->save();
            return ["ok"];
        }
        else{
            return ["not post"];
        }
    }


    public function actionCreatestation()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;

        if ($request->isPost) {
            $request = $request->post();
            $name = $request["name"];
            $station = Station::find()->where(['=', 'id', $name])->one();
            if ($station != null) {
                return ["alredy"];
            } else {
                $station = new Station();
                $station->name = $name;
                $station->save();

                return ["ok"];
            }
        } else {
            return ["postonly"];
        }
    }

    public function actionGetcompany()
    {
        $transporters = Company::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $transporters;
    }

    public function actionCreatecompany()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;

        if ($request->isPost) {
            $request = $request->post();
            $name = $request["name"];
            $station = Company::find()->where(['=', 'id', $name])->one();
            if ($station != null) {
                return ["alredy"];
            } else {
                $station = new Company();
                $station->name = $name;
                $station->save();

                return ["ok"];
            }
        } else {
            return ["postonly"];
        }
    }

    public function actionGetshedule()
    {
        $items = Schedule::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $items;
    }

    public function actionCreateshedule()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        if ($request->isPost) {
            $request = $request->post();
            $shedule = new Schedule();
            $shedule->name = $request["name"];
            $shedule->days = $request["days"];
            $shedule->save();
        }

    }

    public function actionDelshedule($id)
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


}