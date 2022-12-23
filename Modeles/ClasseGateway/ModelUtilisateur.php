<?

class ModelUtilisateur{

    public function isUser(){
        if(isset($_SESSION["login"]) && isset($_SESSION["role"])){
            $login = Nettoyer::nettoyer_string($_SESSION["login"]);
            $role = Nettoyer::nettoyer_string($_SESSION["role"]);
            
            return new Utilisateur($login);
        }
        else{
            return null;
        }
    }

    public function deconnection(){
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    public function connexion($login, $motDePasse){
            global $dsn, $user, $pass;

            $login = Nettoyer::nettoyer_string($login);
            $motDePasse = Nettoyer::nettoyer_string($motDePasse);

            $userGateway = new UtilisateurGateway(new Connection($dsn, $user, $pass));
            $result = $userGateway->getUtilisateur($login, $motDePasse);

            if( empty($result)){
                return null;
            }

            $_SESSION['role'] = 'utilisateur';
            $_SESSION['login'] = $login;

            $utilisateur = '';

            foreach($result as $value){
                $utilisateur = new Utilisateur($value["pseudo"]);
            }

            return $utilisateur;
    }




}







?>