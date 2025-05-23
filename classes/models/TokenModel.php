<?php

use Hatim\Entradas\Entity\Admin;

class TokenModel {

    public static function comprovaUsuari($ON_Admin): bool
    {
        global $em;

        $BD_Admin = $em->getRepository(Admin::class)->findOneBy(['user' => $ON_Admin->__get("user")]);

        if (!$BD_Admin) {
            throw new Exception("Nom d'usuari inexistent.", 404);
        }
        else if ($BD_Admin->getPass() != $ON_Admin->__get("pass")) {
            throw new Exception("Contrassenya incorrecta.", 401);
        }

        return true;
    }

    public static function comprovaToken($token): bool
    {
        global $em;

        $BD_Admin = $em->getRepository(Admin::class)->findOneBy(['token' => $token]);

        if (!$BD_Admin) {
            throw new Exception("Token invalid.", 403);
        }
        else if ($BD_Admin->getExpToken() < new DateTime()) {
            throw new Exception("Token caducat.", 401);
        }

        return true;
    }

    public static function actualitza($ON_Admin): void
    {
        global $em;

        $BD_Admin = $em->getRepository(Admin::class)->findOneBy(['user' => $ON_Admin->__get("user")]);

        $BD_Admin->setToken($ON_Admin->__get("token"));
        $BD_Admin->setExpToken($ON_Admin->__get("expiracio"));
        $em->persist($BD_Admin);
        $em->flush();
    }

}