<?php

namespace frontend\controllers;

use common\models\Notes;
use common\models\search\NotesSearch;
use common\models\Tags;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotesController implements the CRUD actions for Notes model.
 */
class NotesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Notes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NotesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $tags = ArrayHelper::map(Tags::find()->all(), 'id', 'title');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tags' => $tags
        ]);
    }

    /**
     * Creates a new Notes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Notes();
        $model->user_id = \Yii::$app->user->identity->id;

        $tags = Tags::find()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $model->saveRelatedTags();
                \Yii::$app->session->setFlash('success', "Заметка успешно создана!");
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'tags' => $tags
        ]);
    }

    /**
     * Updates an existing Notes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $tags = Tags::find()->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $model->saveRelatedTags();
            \Yii::$app->session->setFlash('success', "Заметка успешно изменена!");
            return $this->redirect(['index']);
        }

        $model->tags = ArrayHelper::getColumn($model->relatedTags, 'id');

        return $this->render('update', [
            'model' => $model,
            'tags' => $tags,
        ]);
    }

    /**
     * Deletes an existing Notes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        \Yii::$app->session->setFlash('success', "Заметка успешно удалена!");

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Notes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notes::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
