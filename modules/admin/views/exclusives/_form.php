<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use app\models\ExclusivesProperties;
use wbraganca\dynamicform\DynamicFormWidget;
use dosamigos\ckeditor\CKEditor;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model app\models\Exclusives */
/* @var $form yii\widgets\ActiveForm */
?>
<link href="https://dadata.ru/static/css/lib/suggestions-15.12.css" type="text/css" rel="stylesheet"/>
<div class="exclusives-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList($model::$types) ?>

    <?= $form->field($model, 'rooms')->input('number') ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'id' => 'address']) ?>

    <?= $form->field($model, 'agent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), []) ?>

    <div class="properties">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper',
            'widgetBody' => '.container-items',
            'widgetItem' => '.item',
            'min' => 0,
            'insertButton' => '.add-item',
            'deleteButton' => '.remove-item',
            'model' => $model,
            'formId' => 'dynamic-form',
            'formFields' => [
                'name',
                'value',
            ],
        ]); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>
                    <i class="glyphicon glyphicon-tags"></i> Характеристики
                    <button type="button" class="add-item btn btn-success btn-sm pull-right">
                        <?= FA::icon('plus') ?> Добавить
                    </button>
                </h4>
            </div>
            <div class="panel-body">
                <div class="container-items"><!-- widgetBody -->
                    <?php if (!empty($model->properties)) {
                        $properties = $model->properties;
                    } else {
                        $properties = [new ExclusivesProperties()];
                    } ?>
                    <?php foreach ($properties as $i => $property): ?>
                        <div class="item panel panel-default"><!-- widgetItem -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Характеристика <?= $i + 1 ?></h3>

                                <div class="pull-right">
                                    <button type="button" class="remove-item btn btn-danger btn-xs">
                                        <?= FA::icon('minus') ?> Удалить
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (!$property->isNewRecord) {
                                    echo Html::activeHiddenInput($property, "[{$i}]id");
                                }
                                ?>
                                <?= $form->field($property, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                                <?= $form->field($property, "[{$i}]value")->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
    </div>
    <?= $form->field($model, 'lot_number')->textInput(['maxlength' => true]) ?>
    <?= GalleryManager::widget([
        'model' => $model,
        'behaviorName' => 'galleryBehavior',
        'apiRoute' => 'exclusives/galleryApi'
    ]);?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?= $this->registerJs('
    $("#address").suggestions({
        serviceUrl: "https://dadata.ru/api/v2",
        token: "b6e8f677ffaa72cc02e31e586fa223d9590e5282",
        type: "ADDRESS",
        count: 10,
    });'); ?>

