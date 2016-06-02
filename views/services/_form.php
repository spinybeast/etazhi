<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Services */
/* @var $form yii\widgets\ActiveForm */
?>
<?php if (Yii::$app->session->hasFlash('consultFormSubmitted')): ?>
    <p class="success">Спасибо за Ваше обращение! Мы обязательно Вам перезвоним.</p>
<?php else: ?>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header text-center">
                Вы можете заказать услугу, отправив нам заявку по форме ниже
            </h2>
        </div>
    </div>
    <div class="reviews-form col-md-4 col-md-offset-4">
    <?php $form = ActiveForm::begin([
        'id' => 'consult-form',
    ]); ?>

    <div class="">
        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Иванов Иван']) ?>
    </div>
    <div class="">
        <?= $form->field($model, 'phone')->textInput(['placeholder' => '+7 901 234-56-78']) ?>
    </div>
    <div class="">
        <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
    </div>
    <div class="">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
<?php endif; ?>