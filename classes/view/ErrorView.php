<?php 

class ErrorView {
    
    public static function show($error) {
        http_response_code(500);
        echo "Internal Server Error. {$error->getMessage()}";
        exit; 
    }
    
}

?>