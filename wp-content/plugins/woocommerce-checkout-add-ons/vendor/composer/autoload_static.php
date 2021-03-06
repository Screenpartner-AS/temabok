<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd5becb7e3a16849c7bc5964cd3a7eba9
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SkyVerge\\WooCommerce\\Checkout_Add_Ons\\' => 38,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SkyVerge\\WooCommerce\\Checkout_Add_Ons\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitd5becb7e3a16849c7bc5964cd3a7eba9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd5becb7e3a16849c7bc5964cd3a7eba9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd5becb7e3a16849c7bc5964cd3a7eba9::$classMap;

        }, null, ClassLoader::class);
    }
}
