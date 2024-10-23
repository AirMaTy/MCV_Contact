<?php
class Contact {
    private $id;
    private $prenom;
    private $nom;
    private $adresse;
    private $cp;
    private $ville;
    private $telephone;

    public function __construct($id, $prenom, $nom, $adresse, $cp, $ville, $telephone) {
        $this->id = $id;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->telephone = $telephone;
    }

    public function getId() {
        return $this->id;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getCp() {
        return $this->cp;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function setCp($cp) {
        $this->cp = $cp;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }
}
