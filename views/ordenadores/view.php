<?php

use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'marca_ord',
            'modelo_ord',
            "aula.den_aula:text:Aula",
        ],
    ]) ?>

    <h3><?= Html::encode("Dispositivos") ?></h3>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getDispositivos(),
        ]),
        'columns' => [
            'marca_disp',
            'modelo_disp',
            [ 'class' => ActionColumn::className() ],
        ],
    ]) ?>

    <h3><?= Html::encode("Historial") ?></h3>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getRegistros(),
        ]),
        'columns' => [
            'origen.den_aula:text:Origen',
            'destino.den_aula:text:Destino',
            'created_at:datetime',
        ],
    ]) ?>
</div>
