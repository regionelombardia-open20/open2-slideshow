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

use lispa\amos\dashboard\controllers\base\DashboardController;
use yii\helpers\Url;

/**
 * Class DefaultController
 * @package lispa\amos\slideshow\controllers
 */
class DefaultController extends DashboardController
{
    /**
     * @var string $layout Layout per la dashboard interna.
     */
    public $layout = 'dashboard_interna';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setUpLayout();
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $params = [
            'currentDashboard' => $this->getCurrentDashboard()
        ];
        return $this->render('index', $params);
    }
}
