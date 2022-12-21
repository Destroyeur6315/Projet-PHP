<?

class UtilisateurGateway{

    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function getUtilisateur($pseudo, $motDePasse){
        $query = 'SELECT * FROM Utilisateur WHERE pseudo=:pseudo AND motdepasse=:motDePasse';

        $this->con->executeQuery($query, array(
            'pseudo' => array($pseudo, PDO::PARAM_STR),
            'motDePasse' => array($motDePasse, PDO::PARAM_STR)
        ));

        $result = $this->con->getResults();
        return $result;
    }

}








?>