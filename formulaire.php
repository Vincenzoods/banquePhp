<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./formulaire.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include './navBar.php'
    ?>
  <h1>Création de compte</h1>

  <form method="post" action="./index.php">
    <div>
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom" required>
    </div>
    <div>
      <label for="age">Age :</label>
      <input type="number" id="age" name="age" required>
    </div>
    <div>
      <label for="solde">Solde :</label>
      <input type="number" id="solde" name="solde" required>
    </div>
    <div>
      <input type="submit" value="Créer">
    </div>
  </form>
</body>

</html>
</html>