<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ordenador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'marca_ord')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modelo_ord')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aula_id')->dropDownList($aulas) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
