<html>
<head>
    <title>Personne - formulaire</title>
    <link href="Vues/style/connexion.css" rel="stylesheet">
    <link href="Vues/style/accueil.css" rel="stylesheet">
</head>
<body>
  
    <header class="site-header">    
      <div class="wrapper site-header__wrapper">
        <div class="site-header__start">
          <a href="#" class="brand">MyToDoList</a>
        </div>
        <div class="site-header__middle">
          <nav class="nav">
            <button class="nav__toggle" aria-expanded="false" type="button">
              menu
            </button>
            <ul class="nav__wrapper">
              <li class="nav__item"><a href="/ToDoList">Accueil</a></li>
              <li class="nav__item"><a href="#">Liste privées</a></li>
            </ul>
          </nav>
        </div>
        <div class="site-header__end">
          <a href="#">Sign in</a>
        </div>
      </div>
    </header>

    <!-- Gestion erreur -->

    <div class="erreur" style="background-color: red;">

      <?
      
        if (isset($dVueEreur) && count($dVueEreur)>0) {
            echo "<h2>ERREUR</h2>";
            foreach ($dVueEreur as $value){
                echo $value;
                echo "<br>";
            }
        }

      ?>

    </div>

    <!-- Formulaire pour se connecter -->

    <div class="login-box">

      <h2>Login</h2>
      <form method="post" action="index.php?action=validationFormulaire" >

          <div class="user-box">
            <input type="text" name="txtPseudo">
            <label>Username</label>
          </div>

          <div class="user-box">
            <input type="password" name="txtMotDePasse">
            <label>Password</label>
          </div>

          <input class="boutonEnvoie" type="submit" value="Se connecter">
            <span></span><span></span><span></span><span></span>
          </input>

      </form>

    </div>

</body>
</html>
