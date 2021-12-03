<?php

namespace App;

use Parsedown;

class MarkdownParser
{

    public static function parse( $text ){
        //return "www";
        //return app(Parsedown::class)->setSafeMode(true)->text($text);

        return Parsedown::instance()->setSafeMode(true)->text( $text );
    }
}
