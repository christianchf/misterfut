<?php

namespace app\controllers;

use Yii;
use app\models\Event;
use app\models\Equipo;
use app\models\Evento;
use app\models\EventoSearch;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventosController implementa las acciones CRUD para el modelo de Evento.
 */
class EventosController extends Controller
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
                        'actions' => ['index', 'create', 'registro'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $idEquipo = Yii::$app->request->get('idEquipo');
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
                        'actions' => ['delete', 'actualizar'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'update'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $idEvento = Yii::$app->request->get('id');
                            $evento = Evento::find()->where(['id' => $idEvento])->one();
                            if ($evento !== null) {
                                $equipoEvento = $evento->id_equipo;
                            } else {
                                throw new \yii\web\HttpException(404, 'El evento que busca no existe.');
                            }
                            $usuarioEquipo = Equipo::find()->where(['id' => $equipoEvento])->one()->id_usuario;
                            $idUsuario = Yii::$app->user->id;

                            return $usuarioEquipo == $idUsuario;
                        }
                    ],
                ],
            ],
        ];
    }

    /**
    * Lista todos los eventos de un equipo.
     * @param int $idEquipo El id del equipo.
     * @return mixed
     */
    public function actionIndex($idEquipo)
    {
        $equipo = Equipo::find()->where(['id' => $idEquipo])->one();
        $events = [];
        $eventos = Evento::find()->where(['id_equipo' => $idEquipo])->orderBy('fecha_inicio, hora_inicio')->all();
        foreach ($eventos as $evento) {
            $event = new Event;
            $event->id = $evento->id;
            $event->title = $evento->nombre;
            $event->start = $evento->fecha_inicio . ' ' . $evento->hora_inicio;
            $event->end = $evento->fecha_fin . ' ' . $evento->hora_fin;
            $event->url = Url::to(['/eventos/view', 'id' => $evento->id]);
            if ($evento->tipo == 'Partido') {
                $event->color = '#67cca0';
            } elseif ($evento->tipo == 'Entrenamiento') {
                $event->color = '#f1af2d';
            } elseif ($evento->tipo == 'Evento publicitario') {
                $event->color = '#6457b0';
            } elseif ($evento->tipo == 'Otros') {
                $event->color = '#ee4b4b';
            }
            $event->editable = true;
            $event->startEditable = true;
            $event->durationEditable = true;
            $events[] = $event;
        }

        return $this->render('index', [
            'equipo' => $equipo,
            'events' => $events,
        ]);
    }

    /**
     * Muestra un registro de todos los eventos del equipo actual.
     * @param int $idEquipo El id del equipo.
     * @return mixed
     */
    public function actionRegistro($idEquipo)
    {
        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $equipo = Equipo::find()->where(['id' => $idEquipo])->one();
        $tipos = [
            'Partido' => 'Partido',
            'Entrenamiento' => 'Entrenamiento',
            'Evento publicitario' => 'Evento publicitario',
            'Otros' => 'Otros',
        ];

        return $this->render('registro', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'equipo' => $equipo,
            'tipos' => $tipos,
        ]);
    }

    /**
     * Actualiza las fechas de inicio y de fin de un evento cuando se arrastra a
     * otra fecha.
     * @return void
     */
    public function actionActualizar()
    {
        $datos = json_decode(file_get_contents('php://input'));

        if ($datos != null) {
            $evento = Evento::find()->where(['id' => $datos->idEvento])->one();
            $evento->fecha_inicio = $datos->diaInicio;
            $evento->hora_inicio = $datos->horaInicio;
            $evento->fecha_fin = $datos->diaFin;
            $evento->hora_fin = $datos->horaFin;
            $evento->save(false);
        }
    }

    /**
     * Muestra los datos de un solo evento.
     * @param int $id El id del evento que se quiere mostrar.
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
     * Crea un nuevo evento para el equipo actual.
     * Si el evento se ha creado con exito, el navegador se redireccionará al
     * calendario del equipo.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Evento();
        $model->id_equipo = Yii::$app->request->get('idEquipo');
        $equipo = Equipo::find()->where(['id' => Yii::$app->request->get('idEquipo')])->one()->nombre;
        $tipos = [
            'Partido' => 'Partido',
            'Entrenamiento' => 'Entrenamiento',
            'Evento publicitario' => 'Evento publicitario',
            'Otros' => 'Otros',
        ];

        if ($model->load(Yii::$app->request->post())) {
            if ($model->fecha_inicio == null) {
                $model->fecha_inicio = Yii::$app->request->get('dia');
            }
            if ($model->hora_inicio == null) {
                $model->hora_inicio = Yii::$app->request->get('hora');
            }
            if ($model->fecha_inicio == '') {
                $model->fecha_inicio = date('Y-m-d');
            }
            if ($model->fecha_fin == '') {
                $model->fecha_fin = $model->fecha_inicio;
            }
            $model->save();
            return $this->redirect(['index', 'idEquipo' => $model->id_equipo]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'equipo' => $equipo,
                'tipos' => $tipos,
            ]);
        }
    }

    /**
     * Modifica los datos de un evento existente.
     * Si la modificación se ha realizado con exito, el navegador se redireccionará
     * a la vista del evento modificado.
     * @param int $id El id del evento que se quiere modificar.
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $equipo = Equipo::find()->where(['id' => $model->id_equipo])->one()->nombre;
        $tipos = [
            'Partido' => 'Partido',
            'Entrenamiento' => 'Entrenamiento',
            'Evento publicitario' => 'Evento publicitario',
            'Otros' => 'Otros',
        ];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'idEquipo' => $model->id_equipo]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'equipo' => $equipo,
                'tipos' => $tipos,
            ]);
        }
    }

    /**
     * Borra un evento existente.
     * Si se ha borrado con exito, el navegador se redireccionara la página
     * índice de los eventos del equipo.
     * @param int $id El id del evento que se quiere borrar.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $idEquipo = $this->findModel($id)->id_equipo;
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'idEquipo' => $idEquipo]);
    }

    /**
      * Encuentra un evento buscando por su clave primaria (id).
      * Si el evento no se encuentra, se lanzara una excepción 404 HTTP.
      * @param int $id El id del evento que se quiere buscar.
      * @return Evento El evento cargado
      * @throws NotFoundHttpException Si el evento no se ha encontrado.
      */
    protected function findModel($id)
    {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
