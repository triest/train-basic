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

class CompanyController  extends ActiveController
{
    public $modelClass='app\models\Company';

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



    public function actionIndex()
    {
        $items = Company::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $items;

    }

    public function actionView($id){
        $items = Company::find()->where(['id' => $id])->one();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $items;
    }




    public function actionCreate()
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


    public function actionUpdate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $post = $request->post();

        $model = Company::find()->where(['=', 'id', $post["id"]])->one();
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

        $item = Company::find()->where(['=', 'id', $id])->one();
        if ($item != null) {
            $trainShedule = TrainSchedule::find()
                ->where(['=', 'transport_company_id', $id])
                ->one();
            if ($trainShedule == null) {
             //   $item->delete();
                return ["ok"];
            } else {
                return ["has relation"];
            }


        } else {
            return ["fail"];
        }
    }


}