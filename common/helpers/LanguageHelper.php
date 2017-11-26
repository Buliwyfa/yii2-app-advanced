<?php

namespace common\helpers;

use Yii;
use yii\web\Cookie;

class LanguageHelper
{

    public static function setLanguageCookie($language)
    {
        $cookie = new Cookie();
        $cookie->name = 'customer-language';
        $cookie->value = $language;

        Yii::$app->response->getCookies()->add($cookie);
    }

    public static function getPreferredLanguage($supportedLanguages)
    {
        // get preferred language from cookie
        $preferredLanguage = isset(Yii::$app->request->cookies['customer-language']) ? (string)Yii::$app->request->cookies['customer-language'] : null;

        // get prefered language from browser
        if (empty($preferredLanguage)) {
            $preferredLanguage = Yii::$app->request->getPreferredLanguage($supportedLanguages);
        }

        // get prefered language from profile
        if (empty($preferredLanguage)) {
            if (!Yii::$app->user->isGuest) {
                $language = Yii::$app->user->language;

                if ($language) {
                    $preferredLanguage = $language->code_iso_language;
                }
            }
        }

        // check for language existance
        foreach ($supportedLanguages as $supportedLanguage) {
            if ($supportedLanguage == $preferredLanguage) {
                break;
            }
        }

        if (empty($preferredLanguage)) {
            if (count($supportedLanguages) > 0) {
                $preferredLanguage = $supportedLanguages[0];
            }
        }

        return $preferredLanguage;
    }

}