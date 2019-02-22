<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow
 * @category   CategoryName
 */

namespace backend\modules\slideshow\models;

use backend\modules\cwh\query\CwhActiveQuery;
use creocoder\taggable\TaggableQueryBehavior;
use yii\helpers\ArrayHelper;


/**
 * Class Slideshow PageQuery
 * @package backend\modules\slideshow\models * File generato automaticamente, verificarne
 * il contenuto prima di utilizzarlo in produzione
 */
class SlideshowPageQuery extends CwhActiveQuery
{
    /**
     * @return array
     * da scommentare se si utilizzano i tag
     */
    //public function behaviors()
    //{
    //    return ArrayHelper::merge(
    //        parent::behaviors(), [
    //            TaggableQueryBehavior::className()
    //        ]
    //    );   
    //}

    /**
     * @return \yii\db\ActiveQuery     
     */
    public function attive()
    {
    //Questo è solo un esempio, verificare che i campi e le tabelle siano corretti
    return $this->innerJoin('slideshowPage_stato', 'slideshowPage.slideshowPage_stato_id = slideshowPage_stato.id AND slideshowPage_stato.nome = :stato_nome', [
            ':stato_nome' => 'Attiva'
        ]);
    }
}