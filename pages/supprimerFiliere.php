<?php 
    require_once('connxiondb.php');
    $idf=isset($_GET['idF'])?$_GET['idF']:0;

    $requeteStag="select count(*) countStag from stagiaire where idFiliere=$idf";
    $resultatStag=$pdo->query($requeteStag);
    $tabCountStag=$resultatStag->fetch();
    $nbrStag=$tabCountStag['countStag'];

    if($nbrStag==0){
        $requete= "delete from filiere where idFiliere=?";
        $params=array($idf);
        $resultat=$pdo->prepare($requete);
        $resultat->execute($params);
        header('location:filieres.php');
    }else{
        $msg="suppression impossible: Vous devez supprimer tous les stagiaires inscris dans cette filiere";
        header("location:alerte.php?message=$msg");
    }
    

    
?>