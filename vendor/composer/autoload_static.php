<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit983fee17fdf1b11b337bded5875e2180
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'KnConfigurator\\Controller\\' => 26,
            'KnConfigurator\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'KnConfigurator\\Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controller',
        ),
        'KnConfigurator\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit983fee17fdf1b11b337bded5875e2180::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit983fee17fdf1b11b337bded5875e2180::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}