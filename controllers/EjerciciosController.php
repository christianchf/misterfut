<?php

namespace app\controllers;

use Yii;
use app\models\Ejercicio;
use app\models\EjercicioSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EjerciciosController implementa las acciones CRUD para el modelo de Equipo.
 */
class EjerciciosController extends Controller
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
                        'actions' => ['index', 'create', 'delete'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'update'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $idEjercicio = Yii::$app->request->get('id');
                            $ejercicio = Ejercicio::find()->where(['id' => $idEjercicio])->one();
                            if ($ejercicio !== null) {
                                $usuarioEjercicio = $ejercicio->id_usuario;
                            } else {
                                throw new \yii\web\HttpException(404, 'El ejercicio que busca no existe.');
                            }
                            $idUsuario = Yii::$app->user->id;

                            return $usuarioEjercicio == $idUsuario;
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lista todos los ejercicios del usuario.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EjercicioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $tipos = [
            'Físico' => 'Físico',
            'Táctico' => 'Táctico',
            'Otros' => 'Otros',
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tipos' => $tipos,
        ]);
    }

    /**
     * Muestea los datos de un solo ejercicio.
     * @param int $id El id del ejercicio.
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea un nuevo ejercicio.
     * Si la creación se ha realizado con exito, el navegador redireccionará a
     * la vista del ejercicio creado.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ejercicio();
        $tipos = [
            'Físico' => 'Físico',
            'Táctico' => 'Táctico',
            'Otros' => 'Otros',
        ];
        $model->id_usuario = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tipos' => $tipos,
            ]);
        }
    }

    /**
     * Modifica los datos de un ejercicio existente.
     * Si la modificación se ha realizado con exito, el navegador redireccionará
     * a la vista del ejercicio modificado.
     * @param int $id El id del ejercicio que se va a modificar.
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tipos = [
            'Físico' => 'Físico',
            'Táctico' => 'Táctico',
            'Otros' => 'Otros',
        ];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tipos' => $tipos,
            ]);
        }
    }

    /**
     * Borra un ejercicio existente.
     * Si el borrado se ha realizado con exito, el navegador redireccionará a la
     * página índice de los ejercicios del usuario.
     * @param int $id El id del ejercicio que se desea borrar.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Encuentra un ejercicio buscando por su clave primaria (id).
     * Si el ejercicio no se encuentra, se lanzara una excepción 404 HTTP.
     * @param int $id El id del ejercicio que se quiere buscar.
     * @return Ejercicio El ejercicio cargado
     * @throws NotFoundHttpException Si el ejercicio no se ha encontrado.
     */
    protected function findModel($id)
    {
        if (($model = Ejercicio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
