<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dispositivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dispositivo-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'marca_disp')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'modelo_disp')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'ubicacion_id')->dropDownList($ubicaciones) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
