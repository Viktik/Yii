<?php

namespace backend\controllers;

use common\models\SignupForm;
use common\models\Subscribes;
use Yii;
use yii\data\ActiveDataProvider;
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

    public function actionIndex($id = null)
    {
        $user = $this->findModel($id);
        $model = new UploadForm();
        $quantity = Posts::find()
            ->where(['user_id' => $user->id])
            ->count();

        $sub = $this->findSub($id);
        if ($sub->status == 1) {
            $isSub = true;
        } else {
            $isSub = false;
        }

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload($filename = 'user' . $user->id)) {
                // file is uploaded successfully
                return $this->render('index', compact('user', 'model', 'quantity', 'id', 'isSub'));
            }
        }
        return $this->render('index', compact('user', 'model', 'quantity', 'id', 'isSub'));
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

    protected function findModel($id = null)
    {
        if ($id == null){
            $id = Yii::$app->user->identity->id;
        }
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findSub($user_id)
    {
        $subscriber_id = Yii::$app->user->identity->id;
        $model = Subscribes::findOne([
            'subscriber_id' => $subscriber_id,
            'user_id' => $user_id,
        ]);

        if ($model) {
            return $model;
        } else {
            return false;
        }
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

    public function actionPosts($id = null)
    {
        $user = $this->findModel($id);

        $query = Posts::find()
            ->select('title, body, id')
            ->where(['user_id' => $user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('posts', compact('dataProvider', 'user'));
    }

    public function actionSubscribe($user_id)
    {
        $model = $this->findSub($user_id);
        if ($model) {
            $model->status = 1;
            $model->save();
        } else {
            $subscriber_id = Yii::$app->user->identity->id;
            $model = new Subscribes();
            $model->subscriber_id = $subscriber_id;
            $model->user_id = $user_id;
            $model->status = 1;
            $model->save();
        }

        return $this->redirect(["profile/index?id=$user_id"]);
    }

    public function actionUnsubscribe($user_id)
    {
        $model = $this->findSub($user_id);
        $model->status = 0;
        $model->save();
        return $this->redirect(["profile/index?id=$user_id"]);
    }

    public function actionNews()
    {
        $subscriber_id = Yii::$app->user->identity->id;

        $subscribesAll = Subscribes::find()
            ->select('user_id')
            ->where(['subscriber_id' => $subscriber_id,
                     'status' => 1])
            ->asArray()
            ->all();

        $subscribes = array_column($subscribesAll, 'user_id');

        $query = Posts::find()
            ->select(['posts.id', 'posts.title', 'posts.body', 'user.username'])
            ->from('posts')
            ->joinWith('user')
            ->where(['posts.user_id' => $subscribes])
            ->orderBy('posts.updated_at DESC')
            ->asArray();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        /*print_r($dataProvider);
        exit;*/
        return $this->render('news', compact('dataProvider'));

    }
}