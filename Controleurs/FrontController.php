<?

class FrontController{

    public function __construct(){

        global $rep, $vues;
        $dVueEreur = [];

        session_start();

        $listeActon_Utilisateur = array('avoirListePrive', 'deconnecter', 'ajouterListePrive', 'supprimerTachePrive');
        $modelUtilisateur = new ModelUtilisateur();

        try{
            $Utilisateur = $modelUtilisateur->isUser();

            $action = $_REQUEST["action"];

            if(in_array($action, $listeActon_Utilisateur)){
                
                if($Utilisateur == null){
                    require($rep.$vues['connexion']);
                }
                else{
                    $ControllerUser = new ControllerUtilisateur();
                }

            }
            else{
                $ControllerVisit = new ControllerVisiteur();
            }

        }catch(PDOException $e){
            $dVueEreur[] = "Erreur PDO";
            $dVueEreur[] = $e->getMessage();
            require($rep.$vues["erreur"]);
            
        }catch(Exception $e){
            $dVueEreur[] = $e->getMessage();
            require($rep.$vues["erreur"]);
        }


    }



}






?>