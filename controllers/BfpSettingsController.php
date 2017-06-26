<?php

//namespace common\controllers;
namespace rikcage\bfp\controllers;

use Yii;
use rikcage\bfp\models\BfpSettings;
use rikcage\bfp\models\BfpSettingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BfpSettingsController implements the CRUD actions for BfpSettings model.
 */
class BfpSettingsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behavior = [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'update' => ['post'],
//                    '*' => ['get'],
//                ],
//            ]
        ];

        if (!empty(Yii::$app->controller->module->params['accessRoles'])) {
            $behavior['access'] = [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => Yii::$app->controller->module->params['accessRoles'],
                    ],
                ],
            ];
        }

        return $behavior;
    }

    /**
     * Lists all BfpSettings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BfpSettingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new BfpSettings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BfpSettings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index',]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BfpSettings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index',]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BfpSettings model.
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
     * Finds the BfpSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BfpSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BfpSettings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
