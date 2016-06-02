<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Exclusives */

$this->title = 'Созздать эксклюзив';
$this->params['breadcrumbs'][] = ['label' => 'Эксклюзивные предложения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exclusives-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
