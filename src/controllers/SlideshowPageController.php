<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow\controllers
 * @category   CategoryName
 */

namespace lispa\amos\slideshow\controllers;

use lispa\amos\slideshow\AmosSlideshow;
use lispa\amos\slideshow\models\Slideshow;
use lispa\amos\slideshow\models\SlideshowPage;
use Yii;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Class SlideshowPageController
 *
 * This is the class for controller "SlideshowPageController".
 *
 * @package lispa\amos\slideshow\controllers
 */
class SlideshowPageController extends \lispa\amos\slideshow\controllers\base\SlideshowPageController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'create-for-specific-slideshow',
                        ],
                        'roles' => [SlideshowPage::className() . '_CREATE', 'ADMIN']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post', 'get']
                ]
            ]
        ]);
        return $behaviors;
    }

    /**
     * Lists all SlideshowPage models.
     * @param null|string $layout
     * @return mixed|string
     */
    public function actionIndex($layout = NULL)
    {
        $this->setUpLayout('list');

        Url::remember();
        $params = Yii::$app->request->getQueryParams();
        $this->setDataProvider($this->getModelSearch()->searchSlideshowPages($params));

        //Yii::$app->view->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Slideshow'), 'url' => '/slideshow/slideshow/index'];
        $slideshowName = "";
        if (isset($params['slideshowId'])) {
            Yii::$app->view->params['slideshowId'] = $params['slideshowId'];
            $slideshow = Slideshow::findOne($params['slideshowId']);
            if (!is_null($slideshow)) {
                $slideshowName = ": " . $slideshow->name;
            }
            Yii::$app->view->title = AmosSlideshow::t('amosslideshow', 'Pagine dello slideshow' . $slideshowName);
        } else {
            Yii::$app->view->title = AmosSlideshow::t('amosslideshow', 'Pagine degli slideshow');
        }
        //Yii::$app->view->params['breadcrumbs'][] = Yii::$app->view->title;
        Yii::$app->view->params['createNewBtnParams'] = [
            'urlCreateNew' => [
                'create-for-specific-slideshow',
                'slideshow_id' => $params['slideshowId']
            ]
        ];

        return $this->render('index', [
            'dataProvider' => $this->getDataProvider(),
            'model' => $this->getModelSearch(),
            'currentView' => $this->getCurrentView(),
            'availableViews' => $this->getAvailableViews(),
            'url' => ($this->url) ? $this->url : NULL,
            'parametro' => ($this->parametro) ? $this->parametro : NULL
        ]);
    }

    /**
     * Creates a new SlideshowPage model for a specific slideshow.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateForSpecificSlideshow()
    {
        $this->setUpLayout('form');

        $this->model = new SlideshowPage();
        $params = Yii::$app->request->getQueryParams();
        $this->model->slideshow_id = $params['slideshow_id'];

        Yii::$app->view->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Slideshow'), 'url' => '/slideshow'];
        Yii::$app->view->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Elenco'), 'url' => '/slideshow/slideshow/index'];
        $slideshowPageName = 'Pagine degli slideshow';
        if (isset($params['slideshow_id'])) {
            $slideshow = Slideshow::findOne($params['slideshow_id']);
            if (!is_null($slideshow)) {
                $slideshowName = $slideshow->name;
            }
        }
        Yii::$app->view->params['breadcrumbs'][] = ['label' => $slideshowName, 'url' => Url::previous()];
        Yii::$app->view->title = AmosSlideshow::t('amosslideshow', 'Crea pagina');
        Yii::$app->view->params['breadcrumbs'][] = Yii::$app->view->title;

        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate()) {
            if ($this->model->save()) {
                Yii::$app->getSession()->addFlash('success', AmosSlideshow::tHtml('amosslideshow', 'Elemento creato correttamente.'));
                return $this->redirect(Url::previous());
            } else {
                Yii::$app->getSession()->addFlash('danger', AmosSlideshow::tHtml('amosslideshow', 'Elemento non creato, verificare i dati inseriti.'));
                return $this->render('create', [
                    'model' => $this->model,
                    'slideshowName' => $slideshowName
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $this->model,
                'slideshowName' => $slideshowName
            ]);
        }
    }
}
