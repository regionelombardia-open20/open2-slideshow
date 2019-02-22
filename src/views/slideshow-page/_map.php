<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow
 * @category   CategoryName
 */

/*
 * Personalizzare a piacimento la vista
 * $model è il model legato alla tabella del db
 * $buttons sono i tasti del template standard {view}{update}{delete}
 */
?>

<div class="listview-container">
    <div class="bk-listViewElement">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h2><?= $model ?></h2>
            <p>####### personalizzare l&#39;html a piacimento #######</p>
        </div>
        <div class="bk-elementActions">
            <a href="slideshow-pages/view?id=<?= $model->id ?>">
                <button class="btn btn-success"><?= AmosSlideshow::t('amosslideshow', 'Visualizza') ?></button>
            </a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>