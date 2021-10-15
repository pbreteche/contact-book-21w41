<?php

namespace App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplateEngine
{
    private static Environment $twig;

    public static function getEnvironment(): Environment
    {
        if (!isset(self::$twig)) {
            $loader = new FilesystemLoader(__DIR__.'/../templates');
            self::$twig = new Environment($loader, [
                'debug' => true,
                'cache' => __DIR__.'/../cache',
            ]);
        }

        return self::$twig;
    }
}
