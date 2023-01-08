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

    // $_SESSION['personnes'][] = $personne, cela signifie que $personne sera ajoutée à la fin du tableau $_SESSION['personnes']
    // ajoute l'objet $personne créé précédemment à la fin du tableau $_SESSION['personnes']. Cela signifie que l'objet sera ajouté à la liste de personnes stockées dans la variable de session
    // permet de stocker toutes les personnes dans l'ordre où elles ont été créées
    // Ajoute la nouvelle personne à la liste de personnes dans la variable de session
    $_SESSION['personnes'][] = $personne;
  }



  $personne_select = null;
  // déclare une variable $personne_select et lui affecte la valeur null. Cela signifie que la variable est initialisée avec aucune valeur.


  if (isset($_POST['personne_select'])) {
    // vérifie si la variable $_POST['personne_select'] a été définie (si elle a été envoyée dans le formulaire). 


    $nom_personne_select = $_POST['personne_select'];
    // Cette ligne récupère la valeur de $_POST['personne_select'] et la stocke dans la variable $nom_personne_select.


    foreach ($_SESSION['personnes'] as $personne) {
      // Cette ligne démarre une boucle foreach, qui parcourera chaque élément du tableau $_SESSION['personnes']. Pour chaque élément, la variable $personne sera définie avec la valeur de l'élément en cours de parcours.


      if ($personne->nom === $nom_personne_select) {
        // Cette ligne vérifie si le nom de la personne actuelle (stockée dans la propriété nom de l'objet $personne) est égal à la valeur de $nom_personne_select. Si c'est le cas, alors le code à l'intérieur des accolades sera exécuté.


        $personne_select = $personne;
        // Cette ligne définit la variable $personne_select avec la valeur de $personne. Cela signifie que la personne sélectionnée sera définie comme étant la personne actuelle de la boucle foreach.


        break;
        // Cette ligne termine la boucle foreach. Ainsi, une fois que la personne sélectionnée a été trouvée, la boucle s'arrêtera et le reste du code ne sera pas exécuté.
      }
    }
  }


  // Si une Personne a été sélectionnée ($personne_select est différente de null),
  // récupère l'objet CompteBancaire associé à la Personne sélectionnée en accédant à la propriété compteBancaire de l'objet $personne_select
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