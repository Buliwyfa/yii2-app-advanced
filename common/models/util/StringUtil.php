<?php

namespace common\models\util;

use Ausi\SlugGenerator\SlugGenerator;

class StringUtil
{

    public static function slug($string)
    {
        $generator = new SlugGenerator();
        return $generator->generate($string);
    }

}