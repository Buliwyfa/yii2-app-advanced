<?php

namespace backend\components;

use common\helpers\LanguageHelper;
use Yii;
use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface
{

    public $supportedLanguages = [];

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $preferredLanguage = LanguageHelper::getPreferredLanguage($this->supportedLanguages);

        if (!empty($preferredLanguage)) {
            Yii::$app->language = $preferredLanguage;
            LanguageHelper::setLanguageCookie($preferredLanguage);
        }
    }

}