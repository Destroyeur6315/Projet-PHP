<?php

class ControllerVisiteur{

    public function __construct(){

        global $rep,$vues;

        // tableau d'erreurs
        $dVueEreur = array();

        try{
            $action = $_REQUEST["action"];
            
            switch($action){
                case NULL:
                    $this->afficherAccueil();
                    break;
                case 'ajouterUneListe':
                    $this->ajouterListe($dVueEreur);
                    break;
                case 'ajouterUneTache':
                    $this->ajouterTache($dVueEreur);
                    break;
                case 'supprimerUneListe':
                    $this->supprimerListe($dVueEreur);
                    break;
                case 'supprimerUneTache':
                    $this->supprimerTache($dVueEreur);
                    break;
                case 'avoirPageConnexion':
                    $this->afficherPageConnexion($dVueEreur);
                    break;
                case 'validationFormulaire':
                    $this->seConnecter($dVueEreur);
                    break;
                case 'tacheChecked':
                    $this->tacheValide($dVueEreur);
                    break;
                default :
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

    function affiche($model, $possesseur){
        global $rep,$vues;

        $tab_tache = $model->get_AllTache();        
        $tab_liste = $model->get_AllListe($possesseur);

        require ($rep.$vues['accueil']); 
    }
    

    function afficherAccueil(){
        $model = new Model();
        $possesseur = "";
        $possesseur = Nettoyer::nettoyer_string($possesseur);

        $this->affiche($model, $possesseur);  
    }


    function ajouterListe($dVueEreur){  
        global $rep,$vues;

        $model = new Model();
        $nomListe = $_POST['nomListe'];
        $dVueEreur = Validation::val_ListeTache($nomListe, $dVueEreur);
        $possesseur = "";

        if(empty($dVueEreur)){
            $result = $model->insertListe($nomListe, $possesseur);
        }

        $this->affiche($model, $possesseur);
    }


    function supprimerListe($dVueEreur){
        global $rep,$vues;

        $model = new Model();
        $model->suppListe($_REQUEST["idListe"]);
        $possesseur = "";

        $this->affiche($model, $possesseur);  
    }


    function ajouterTache($dVueEreur){
        global $rep,$vues;

        $model = new Model();
        $newTache = $_POST["NewTache"];
        $idListe = $_REQUEST["idListe"];
        $idListe = Nettoyer::nettoyer_string($idListe);
        $dVueEreur = Validation::val_ListeTache($newTache, $dVueEreur);

        if(empty($dVueEreur)){
            $model->insertTache($idListe, $newTache);
        }

        $possesseur = "";
        $this->affiche($model, $possesseur); 
    }


    function supprimerTache($dVueEreur){
        global $rep,$vues;

        $model = new Model();
        $model->suppTache($_REQUEST["idTache"]);
        $possesseur = "";

        $this->affiche($model, $possesseur);
    }


    function afficherPageConnexion($dVueEreur){
        global $rep,$vues;
        
        require($rep.$vues['connexion']);
    }


    function seConnecter($dVueEreur){
        global $rep, $vues;

        $pseudo = $_POST["txtPseudo"];
        $motDePasse = $_POST["txtMotDePasse"];

        $dVueEreur = Validation::val_formulaire($pseudo, $motDePasse, $dVueEreur);

        if(! empty($dVueEreur)){
            require($rep.$vues['connexion']);
        }
        else{            
            $modelUtilisateur = new ModelUtilisateur();
            $user = $modelUtilisateur->connexion($pseudo, $motDePasse);
            
            if($user == null){
                $dVueEreur[] = "Mot de passe ou pseudo incorrecte";
                
                require($rep.$vues['connexion']);
            }
            else{
                $model = new Model();
                $possesseur = $_SESSION["login"];
                $possesseur = Nettoyer::nettoyer_string($possesseur);

                $tab_tache = $model->get_AllTache();       
                $tab_liste = $model->get_AllListe($possesseur);

                require($rep.$vues['listePrive']);
            }            
        }
    }

    function tacheValide($dVueEreur){
        global $rep, $vues;

        $model = new Model();

        $valide = $_POST["valide"];
        $valide = Nettoyer::nettoyer_string($valide);
        
        if(empty($valide)){
            $this->afficherAccueil();
        }
        else{
            $idTache = $_REQUEST["idTache"];
            $idTache = Nettoyer::nettoyer_string($idTache);
            $result = $model->modifTermineTache($idTache);
            $possesseur = "";
            
            $this->affiche($model, $possesseur);
        }

    }

}




?>