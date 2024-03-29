<?php

namespace backend\controllers;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * CRUD controller
 */
class CRUDController extends BaseController
{

    /**
     * On each render call, it was passed as param, so all methods can add data here to be accessed from view
     * @var array
     */
    protected $renderParams = [];

    /**
     * @var ActiveRecord
     */
    protected $modelForView = null;

    /**
     * @var ActiveRecord
     */
    protected $modelForSearch = null;

    /**
     * @var Model
     */
    protected $modelForCreate = null;

    /**
     * @var Model
     */
    protected $modelForUpdate = null;

    /**
     * @var Model
     */
    protected $modelForDelete = null;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['get'],
                    'view' => ['get'],
                    'create' => ['get', 'post'],
                    'update' => ['get', 'post'],
                    'delete' => ['get', 'post'],
                ],
            ]
        ]);
    }

    public function actionIndex()
    {
        // init
        $searchModel = $this->getModelForIndex();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $areaTitle = $this->getAreaTitle();

        // setup sort
        $this->setupSearchSortData($dataProvider);

        // default params
        $this->addRenderParam('title', Yii::t('backend', 'Common.Area.Index.Title', ['areaTitle' => $areaTitle]));
        $this->addRenderParam('areaTitle', $areaTitle);
        $this->addRenderParam('breadcrumbs', [Yii::t('backend', 'Common.Area.Index.Breadcrumb.Title', ['areaTitle' => $areaTitle])]);
        $this->addRenderParam('showCreateButton', true);
        $this->addRenderParam('showGridView', true);
        $this->addRenderParam('showFilterForm', false);
        $this->addRenderParam('showGridViewFilter', true);
        $this->addRenderParam('containerClass', $this->getContainerClass());
        $this->addRenderParam('viewPath', $this->getControllerViewPath());
        $this->addRenderParam('searchModel', $searchModel);
        $this->addRenderParam('filterModel', $searchModel);
        $this->addRenderParam('dataProvider', $dataProvider);

        // render
        $this->beforeRenderOnIndex();

        return $this->render('@backend/views/_partial/crud/index', $this->renderParams);
    }

    /**
     * Get the model for index action
     * @return ActiveRecord
     */
    protected function getModelForIndex()
    {
        $model = new $this->modelForSearch;
        return $model;
    }

    /**
     * Get custom area title
     * @throws Exception
     */
    protected function getAreaTitle()
    {
        throw new Exception('You need set it on your own class.');
    }

    /**
     * Setup data provider with sort data
     * @param $dataProvider
     */
    protected function setupSearchSortData(&$dataProvider)
    {
        $dataProvider->sort = [
            'defaultOrder' => $this->getSearchDefaultSort()
        ];
    }

    /**
     * Get the default search sort data
     * @return array
     */
    protected function getSearchDefaultSort()
    {
        return ['created_at' => SORT_DESC];
    }

    /**
     * Add new data to render params
     * @param $key
     * @param $value
     */
    protected function addRenderParam($key, $value)
    {
        if ($this->renderParams == null) {
            $this->renderParams = [];
        }

        $this->renderParams[$key] = $value;
    }

    /**
     * Get custom CSS class for the view containers
     * @throws Exception
     */
    protected function getContainerClass()
    {
        throw new Exception('You need set it on your own class.');
    }

    /**
     * Get custom view path for child controller
     * @throws Exception
     */
    protected function getControllerViewPath()
    {
        throw new Exception('You need set it on your own class.');
    }

    /**
     * Execute before call render on index action
     */
    protected function beforeRenderOnIndex()
    {
    }

    public function actionView()
    {
        // init
        $model = $this->getModelForView();
        $model->setScenario('view');
        $areaTitle = $this->getAreaTitle();

        // default params
        $this->addRenderParam('title', Yii::t('backend', 'Common.Area.View.Title', ['areaTitle' => $areaTitle, 'id' => $model->id]));
        $this->addRenderParam('areaTitle', $areaTitle);
        $this->addRenderParam('breadcrumbs', [
            ['label' => Yii::t('backend', 'Common.Area.Index.Breadcrumb.Title', ['areaTitle' => $areaTitle]), 'url' => Url::to('index')],
            Yii::t('backend', 'Common.Area.View.Breadcrumb.Title', ['areaTitle' => $areaTitle]),
        ]);
        $this->addRenderParam('containerClass', $this->getContainerClass());
        $this->addRenderParam('viewPath', $this->getControllerViewPath());
        $this->addRenderParam('model', $model);

        // render
        $this->beforeRenderOnView();

        return $this->render('@backend/views/_partial/crud/view', $this->renderParams);
    }

    /**
     * Get the model for view action
     * @return ActiveRecord
     */
    protected function getModelForView()
    {
        if (($model = call_user_func((string)$this->modelForView . '::findOne', Yii::$app->request->get('id'))) !== null) {
            return $model;
        } else {
            $this->onItemNotFound();
        }

        return null;
    }

    /**
     * Executed when item was not found / invalid
     */
    protected function onItemNotFound()
    {
        Yii::$app->session->setFlash('flash', [
            'options' => ['class' => 'alert-danger'],
            'body' => Yii::t('backend', 'Message.ItemNotFound')
        ]);

        Yii::$app->getResponse()->redirect('index');
        Yii::$app->end();
    }

    /**
     * Execute before call render on view action
     */
    protected function beforeRenderOnView()
    {
    }

    public function actionCreate()
    {
        // init
        $model = $this->getModelForCreate();
        $model->setScenario('create');
        $areaTitle = $this->getAreaTitle();

        // process
        if (Yii::$app->request->isPost) {
            if ($this->beforeLoadDataOnCreate($model)) {
                if ($model->load(Yii::$app->request->post())) {
                    if ($this->afterLoadDataOnCreate($model)) {
                        if ($model->validate()) {
                            if ($this->afterValidateOnCreate($model)) {
                                if ($model->save(false)) {
                                    if ($this->afterSaveOnCreate($model)) {
                                        $this->redirectOnCreate($model);
                                        return false;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $this->afterModelNewInstanceOnCreate($model);
        }

        // default params
        $this->addRenderParam('title', Yii::t('backend', 'Common.Area.Create.Title', ['areaTitle' => $areaTitle]));
        $this->addRenderParam('areaTitle', $areaTitle);
        $this->addRenderParam('breadcrumbs', [
            ['label' => Yii::t('backend', 'Common.Area.Index.Breadcrumb.Title', ['areaTitle' => $areaTitle]), 'url' => Url::to('index')],
            Yii::t('backend', 'Common.Area.Create.Breadcrumb.Title', ['areaTitle' => $areaTitle]),
        ]);
        $this->addRenderParam('containerClass', $this->getContainerClass());
        $this->addRenderParam('viewPath', $this->getControllerViewPath());
        $this->addRenderParam('model', $model);
        $this->addRenderParam('showForm', true);

        // render
        $this->beforeRenderOnCreate();

        return $this->render('@backend/views/_partial/crud/create', $this->renderParams);
    }

    /**
     * Get the model for create action
     * @return ActiveRecord
     */
    protected function getModelForCreate()
    {
        $model = new $this->modelForCreate;
        return $model;
    }

    /**
     * Executed before load data from request on model inside create action
     * @param $model
     * @return bool
     */
    protected function beforeLoadDataOnCreate(&$model)
    {
        return true;
    }

    /**
     * Executed after load data from request on model inside create action
     * @param $model
     * @return bool
     */
    protected function afterLoadDataOnCreate(&$model)
    {
        return true;
    }

    /**
     * Executed after validate model inside create action
     * @param $model
     * @return bool
     */
    protected function afterValidateOnCreate(&$model)
    {
        return true;
    }

    /**
     * Executed after save model inside create action
     * @param $model
     * @return bool
     */
    protected function afterSaveOnCreate(&$model)
    {
        return true;
    }

    /**
     * Executed to redirect the user to other action from create action
     * @param $model
     */
    protected function redirectOnCreate(&$model)
    {
        Yii::$app->session->setFlash('flash', [
            'options' => ['class' => 'alert-success'],
            'body' => Yii::t('backend', 'Message.ItemCreated')
        ]);

        Yii::$app->getResponse()->redirect('index');
    }

    /**
     * Executed after new instance of model was created to be showed on view
     * @param $model
     */
    protected function afterModelNewInstanceOnCreate(&$model)
    {
    }

    /**
     * Execute before call render on create action
     */
    protected function beforeRenderOnCreate()
    {
    }

    public function actionUpdate()
    {
        // init
        $model = $this->getModelForUpdate();
        $model->setScenario('update');
        $areaTitle = $this->getAreaTitle();

        // process
        if (Yii::$app->request->isPost) {
            if ($this->beforeLoadDataOnUpdate($model)) {
                if ($model->load(Yii::$app->request->post())) {
                    if ($this->afterLoadDataOnUpdate($model)) {
                        if ($model->validate()) {
                            if ($this->afterValidateOnUpdate($model)) {
                                if ($model->save(false)) {
                                    if ($this->afterSaveOnUpdate($model)) {
                                        $this->redirectOnUpdate($model);
                                        return false;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $this->afterModelLoadedOnUpdated($model);
        }

        // default params
        $this->addRenderParam('title', Yii::t('backend', 'Common.Area.Update.Title', ['areaTitle' => $areaTitle]));
        $this->addRenderParam('areaTitle', $areaTitle);
        $this->addRenderParam('breadcrumbs', [
            ['label' => Yii::t('backend', 'Common.Area.Index.Breadcrumb.Title', ['areaTitle' => $areaTitle]), 'url' => Url::to('index')],
            Yii::t('backend', 'Common.Area.Update.Breadcrumb.Title', ['areaTitle' => $areaTitle]),
        ]);
        $this->addRenderParam('containerClass', $this->getContainerClass());
        $this->addRenderParam('viewPath', $this->getControllerViewPath());
        $this->addRenderParam('model', $model);
        $this->addRenderParam('showForm', true);

        // render
        $this->beforeRenderOnUpdate();

        return $this->render('@backend/views/_partial/crud/update', $this->renderParams);
    }

    /**
     * Get the model for update action
     * @return ActiveRecord
     */
    protected function getModelForUpdate()
    {
        if (($model = call_user_func((string)$this->modelForView . '::findOne', Yii::$app->request->get('id'))) !== null) {
            return $model;
        } else {
            $this->onItemNotFound();
        }

        return null;
    }

    /**
     * Executed before load data from request on model inside update action
     * @param $model
     * @return bool
     */
    protected function beforeLoadDataOnupdate(&$model)
    {
        return true;
    }

    /**
     * Executed after load data from request on model inside update action
     * @param $model
     * @return bool
     */
    protected function afterLoadDataOnUpdate(&$model)
    {
        return true;
    }

    /**
     * Executed after validate model inside update action
     * @param $model
     * @return bool
     */
    protected function afterValidateOnUpdate(&$model)
    {
        return true;
    }

    /**
     * Executed after save model inside update action
     * @param $model
     * @return bool
     */
    protected function afterSaveOnUpdate(&$model)
    {
        return true;
    }

    /**
     * Executed to redirect the user to other action from update action
     * @param $model
     */
    protected function redirectOnUpdate(&$model)
    {
        Yii::$app->session->setFlash('flash', [
            'options' => ['class' => 'alert-success'],
            'body' => Yii::t('backend', 'Message.ItemUpdated')
        ]);

        Yii::$app->getResponse()->redirect('index');
    }

    /**
     * Executed after model loaded to be showed on view
     * @param $model
     */
    protected function afterModelLoadedOnUpdated(&$model)
    {
    }

    /**
     * Execute before call render on create action
     */
    protected function beforeRenderOnUpdate()
    {
    }

    public function actionDelete()
    {
        // init
        $model = $this->getModelForDelete();
        $model->setScenario('delete');

        if ($model) {
            if ($this->beforeDeleteModelOnDelete($model)) {
                if ($model->delete()) {
                    if ($this->afterDeleteModelOnDelete($model)) {
                        Yii::$app->session->setFlash('flash', [
                            'options' => ['class' => 'alert-success'],
                            'body' => Yii::t('backend', 'Message.ItemDeleted')
                        ]);
                    }
                }
            }
        }

        return Yii::$app->getResponse()->redirect('index');
    }

    /**
     * Get the model for delete action
     * @return ActiveRecord
     */
    protected function getModelForDelete()
    {
        if (($model = call_user_func((string)$this->modelForDelete . '::findOne', Yii::$app->request->get('id'))) !== null) {
            return $model;
        } else {
            $this->onItemNotFound();
        }

        return null;
    }

    /**
     * Executed before delete model on delete action
     * @return boolean
     */
    protected function beforeDeleteModelOnDelete(&$model)
    {
        return true;
    }

    /**
     * Executed after delete model on delete action
     * * @return boolean
     */
    protected function afterDeleteModelOnDelete(&$model)
    {
        return true;
    }

}
