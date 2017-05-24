<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita3996137b4abbb79a15622f3ff1c791d
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Clickatell\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Clickatell\\' => 
        array (
            0 => __DIR__ . '/..' . '/arcturial/clickatell/src',
            1 => __DIR__ . '/..' . '/arcturial/clickatell/test',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita3996137b4abbb79a15622f3ff1c791d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita3996137b4abbb79a15622f3ff1c791d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
