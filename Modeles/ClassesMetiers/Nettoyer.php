<?

class Nettoyer{

    public static function nettoyer_string($chaine){
        return filter_var($chaine, FILTER_DEFAULT);
    }
}


?>