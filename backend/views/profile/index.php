<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var \common\models\UploadForm $model */
?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><?=$user->username?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 col-lg-3 " align="center">

                <?php if (file_exists("uploads/user$user->id.jpg")) { ?>
                    <img src="/uploads/user<?=$user->id ?>.jpg" width="200" height="211" alt="">
                <?php } else { ?>
                    <img src="/uploads/default.jpg" width="200" height="211" alt=""><?php
                } ?>
                <? if ($id == null) { ?>
                    <? $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                    <?= $form->field($model, 'imageFile')->fileInput() ?>

                    <button>Submit</button>

                    <?php ActiveForm::end();
                } ?>
            </div>

            <div class=" col-md-9 col-lg-9 ">
                <table class="table table-user-information">
                    <tbody>
                    <tr>
                        <td>Name:</td>
                        <td><?= $user->username ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $user->email ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?= $user->phone ?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?= $user->gender ?></td>
                    </tr>
                    <tr>
                        <td>Creation date</td>
                        <td><?= date('H:i D-m-Y', $user->created_at) ?></td>
                    </tr>

                    <tr>
                        <td>Posts quantity</td>
                        <td><a href="<?= Yii::$app->urlManager->createUrl(["profile/posts?id=$id"])?>"><?=$quantity?></a></td>
                    </tr>

                    </tbody>
                </table>
                <? if ($id == null) { ?>
                    <?= Html::a('Update', ['update'], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('New Post', ['create'], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('My Posts', ['posts'], ['class' => 'btn btn-primary']) ?>
                    <?
                } elseif ($isSub == false) {
                    echo Html::a('Subscribe', ["subscribe?user_id=$user->id"], ['class' => 'btn btn-primary']);
                } else {
                    echo Html::a('Unsubscribe', ["unsubscribe?user_id=$user->id"], ['class' => 'btn btn-primary']);
                } ?>
            </div>
        </div>
    </div>

