<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Exclusives */

$this->title = 'Редактировать Эксклюзив: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Эксклюзивные предложения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="exclusives-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
