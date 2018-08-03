<?php

namespace backend\controllers;

class SingletonController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index'/*,[
            'classname' => $classname,
        ]*/);
    }

}
