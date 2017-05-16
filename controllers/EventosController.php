<?php

namespace app\controllers;

use Yii;
use index;
use app\models\Equipo;
use app\models\Evento;
use app\models\EventoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventosController implementa las acciones CRUD para el modelo de Evento.
 */
class EventosController extends Controller
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
     * @return mixed
     */
    public function actionIndex($id_equipo)
    {
        // $searchModel = new EventoSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $equipo = Equipo::find()->where(['id' => Yii::$app->request->get('id_equipo')])->one()->nombre;
        //
        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        //     'equipo' => $equipo,
        // ]);

        $equipo = Equipo::find()->where(['id' => $id_equipo])->one()->nombre;
        $events = [];
        $eventos = Evento::find()->where(['id_equipo' => $id_equipo])->all();
        // var_dump($eventos);die;
        foreach ($eventos as $evento) {
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $evento->id;
            // $event->nonstandard = [
            //     'tipo' => $evento->tipo,
            // ];
            $Event->title = $evento->nombre;
            $Event->start = $evento->fecha_inicio;
            $Event->end = $evento->fecha_fin;
            $events[] = $Event;
        }

        return $this->render('index', [
            'equipo' => $equipo,
            'events' => $events,
        ]);
        // var_dump($events);die;
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
     * Si el evento se ha creado con exito, el navegador se redireccionará a la
     * vista del equipo creado.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Evento();
        $model->id_equipo = Yii::$app->request->get('id_equipo');
        $equipo = Equipo::find()->where(['id' => Yii::$app->request->get('id_equipo')])->one()->nombre;
        $tipos = ['Partido' => 'Partido', 'Entrenamiento' => 'Entrenamiento'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
        $tipos = ['Partido' => 'Partido', 'Entrenamiento' => 'Entrenamiento'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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

        return $this->redirect(['index', 'id_equipo' => $idEquipo]);
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
