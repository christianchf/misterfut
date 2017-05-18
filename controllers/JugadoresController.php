<?php

namespace app\controllers;

use Yii;
use app\models\Equipo;
use app\models\Jugador;
use app\models\Posicion;
use app\models\JugadorSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JugadoresController implementa las acciones CRUD para el modelo de Jugador.
 */
class JugadoresController extends Controller
{
    /**
     * Devuelve un listado con los comportamientos del componente.
     * @return mixed
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
                        'actions' => ['index', 'create'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $idEquipo = Yii::$app->request->get('id_equipo');
                            $equipo = Equipo::find()->where(['id' => $idEquipo])->one();
                            if ($equipo !== null) {
                                $usuarioEquipo = $equipo->id_usuario;
                            } else {
                                throw new \yii\web\HttpException(404, 'El equipo que busca no existe.');
                            }
                            $idUsuario = Yii::$app->user->id;

                            return $usuarioEquipo == $idUsuario;
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'update', 'actualizar'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $idJugador = Yii::$app->request->get('id');
                            $jugador = Jugador::find()->where(['id' => $idJugador])->one();
                            if ($jugador !== null) {
                                $equipoJugador = $jugador->id_equipo;
                            } else {
                                throw new \yii\web\HttpException(404, 'El jugador que busca no existe.');
                            }
                            $usuarioEquipo = Equipo::find()->where(['id' => $equipoJugador])->one()->id_usuario;
                            $idUsuario = Yii::$app->user->id;

                            return $usuarioEquipo == $idUsuario;
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * Lista todos los jugadores del equipo actual.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JugadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $equipo = Equipo::find()->where(['id' => Yii::$app->request->get('id_equipo')])->one()->nombre;
        $posiciones = Posicion::find()->asArray()->all();
        $posiciones = ArrayHelper::map($posiciones, 'posicion', 'posicion');
        $dorsales = Jugador::find()
                        ->select('dorsal')
                        ->where(['id_equipo' => Yii::$app->request->get('id_equipo')])
                        ->orderBy('dorsal')
                        ->asArray()->all();
        $dorsales = ArrayHelper::map($dorsales, 'dorsal', 'dorsal');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'equipo' => $equipo,
            'posiciones' => $posiciones,
            'dorsales' => $dorsales,
        ]);
    }

    /**
     * Muestra los datos de un solo jugador.
     * @param int $id El id del jugador.
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $equipo = Equipo::find()->where(['id' => $model->id_equipo])->one()->nombre;

        return $this->render('view', [
            'model' => $model,
            'equipo' => $equipo,
        ]);
    }

    /**
     * Actualiza las estadísticas de un jugador recibido utilizando Ajax en el
     * lado del cliente.
     * @param  int $id El id del jugador que se va a actualizar.
     * @return mixed Las estadísticas del jugador actualizadas.
     */
    public function actionActualizar($id)
    {
        $jugador = Jugador::find()->where(['id' => $id])->one();
        $datos = json_decode(file_get_contents('php://input'));
        if ($datos != null) {
            $idBtn = $datos->idBtn;
            switch ($idBtn) {
                case 'suma0':
                    $jugador->partidos_jugados = $jugador->partidos_jugados + 1;
                    break;
                case 'suma1':
                    $jugador->goles_marcados = $jugador->goles_marcados + 1;
                    break;
                case 'suma2':
                    $jugador->asistencias = $jugador->asistencias + 1;
                    break;
                case 'suma3':
                    $jugador->goles_encajados = $jugador->goles_encajados + 1;
                    break;
                case 'resta0':
                    if ($jugador->partidos_jugados > 0) {
                        $jugador->partidos_jugados = $jugador->partidos_jugados - 1;
                    }
                    break;
                case 'resta1':
                    if ($jugador->goles_marcados > 0) {
                        $jugador->goles_marcados = $jugador->goles_marcados - 1;
                    }
                    break;
                case 'resta2':
                    if ($jugador->asistencias > 0) {
                        $jugador->asistencias = $jugador->asistencias - 1;
                    }
                    break;
                case 'resta3':
                    if ($jugador->goles_encajados > 0) {
                        $jugador->goles_encajados = $jugador->goles_encajados - 1;
                    }
                    break;
            }
            $jugador->save();
            $jugador->refresh();
        }

        $datosActuales = [
            'jugados' => $jugador->partidos_jugados,
            'golesMarcados' => $jugador->goles_marcados,
            'golesEncajados' => $jugador->goles_encajados,
            'asistencias' => $jugador->asistencias,
            'golesPartido' => $jugador->golesPorPartido,
        ];

        return json_encode($datosActuales);
    }

    /**
     * Crea un nuevo jugador.
     * Si se ha creado con exito, el navegador se redireccionará a la vista del
     * jugador creado.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Jugador();
        $model->id_equipo = Yii::$app->request->get('id_equipo');
        $posiciones = Posicion::find()->asArray()->all();
        $posiciones = ArrayHelper::map($posiciones, 'id', 'posicion');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'posiciones' => $posiciones,
            ]);
        }
    }

    /**
     * Modificar los datos de un jugador existente.
     * Si la modificación se ha realizado con exito, el navegador se redireccionará
     * a la vista del jugador modificado.
     * @param int $id El id del jugador que se quiere modificar.
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $posiciones = Posicion::find()->asArray()->all();
        $posiciones = ArrayHelper::map($posiciones, 'id', 'posicion');
        $equipo = Equipo::find()->where(['id' => $model->id_equipo])->one()->nombre;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'posiciones' => $posiciones,
                'equipo' => $equipo,
            ]);
        }
    }

    /**
     * Borra un jugador existente.
     * Si se ha borrado con exito, el navegador se redireccionará a la página índice
     * de los jugadores del equipo.
     * @param int $id El id del jugador que se quiere borrar.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $idEquipo = $this->findModel($id)->id_equipo;
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'id_equipo' => $idEquipo]);
    }

    /**
      * Encuentra un jugador buscando por su clave primaria (id).
      * Si el jugador no se encuentra, se lanzara una excepción 404 HTTP.
      * @param int $id El id del jugador que se quiere buscar.
      * @return Jugador El jugador cargado
      * @throws NotFoundHttpException Si el jugador no se ha encontrado.
      */
    protected function findModel($id)
    {
        if (($model = Jugador::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
