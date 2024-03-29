<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitca94ffb47c675edf27b82a83a9059913
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

        spl_autoload_register(array('ComposerAutoloaderInitca94ffb47c675edf27b82a83a9059913', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitca94ffb47c675edf27b82a83a9059913', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitca94ffb47c675edf27b82a83a9059913::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
