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

class ScheduleController extends Controller
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
        $stations = Schedule::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $stations;

    }


    public function actionCreate()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        if ($request->isPost) {

            $request = $request->post();
            $shedule = new Schedule();
            $shedule->name = $request["name"];
            $shedule->days = $request["days"];
            $shedule->save(false);
        }

    }



    public function actionUpdate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $post = $request->post();

        $model = Station::find()->where(['=', 'id', $post["id"]])->one();
        if ($request->isPost && $model != null) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model->name = $post["name"];
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


}