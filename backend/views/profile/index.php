<?php
use yii\widgets\ActiveForm;

?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><?=$user->username?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 col-lg-3 " align="center">
                <?php if($model->imageFile): ?>
                    <img src="/uploads/<?= $model->imageFile?>" alt="">
                <?php endif; ?>
                <? $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                <?= $form->field($model, 'imageFile')->fileInput() ?>

                <button>Submit</button>

                <?php ActiveForm::end() ?>
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
                        <td>Creation date</td>
                        <td><?= date('H:i D-m-Y', $user->created_at) ?></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

