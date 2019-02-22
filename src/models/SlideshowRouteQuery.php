<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow
 * @category   CategoryName
 */

namespace lispa\amos\slideshow\models;

use lispa\amos\cwh\query\CwhActiveQuery;

/**
 * Class Slideshow RouteQuery
 * @package lispa\amos\slideshow\models * File generato automaticamente, verificarne
 * il contenuto prima di utilizzarlo in produzione
 */
class SlideshowRouteQuery extends CwhActiveQuery
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
        return $this->innerJoin('slideshowRoute_stato', 'slideshowRoute.slideshowRoute_stato_id = slideshowRoute_stato.id AND slideshowRoute_stato.nome = :stato_nome', [
            ':stato_nome' => 'Attiva'
        ]);
    }
}