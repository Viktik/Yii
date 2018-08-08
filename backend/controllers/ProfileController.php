<?php



namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\UploadForm;
use yii\web\UploadedFile;
use  common\models\User;

class ProfileController extends Controller
{
    public $userClosed;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new UploadForm();
        $this->userClosed = Yii::$app->user->identity;
        $user = User::findIdentity($this->userClosed->id);

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload($filename = 'user' . $user->id)) {
                // file is uploaded successfully
                return $this->render('index', compact('user', 'model'));
            }
        }
        return $this->render('index', compact('user', 'model'));
    }
}