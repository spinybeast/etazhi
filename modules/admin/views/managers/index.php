<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менеджеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="managers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить менеджера', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' => false,
        'columns' => [
            'name',
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'priority',
                'editableOptions' => [
                    'header' => 'Приоритет',
                    'options' => ['pluginOptions' => ['min' => 0, 'max' => 100]]
                ],
                'format' => ['decimal', 0],
            ],
            'phone',
            'description:ntext',
            [
                'attribute' => 'photo',
                'format' => 'image',
                'value' => function ($data) {
                    return $data->getThumbUploadUrl('photo', 'preview');
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
