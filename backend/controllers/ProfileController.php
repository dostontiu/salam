<?php

namespace backend\controllers;

use Yii;
use common\models\Profile;
use common\models\search\ProfileQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
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
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfileQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
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
     * Displays a single Profile model.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionShow()
    {
        $model = Profile::findOne(['user_id' => Yii::$app->user->id]);
        if ($model === null){
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model_user = Profile::find()->where(['user_id' => Yii::$app->user->id])->one();
        if ($model_user !== null){
            Yii::$app->session->setFlash('success', Yii::t('app', 'Вы уже создали учетную запись, так что вы можете обновить свой профиль'));
            return $this->redirect(['update', 'id' => $model_user->id]);
        }
        $model = new Profile();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->user_id = Yii::$app->user->id;
            $file = UploadedFile::getInstance($model, 'file');
            if ($file != null){
                $model->image = "profile_".$model->user_id."_".time().'.'.$file->extension;
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/profile/';
                $path = Yii::$app->params['uploadPath'] . $model->image;
            }
            if ($model->validate() && $model->save()){
                if ($file != null){
                    $file->saveAs($path);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id !== Yii::$app->user->id){
            Yii::$app->session->setFlash('success', Yii::t('app', 'Вы не можете обновить другой профиль'));
            return $this->redirect(Yii::$app->request->getReferrer());
        }

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'file');
            if ($file != null){
                $model->image = "profile_".$model->id."_".time().'.'.$file->extension;
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/profile/';
                $path = Yii::$app->params['uploadPath'] . $model->image;
            }
            if ($model->validate() && $model->save()){
                if ($file != null){
                    $file->saveAs($path);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Profile model.
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
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
}
