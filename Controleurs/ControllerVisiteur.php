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

    function afficherAccueil(){
        global $rep,$vues;

        $model = new Model();
        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe();

        require ($rep.$vues['accueil']);   
    }

    function ajouterListe($dVueEreur){  
        global $rep,$vues;

        $model = new Model();

        $nomListe = $_POST['nomListe'];

        $dVueEreur = Validation::val_ListeTache($nomListe, $dVueEreur);

        if(! empty($dVueEreur)){
            $tab_tache = $model->get_AllTache();
            $tab_liste = $model->get_AllListe();

            require($rep.$vues['accueil']);
        }
        else{
            $result = $model->insertListe($nomListe);

            $tab_tache = $model->get_AllTache();
            $tab_liste = $model->get_AllListe();

            require($rep.$vues['accueil']);
        }  
    }

    function ajouterTache($dVueEreur){
        global $rep,$vues;

        $model = new Model();
        $model->insertTache($_REQUEST["idListe"], $_POST["NewTache"]);

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe();

        require ($rep.$vues['accueil']);  
    }

    function supprimerListe($dVueEreur){
        global $rep,$vues;

        $model = new Model();
        $model->suppListe($_REQUEST["idListe"]);

        $tab_tache = $model->get_AllTache();
        $tab_liste = $model->get_AllListe();

        require ($rep.$vues['accueil']);   
    }

    function supprimerTache($dVueEreur){
        global $rep,$vues;

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

        // valide les données rentrées par l'utilisateur
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
                // remplir les listes privées

                //afficher liste privées
                require($rep.$vues['listePrive']);
            }

            
            
        }

    }

}




?>