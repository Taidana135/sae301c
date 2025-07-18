<?php
namespace app;

    // fabrique le message d'erreur debug
    class Debug{
    public static bool $actif = false;
    public static function debug(array $array): void {
        if(!self::$actif) return;
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    // arrête le script entier au moment et a l'endroit de l'erreur
    public static function debugDie(array $array): void {
        self::debug($array);
        die();
    }
}

?>