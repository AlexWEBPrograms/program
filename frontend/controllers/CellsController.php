<?php

namespace frontend\controllers;

use app\models\CitySearch;
use app\models\Services;
use app\models\Street;
use app\models\TypeAbon;
use app\models\TypeExit;
use common\fixtures\User;
use yii\filters\AccessControl;
use Yii;
use app\models\Cells;
use app\models\City;
use app\models\Region;
use app\models\CellsSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CellsController implements the CRUD actions for Cells model.
 */
class CellsController extends Controller
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
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'actions'=>['index','create','update','view','checked','list','lists','lista','liste','listse'],
                        'allow'=>true,
                        'roles'=>['admin','operator','root'],
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Cells models.
     * @return mixed
     */
    //--------------------------Дзвінки--------------------------------------
    public function actionIndex()
    {
        $searchModel = new CellsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cells model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cells model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cells();
        if ($model->load(Yii::$app->request->post())) {
            $model->date_exit=$model->getDate($model->date_exit);
            $model->date_reg=$model->getDate(date('c'));
            $model->user_id=Yii::$app->user->getId();
            if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model_region=Region::find()->orderBy('name ASC')->all();
            foreach ($model_region as $value)
            {
                $arrRegion[$value->id] = $value->name;
            }
            return $this->render('create', [
                'model' => $model,
                'arrRegion'=>$arrRegion,
                'arrCity'=>[],
                'arrStreet'=>[],
                'arrService'=>[],
                'arrExit'=>[],
                'arrAbon'=>[],
                'onOff'=>'disabled'
            ]);
        }
    }
    public function actionList($id)
    {
        $countCity=City::find()->where(['region_id'=>$id])->count();
        $city=City::find()->where(['region_id'=>$id])->orderBy('name ASC')->all();
        if($countCity>0){
            echo "<option>Вибиріть.....</option>";
            foreach ($city as $citys){
                echo "<option value='".$citys->id."'>".$citys->name."</option>";
            }
        }
    }
    public function actionLists($id)
    {
        $countStreet=Street::find()->where(['city_id'=>$id])->count();
        $street=Street::find()->where(['city_id'=>$id])->orderBy('name ASC')->all();
        if($countStreet>0){
            echo "<option>Вибиріть.....</option>";
            foreach ($street as $streets){
                echo "<option value='".$streets->id."'>".$streets->name."</option>";
            }
        }
    }
    public function actionLista($id)
    {
        $countAbon=TypeAbon::find()->count();
        $abon=TypeAbon::find()->orderBy('name ASC')->all();
        if($countAbon>0){
            echo "<option>Вибиріть.....</option>";
            foreach ($abon as $abons){
                echo "<option value='".$abons->id."'>".$abons->name."</option>";
            }
        }
    }
    public function actionListe($id)
    {
        $countExit=TypeExit::find()->count();
        $exit=TypeExit::find()->orderBy('name ASC')->all();
        if($countExit>0){
            echo "<option>Вибиріть.....</option>";
            foreach ($exit as $exits){
                echo "<option value='".$exits->id."'>".$exits->name."</option>";
            }
        }
    }
    public function actionListse($id)
    {
        $countServices=Services::find()->count();
        $services=Services::find()->orderBy('name ASC')->all();
        if($countServices>0){
            echo "<option>Вибиріть.....</option>";
            foreach ($services as $servicess){
                echo "<option value='".$servicess->id."'>".$servicess->name."</option>";
            }
        }
    }

    /**
     * Updates an existing Cells model.
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
            $model_region=Region::find()->orderBy('name ASC')->all();
            foreach ($model_region as $value)
            {
                $arrRegion[$value->id] = $value->name;
            }

            $model_city=City::find()->where(['region_id'=>$model->region_id])->orderBy('name ASC')->all();
            foreach ($model_city as $value)
            {
                $arrCity[$value->id] = $value->name;
            }

            $model_street=Street::find()->where(['city_id'=>$model->city_id])->orderBy('name ASC')->all();
            foreach ($model_street as $value)
            {
                $arrStreet[$value->id] = $value->name;
            }

            $model_services=Services::find()->orderBy('name ASC')->all();
            foreach ($model_services as $value)
            {
                $arrServices[$value->id] = $value->name;
            }

            $model_exit=TypeExit::find()->orderBy('name ASC')->all();
            foreach ($model_exit as $value)
            {
                $arrExit[$value->id] = $value->name;
            }

            $model_abon=TypeAbon::find()->orderBy('name ASC')->all();
            foreach ($model_abon as $value)
            {
                $arrAbon[$value->id] = $value->name;
            }

            return $this->render('update', [
                'model' => $model,
                'arrRegion'=>$arrRegion,
                'arrCity'=>$arrCity,
                'arrStreet'=>$arrStreet,
                'arrService'=>$arrServices,
                'arrExit'=>$arrExit,
                'arrAbon'=>$arrAbon,
                'onOff'=>'enabled'
            ]);
        }
    }

    /**
     * Deletes an existing Cells model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can('rulesAdmin')) {

            $this->findModel($id)->delete();
            return $this->redirect(['index']);
            }
            else
                throw new ForbiddenHttpException('Мало прав');
    }

    /**
     * Finds the Cells model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cells the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cells::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Нажаль сторінка не доступна або не існує!!');
        }
    }

    public function actionChecked($id)
    {
        $cells = Cells::findOne($id);
        $cells->update(['checked' => 1]);
        return $this->redirect(['index']);
    }
}
