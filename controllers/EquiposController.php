<?php

namespace app\controllers;

use Yii;
use app\models\Equipo;
use app\models\Jugador;
use app\models\EquipoSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EquiposController implements the CRUD actions for Equipo model.
 */
class EquiposController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'delete'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'update', 'actualizar'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $idEquipo = Yii::$app->request->get('id');
                            $equipo = Equipo::find()->where(['id' => $idEquipo])->one();
                            if ($equipo !== null) {
                                $usuarioEquipo = $equipo->id_usuario;
                            } else {
                                throw new \yii\web\HttpException(404, 'El equipo que busca no existe.');
                            }
                            $idUsuario = Yii::$app->user->id;

                            return $usuarioEquipo == $idUsuario;
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Equipo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EquipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $temporadas = Equipo::find()
                        ->where(['id_usuario' => Yii::$app->user->id])
                        ->asArray()->all();
        $temporadas = ArrayHelper::map($temporadas, 'temporada', 'temporada');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'temporadas' => $temporadas,
        ]);
    }

    /**
     * Displays a single Equipo model.
     * @param int $id
     * @return mixed
     */
    public function actionView($id)
    {
        $jugadores = new ActiveDataProvider([
            'query' => Jugador::find()->where(['id_equipo' => $id])
                    ->orderBy(['id_posicion' => SORT_ASC, 'nombre' => SORT_ASC]),
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'jugadores' => $jugadores,
        ]);
    }

    /**
     * Actualiza las estadísticas del equipo recibido utilizando Ajax en el
     * lado del cliente.
     * @param  int $id El id del equipo que se va a actualizar.
     * @return mixed Las estadísticas del equipo actualizadas.
     */
    public function actionActualizar($id)
    {
        $equipo = Equipo::find()->where(['id' => $id])->one();
        $datos = json_decode(file_get_contents('php://input'));
        if ($datos != null) {
            $idBtn = $datos->idBtn;
            switch ($idBtn) {
                case 'suma0':
                    $equipo->partidos_ganados = $equipo->partidos_ganados + 1;
                    break;
                case 'suma1':
                    $equipo->partidos_empatados = $equipo->partidos_empatados + 1;
                    break;
                case 'suma2':
                    $equipo->partidos_perdidos = $equipo->partidos_perdidos + 1;
                    break;
                case 'suma3':
                    $equipo->goles_a_favor = $equipo->goles_a_favor + 1;
                    break;
                case 'suma4':
                    $equipo->goles_en_contra = $equipo->goles_en_contra + 1;
                    break;
                case 'resta0':
                    $equipo->partidos_ganados = $equipo->partidos_ganados - 1;
                    break;
                case 'resta1':
                    $equipo->partidos_empatados = $equipo->partidos_empatados - 1;
                    break;
                case 'resta2':
                    $equipo->partidos_perdidos = $equipo->partidos_perdidos - 1;
                    break;
                case 'resta3':
                    $equipo->goles_a_favor = $equipo->goles_a_favor - 1;
                    break;
                case 'resta4':
                    $equipo->goles_en_contra = $equipo->goles_en_contra - 1;
                    break;
            }
            $equipo->save();
            $equipo->refresh();
        }

        $datosActuales = [
            'jugados' => $equipo->partidosJugados,
            'ganados' => $equipo->partidos_ganados,
            'empatados' => $equipo->partidos_empatados,
            'perdidos' => $equipo->partidos_perdidos,
            'golesFavor' => $equipo->goles_a_favor,
            'golesContra' => $equipo->goles_en_contra,
        ];

        return json_encode($datosActuales);
    }

    /**
     * Creates a new Equipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Equipo();
        $model->id_usuario = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Equipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
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
            ]);
        }
    }

    /**
     * Deletes an existing Equipo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Equipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Equipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Equipo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
