<?php

namespace app\controllers;

use Yii;
use app\models\Equipo;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosController implementa las acciones CRUD para el modelo de usuario.
 */
class UsuariosController extends Controller
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
                        'actions' => ['create'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'update', 'delete'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $id = Yii::$app->request->get('id');
                            $idLogin = Usuario::find()->where(['id' => Yii::$app->user->id])->one()->id;

                            return $id === null || $id == $idLogin;
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->esAdmin;
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lista todos los usuarios registrados en la aplicación.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra los datos de un usuario.
     * @param int $id El id del usuario.
     * @return mixed
     */
    public function actionView($id)
    {
        $equipos = new ActiveDataProvider([
            'query' => Equipo::find()->select(['nombre'])
                        ->where(['id_usuario' => $id])
                        ->groupBy(['nombre'])
                        ->orderBy('nombre'),
            'pagination' => false,
            'sort' => false,
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'equipos' => $equipos,
        ]);
    }

    /**
     * Crea un nuevo usuario.
     * Si la creación se ha realizado con exito, el navegador se redireccionará
     * a la vista del usuario creado.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario([
            'scenario' => Usuario::ESCENARIO_CREATE
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash(
                    'exito',
                    'Usuario creado correctamente. Por favor, inicie sesión.'
                );
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Modifica los datos de un usuario.Updates an existing Usuario model.
     * Si la modificación se ha realizado con exito, el navegador se redireccionará
     * a la vista del usuario modificado.
     * @param int $id El id del usuario que se quiere modificar.
     * @return mixed
     */
    public function actionUpdate($id = null)
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
     * Borrar un usuario existente.
     * Si se ha borrado con exito, el navegador se redireccionará a la página
     * índice de los usuarios.
     * @param int $id El id del usuario que se quiere borrar.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Encuentra un usuario buscando por su clave primaria (id).
     * Si el usuario no se encuentra, se lanzara una excepción 404 HTTP.
     * @param int $id El id del usuario que se quiere buscar.
     * @return Usuario El usuario cargado
     * @throws NotFoundHttpException Si el usuario no se ha encontrado.
     */
    protected function findModel($id)
    {
        $id = $id ?? Yii::$app->user->id;
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
