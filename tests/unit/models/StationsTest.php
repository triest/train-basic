<?php


namespace app\models;

use Yii;
use Codeception\PHPUnit\TestCase;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\TrainSchedule;
use yii\rest\ActiveController;
use Codeception\Lib\Connector\Yii2;
require  'W:\domains\train-basic\train\models\Station.php';

class SrationsTest extends TestCase
{
    public function testCreateStation()
    {
        $station=new Station();
       $station->name="Test";
       $station->save();

      //  $this->assertEquals("Test", Station::find()->test);
    }
}