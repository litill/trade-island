<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbdba65dc2e91baf2d2ecc40a258553fb
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TradeIsland\\Rest\\' => 17,
            'TradeIsland\\Repos\\' => 18,
            'TradeIsland\\Entities\\' => 21,
            'TradeIsland\\CPTS\\' => 17,
            'TradeIsland\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TradeIsland\\Rest\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/rest',
        ),
        'TradeIsland\\Repos\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/repos',
        ),
        'TradeIsland\\Entities\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/entities',
        ),
        'TradeIsland\\CPTS\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/cpts',
        ),
        'TradeIsland\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitbdba65dc2e91baf2d2ecc40a258553fb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbdba65dc2e91baf2d2ecc40a258553fb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbdba65dc2e91baf2d2ecc40a258553fb::$classMap;

        }, null, ClassLoader::class);
    }
}