<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Dispositivo */

$this->title = $model->nombre;
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
            'ubicacion',
        ],
    ]) ?>
    <?= GridView::widget([
             'dataProvider' => new ActiveDataProvider([
                  'query' => $model->getRegistros(),
              ]),
              'columns' => [
                  [
                    'attribute' => 'origen_id',
                    'value' => function ($model, $widget) {
                        if ($model->origen_ord_id !== null) {
                            return $model->origenOrd->nombre;
                        } else {
                            return $model->origen_aula_id;
                        }
                    },
                        'label' => 'Origen'
                    ],
                 [
                    'attribute' => 'destino_id',
                    'value' => function ($model, $widget) {
                        if ($model->destino_ord_id !== null) {
                            return $model->destino_ord_id;
                        } else {
                            return $model->destino_aula_id;
                        }
                    },
                    'label' => 'Destino'
                 ],
                    'created_at:datetime'
                ],
      ]) ?>
</div>
