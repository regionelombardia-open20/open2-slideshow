<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow
 * @category   CategoryName
 */

namespace lispa\amos\slideshow\widgets\icons;

use lispa\amos\core\widget\WidgetIcon;
use lispa\amos\slideshow\AmosSlideshow;
use Yii;
use yii\helpers\ArrayHelper;

class WidgetIconSlideshowConf extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosSlideshow::tHtml('amosslideshow', 'Slideshow'));
        $this->setDescription(AmosSlideshow::t('amosslideshow', 'Visualizza gli slideshow presenti'));
        $this->setIcon('image');
        if (!Yii::$app->user->isGuest) {
            $this->setUrl(\Yii::$app->urlManager->createUrl(['/slideshow/slideshow/index']));
        }

        $this->setCode('SLIDESHOW_LIST');
        $this->setModuleName('slideshow');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                [
                    'bk-backgroundIcon',
                    'color-darkPrimary'
                ]
            )
        );
    }

}
