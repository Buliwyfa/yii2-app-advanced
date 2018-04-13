<?php

/* @var $gallery common\models\domain\Gallery */

/* @var $galleryImageList [common\models\domain\GalleryItem] */

/* @var $pagination yii\data\Pagination */

use frontend\assets\Lightbox2Asset;
use yii\helpers\Html;
use yii\widgets\LinkPager;

Lightbox2Asset::register($this);

$formatter = Yii::$app->formatter;
?>

<div class="gallery-index">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="gallery-title">
                <?= $gallery->title ?>
            </h1>

            <p>
                <?= $formatter->asDatetime($gallery->created_at) ?>
            </p>
        </div>

        <?php if ($galleryImageList && count($galleryImageList) > 0) { ?>

            <?php foreach ($galleryImageList as $galleryImage) { ?>

                <div class="gallery-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <?= Html::a(Html::img($galleryImage->getUrl(true), ['class' => 'img-responsive']), $galleryImage->getUrl(true), ['data-lightbox' => 'gallery']) ?>
                </div>

            <?php } ?>

            <div style="clear: both"></div>

            <?= LinkPager::widget([
                'pagination' => $pagination,
            ]);
            ?>

        <?php } else { ?>

            <p>
                <?= Yii::t('frontend', 'Gallery.ImageList.EmptyMessage') ?>
            </p>

        <?php } ?>

        <p>&nbsp;</p>

        <p>
            <?= Html::a(Yii::t('frontend', 'Button.Back'), ['/gallery/list'], ['class' => 'btn btn-primary']) ?>
        </p>

    </div>
</div>