<?php

namespace app\controllers;

use Yii;
use app\models\EstadisticasEquipo;
use app\models\EstadisticasEquipoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EstadisticasEquiposController implements the CRUD actions for EstadisticasEquipo model.
 */
class EstadisticasEquiposController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all EstadisticasEquipo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstadisticasEquipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EstadisticasEquipo model.
     * @param integer $id_temporada
     * @param integer $id_equipo
     * @return mixed
     */
    public function actionView($id_temporada, $id_equipo)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_temporada, $id_equipo),
        ]);
    }

    /**
     * Creates a new EstadisticasEquipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EstadisticasEquipo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_temporada' => $model->id_temporada, 'id_equipo' => $model->id_equipo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EstadisticasEquipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_temporada
     * @param integer $id_equipo
     * @return mixed
     */
    public function actionUpdate($id_temporada, $id_equipo)
    {
        $model = $this->findModel($id_temporada, $id_equipo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_temporada' => $model->id_temporada, 'id_equipo' => $model->id_equipo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EstadisticasEquipo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_temporada
     * @param integer $id_equipo
     * @return mixed
     */
    public function actionDelete($id_temporada, $id_equipo)
    {
        $this->findModel($id_temporada, $id_equipo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EstadisticasEquipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_temporada
     * @param integer $id_equipo
     * @return EstadisticasEquipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_temporada, $id_equipo)
    {
        if (($model = EstadisticasEquipo::findOne(['id_temporada' => $id_temporada, 'id_equipo' => $id_equipo])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
