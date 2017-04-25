<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aula */

$this->title = 'Modificar Aula: ' . $model->den_aula;
$this->params['breadcrumbs'][] = ['label' => 'Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->den_aula, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="aula-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
