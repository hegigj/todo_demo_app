<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitae5fa4e26d5407ff86582d5a880cada4
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Controllers\\AuthController' => __DIR__ . '/../..' . '/controllers/AuthController.php',
        'Controllers\\Controller' => __DIR__ . '/../..' . '/controllers/Controller.php',
        'Controllers\\TodoController' => __DIR__ . '/../..' . '/controllers/TodoController.php',
        'Models\\Database' => __DIR__ . '/../..' . '/models/Database.php',
        'Models\\Model' => __DIR__ . '/../..' . '/models/Model.php',
        'Models\\TodoModel' => __DIR__ . '/../..' . '/models/TodoModel.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitae5fa4e26d5407ff86582d5a880cada4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitae5fa4e26d5407ff86582d5a880cada4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitae5fa4e26d5407ff86582d5a880cada4::$classMap;

        }, null, ClassLoader::class);
    }
}
