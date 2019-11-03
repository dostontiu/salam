<?php

namespace app\modules\api\controllers;

use yii\helpers\Json;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return Json::encode(['status' => true, 'message' => 'Добро пожаловать']);
    }
}
