<?php

namespace backend\controllers;

class SingletonController extends \yii\web\Controller
{
    public function actionIndex($className = '')
    {
        return $this->render('index', [
            'className' => $className,
        ]);
    }

}
