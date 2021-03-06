<?php

namespace app\controllers;

use Yii;
use app\models\Aula;
use app\models\Ordenador;
use app\models\RegistroOrd;
use app\models\OrdenadorSearch;
use yii\data\Sort;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdenadoresController implements the CRUD actions for Ordenador model.
 */
class OrdenadoresController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => ['@'],
                        'matchCallBack' => function($rule, $action) {
                            return Yii::$app->user->identity->tipo === 'A';
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ordenador models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdenadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ordenador model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model= $this->findModel($id);
        $dataProviderDisp = $model->verDispositivos();
        $dataProviderHist = $model->verHistorial();

        return $this->render('view', [
            'model' => $model,
            'dataProviderDisp' => $dataProviderDisp,
            'dataProviderHist' => $dataProviderHist,
        ]);
    }

    public function actionBorrarHistorial()
    {
        $id = Yii::$app->request->post('id');

        if ($id === null || Ordenador::findOne($id) === null) {
            throw new NotFoundHttpException('Ordenador no encontrado');
        }

        RegistroOrd::deleteAll(['ordenador_id' => $id]);
    }
    /**
     * Creates a new Ordenador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ordenador();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'aulas' =>Aula::findDropDownList(),
            ]);
        }
    }

    /**
     * Updates an existing Ordenador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'aulas' =>Aula::findDropDownList(),
            ]);
        }
    }

    /**
     * Deletes an existing Ordenador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ordenador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ordenador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ordenador::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
