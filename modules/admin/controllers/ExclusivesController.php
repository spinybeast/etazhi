<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Exclusives;
use app\models\Properties;
use app\models\ExclusivesProperties;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

/**
 * ExclusivesController implements the CRUD actions for Exclusives model.
 */
class ExclusivesController extends DefaultController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    public function actions()
    {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'product' => Exclusives::className()
                ]
            ],
        ];
    }
    /**
     * Lists all Exclusives models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Exclusives::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Exclusives model.
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
     * Creates a new Exclusives model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Exclusives();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveProperties($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Exclusives model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->clearProperties();
            $this->saveProperties($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Exclusives model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Exclusives model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exclusives the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exclusives::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function saveProperties($model)
    {
        if ($properties = Yii::$app->request->post('ExclusivesProperties', false)) {
            foreach ($properties as $property) {
                if ($propertyName = Properties::find()->where(['name' => $property['name']])->one()) {
                    if ($propertyVal = ExclusivesProperties::find()->where([
                        'property_id' => $propertyName['id'],
                        'exclusive_id' => $model->id
                    ])->one()
                    ) {
                        $propertyVal->value = $property['value'];
                        $propertyVal->save();
                    } else {
                        $propertyVal = new ExclusivesProperties();
                        $propertyVal->exclusive_id = $model->id;
                        $propertyVal->property_id = $propertyName->id;
                        $propertyVal->value = $property['value'];
                        $propertyVal->save();
                    }
                } else {
                    $propertyName = new Properties();
                    $propertyName->name = $property['name'];
                    $propertyName->save();
                    $propertyVal = new ExclusivesProperties();
                    $propertyVal->exclusive_id = $model->id;
                    $propertyVal->property_id = $propertyName->id;
                    $propertyVal->value = $property['value'];
                    $propertyVal->save();
                }
            }
        }
    }

}
