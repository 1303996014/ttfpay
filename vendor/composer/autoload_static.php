<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit40dd55ff50190307f2b8f90342776525
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Laoyao\\Ttfpay\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Laoyao\\Ttfpay\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit40dd55ff50190307f2b8f90342776525::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit40dd55ff50190307f2b8f90342776525::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit40dd55ff50190307f2b8f90342776525::$classMap;

        }, null, ClassLoader::class);
    }
}
