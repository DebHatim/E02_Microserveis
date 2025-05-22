<?php

use Hatim\Entradas\Entity\Usuari;

class UsuariModel {

    public static function crea($usuari) {
        global $em;
        $user = new Usuari();
        $user->setNom($usuari->__get("nom"));
        $user->setEmail($usuari->__get("email"));
        $em->persist($user);
        $em->flush($user);
    }

    public static function actualitza($usuari) {
        global $em;

        $userDB = $em->getRepository(Usuari::class)->find($usuari->__get("id"));
        if ($userDB === null) {
            throw new Exception("Id d'usuari no trobat.");
        }

        $userDB->setNom($usuari->__get("nom"));
        $userDB->setEmail($usuari->__get("email"));
        if ($usuari->__get("telefon")) {
            $userDB->setTelefon($usuari->__get("telefon"));
        }

        $em->persist($userDB);
        $em->flush();
    }

    public static function elimina($ONusuari) {
        global $em;
        $usuari = $em->getRepository(Usuari::class)->findOneBy(['email' => $ONusuari->__get("email")]);

        if ($usuari === null) {
            throw new Exception("Usuari no trobat amb email: " . $ONusuari->__get("email"));
        }

        $em->remove($usuari);
        $em->flush();
    }

    public static function findOneByEmail($email) {
        global $em;
        return $em->getRepository(Usuari::class)->findOneBy(['email' => $email]);
    }

    public static function findAll(): array
    {
        global $em;
        return $em->getRepository(Usuari::class)->findAll();
    }

    public static function find(int $id): ?Usuari
    {
        global $em;
        return $em->getRepository(Usuari::class)->find($id);
    }

}