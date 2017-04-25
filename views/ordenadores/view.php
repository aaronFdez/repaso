<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenador */

$this->title = $model->marca_ord . ' ' . $model->modelo_ord;
$this->params['breadcrumbs'][] = ['label' => 'Ordenadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordenador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => "¿Está usted seguro que desea borrar $this->title?",
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="media">
           <div class="media-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'marca_ord',
                        'modelo_ord',
                        "aula.den_aula:text:Aula",
                    ],
                ]) ?>
            </div>
            <div class="media-right">

            <?= Html::img($model->foto, ['title' => $model->nombre , 'width' => '230px', 'height'=>'110px']); ?>
        </div>
    </div>
    <h2><?= Html::encode("Dispositivos del ordenador") ?></h2>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
        'query' => $model->getDispositivos(),
        ]),
        'columns' => [
            [
                'attribute' => 'Dispositivos',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->marca_disp . ' ' . $model->modelo_disp ),
                        ['dispositivos/view', 'id' => $model->id]
                    );
                },
                'format' => 'html',
            ],
        ],
    ]) ?>

    <h2><?= Html::encode("Historial del ordenador") ?></h2>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getRegistros(),
        ]),
        'columns' => [
            [
                'attribute' => 'Origen',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->origen->den_aula),
                        ['aulas/view', 'id' => $model->id]
                    );
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'Destino',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->destino->den_aula),
                        ['aulas/view', 'id' => $model->id]
                    );
                },
                'format' => 'html',
            ],
            'created_at:datetime',
        ],
    ]) ?>
</div>
