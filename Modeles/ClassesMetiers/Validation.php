<?

class Validation{

    static function val_formulaire($pseudo, $motDePasse, $dataErreur){

        // chaine vide
        if(! isset($pseudo) || $pseudo==""){
            $dataErreur[] = "pas de pseudo référencé";
        }
        if(! isset($motDePasse) || $motDePasse==""){
            $dataErreur[] = "pas de mot de passe référencé";
        }

        if(! empty($dataErreur)){
            return $dataErreur;
        }

        // injection PHP
        if(! preg_match('/^[a-zA-Z0-9]{6,15}$/', $pseudo)){
            $dataErreur[] = "Veuillez rentrer un pseudo conforme (chiffre et lettre uniquement, 6 caractères minimums)";
        }
        if(! preg_match('/^[a-zA-Z0-9]{6,15}$/', $pseudo)){
            $dataErreur[] = "Veuillez rentrer un mot de passe correcte (chiffre, lettre et symbole : .;/:#, 6 caractères minimums)";
        }
       
        return $dataErreur;
    }

    static function val_ListeTache($chaine, $dataErreur){
        if(! isset($chaine) || $chaine==""){
            $dataErreur[] = "Veuillez référencé un nom";
        }
        if(! preg_match('/^[a-zA-Z0-9]{3,15}$/', $chaine)){
            $dataErreur[] = "Veuillez rentrer un nom conforme (chiffre et lettre uniquement)";
        }

        return $dataErreur;
    }

}


?>