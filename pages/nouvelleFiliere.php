<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouvelle filiéres</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>

        <div class="container">

            <div class="panel panel-primary margetop">
                <div class="panel-heading">VEUILLEZ SAISIR LES DONNEES DE LA NOUVELLE FILIERE</div>
                <div class="panel-body">
                    <form method="post" action="insertFiliere.php" class="form">

                            <div class="form-group">
                                <label for="niveau">Nom de la filiere :</label>
                                <input type="text" name="nomF" 
                                       placeholder="Taper le nom de la filiere" 
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="niveau">Niveau :</label>
                                <select name="niveau" class="form-control" id="niveau">
                                    <option value="m">Master</option>
                                    <option value="l">Licence</option>
                                    <option value="ts" selected>Technicien spécialisé</option>
                                    <option value="t">Technicien</option>
                                    <option value="q">Qualification</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-save"></span>
                                Enregistrer
                            </button>
                        </form>
                </div>
            </div>
        </div>
    </body>
</html>