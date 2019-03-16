<?php

namespace app\controllers;

use app\models\Company;
use app\models\Schedule;
use app\models\Station;
use Yii;
use app\models\TrainSchedule;
use app\models\TrainscheduleSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrainscheduleController implements the CRUD actions for TrainSchedule model.
 */
class TrainscheduleController extends ActiveController
{
    public $modelClass = 'app\models\TrainSchedule';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);

        return $actions;
    }


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

    public function actionIndex()
    {
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

    /**
     * Displays a single TrainSchedule model.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

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

            return ["200"];
        }

        return ["404"];
    }

    public function actionUpdate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $post = $request->post();
        $model = TrainSchedule::find()->where(['=', 'id', $post["id"]])->one();
        if ($request->isPost && $model != null) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model->name = $post["name"];
            $model->departute_station_id = $post["departute_station_id"];
            $model->arrival_station_id = $post["arrival_station_id"];
            $model->departut_time = $post["departut_time"];
            $model->arrival_time = $post["arrival_time"];
            $model->save();

            return Yii::$app->response->statusCode = 200;
        } else {
            return Yii::$app->response->statusCode = 409;
        }
    }


    public function actionGetcompany()
    {
        $transporters = Company::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $transporters;
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


    public function actionDelete($id)
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $trainSchedule = TrainSchedule::find()->where(['=', 'id', $id])->one();
        if ($trainSchedule != null) {
            $trainSchedule->delete();

            return Yii::$app->response->statusCode = 200;
        } else {
            return Yii::$app->response->statusCode = 404;
        }
    }
}
