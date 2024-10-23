<!DOCTYPE html>
<html>
<head>
    <title>Gestion des contacts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter ou Modifier un contact</h1>

        <?php
        require_once 'ContactControleur.php';
        $controleur = new ContactControleur();

        $ID = '';
        $prenom = '';
        $nom = '';
        $adresse = '';
        $cp = '';
        $ville = '';
        $telephone = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['prenom'], $_POST['nom'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['telephone'])) {
                if (!empty($_POST['ID'])) {
                    $controleur->modifierContact($_POST['ID'], $_POST['prenom'], $_POST['nom'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['telephone']);
                } else {
                    $controleur->ajouterContact($_POST['prenom'], $_POST['nom'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['telephone']);
                }
                header("Location: saisie.php"); 
                exit();
            }
        }

        if (isset($_GET['action']) && isset($_GET['ID'])) {
            $ID = $_GET['ID'];

            if ($_GET['action'] === 'supprimer') {
                $controleur->supprimerContact($ID);
                header("Location: saisie.php");
                exit();
            }

            if ($_GET['action'] === 'modifier') {
                $contact = $controleur->afficherContact($ID);
                $ID = $contact['ID'];
                $prenom = $contact['prenom'];
                $nom = $contact['nom'];
                $adresse = $contact['adresse'];
                $cp = $contact['cp'];
                $ville = $contact['ville'];
                $telephone = $contact['telephone'];
            }
        }
        ?>

        <form action="saisie.php" method="post">
            <input type="hIDden" name="ID" value="<?= $ID ?>">
            Prénom: <input type="text" name="prenom" value="<?= $prenom ?>"><br>
            Nom: <input type="text" name="nom" value="<?= $nom ?>"><br>
            Adresse: <input type="text" name="adresse" value="<?= $adresse ?>"><br>
            Code Postal: <input type="text" name="cp" value="<?= $cp ?>"><br>
            Ville: <input type="text" name="ville" value="<?= $ville ?>"><br>
            Téléphone: <input type="text" name="telephone" value="<?= $telephone ?>"><br>
            <input type="submit" value="<?= empty($ID) ? 'Ajouter' : 'Modifier' ?>">
        </form>

        <hr>

        <h2>Rechercher un contact</h2>
        <form action="saisie.php" method="get">
            Mot clé: <input type="text" name="mot_cle" value="<?= $_GET['mot_cle'] ?? '' ?>"><br>
            <input type="submit" value="Rechercher">
            <button type="button" onclick="window.location.href='saisie.php';">Réinitialiser</button>
        </form>

        <?php
        if (isset($_GET['mot_cle']) && !empty($_GET['mot_cle'])) {
            $motCle = $_GET['mot_cle'];
            $contacts = $controleur->rechercherContactsParMotCle($motCle); // Fonction pour rechercher dans le DAO
        } else {
            $contacts = $controleur->afficherTousLesContacts();
        }
        ?>

        <h2>Liste des contacts</h2>
        <?php foreach ($contacts as $contact): ?>
            <p>
                <?= "{$contact['prenom']} {$contact['nom']} - {$contact['ville']} - {$contact['telephone']}" ?>
                <?php if (isset($contact['ID']) && !empty($contact['ID'])): ?>
                    <a href="saisie.php?action=modifier&ID=<?= $contact['ID'] ?>">Modifier</a>
                    <a href="saisie.php?action=supprimer&ID=<?= $contact['ID'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">Supprimer</a>
                <?php endif; ?>
            </p>
        <?php endforeach; ?>
    </div>                
</body>
</html>
