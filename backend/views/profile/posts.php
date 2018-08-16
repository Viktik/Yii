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
        'title',
        'body',
    ]
]);