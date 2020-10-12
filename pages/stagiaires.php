<?php 
    require_once("connxiondb.php");
    
    
    $nomPrenom=isset($_GET['nomPrenom'])? $_GET['nomPrenom']:"";
    $filiere=isset($_GET['filiere'])? $_GET['filiere']:0;

    $size=isset($_GET['size'])? $_GET['size']:6;
    $page=isset($_GET['page'])? $_GET['page']:1;
    $offset=($page-1)*$size;

    $requeteFiliere="select * from filiere";

    if($filiere===0){
        $requeteStagiaire="select idStagiaire,nom,prenom,nomFiliere,photo,civilite 
             from filiere as f, stagiaire as s
             where f.idFiliere=s.idFiliere
             and (nom like '%$nomPrenom%' or prnom like '%$nomPrenom%')
             limit $size
             offset $offset";
        $requeteCount="select count(*) countS from stagiaire
                       where nom like '%$nomPrenom%' or prnom like '%$nomPrenom%'";
    }else{
        $requeteStagiaire="select idStagiaire,nom,prenom,nomFiliere,photo,civilite 
             from filiere as f, stagiaire as s
             where f.idFiliere=s.idFiliere
             and (nom like '%$nomPrenom%' or prnom like '%$nomPrenom%')
             and f.idFiliere=$filiere
             limit $size
             offset $offset";
        $requeteCount="select count(*) countS from stagiaire
                       where nom like '%$nomPrenom%' or prnom like '%$nomPrenom%'
                       and f.idFiliere=$filiere";
    
    }
    
    $resultatFiliere=$pdo->query($requeteFiliere);
    $resultatStagiaire=$pdo->query($requeteStagiaire);
    $requeteCount=$pdo->query($requeteCount);

    $tabCount=$requeteCount->fetch();
    $nbrstagiaire=$tabCount['countS'];
    $reste=$nbrstagiaire % $size; 
    if($reste===0)
       $nbrPage=$nbrFiliere/$size;
    else
      $nbrPage=floor($nbrstagiaire/$size)+1; //floor : la partie entiere d'un nombre décimal

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion des stagiaires</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>

        <div class="container">
            <div class="panel panel-success margetop">
                <div class="panel-heading">Rechercher des stagiaires...</div>
                <div class="panel-body">
                    <form method="get" action="stagiaires.php" class="form-inline">
                        <div class="form-group">
                           <input type="text" name="nomPrenom" placeholder="Taper le nom et prenom" class="form-control" value="<?php echo $nomPrenom ?>">
                        </div>
                        <label for="filiere">Filiere :</label>
                        <select name="filiere" class="form-control" id="filiere"
                                 onchange="this.form.submit()">
                                 <option value=0>Toutes les filieres</option>
                            <?php while($filiere=$resultatFiliere->fetch()) { ?>
                                <option value="<?php echo $filiere['idFiliere'] ?>">
                                    <?php echo $filiere['nomFiliere'] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Rechercher...
                        </button>
                        &nbsp &nbsp
                        <a href="nouveauStagiaire.php">
                            <span class="glyphicon glyphicon-plus"></span>
                            nouveau Stagiaire
                        </a>
                    </form>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Liste des stagiaires (<?php echo $nbrstagiaire ?>) stagiaires</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id stagiaire</th> <th>Nom</th> <th>Prenom</th>
                                <th>Filiere</th> <th>Photo</th> <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php while($stagiaire=$resultatStagiaire->fetch()) {?>
                                    <tr>
                                        <td><?php echo $stagiaire['idstagiaire'] ?></td>
                                        <td><?php echo $stagiaire['nom'] ?></td>
                                        <td><?php echo $stagiaire['prenom'] ?></td>
                                        <td><?php echo $stagiaire['nomFiliere'] ?></td>
                                        <td><img src="../images/"<?php echo $stagiaire['photo'] ?>></td>
                                        <td>
                                            <a href="editerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            &nbsp;
                                            <a onclick="return confirm('Etes vous sur de vouloir supprimer le Stagiaire?')"
                                               href="supprimerStagiaire.php?idS=<?php echo $filiere['idStagiaire'] ?>">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }?>
                        </tbody>
                    </table>
                    <div>
                        <ul class="pagination">
                            <?php for($i=1; $i<=$nbrPage;$i++){ ?>
                                <li class="<?php if($i==$page) echo 'active'?> "> 
                                    <a href="stagiaire.php?page=<?php echo $i; ?>&nomPrenom=<?php echo $nomPrenom ?> &filiere=<?php echo $filiere ?>">
                                         <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>