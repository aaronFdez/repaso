<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Dispositivo */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Dispositivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$url = Url::to(['borrar-historial']);
$id = $model->id;

$js = <<<EOT
    $('#borrarHistorial').click(function() {
        $.ajax({
            url: "$url",
            type: 'POST',
            data: { "id": "$id"},
            success: function (data, status, xhr) {
                $('#historial').empty();
            }
        });
    });
EOT;
$this->registerJs($js);
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
    <h2>Historial de movimientos</h2>
    <?= GridView::widget([
            'options' => [
                'id' => 'historial',
                'class' => 'grid-view',
            ],
             'dataProvider' => new ActiveDataProvider([
                  'query' => $model->getRegistros(),
              ]),
              'columns' => [
                  [
                    'attribute' => 'origen_id',
                    'value' => function ($reg, $widget) {
                        if ($reg->origen_ord_id !== null) {
                            return Html::a(
                                Html::encode($reg->origenOrd->nombre),
                                ['ordenadores/view', 'id' => $reg->origen_ord_id]
                            );
                        } else {
                            return Html::a(
                                Html::encode($reg->origenAula->den_aula),
                                ['aulas/view', 'id' => $reg->origen_aula_id]
                            );
                        }
                    },
                        'format' => 'html',
                        'label' => 'Origen'
                    ],
                    [
                    'attribute' => 'destino_id',
                    'value' => function ($reg, $widget) {
                        if ($reg->destino_ord_id !== null) {
                            return Html::a(
                                Html::encode($reg->destinoOrd->nombre),
                                ['ordenadores/view', 'id' => $reg->destino_ord_id]
                            );
                        } else {
                            return Html::a(
                                Html::encode($reg->destinoAula->den_aula),
                                ['aulas/view', 'id' => $reg->destino_aula_id]
                            );
                        }
                    },
                    'format' => 'html',
                    'label' => 'Destino'
                 ],
                    'created_at:datetime'
                ],
      ]) ?>
      <?= Html::button(
          'Borrar historial', [
              'class' => 'btn btn-danger',
              'id' => 'borrarHistorial',
          ]) ?>
</div>
