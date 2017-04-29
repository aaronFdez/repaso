<?php

use yii\data\Sort;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenador */

$this->title = $model->marca_ord . ' ' . $model->modelo_ord;
$this->params['breadcrumbs'][] = ['label' => 'Ordenadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$url = Url::to(['borrar-historial']);
 $id = $model->id;

 $js = <<<EOT
     $('#borrarHistorial').click(function () {
        $.ajax({
            url: "$url",
             type: 'POST',
             data: { "id": "$id" },
            success: function (data, status, xhr) {
                $('#historial').empty();
            }
        });
    });
EOT;

$this->registerJs($js);
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
    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderDisp,
        'columns' => [
            [
                'attribute' => 'nombre',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->nombre),
                        ['dispositivos/view', 'id' => $model->id]
                    );
                },
                'format' => 'html',
            ],
        ],
    ]) ?>
    <?php Pjax::end() ?>

    <h2><?= Html::encode("Historial del ordenador") ?></h2>
    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'options' => [
            'id' => 'historial',
            'class' => 'grid-view',
        ],
        'dataProvider' => $dataProviderHist,
        'columns' => [
            [
                'attribute' => 'origen',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->origen->den_aula),
                        ['aulas/view', 'id' => $model->id]
                    );
                },
                'label' => 'Origen',
                'format' => 'html',
            ],
            [
                'attribute' => 'destino',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->destino->den_aula),
                        ['aulas/view', 'id' => $model->id]
                    );
                },
                'label' => 'Destino',
                'format' => 'html',
            ],
            'created_at:datetime',
        ],
    ]) ?>
<?php Pjax::end() ?>
    <?= Html::button(
        'Borrar historial', [
                'class' => 'btn btn-danger',
                'id' => 'borrarHistorial',]) ?>
</div>
