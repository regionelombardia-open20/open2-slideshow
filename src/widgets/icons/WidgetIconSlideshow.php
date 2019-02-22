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
use lispa\amos\dashboard\models\AmosWidgets;
use lispa\amos\slideshow\AmosSlideshow;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconSlideshow
 * @package lispa\amos\slideshow\widgets\icons
 */
class WidgetIconSlideshow extends WidgetIcon
{
    public function getOptions()
    {
        $options = parent::getOptions();

        //aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
        return ArrayHelper::merge($options, ["children" => $this->getWidgetsIcon()]);
    }

    public function getWidgetsIcon()
    {
        return AmosWidgets::find()
            ->andWhere([
                'child_of' => self::className()
            ])->all();
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosSlideshow::tHtml('amosslideshow', 'Dashboard Slideshow'));
        $this->setDescription(AmosSlideshow::t('amosslideshow', 'Visualizza dashboard slideshow'));

        $this->setIcon('image');
        //$this->setIconFramework('');

        $this->setUrl(Yii::$app->urlManager->createUrl(['/slideshow']));
        $this->setCode('SLIDESHOW');
        $this->setModuleName('slideshow');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-darkPrimary'
        ]));
    }
}
