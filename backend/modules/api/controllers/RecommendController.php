<?php

namespace app\modules\api\controllers;

use common\models\Organization;
use Yii;
use yii\web\Controller;

class RecommendController extends Controller
{

    public function actionIndex()
    {
        $data = Yii::$app->request->getQueryParams();
        if(empty($data['latitude']) || empty($data['longitude']) || !is_numeric($data['latitude']) || !is_numeric($data['longitude']) ){
            throw new \yii\web\BadRequestHttpException("Вы должны ввести 'latitude' and 'longitude' ");
        }

        $latitude = $data['latitude'];
        $longitude = $data['longitude'];

        $sql = "SELECT *,(((acos(sin(($latitude*pi()/180)) * sin((substring_index(o.gps, '@', 1)*pi()/180))
	+cos(($latitude*pi()/180)) * cos((substring_index(o.gps, '@', 1)*pi()/180)) * cos((($longitude-
	 substring_index(o.gps, '@', -1))*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance 
FROM organization o ORDER BY distance ASC";

        return Organization::findBySql($sql)->all();
    }
}