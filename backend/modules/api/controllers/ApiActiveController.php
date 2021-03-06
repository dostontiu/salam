<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;

class ApiActiveController extends ActiveController
{
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['update'], $actions['delete']);
        return $actions;
    }
}