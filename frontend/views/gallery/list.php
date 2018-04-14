<?php

/* @var $list [common\models\domain\Gallery] */

/* @var $pagination yii\data\Pagination */

use common\models\domain\GalleryItem;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$formatter = Yii::$app->formatter;
?>

<div class="gallery-list">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="gallery-title">
                <?= Yii::t('frontend', 'Gallery.List.Title') ?>
            </h1>
        </div>

        <?php if ($list && count($list) > 0) { ?>

            <?php
            foreach ($list as $gallery) {
                $galleryImages = GalleryItem::find()->galleryId($gallery->id)->orderByOrder()->all();

                if (count($galleryImages) > 0) {
                    $galleryImage = $galleryImages[0];
                    ?>

                    <div class="gallery-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                        <p>
                            <?= $gallery->title ?>
                        </p>

                        <p>
                            <?= $formatter->asDatetime($gallery->created_at) ?>
                        </p>

                        <?= Html::a(Html::img($galleryImage->getUrl(true), ['class' => 'img-responsive']), $gallery->getUrl(true)) ?>
                    </div>

                    <?php
                }
            }
            ?>

            <div style="clear: both"></div>

            <?= LinkPager::widget([
                'pagination' => $pagination,
            ]);
            ?>

        <?php } else { ?>

            <p>
                <?= Yii::t('frontend', 'Gallery.List.EmptyMessage') ?>
            </p>

        <?php } ?>

    </div>
</div>

