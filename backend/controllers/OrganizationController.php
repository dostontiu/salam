<?php

namespace backend\controllers;

use common\models\Category;
use common\models\Filter;
use common\models\OrganizationWithCategory;
use common\models\OrgWithFilter;
use Yii;
use common\models\Organization;
use common\models\search\OrganizationQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * OrganizationController implements the CRUD actions for Organization model.
 */
class OrganizationController extends Controller
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
     * Lists all Organization models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrganizationQuery();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filterFilter' => $this->filterFilter(),
        ]);
    }

    /**
     * Displays a single Organization model.
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
     * Creates a new Organization model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new OrgWithFilter();
        if ($model->load(Yii::$app->request->post())){
            $model->user_id = Yii::$app->user->id;
            $image = UploadedFile::getInstance($model, 'image');
            if ($image != null){
                $model->photo = Yii::$app->security->generateRandomString(12).'.'.$image->extension;
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
                $path = Yii::$app->params['uploadPath'] . $model->photo;
            }
            if ($model->validate() && $model->save()){
                if ($image != null){
                    $image->saveAs($path);
                }
                $model->saveFilters();
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'filters' => $model->getAvailableFilters()
        ]);
    }

    /**
     * Updates an existing Organization model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\base\Exception
     */
    public function actionUpdate($id)
    {
        $model = OrgWithFilter::findOne($id);
        $model->loadFilters();

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image != null){
                $model->photo = Yii::$app->security->generateRandomString(12).'.'.$image->extension;
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
                $path = Yii::$app->params['uploadPath'] . $model->photo;
            }
            if ($model->validate() && $model->save()){
                if ($image != null){
                    $image->saveAs($path);
                }
                $model->saveFilters();
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'filters' => $model->getAvailableFilters()
        ]);
    }

    /**
     * Deletes an existing Organization model.
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
     * Finds the Organization model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organization the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organization::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    function filterFilter(){
        $i=0;
        foreach (Filter::find()->all() as $filter) {
            $data = '';
            $i++;
            foreach ($filter->organizationFilters as $a) {
                $data .= $a->organization_id. ',';
            }
            $filter_name[$i.'|'.$data] = $filter->name_ru;
        }
        return $filter_name;
    }
}
