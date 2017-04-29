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

    <div class="media">
           <div class="media-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'marca_disp',
                        'modelo_disp',
                        'ubicacion',
                    ],
                ]) ?>
            </div>
            <div class="media-right">

            <?= Html::img($model->foto, ['title' => $model->nombre , 'width' => '230px', 'height'=>'110px']); ?>
        </div>
    </div>
    <?= GridView::widget([
             'dataProvider' => new ActiveDataProvider([
                  'query' => $model->getRegistros(),
              ]),
              'columns' => [
                  [
                    'attribute' => 'origen_id',
                    'value' => function ($reg, $widget) {
                        if ($reg->origen_ord_id !== null) {
                            return $reg->origenOrd->nombre;
                        } else {
                            return $reg->origenAula->den_aula;
                        }
                    },
                        'label' => 'Origen'
                    ],
                 [
                    'attribute' => 'destino_id',
                    'value' => function ($reg, $widget) {
                        if ($reg->destino_ord_id !== null) {
                            return $reg->destinoOrd->nombre;
                        } else {
                            return $reg->destinoAula->den_aula;
                        }
                    },
                    'label' => 'Destino'
                 ],
                    'created_at:datetime'
                ],
      ]) ?>
</div>
