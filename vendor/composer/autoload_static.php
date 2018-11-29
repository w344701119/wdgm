<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0ce63bba323852a002e237d1edc535cc
{
    public static $files = array (
        '2630d8b4f8a4e4b5f4e61952f226b9e3' => __DIR__ . '/../..' . '/app/CommonFunction.php',
        '4158aa2be598336581c11bcc5934438f' => __DIR__ . '/../..' . '/app/TableConfig.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'app\\controller\\controller' => __DIR__ . '/../..' . '/app/controller/controller.php',
        'app\\controller\\webApi\\v3\\IndexController' => __DIR__ . '/../..' . '/app/controller/webApi/v3/IndexController.php',
        'app\\lib\\Request' => __DIR__ . '/../..' . '/app/lib/Request.php',
        'app\\lib\\RequestHandle' => __DIR__ . '/../..' . '/app/lib/RequestHandle.php',
        'app\\model\\model' => __DIR__ . '/../..' . '/app/model/model.php',
        'application' => __DIR__ . '/../..' . '/bootstrap/application.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0ce63bba323852a002e237d1edc535cc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0ce63bba323852a002e237d1edc535cc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0ce63bba323852a002e237d1edc535cc::$classMap;

        }, null, ClassLoader::class);
    }
}
