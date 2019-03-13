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

class StationController extends ActiveController
{
    public $modelClass = 'app\models\Station';

    public function actions()
    {
        $actions = parent::actions();
        //  unset($actions['index']);
        unset($actions['create']);
      //  unset($actions['delete']);
        unset($actions['update']);
   //     unset($actions['view']);

        return $actions;
    }

    public function actionCreate()
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


    public function actionUpdate()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $post = $request->post();

        $model = Station::find()->where(['=', 'id', $id])->one();
        if ($request->isPost && $model != null) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model->name = $post["name"];
            $model->save();

            return ["ok"];
        }

        return ["fail"];
    }

    /*
        public function actionDelete($id)
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $item = Station::find()->where(['=', 'id', $id])->one();
            if ($item != null) {
                //check TrainShedule
                $trainShedule = TrainSchedule::find()
                    ->where(['=', 'arrival_station_id', $id])
                    ->orWhere(['=', 'departute_station_id', $id])->one();
                if ($trainShedule == null) {
                    $item->delete();
                } else {
                    return ["has relation"];
                }


                return ["ok"];
            } else {
                return ["fail"];
            }
        }
    */

}