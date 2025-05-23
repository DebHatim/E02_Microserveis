<?php

use Hatim\Entradas\Entity\Usuari;

class UsuariModel {

    public static function crea($ON_Usuari) {
        global $em;

        $userDB = $em->getRepository(Usuari::class)->findOneBy(['email' => $ON_Usuari->__get('email')]);
        if ($userDB) {
            throw new Exception("Email ja utilizat.", 226);
        }
        else if ($userDB->getTelefon() == $ON_Usuari->__get('telefon')) {
            throw new Exception("Numero de telefon ja utilizat.", 226);
        }

        $user = new Usuari();
        $user->setNom($ON_Usuari->__get("nom"));
        $user->setEmail($ON_Usuari->__get("email"));
        if ($ON_Usuari->__get("telefon")) {
            $user->setTelefon($ON_Usuari->__get("telefon"));
        }
        $em->persist($user);
        $em->flush($user);
    }

    public static function actualitza($ON_Usuari) {
        global $em;

        $userDB = $em->getRepository(Usuari::class)->find($ON_Usuari->__get("id"));
        if ($userDB === null) {
            throw new Exception("Id d'usuari no trobat.", 404);
        }
        else if ($em->getRepository(Usuari::class)->findOneBy(['email' => $ON_Usuari->__get("email")])) {
            throw new Exception("Email ja utilizat.", 226);
        }
        else if ($em->getRepository(Usuari::class)->findOneBy(['telefon' => $ON_Usuari->__get("telefon")])) {
            throw new Exception("Numero de telefon ja utilizat.", 226);
        }

        $userDB->setNom($ON_Usuari->__get("nom"));
        $userDB->setEmail($ON_Usuari->__get("email"));
        if ($ON_Usuari->__get("telefon")) {
            $userDB->setTelefon($ON_Usuari->__get("telefon"));
        }

        $em->persist($userDB);
        $em->flush();
    }

    public static function elimina($ONusuari) {
        global $em;
        $usuari = $em->getRepository(Usuari::class)->findOneBy(['email' => $ONusuari->__get("email")]);

        if ($usuari === null) {
            throw new Exception("Usuari no trobat amb email: " . $ONusuari->__get("email"), 404);
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