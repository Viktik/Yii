<?php

namespace backend\controllers;

use common\models\Posts;
use common\models\User;
use common\models\Test;

class SingletonController extends \yii\web\Controller
{
    public function actionIndex($className = '')
    {
        switch ($className) {
            case 'Posts':
                $class = new Posts();
                break;
            case 'User':
                $class = new User();
                break;
            case 'Test':
                $class = new Test();
                break;
            default: $class = false;
        }

        if ($class instanceof \Singleton) {
            $result = 'Single';
        } else {
            $result = 'nope';
        }

        if (!$class){
            $result = 'class does not exist';
        }

        return $this->render('index', [
            'result' => $result,
        ]);
    }

}
