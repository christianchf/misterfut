<?php

namespace app\controllers;

use Yii;
use app\models\Equipo;
use app\models\Jugador;
use app\models\Posicion;
use app\models\EquipoSearch;
use app\models\JugadorSearch;
use app\models\HistorialSearch;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
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
                        'actions' => ['index', 'create', 'delete', 'historial', 'historico', 'traspasar'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'update', 'actualizar', 'traspaso'],
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
        $totales = new ActiveDataProvider([
            'query' => Equipo::find()->select([
                    new Expression('sum(partidos_jugados) as partidos_jugados'),
                    new Expression('sum(partidos_ganados) as partidos_ganados'),
                    new Expression('sum(partidos_empatados) as partidos_empatados'),
                    new Expression('sum(partidos_perdidos) as partidos_perdidos'),
                    new Expression('sum(goles_a_favor) as goles_a_favor'),
                    new Expression('sum(goles_en_contra) as goles_en_contra'),
                ])->where(['id_usuario' => Yii::$app->user->id])
                ->groupBy('id_usuario'),
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'temporadas' => $temporadas,
            'totales' => $totales,
        ]);
    }

    /**
     * Lists all Equipo models.
     * @return mixed
     */
    public function actionHistorial()
    {
        $equipos = new ActiveDataProvider([
            'query' => Equipo::find()->select(['nombre'])
                        ->where(['id_usuario' => Yii::$app->user->id])
                        ->groupBy(['nombre']),
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->render('historial', [
            'equipos' => $equipos,
        ]);
    }

    public function actionHistorico($nombre)
    {
        $searchModel = new HistorialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $temporadas = Equipo::find()
                        ->where(['and', ['id_usuario' => Yii::$app->user->id], ['nombre' => $nombre]])
                        ->asArray()->all();
        $temporadas = ArrayHelper::map($temporadas, 'temporada', 'temporada');
        $totales = new ActiveDataProvider([
            'query' => Equipo::find()->select([
                    new Expression('sum(partidos_jugados) as partidos_jugados'),
                    new Expression('sum(partidos_ganados) as partidos_ganados'),
                    new Expression('sum(partidos_empatados) as partidos_empatados'),
                    new Expression('sum(partidos_perdidos) as partidos_perdidos'),
                    new Expression('sum(goles_a_favor) as goles_a_favor'),
                    new Expression('sum(goles_en_contra) as goles_en_contra'),
                ])->where(['and', ['id_usuario' => Yii::$app->user->id], ['nombre' => $nombre]])
                ->groupBy('id_usuario'),
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->render('historico', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'temporadas' => $temporadas,
            'totales' => $totales,
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

    public function actionTraspaso($id)
    {
        $this->layout = 'ventanaLayout.php';
        $searchModel = new JugadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $equipo = Equipo::find()->where(['id' => $id])->one();
        $equipos = Equipo::find()->where(['and', ['id_usuario' => Yii::$app->user->id], ['not', ['id' => $id]]])->all();
        $equiposOrigen = [];
        foreach ($equipos as $equipoActual) {
            $equiposOrigen[$equipoActual->id] = $equipoActual->nombre . ' (' . $equipoActual->temporada . ')';
        }
        $posiciones = Posicion::find()->asArray()->all();
        $posiciones = ArrayHelper::map($posiciones, 'posicion', 'posicion');
        $dorsales = Jugador::find()
                        ->select('dorsal')
                        ->where(['id_equipo' => Yii::$app->request->get('id_equipo')])
                        ->orderBy('dorsal')
                        ->asArray()->all();
        $dorsales = ArrayHelper::map($dorsales, 'dorsal', 'dorsal');

        return $this->render('traspaso', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'equipo' => $equipo,
            'equiposOrigen' => $equiposOrigen,
            'posiciones' => $posiciones,
            'dorsales' => $dorsales,
        ]);
    }

    public function actionTraspasar()
    {
        $equipos = json_decode(file_get_contents('php://input'));

        if ($equipos->origen != '' && $equipos->destino != '') {
            $antiguos = Jugador::find()->where(['id_equipo' => $equipos->origen])->all();

            foreach ($antiguos as $antiguo) {
                $nuevo = new Jugador;
                $nuevo->nombre = $antiguo->nombre;
                $nuevo->fecha_nac = $antiguo->fecha_nac;
                $nuevo->dorsal = $antiguo->dorsal;
                $nuevo->id_equipo = $equipos->destino;
                $nuevo->id_posicion = $antiguo->id_posicion;
                $nuevo->save();
            }
            Yii::$app->session->setFlash('anadido', 'La plantilla se ha traspasado correctamente');
        }
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
