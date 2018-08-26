<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

if ($user->id == Yii::$app->user->identity->id) {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //$id ='id',
            'title',
            'body',
            'like',
            'dislike',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $id) {
                        $customurl = Yii::$app->getUrlManager()->createUrl(['posts/update', 'id' => $id]); //$model->id для AR
                        return \yii\helpers\Html::a('<span class="glyphicon glyphicon-pencil"></span>', $customurl,
                            ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                    }
                ],
                'template' => '{view}',
            ],
        ]
    ]);
} else {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //$id ='id',
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
}