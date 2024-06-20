<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc94a73d65150908f7b22a3d443f493ef
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc94a73d65150908f7b22a3d443f493ef::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc94a73d65150908f7b22a3d443f493ef::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc94a73d65150908f7b22a3d443f493ef::$classMap;

        }, null, ClassLoader::class);
    }
}
