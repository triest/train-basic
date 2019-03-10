<?php

namespace app\modules\admin\controllers;

use app\models\Company;
use app\models\Schedule;
use app\models\Station;
use Yii;
use app\models\TrainSchedule;
use app\models\TrainscheduleSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrainscheduleController implements the CRUD actions for TrainSchedule model.
 */
class TrainscheduleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TrainSchedule models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrainscheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
            $temp=$request->post("transportCompyny");
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
