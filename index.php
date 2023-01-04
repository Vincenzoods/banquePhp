<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="./depotRetirer.css">
  <link rel="stylesheet" href="./info.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <?php

  include './classeComptebancaire.php';
  include './classPersonne.php';
  include './navBar.php';




  session_start();

  // $_SESSION = array();

  // Vérifie si les variables nécessaires 'nom', 'age' et 'solde' ont été envoyées dans le formulaire
  if (isset($_POST['nom']) && isset($_POST['age']) && isset($_POST['solde'])) {
    // Crée un nouveau compte bancaire en utilisant la valeur de $_POST['solde']
    $compteBancaire = new CompteBancaire($_POST['solde']);
    // Crée une nouvelle personne en utilisant les valeurs de $_POST['nom'] et $_POST['age']
    $personne = new Personne($_POST['nom'], $_POST['age'], $compteBancaire);
    // Ajoute la nouvelle personne à la liste de personnes dans la variable de session
    $_SESSION['personnes'][] = $personne;
  }

  // Initialise la variable $personne_select à null
  $personne_select = null;
  // Vérifie si la variable 'personne_select' a été envoyée dans le formulaire
  if (isset($_POST['personne_select'])) {
    // Récupère le nom de la personne sélectionnée
    $nom_personne_select = $_POST['personne_select'];
    // Parcours la liste de personnes dans la variable de session
    foreach ($_SESSION['personnes'] as $personne) {
      // Si le nom de la personne actuelle correspond au nom de la personne sélectionnée
      if ($personne->nom === $nom_personne_select) {
        // Définit la personne sélectionnée comme la personne actuelle
        $personne_select = $personne;
       
        break;
      }
    }
  }


  // Si une personne a été sélectionnée
  // Vérifie si la variable $personne_select est différente de null
  if ($personne_select !== null) {
    // Récupère l'objet CompteBancaire de la personne sélectionnée
    $compteBancaire = $personne_select->compteBancaire;

   
    if (isset($_POST['deposer']) && is_numeric($_POST['deposer'])) {
      
      $deposer = $_POST['deposer'];
      // Si le montant est positif 
      if ($deposer > 0) {
        // Appelle la méthode déposer de l'objet CompteBancaire avec le montant saisi en argument
        $compteBancaire->deposer($deposer);
      } else {
        // Si le montant est négatif, affiche un message d'erreur
        echo "Vous ne pouvez pas déposer un montant négatif.";
      }
    }
    
    if (isset($_POST['retirer']) && is_numeric($_POST['retirer'])) {
      
      $retirer = $_POST['retirer'];
      
      if ($retirer > 0) {
        // Si le solde du compte est suffisant 
        if ($compteBancaire->solde >= $retirer) {
          // Appelle la méthode retirer de l'objet CompteBancaire avec le montant saisi en argument
          $compteBancaire->retirer($retirer);
        } else {
          // Si le solde est insuffisant, affiche un message d'erreur
          echo "Solde insuffisant.";
        }
      } else {
        // Si le montant est négatif, affiche un message d'erreur
        echo "Vous ne pouvez pas retirer un montant négatif.";
      }
    }

    echo $personne_select->sePresenter();
    echo "<br>";
    echo "Solde du compte : $compteBancaire->solde €";
  }

  echo '<table>
  <tr>
    <th>Nom</th>
    <th>Age</th>
    <th>Solde</th>
    <th>Sélection</th>
  </tr>';
  foreach ($_SESSION['personnes'] as $personne) {
    echo "<tr>
          <td>" . $personne->nom . "</td>
          <td>" . $personne->age . "</td>
          <td>" . $personne->compteBancaire->solde . "</td>
          <td>
          <form method='post' action='./index.php'>
            <select name='personne_select'>
              <option value='" . $personne->nom . "'>" . $personne->nom . "</option>
            </select>
            <br>
            <label>Déposer :</label>
            <input type='number' name='deposer'>
            <br>
            <label>Retirer :</label>
            <input type='number' name='retirer'>
            <br>
            <input type='submit' value='Valider'>
          </form>
        </td>
                </tr>";
  }
  echo '</table>';
 
  ?>
</body>

</html>