<?php

use Hatim\Entradas\Entity\Admin;

class TokenModel {

    public static function comprovaUsuari($ON_Admin): bool
    {
        global $em;

        $BD_Admin = $em->getRepository(Admin::class)->findOneBy(['user' => $ON_Admin->__get("user")]);

        if (!$BD_Admin) {
            throw new Exception("Nom d'usuari inexistent.");
        }
        else if ($BD_Admin->getPass() != $ON_Admin->__get("pass")) {
            throw new Exception("Contrassenya incorrecta.");
        }

        return true;
    }

    public static function comprovaToken($token): bool
    {
        global $em;

        $BD_Admin = $em->getRepository(Admin::class)->findOneBy(['token' => $token]);

        if (!$BD_Admin) {
            return false;
        }

        return true;
    }

}