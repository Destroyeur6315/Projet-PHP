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
                case 'ajouterUneListePrive':
                    $this->ajouterListePrive($dVueEreur);
                    break;
                case 'supprimerUneListePrive':
                    $this->supprimerListePrive($dVueEreur);
                    break;
                case 'ajouterUneTachePrive':
                    $this->ajouterTachePrive($dVueEreur);
                    break;
                case 'supprimerUneTachePrive':
                    $this->supprimerTachePrive($dVueEreur);
                    break;
                case 'tachePriveChecked':
                    $this->tacheValide($dVueEreur);
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

    
    public function afficherListePrive($dVueEreur){
        global $rep, $vues;

        $model = new Model();
        $possesseur = $_SESSION["login"];

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe($possesseur);

        require ($rep.$vues['listePrive']);   
    }    


    public function deconnecter($dVueEreur){
        global $rep, $vues;

        $model = new ModelUtilisateur();
        $model->deconnection();
        $model = new Model();
        $possesseur = "";

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe($possesseur);

        require ($rep.$vues['accueil']); 
    }


    public function ajouterListePrive($dVueEreur){
        global $rep, $vues;

        $model = new Model();
        $nomListe = $_POST['nomListe'];
        $dVueEreur = Validation::val_ListeTache($nomListe, $dVueEreur);
        $possesseur = $_SESSION["login"];

        if(empty($dVueEreur)){
            $result = $model->insertListe($nomListe, $possesseur);
        }

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe($possesseur);

        require($rep.$vues['listePrive']);
    }


    public function supprimerListePrive($dVueEreur){
        global $rep,$vues;

        $model = new Model();
        $idListe = $_REQUEST["idListe"];
        $idListe = Nettoyer::nettoyer_string($idListe);
        $model->suppListe($idListe);

        $tab_tache = $model->get_AllTache();
        $possesseur = $_SESSION["login"];
        $tab_liste = $model->get_AllListe($possesseur);

        require ($rep.$vues['listePrive']);   
    }


    public function ajouterTachePrive($dVueEreur){
        global $rep,$vues;

        $model = new Model();
        $newTache = $_POST["NewTache"];
        $idListe = $_REQUEST["idListe"];
        $idListe = Nettoyer::nettoyer_string($idListe);
        $dVueEreur = Validation::val_ListeTache($newTache, $dVueEreur);

        if(empty($dVueEreur)){
            $model->insertTache($idListe, $newTache);
        }
        
        $possesseur = $_SESSION["login"];
        $possesseur = Nettoyer::nettoyer_string($possesseur);

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe($possesseur);

        require ($rep.$vues['listePrive']);  
    }


    public function supprimerTachePrive($dVueEreur){
        global $rep,$vues;

        $model = new Model();
        $idTache = $_REQUEST["idTache"];
        $idTache = Nettoyer::nettoyer_string($idTache);

        $model->suppTache($idTache);
        $possesseur = $_SESSION["login"];
        $possesseur = Nettoyer::nettoyer_string($possesseur);

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe($possesseur);

        require ($rep.$vues['listePrive']);
    }


    public function tacheValide($dVueEreur){
        global $rep, $vues;

        $model = new Model();

        $valide = $_POST["valide"];
        $valide = Nettoyer::nettoyer_string($valide);
        $possesseur = $_SESSION['login'];
        $possesseur = Nettoyer::nettoyer_string($possesseur);
        
        if(! empty($valide)){
            $idTache = $_REQUEST["idTache"];
            $idTache = Nettoyer::nettoyer_string($idTache);
            $result = $model->modifTermineTache($idTache);
        }

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe($possesseur); 
        
        require ($rep.$vues['listePrive']);
        
    }
    
}




?>