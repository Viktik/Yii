<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        //$id ='id',
        'username',
        'title',
        'body',
        'like',
        'dislike',
        ['class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'like' => function ($url, $model, $id) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['posts/like', 'postId' => $id]); //$model->id для AR
                    return \yii\helpers\Html::a('<span class="glyphicon glyphicon-thumbs-up"></span>', $customurl,
                        ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                },
                'dislike' => function ($url, $model, $id) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['posts/dislike', 'postId' => $id]); //$model->id для AR
                    return \yii\helpers\Html::a('<span class="glyphicon glyphicon-thumbs-down"></span>', $customurl,
                        ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                }
            ],
            'template' => '{like} {dislike}',
        ],
    ]
]);