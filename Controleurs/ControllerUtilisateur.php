<?

class ControllerUtilisateur{

    public function __construct()
    {
        global $rep, $vues;

        $dVueEreur = array();

        try{
            $action = $_REQUEST["action"];

            switch($action){
                case 'avoirListePrive':
                    $this->afficherListePrive($dVueEreur);
                    break;
                case 'deconnecter':
                    $this->deconnecter($dVueEreur);
                    break;
                case 'ajouterListePrive':
                    $this->ajouterListePrive($dVueEreur);
                    break;
                default:
                    $dVueEreur[] = "cette action n'est pas reconnu";
                    require ($rep.$vues['erreur']);
                    break;
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

    public function ajouterListePrive($dVueEreur){
       

    }

    public function afficherListePrive($dVueEreur){
        global $rep, $vues;

        require($rep.$vues['listePrive']);
    }

    public function deconnecter($dVueEreur){
        global $rep, $vues;

        $model = new ModelUtilisateur();
        $model->deconnection();

        $model = new Model();
        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe();

        require ($rep.$vues['accueil']); 
    }

    
    
}




?>