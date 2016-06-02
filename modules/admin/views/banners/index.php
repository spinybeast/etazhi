<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Баннеры');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banners-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Создать баннер'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'photo',
                'format' => 'image',
                'value' => function ($data) {
                    return $data->getThumbUploadUrl('photo');
                },
            ],
            'url:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
