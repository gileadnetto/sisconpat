<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit96857f75c9263e6ad90cbfcf57904f98
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SON\\' => 4,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SON\\' => 
        array (
            0 => 'C:\\xampp\\htdocs\\sisconpat\\vendor',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'App\\Controllers\\Autenticar' => __DIR__ . '/../..' . '/app/Controllers/autenticar.php',
        'App\\Controllers\\Helpers\\Validadores' => __DIR__ . '/../..' . '/app/Controllers/Helpers/Validadores.php',
        'App\\Controllers\\Helpers\\dateHelper' => __DIR__ . '/../..' . '/app/Controllers/Helpers/dateHelper.php',
        'App\\Controllers\\HomeCtrl' => __DIR__ . '/../..' . '/app/Controllers/HomeCtrl.php',
        'App\\Controllers\\Index' => __DIR__ . '/../..' . '/app/Controllers/index.php',
        'App\\Controllers\\LocalidadeCtrl' => __DIR__ . '/../..' . '/app/Controllers/LocalidadeCtrl.php',
        'App\\Controllers\\PatrimonioCtrl' => __DIR__ . '/../..' . '/app/Controllers/PatrimonioCtrl.php',
        'App\\Controllers\\TransferenciaCtrl' => __DIR__ . '/../..' . '/app/Controllers/TransferenciaCtrl.php',
        'App\\Controllers\\UsuarioCtrl' => __DIR__ . '/../..' . '/app/Controllers/UsuarioCtrl.php',
        'App\\Init' => __DIR__ . '/../..' . '/app/Init.php',
        'App\\Models\\Endereco' => __DIR__ . '/../..' . '/app/Models/Endereco.php',
        'App\\Models\\Home' => __DIR__ . '/../..' . '/app/Models/Home.php',
        'App\\Models\\Localidade' => __DIR__ . '/../..' . '/app/Models/Localidade.php',
        'App\\Models\\Patrimonio' => __DIR__ . '/../..' . '/app/Models/Patrimonio.php',
        'App\\Models\\Transferencia' => __DIR__ . '/../..' . '/app/Models/Transferencia.php',
        'App\\Models\\TransferenciaItem' => __DIR__ . '/../..' . '/app/Models/TransferenciaItem.php',
        'App\\Models\\UserSession' => __DIR__ . '/../..' . '/app/Models/UserSession.php',
        'App\\Models\\Usuario' => __DIR__ . '/../..' . '/app/Models/Usuario.php',
        'SON\\Controller\\Action' => __DIR__ . '/..' . '/SON/Controller/Action.php',
        'SON\\Dao\\EnderecoDao' => __DIR__ . '/..' . '/SON/Dao/EnderecoDao.php',
        'SON\\Dao\\HomeDao' => __DIR__ . '/..' . '/SON/Dao/HomeDao.php',
        'SON\\Dao\\LocalidadeDao' => __DIR__ . '/..' . '/SON/Dao/LocalidadeDao.php',
        'SON\\Dao\\PatrimonioDao' => __DIR__ . '/..' . '/SON/Dao/PatrimonioDao.php',
        'SON\\Dao\\TransferenciaDao' => __DIR__ . '/..' . '/SON/Dao/TransferenciaDao.php',
        'SON\\Dao\\UsuarioDao' => __DIR__ . '/..' . '/SON/Dao/UsuarioDao.php',
        'SON\\Dao\\baseDao' => __DIR__ . '/..' . '/SON/Dao/baseDao.php',
        'SON\\Di\\Container' => __DIR__ . '/..' . '/SON/Di/Container.php',
        'SON\\Init\\Bootstrap' => __DIR__ . '/..' . '/SON/init/Bootstrap.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit96857f75c9263e6ad90cbfcf57904f98::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit96857f75c9263e6ad90cbfcf57904f98::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit96857f75c9263e6ad90cbfcf57904f98::$classMap;

        }, null, ClassLoader::class);
    }
}
