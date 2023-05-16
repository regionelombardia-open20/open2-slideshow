<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\slideshow
 * @category   CategoryName
 */

/**
 * @var \open20\amos\slideshow\models\Slideshow $slideshow
 */
use open20\amos\slideshow\AmosSlideshow;
use open20\amos\slideshow\widgets\Modal;

$csrfTokenName = \Yii::$app->request->csrfParam;
$csrfToken = \Yii::$app->request->csrfToken;
$module     = AmosSlideshow::instance();

$this->registerJs('        
    $("#checkAmosSlideshow").on("click", function() {
        var check = $(this).is(":checked");     
        var route = $(this).val();
        $.ajax({
            type:"POST",
            url: "/slideshow/slideshow/cambia",
            data: {
                set:check,
                value:route,'.
                $csrfTokenName.': "'.$csrfToken.'"
            },
            success: function(result) { 
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
            $("#checkAmosSlideshow").trigger("click");
        ', yii\web\View::POS_READY);
        $onceViewedSlideshows = Yii::$app->getSession()->get('onceViewedSlideshows');
        $onceViewedSlideshows[] = $slideshow->slideshowRoutes->route;
        //Yii::$app->getSession()->set('onceViewedSlideshows', $onceViewedSlideshows);//PROVVISORIO DA SISTEMARE
    }else{
        $this->registerJs('
                $(function() {
                var iframe = document.querySelector( "iframe");
                if ( iframe ) {
                var iframeSrc = iframe.src;
                iframe.src = iframeSrc.replace("autoplay=1", "autoplay=0");	
                }
                });
       
        ', yii\web\View::POS_READY);
    }

    Modal::begin([
        'options' => [
            'id' => 'amos-slideshow',
            'class' => $module->customClassName . ' modal-slideshow',
            'tabindex' => 1, // important for Select2 to work properly,
            'data-backdrop' => 'static',
        ],
        'size' => Modal::SIZE_LARGE ,
        'title' => ($headerModal) ? $slideshow->name : '',
        'footer' => '<label for="checkAmosSlideshow"><input type="checkbox" name="check" id="checkAmosSlideshow" value="' . $slideshow->slideshowRoutes->id . '" ' . ((!$default_not_show_again) ? 'checked' : '') . '/>' . AmosSlideshow::t('amosslideshow', 'Non visualizzare alla prossima visita') . '</label>',
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
                <div class="item carousel-item<?= ($inds == 0) ? ' active' : '' ?>">
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




$js = <<< JS

// function on click to modal button close  
// stop play youtube video and set default url into iframe

$('button.close').click(function(){

    var url;
    // find all iframe into slide show carousel div 
    var iframe_video = $('#introSlideshow').find('iframe');

    // foreach iframe in to slide show carousel div, remove autoplay from youtube url
    iframe_video.each(function(){

        url = $(this).attr('src');
        url = url.replace('?autoplay=1','')
        $(this).attr('src', url);

    });
});
JS;
$this->registerJs($js);

?>