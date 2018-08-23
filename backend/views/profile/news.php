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
    ]
]);