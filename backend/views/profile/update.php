<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Update';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to update your profile:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin();

            $params = [
                'prompt' => ''
            ];

            $options = [
                'male' => 'male',
                'female' => 'female',
            ];
            ?>

            <?= $form->field($model, 'gender')->dropDownList($options, $params); ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'phone') ?>


            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
