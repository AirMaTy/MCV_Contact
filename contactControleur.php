<?php
require_once 'ContactDAO.php';

class ContactControleur {
    private $contactDAO;

    public function __construct() {
        $this->contactDAO = new ContactDAO();
    }

    public function afficherTousLesContacts() {
        return $this->contactDAO->getAllContacts();
    }

    public function afficherContact($id) {
        return $this->contactDAO->getContactById($id);
    }

    public function ajouterContact($prenom, $nom, $adresse, $cp, $ville, $telephone) {
        $this->contactDAO->addContact($prenom, $nom, $adresse, $cp, $ville, $telephone);
    }

    public function modifierContact($id, $prenom, $nom, $adresse, $cp, $ville, $telephone) {
        $this->contactDAO->updateContact($id, $prenom, $nom, $adresse, $cp, $ville, $telephone);
    }

    public function supprimerContact($id) {
        $this->contactDAO->deleteContact($id);
    }

    public function rechercherContactsParMotCle($motCle) {
        return $this->contactDAO->searchContactsByKeyword($motCle);
    }    
    
}
