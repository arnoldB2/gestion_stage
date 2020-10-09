<?php 
    require_once("connxiondb.php");
    
    
    $nomf=isset($_GET['nomF'])? $_GET['nomF']:"";
    $niveau=isset($_GET['niveau'])? $_GET['niveau']:"all";

    $size=isset($_GET['size'])? $_GET['size']:6;
    $page=isset($_GET['page'])? $_GET['page']:1;
    $offset=($page-1)*$size;

    if($niveau=="all"){
        $requete="select * from filiere
             where nomFiliere like '%$nomf%'
             limit $size
             offset $offset";
        $requeteCount="select count(*) countF from filiere
                       where nomFiliere like '%$nomf%'";
    }else{
        $requete="select * from filiere
             where nomFiliere like '%$nomf%'
             and niveau='$niveau'
             limit $size
             offset $offset";
             $requeteCount="select count(*) countF from filiere
                            where nomFiliere like '%$nomf%'
                            and niveau='$niveau'";
    }

    $resultatF=$pdo->query($requete);
    $requeteCount=$pdo->query($requeteCount);
    $tabCount=$requeteCount->fetch();
    $nbrFiliere=$tabCount['countF'];
    $reste=$nbrFiliere % $size; 
    if($reste===0)
       $nbrPage=$nbrFiliere/$size;
    else
      $nbrPage=floor($nbrFiliere/$size)+1; //floor : la partie entiere d'un nombre décimal

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion de filiéres</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>

        <div class="container">
            <div class="panel panel-success margetop">
                <div class="panel-heading">Rechercher des filiéres...</div>
                <div class="panel-body">
                    <form method="get" action="filieres.php" class="form-inline">
                        <div class="form-group">
                           <input type="text" name="nomF" placeholder="Taper le nom de la filiere" class="form-control" value="<?php echo $nomf ?>">
                        </div>
                        <label for="niveau">Niveau :</label>
                        <select name="niveau" class="form-control" id="niveau"
                                 onchange="this.form.submit()">
                            <option value="all" <?php if($niveau==="all") echo "selected" ?>>Tous les niveau</option>
                            <option value="m" <?php if($niveau==="m") echo "selected" ?>>Master</option>
                            <option value="l" <?php if($niveau==="l") echo "selected" ?>>Licence</option>
                            <option value="ts" <?php if($niveau==="ts") echo "selected" ?>>Technicien spécialisé</option>
                            <option value="t" <?php if($niveau==="t") echo "selected" ?>>Technicien</option>
                            <option value="q" <?php if($niveau==="q") echo "selected" ?>>Qualification</option>
                        </select>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Rechercher...
                        </button>
                        &nbsp &nbsp
                        <a href="nouvelleFiliere.php">
                            <span class="glyphicon glyphicon-plus"></span>
                            Nouvelle Filiere
                        </a>
                    </form>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Liste des filiéres (<?php echo $nbrFiliere ?>) Filieres</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id filiére</th><th>Nom filére</th><th>Niveau</th><th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php while($filiere=$resultatF->fetch()) {?>
                                    <tr>
                                        <td><?php echo $filiere['idFiliere'] ?></td>
                                        <td><?php echo $filiere['nomFiliere'] ?></td>
                                        <td><?php echo $filiere['niveau'] ?></td>
                                        <td>
                                            <a href="editerFiliere.php?idF=<?php echo $filiere['idFiliere'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            &nbsp;
                                            <a onclick="return confirm('Etes vous sur de vouloir supprimer la Filiere?')"
                                               href="supprimerFiliere.php?idF=<?php echo $filiere['idFiliere'] ?>">
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
                                    <a href="filieres.php?page=<?php echo $i; ?>&nomf=<?php echo $nomf ?> &niveau=<?php echo $niveau ?>">
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