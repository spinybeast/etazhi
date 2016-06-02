<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Услуги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать услугу', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Создать категорию услуг', ['/admin/servicecategories/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Управление категориями услуг', ['/admin/servicecategories/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' =>
            [
                'title',
                [
                    'attribute' => 'category_id',
                    'value' => function ($data) {
                        return $data->category->name;
                    }
                ],
                'text:html',

                ['class' => 'yii\grid\ActionColumn'],
            ],
    ]); ?>

</div>
