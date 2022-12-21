<?

class ModelUtilisateur{

    public function isUser(){
        if(isset($_SESSION["login"]) && isset($_SESSION["role"])){
            //$login = Nettoyer::nettoyer_string($_SESSION["login"]);
            //$role = Nettoyer::nettoyer_string($_SESSION["login"]);
            
            // Penser à nettoyer le login et le role
            $login = filter_var($_SESSION["login"], FILTER_DEFAULT); 
            $role = filter_var($_SESSION["role"], FILTER_DEFAULT); 

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

            // Appelle de gateway si le login existe bien et si mot de passe est le bon
            $userGateway = new UtilisateurGateway(new Connection($dsn, $user, $pass));
            $result = $userGateway->getUtilisateur($login, $motDePasse);

            if( empty($result)){
                return null;
            }

            $_SESSION['role'] = 'utilisateur';
            $_SESSION['login'] = $login;

            $user = '';

            foreach($result as $value){
                $user = new Utilisateur($value["pseudo"]);
            }

            return $user;
    }




}







?>