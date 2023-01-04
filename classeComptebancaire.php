<?php

class CompteBancaire {
  
    public $solde;

  
    public function __construct($solde){

      $this->solde = $solde;
    }

    // dépose un montant sur le compte bancaire et renvoie le nouveau solde
    public function deposer($montant){

      $this->solde += $montant;
      return $this->solde;
    }

    // retire un montant du compte bancaire et renvoie le nouveau solde, ou affiche un message d'erreur si le retrait est impossible
    public function retirer($montant){

      if ($montant > $this->solde) {

        echo "Vous ne pouvez pas retirer.<br>";
      } 
      else {

        $this->solde -= $montant;
        return $this->solde;
      }
    }

    // effectue un virement depuis ce compte bancaire vers un compte bancaire destinataire, ou affiche un message d'erreur si le virement est impossible
    public function virement($montant, CompteBancaire $compteDestinataire){

      if ($montant > $this->solde) {

        echo "Soldes insuffisants.<br>";
      }
      else {

        $this->solde -= $montant;
        $compteDestinataire->deposer($montant);
      }
    }

    // renvoie le solde du compte bancaire
    public function getSolde(){

      return $this->solde;
    }
    // Modifie le solde du compte bancaire 
    public function setSolde($solde) {

      $this->solde = $solde;
  }
}   

  
