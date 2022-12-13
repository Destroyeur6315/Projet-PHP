<html>
<head>
    <title>Personne - formulaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="Vues/style/accueil.css" rel="stylesheet">
    <link href="Vues/style/footer.css" rel="stylesheet">
    <link href="Vues/style/ToDoList2.css" rel="stylesheet">

</head>
<body>
    
    <!-- barre de navigation -->

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
              <li class="nav__item"><a class="listePrivees" href="#">Liste privées</a></li>
            </ul>
          </nav>
        </div>
        <div class="site-header__end">
          <a href="?action=avoirPageConnexion">Sign in</a>
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

    <!-- Formulaire ajout liste -->
    
    <div class="BoutonBigContainer">
        <div class="BoutonContainer">
            <form method="post" class="formAjoutListe">
                <label id="icon" for="name"><i class="fas fa-envelope"></i></label>
                <input name="nomListe" type="text" id="inputAjout"> 
                <input type="submit" value="create" class="inputAjoutList">
                
                <!-- action !!!!!!!!!! -->
                <input type="hidden" name="action" value="ajouterUneListe">    
            </form>
        </div>
    </div>

    <!-- les todolist -->

    <div class="containerfirstToDoList">
        <div class="containerToDoList">
        
            <?php  foreach ($tab_liste as $liste) : ?>  
                    
                <div class="MyToDoList">
                    <h1>  <? echo $liste->getNom(); ?> </h1>
                    <form action="?idListe=<? echo $liste->getId() ?>" method="post">
                        <input name="NewTache" type="text" placeholder="Add your new todo">
                        <input type="submit" value="add">
        
                        <!-- action !!!!!!!!!! -->
                        <input type="hidden" name="action" value="ajouterUneTache">  
                    </form>
                    
                    <ul class="todoList">

                        <?php  foreach ($tab_tache as $tache) : 
                                if($tache->getIdListe() == $liste->getId())
                                {
                                    ?>
                                    <form action="?idTache=<? echo $tache->getId() ?>" method="post">
                                        <li>   
                                            <? echo $tache->getDescription(); ?> 
                                            <input type="submit" value="X">
        
                                            <!-- action !!!!!!!!!! -->
                                            <input type="hidden" name="action" value="supprimerUneTache"> 
                                        </li>
                                    </form> 
                                    
                                    <?php
                                }                       
                        endforeach; ?>

                    </ul>
                    <form action="?idListe=<? echo $liste->getId() ?>" method="post"> 
                    <input type="submit" value="delete">
        
                    <!-- action !!!!!!!!!! -->
                    <input type="hidden" name="action" value="supprimerUneListe"> 
                    </form>
                </div>
            <?php endforeach; ?>   
        
        </div> 
    </div>
    <!--
    <form action="index.php?action=ajouterUneListe" method="post">
        <input name="nomListe" type="text"> 
        <button type="submit" value="action">Ajouter une liste</button>
    </form>

    <form action="index.php?action=ajouterUneTache" method="post">
        <input name="nomTache" type="text"> 
        <button type="submit" value="action">Ajouter une tâche</button>
    </form>

    <br>
        -->

   
    <!--
    <form method="post">
        <input name="nomListe" type="text"> 
        <input type="submit" name="action" value="ajouterUneListe">
    </form>
                    -->

    <!-- footer -->

    <div class="MyContainer">
        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <h6>About</h6>
                        <p class="text-justify"> Just a web application for people who want a ToDoList</p>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <h6>Categories</h6>
                        <ul class="footer-links">
                        <li><a href="http://scanfcode.com/category/back-end-development/">PHP</a></li>
                        <li><a href="http://scanfcode.com/category/templates/">Templates</a></li>
                        </ul>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <h6>Quick Links</h6>
                        <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
            </div>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <p class="copyright-text">Copyright &copy; 2022 All Rights Reserved by 
                    <a href="#">Romain FIllot</a>.
                        </p>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <ul class="social-icons">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>   
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>