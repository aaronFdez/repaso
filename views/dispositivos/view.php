<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dispositivo */

$this->title = $model->marca_disp . ' ' . $model->modelo_disp;
$this->params['breadcrumbs'][] = ['label' => 'Dispositivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dispositivo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => "¿Está usted seguro que desea eliminar el dispositivo $this->title ?",
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'marca_disp',
            'modelo_disp',
            'ordenador_id',
            'aula.den_aula',
        ],
    ]) ?>

</div>
