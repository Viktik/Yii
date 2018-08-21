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
        $id ='id',
        'title',
        'body',
        ['class' => 'yii\grid\ActionColumn',
            'buttons'=>[
                'view'=>function ($url, $model, $id) {
                    $customurl=Yii::$app->getUrlManager()->createUrl(['posts/update','id'=>$id]); //$model->id для AR
                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $customurl,
                        ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                }
            ],
            'template'=>'{view}',
        ],
    ]
]);