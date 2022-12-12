<?php

//require_once('../Modeles/Modele');

class ControllerVisiteur{

    public $dataVue = array();

    public function __construct(){

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
                default :
                    $dVueEreur[] = "Erreur d'appel php";
                    //require ($rep.$vues['vuephp1']);
                    echo $dVueEreur[0];
                    break;
            } 

        }catch(PDOException $e){
            $dVueEreur=["erreur innatendue"];
            require($rep.$vues["erreur"]);
            echo $e->getMessage();
            
        }catch(Exception $e){
            echo $e->getMessage();
        }
        
    }

    function afficherAccueil(){
        global $rep,$vues;
        global $dsn, $user, $pass;

        $data = array();

        $model = new Model();
        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe();

        require ($rep.$vues['accueil']);   
    }

    function ajouterListe($dVueEreur){  
        global $rep,$vues;
        global $dsn, $user, $pass;

        $model = new Model();
        $result = $model->insertListe($_POST['nomListe']);

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe();

        require ($rep.$vues['accueil']);  
    }

    function ajouterTache($dVueEreur){
        global $rep,$vues;
        global $dsn, $user, $pass;

        $model = new Model();
        $model->insertTache($_REQUEST["idListe"], $_POST["NewTache"]);

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe();

        require ($rep.$vues['accueil']);  
    }

    function supprimerListe($dVueEreur){
        global $rep,$vues;
        global $dsn, $user, $pass;

        $model = new Model();
        $model->suppListe($_REQUEST["idListe"]);

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe();

        require ($rep.$vues['accueil']);   
    }

    function supprimerTache($dVueEreur){
        global $rep,$vues;
        global $dsn, $user, $pass;

        $model = new Model();
        $model->suppTache($_REQUEST["idTache"]);

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe();

        require ($rep.$vues['accueil']);
    }

    function afficherPageConnexion($dVueEreur){
        global $rep,$vues;
        
        require($rep.$vues['connexion']);
    }

    function seConnecter($dVueEreur){
        global $rep, $vues;

        $pseudo = $_POST["txtPseudo"];
        $motDePasse = $_POST["txtMotDePasse"];

        //echo $pseudo;
        //echo $motDePasse;

        $dVueEreur = Validation::val_formulaire($pseudo, $motDePasse, $dVueEreur);

        if(! empty($dVueEreur)){
            require($rep.$vues['connexion']);
        }
        else{
            
            echo "Page à venir...";
        }

        //echo $this->dataVue["nom"];
        //echo $this->dataVue["pseudo"];
    }

}




?>