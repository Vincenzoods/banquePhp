<?php
class Personne {
   
    public $nom;
    public $age;
    public $compteBancaire;

   
    // attend en paramètre un objet de la classe "CompteBancaire".
    //  Si un autre type de valeur est passé en paramètre génére une erreur.
    
    public function __construct($nom, $age, CompteBancaire $compteBancaire) {

        $this->nom = $nom;
        $this->age = $age;
        $this->compteBancaire = $compteBancaire;
    }

    // Affiche une phrase de présentation
    public function sePresenter() {

        return "Bonjour, je m'appelle $this->nom et j'ai $this->age ans.";
    }


    
    // Récupère le nom 
    public function getNom() {

        return $this->nom;
    }
    // Modifie le nom 
    public function setNom($nom) {

        $this->nom = $nom;
    }



    // Récupère l'âge 
    public function getAge() {

        return $this->age;
    }
    // Modifie l'âge 
    public function setAge($age) {

        $this->age = $age;
    }



    // Récupère le compte bancaire 
    public function getCompteBancaire() {

        return $this->compteBancaire;
    }
    // Modifie le compte bancaire 
    public function setCompteBancaire(CompteBancaire $compteBancaire) {

        $this->compteBancaire = $compteBancaire;
    }
   

}