<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Aula */

$this->title = $model->den_aula;
$this->params['breadcrumbs'][] = ['label' => 'Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => "¿Seguro que quieres borrar la aula $model->den_aula ?",
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'den_aula',
            // [
            //     'attribute'=>'Foto',
            //     'value'=>$model->foto,
            //     'format' => ['image',['width'=>'100','height'=>'100']],
            // ],
        ],
    ]) ?>
    <h2><?= Html::encode("Ordenadores del aula $model->den_aula") ?></h2>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getOrdenadores(),
        ]),
        'columns' => [
            [
                'attribute' => 'nombre',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->nombre),
                        ['ordenadores/view', 'id' => $model->id]
                    );
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'numero',
                'value' => function ($model, $widget) {
                    return count($model->dispositivos);
                },
                'label' => 'Número de dispositivos',
            ],
        ],
    ]) ?>

</div>
