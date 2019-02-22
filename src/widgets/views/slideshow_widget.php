<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\slideshow
 * @category   CategoryName
 */

/**
 * @var \lispa\amos\slideshow\models\Slideshow $slideshow
 */
use lispa\amos\slideshow\AmosSlideshow;
use yii\bootstrap\Modal;

$this->registerJs('        
    $("#checkAmosSlideshow").on("click", function() {
        var check = $(this).is(":checked");     
        var route = $(this).val();
        $.ajax({
            type:"POST",
            url: "/slideshow/slideshow/cambia",
            data: {
                set:check,
                value:route
            },
            success: function(result) { 
                //console.log("ok");
            }
        });			
    });
 ', \yii\web\View::POS_READY);

if ($slideshow->getSlideshowPages()->count() && !empty($slideshow->slideshowRoutes->route) && $route == $slideshow->slideshowRoutes->route) {
    $headerModal = \Yii::$app->getModule('slideshow')->params['headerModal'];

    if (!isset(Yii::$app->session['onceViewedSlideshows'])) {
        Yii::$app->getSession()->set('onceViewedSlideshows', []);
    }

    if ($slideshow->slideshowRoutes->already_view == 1 && !$flag && !in_array($slideshow->slideshowRoutes->route, Yii::$app->getSession()->get('onceViewedSlideshows'))) {
        $this->registerJs('
            $("#amos-slideshow").modal({
                "show": true
            });
        ', yii\web\View::POS_READY);
        $onceViewedSlideshows = Yii::$app->getSession()->get('onceViewedSlideshows');
        $onceViewedSlideshows[] = $slideshow->slideshowRoutes->route;
        //Yii::$app->getSession()->set('onceViewedSlideshows', $onceViewedSlideshows);//PROVVISORIO DA SISTEMARE
    }

    Modal::begin([
        'options' => [
            'id' => 'amos-slideshow',
            'class' => 'modal-slideshow',
            'tabindex' => 1, // important for Select2 to work properly,
            'data-backdrop' => 'static',
        ],
        'header' => ($headerModal) ? $slideshow->name : '',
        'footer' => '<label for="checkAmosSlideshow"><input type="checkbox" name="check" id="checkAmosSlideshow" value="' . $slideshow->slideshowRoutes->id . '" ' . (($flag) ? 'checked' : '') . '/>' . AmosSlideshow::t('amosslideshow', 'Non visualizzare alla prossima visita') . '</label>',
        //'toggleButton' => ['label' => (strlen($slideshow->label)) ? $slideshow->label : 'Apri slideshow', 'class' => 'btn btn-success'/* , 'style' => 'display:none;' */],
    ]);
    ?>


    <div id="introSlideshow" class="carousel" data-ride="carousel" data-interval="false">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            $inds = 0;
            foreach ($slideshow->getSlideshowPages()->orderBy('ordinal')->asArray()->all() as $pageContent):
                ?>
                <div class="item<?= ($inds == 0) ? ' active' : '' ?>">
                    <?= ($header !== NULL) ? $this->render($header) : '' ?>
                    <!--<div class="amosSlideshow">-->
                        <?= $pageContent['pageContent'] ?>
                    <!--</div>-->
                    <?= ($footer !== NULL) ? $this->render($footer) : '' ?>
                </div>
                <?php
                $inds++;
            endforeach;
            ?>
        </div>

        <!-- Controls -->
        <?php if ($slideshow->getSlideshowPages()->count() > 1) { ?>
            <a class="left carousel-control" href="#introSlideshow" data-slide="prev" title="<?= AmosSlideshow::t('amosslideshow', 'slide precedente') ?>">
                <span class="glyphicon glyphicon-chevron-left"></span><span class="sr-only"><?= AmosSlideshow::t('amosslideshow', 'Prev') ?></span>
            </a>
            <a class="right carousel-control" href="#introSlideshow" data-slide="next" title="<?= AmosSlideshow::t('amosslideshow', 'slide successiva') ?>">
                <span class="glyphicon glyphicon-chevron-right"></span><span class="sr-only"><?= AmosSlideshow::t('amosslideshow', 'Next') ?></span>
            </a>
        <?php } ?>

        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            $ind = 0;
            foreach ($slideshow->getSlideshowPages()->orderBy('ordinal')->asArray()->all() as $page):
                ?>
                <li data-target="#introSlideshow" data-slide-to="<?= $ind ?>" <?= ($ind == 0) ? 'class="active"' : '' ?>></li>
                <?php
                $ind++;
            endforeach;
            ?>
        </ol>

    </div>

    <?php
    Modal::end();
}
?>