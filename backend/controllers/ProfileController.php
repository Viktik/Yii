<?php



namespace backend\controllers;

use common\models\SignupForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\UploadForm;
use yii\web\UploadedFile;
use common\models\User;
use common\models\Posts;

class ProfileController extends Controller
{

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
        $user = $this->findModel();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload($filename = 'user' . $user->id)) {
                // file is uploaded successfully
                return $this->render('index', compact('user', 'model'));
            }
        }
        return $this->render('index', compact('user', 'model'));
    }

    public function actionUpdate()
    {
        $model = new SignupForm();
        $currentUser = $this->findModel();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->update($currentUser)) {
                    return $this->redirect(['profile/index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findModel()
    {
        $id = Yii::$app->user->identity->id;
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreate()
    {
        $user_id = Yii::$app->user->identity->id;

        $model = new posts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile/index']);
        }

        return $this->render('create', [
            'model' => $model,
            'user_id' => $user_id,
        ]);
    }
}