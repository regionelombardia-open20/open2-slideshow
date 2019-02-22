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

use lispa\amos\slideshow\models\SlideshowRoute;
use lispa\amos\slideshow\models\SlideshowUserflag;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class SlideshowController
 * @package lispa\amos\slideshow\controllers
 *
 * This is the class for controller "SlideshowController".
 */
class SlideshowController extends \lispa\amos\slideshow\controllers\base\SlideshowController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'cambia',
                            'route-by-role',
                        ],
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'route-by-role' => ['post']
                ]
            ]
        ]);
        return $behaviors;
    }

    /**
     * @return bool
     */
    public function actionCambia()
    {
        if (\Yii::$app->request->isAjax) {
            if (!\Yii::$app->getUser()->isGuest) {
                $data = \Yii::$app->request->post();
                if (isset($data['set']) && $data['set'] == 'true') {
                    $routeId = $data['value'];
                    $userId = \Yii::$app->getUser()->getId();
                    $slideshowUserflag = SlideshowUserflag::findOne(['user_id' => $userId, 'slideshow_route_id' => $routeId]);
                    if (!$slideshowUserflag) {
                        $slideshowUserflag = new SlideshowUserflag();
                        $slideshowUserflag->slideshow_route_id = $routeId;
                        $slideshowUserflag->user_id = $userId;
                        $slideshowUserflag->save(FALSE);
                    }
                } else {
                    $routeId = $data['value'];
                    $userId = \Yii::$app->getUser()->getId();
                    $slideshowUserflag = SlideshowUserflag::deleteAll(['user_id' => $userId, 'slideshow_route_id' => $routeId]);
                }
            }
        }

        return TRUE;
    }

    public function actionRouteByRole()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $id_selected = end($_POST['depdrop_params']);
            $slideshow = new SlideshowRoute();
            $routes = $slideshow->getRotte(NULL, $id);
            $selected = null;

            if ($id != null && count($routes) > 0) {
                $selected = '';
                foreach ($routes as $i => $route) {

                    $out[] = ['id' => $i, 'name' => $route];

                    if ($id_selected) {
                        $selected = $id_selected;
                    } elseif ($i == 0) {
                        $selected = $i;
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }

        echo Json::encode(['output' => '', 'selected' => '']);
    }
}
