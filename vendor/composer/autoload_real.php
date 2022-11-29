<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitae10a290b97e807ad6c712b0278dfd4a
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitae10a290b97e807ad6c712b0278dfd4a', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitae10a290b97e807ad6c712b0278dfd4a', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitae10a290b97e807ad6c712b0278dfd4a::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
