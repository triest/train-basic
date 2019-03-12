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
class TrainscheduleController  extends ActiveController
{
    public $modelClass='app\models\TrainSchedule';

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

        return $stations;

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

    /**
     * Creates a new TrainSchedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrainSchedule();
        $request = Yii::$app->request;
        $post = $request->post();


        if ($model->load($request->post()) && $model->save()) {

            $temp = $request->post("departure_station");

            $temp = Station::find()->where(['=', 'id', $temp])->one();
            $model->saveDepartion($temp);
            $temp = $request->post("arrival_station");
            $temp = Station::find()->where(['=', 'id', $temp])->one();
            $model->saveArrived($temp);
            $temp = $request->post("transportCompyny");
            $temp = Company::find()->where(['=', 'id', $temp])->one();
            $model->saveCompany($temp);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        $Station = ArrayHelper::map(Station::find()->all(), 'id', 'name');
        $Compynyes = ArrayHelper::map(Company::find()->all(), 'id', 'name');
        $Schedule = ArrayHelper::map(Schedule::find()->all(), 'id', 'days');

        return $this->render('create', [
            'model' => $model,
            'departuteStation' => $Station,
            'arrivalStation' => $Station,
            'transportCompyny' => $Compynyes,
            'Schedule' => $Schedule,

        ]);
    }

    /**
     * Updates an existing TrainSchedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $Station = ArrayHelper::map(Station::find()->all(), 'id', 'name');
        $Compynyes = ArrayHelper::map(Company::find()->all(), 'id', 'name');
        $Schedule = ArrayHelper::map(Schedule::find()->all(), 'id', 'days');

        return $this->render('update', [
            'model' => $model,
            'departuteStation' => $Station,
            'arrivalStation' => $Station,
            'transportCompyny' => $Compynyes,
            'Schedule' => $Schedule,
        ]);
    }

    /**
     * Deletes an existing TrainSchedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrainSchedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return TrainSchedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrainSchedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
