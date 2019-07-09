<?php

namespace app\controllers;

use app\models\Biomaterial;
use app\models\ServiceTestTube;
use app\models\TestTube;
use Yii;
use app\models\Service;
use app\models\search\ServiceSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Service model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Service();
        $testTubeModels = [new ServiceTestTube()];

        if ($model->load(Yii::$app->request->post())) {

            if($model->save()){
                if(isset(Yii::$app->request->post()["ServiceTestTube"])){                                               //Если пользователь передал пробирки
                    $testTubes = Yii::$app->request->post()["ServiceTestTube"];                                         //Сохраняем в отдельную переменную, данные о пробирках

                    foreach ($testTubes as $testTube){                                                                  //Перебираем пробирки
                        if($testTube['test_tube'] != null){                                                             //Если у пробирки выбрано поле
                            $newTestTube = new ServiceTestTube();                                                       //Создаем новую модель пробирки
                            $newTestTube->test_tube = $testTube['test_tube'];                                           //Подставляем id пробирки
                            $newTestTube->service_id = $model->id;                                                      //Подставляем id услуги
                            $newTestTube->save();                                                                       //Сохраняем пробирку
                        }
                    }
                }
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'testTubeModels' => $testTubeModels,
                'biomaterials' => ArrayHelper::map(Biomaterial::find()->asArray()->all(), 'id', 'name_biomaterial'),
                'testTubes' => ArrayHelper::map(TestTube::find()->asArray()->all(), 'id', 'test_tube_name')
            ]);
        }
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(($testTubeModels = ServiceTestTube::findAll(['service_id' => $id])) == null){                                //Модели пробирок, если они есть
            $testTubeModels = [new ServiceTestTube()];                                                                  //Если их нет, создаем новую модель пробирок
        }

        if ($model->load(Yii::$app->request->post()) && ServiceTestTube::loadMultiple($testTubeModels, Yii::$app->request->post())) { //Если в модель загрузились данные от страницы и от пробирок


            $isValid = ServiceTestTube::validateMultiple($testTubeModels, Yii::$app->request->post()) && $model->validate(); //Проверяем данные для пробирок
            if ($isValid) {                                                                                             //Если обе проверки прошли успешно
                if($model->save(false)){                                                                   //Сохраняем услугу


                    /** Обновление существующих пробирок **/
                    foreach ($testTubeModels as $testTubeModel){                                                        //Сохраняем по очереди уже отредактированные пробирки (сеществовавшие ранее)
                        if($testTubeModel->test_tube !== ""){
                            $testTubeModel->service_id = $model->id;
                            $testTubeModel->save();
                        }
                    }

                    /** Сохранение новых пробирок **/
                    $allTestTubeModelsFromUser = Yii::$app->request->post()["ServiceTestTube"];                         //Присваиваем новой переменной, все пробирки от пользователя
                    array_splice($allTestTubeModelsFromUser, 0, count($testTubeModels));                  //Удаляем из этой переменной, поля которые уже были в базе (первые, редактируемые, не новые)

                    if($allTestTubeModelsFromUser != null){                                                             //Проверяем, остались ли данные, после очистки массива от старых пробирок.
                        foreach ($allTestTubeModelsFromUser as $testTubeModelsFromUser) {                               //Перебираем все оставшшиеся массивы с пробирками для сохранения
                            if($testTubeModelsFromUser['test_tube'] != null){                                           //Если пробирка указана
                                $newTestTube = new ServiceTestTube();
                                $newTestTube->test_tube = $testTubeModelsFromUser['test_tube'];
                                $newTestTube->service_id = $model->id;
                                $newTestTube->save();
                            }
                        }
                    }
                    return $this->redirect(['index']);
                }
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'testTubeModels' => $testTubeModels,
            'biomaterials' => ArrayHelper::map(Biomaterial::find()->asArray()->all(), 'id', 'name_biomaterial'),
            'testTubes' => ArrayHelper::map(TestTube::find()->asArray()->all(), 'id', 'test_tube_name')
        ]);
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteServiceTestTube()
    {
        if(($post = Yii::$app->request->post()) != null) {                                                              //Проверяем, переданы ли данные постом
            $idServiceTestTube = intval($post['testTubeId']) !== 0 ? intval($post['testTubeId']) : NULL;                //Добавляем в переменную полученный id если он является числом, если нет, то он 0
            if (($serviceTestTube = $this->findServiceTestTubeModel($idServiceTestTube)) != null) {                     //Проверяем есть ли такая пробирка
                $serviceTestTube->delete();                                                                             //Удаляем пробирку

                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'status' => 'success',
                    'message' => 'Пробирка удалена',
                ];
            }
        }
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param integer $id
     *
     * @return ServiceTestTube the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findServiceTestTubeModel($id)
    {
        if (($model = ServiceTestTube::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
