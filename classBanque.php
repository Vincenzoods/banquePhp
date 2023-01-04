<?php

class Banque {

    // Un tableau pour stocker les personnes de la banque
    public $personnes = [];

    // Ajoute une personne à la banque
    public function ajouterPersonne(Personne $personne) {

        $this->personnes[] = $personne;
    }

    // Récupère une personne de la banque en fonction de son nom, ou null si aucune personne n'a été trouvée
    public function getPersonne($nom) {

        foreach ($this->personnes as $personne) {
            if ($personne->getNom() == $nom) {
                return $personne;
            }
        }
        return null;
    }

    // Récupère toutes les personnes de la banque
    public function getPersonnes() {

        return $this->personnes;
    }

    // Récupère le nombre de personnes de la banque
    public function getPersonnesCount() {

        return count($this->personnes);
    }

    // Récupère une personne de la banque en fonction de son solde bancaire
    public function getPersonneBySolde($solde) {

        foreach ($this->personnes as $personne) {
            if ($personne->getCompteBancaire()->getSolde() == $solde) {
                return $personne;
            }
        }
        return null;
    }

    // Récupère une personne de la banque en fonction de son âge
    public function getPersonneByAge($age) {

        foreach ($this->personnes as $personne) {
            if ($personne->getAge() == $age) {
                return $personne;
            }
        }
        return null;
    }
}