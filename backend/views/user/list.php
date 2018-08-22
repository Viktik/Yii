<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'username',
        'email',
        ['class' => 'yii\grid\ActionColumn',
            'buttons'=>[
                'view'=>function ($url, $model) {
                    $customurl=Yii::$app->getUrlManager()->createUrl(['profile/index','id'=>$model['id']]); //$model->id для AR
                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customurl,
                        ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                }
            ],
            'template'=>'{view}',
        ],
    ]
]);