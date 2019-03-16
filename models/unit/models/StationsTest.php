<?php


namespace app\modules\admin\controllers;

use Codeception\PHPUnit\TestCase;
require  'W:\domains\train-basic\train\models\Station.php';

class SrationsTest extends TestCase
{
    public function testCreateStation()
    {
        $station = new Station();
        $station->name = 'TestName';
        $station->save();
    }
}