<?php

class UsuariView {

    public static function mostra($userData): void
    {
        if (is_array($userData)) {
            foreach ($userData as $usuari) {
                var_dump($usuari->jsonSerialize());
            }
        }
        else {
            var_dump( $userData->jsonSerialize());
        }
    }

}