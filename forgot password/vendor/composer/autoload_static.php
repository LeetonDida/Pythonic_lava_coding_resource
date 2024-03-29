<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb65a141941268313f82a1f6e1aad53b0
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb65a141941268313f82a1f6e1aad53b0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb65a141941268313f82a1f6e1aad53b0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb65a141941268313f82a1f6e1aad53b0::$classMap;

        }, null, ClassLoader::class);
    }
}
