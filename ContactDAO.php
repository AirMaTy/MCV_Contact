<?php
class ContactDAO {
    private $db;

    public function __construct() {
        $this->db = new PDO('sqlite:R3.01.db');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllContacts() {
        $query = 'SELECT * FROM contact';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContactById($id) {
        $query = 'SELECT * FROM contact WHERE ID = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addContact($prenom, $nom, $adresse, $cp, $ville, $telephone) {
        $query = 'INSERT INTO contact (prenom, nom, adresse, cp, ville, telephone) VALUES (:prenom, :nom, :adresse, :cp, :ville, :telephone)';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':adresse', $adresse);
        $stmt->bindValue(':cp', $cp);
        $stmt->bindValue(':ville', $ville);
        $stmt->bindValue(':telephone', $telephone);
        $stmt->execute();
    }

    public function updateContact($id, $prenom, $nom, $adresse, $cp, $ville, $telephone) {
        $query = 'UPDATE contact SET prenom = :prenom, nom = :nom, adresse = :adresse, cp = :cp, ville = :ville, telephone = :telephone WHERE ID = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':adresse', $adresse);
        $stmt->bindValue(':cp', $cp);
        $stmt->bindValue(':ville', $ville);
        $stmt->bindValue(':telephone', $telephone);
        $stmt->execute();
    }

    public function deleteContact($id) {
        $query = 'DELETE FROM contact WHERE ID = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function searchContactsByKeyword($motCle) {
        $sql = "SELECT * FROM contact WHERE 
                prenom LIKE :motCle OR 
                nom LIKE :motCle OR 
                adresse LIKE :motCle OR 
                ville LIKE :motCle OR 
                telephone LIKE :motCle";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':motCle' => "%$motCle%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
