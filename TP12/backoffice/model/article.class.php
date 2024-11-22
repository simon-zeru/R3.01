<?php
require_once(__DIR__ . '/dao.class.php');
require_once(__DIR__ . '/categorie.class.php');

// Un article en vente 
class Article
{
  private int     $ref;         // Référence unique
  private string  $libelle;     // Nom de l'article
  private Categorie  $categorie; // La catégorie de cet attribut
  private float   $prix;        // Le prix
  private string  $image;       // Nom du fichier image
  // URL absolue pour les images
  const distantURL =  'https://www-info.iut2.univ-grenoble-alpes.fr/intranet/enseignements/ProgWeb/data/bricomachin/img/';
  const localURL = "public/img/";

  // Constructeur
  public function __construct(
    int $ref = -1,
    string $libelle = '',
    Categorie $categorie = NULL,
    float $prix = 0.0,
    string  $image = ''
  ) {
    $this->ref = $ref;
    $this->libelle = $libelle;
    // On ne peux pas affecter NULL à un attribut de type Categorie
    if ($categorie === NULL) {
      $this->categorie = new Categorie();
    } else {
      $this->categorie = $categorie;
    }
    $this->prix = $prix;
    $this->image = $image;
  }

  // Getters
  public function getRef(): int
  {
    return $this->ref;
  }

  public function getLibelle(): string
  {
    return $this->libelle;
  }

  public function getCategorie(): Categorie
  {
    $this->categorie;
  }

  public function getPrix(): float
  {
    return $this->prix;
  }

  public function getImage(): string
  {
    return $this->image;
  }

  // Retourne l'URL complete de l'image pour une utilisation dans la vue.
  public function getImageURL(): string
  {
    return self::URL;
  }

  // Setter
  // NB: on n'a pas le droit de changer la référence car cela devient un autre objet

  public function setLibelle(string $libelle)
  {
    $this->libelle = $libelle;
  }

  public function setCategorie(Categorie $categorie)
  {
    $this->categorie = $categorie;
  }

  public function setPrix(float $prix)
  {
    $this->prix = $prix;
  }

  public function setImage(string $image)
  {
    $this->image = $image;
  }

  // 
  ///////////////////////////////////////////////////////
  //  A COMPLETER
  ///////////////////////////////////////////////////////
  // ////////////////////////////////////////////////////////////////////////////
  // Gestion de la persistance, Acces CRUD
  // CRUD = Create Read Update Delete
  //////////////////////////////////////////////////////////////////////////////

  // Retourne le nombre total d'articles dans la base
  // Est utilisé pour calculer le nombre de pages
  public static function count(): int
  {
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT COUNT(ref) FROM article');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute();
    // Récupère le résultat
    $table = $query->fetchAll();

    return $table[0];
  }


  /////////////////////////// CREATE /////////////////////////////////////

  public function checkIfExist(): bool
  {
    try {
      $this->read($this->ref);
      return false;
    } catch (Exception $e) {
      return true;
    }
  }

  // Création d'un nouvel article dans la base de données
  // Si le résultat de excec sur la base de donnée ne retourne pas 1
  // alors lève une exception pour signaler que l'insertion a échoué
  public function create()
  {

    try {
      // Acces au DAO
      $dao = DAO::get();
      // Prépare la requête SQL
      $query = $dao->prepare('INSERT INTO Article VALUES (:ref, :libelle, :categorie, :prix, :imageURL)');
      // Exécute la requête SQL en lui passant les paramètres
      $query->execute([':ref' => $this->ref, ':libelle' => $this->libelle, ':categorie' => $this->categorie->getId(), ':prix' => $this->prix, ':imageURL' => $this->getImage()]);
    } catch (Exception $e) {
      throw $e;
    }
    
  }

  /////////////////////////// READ /////////////////////////////////////

  // Acces à un article connaissant sa référence
  // $ref : la référence de l'article
  public static function read(int $ref): Article
  {
  
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article a JOIN categorie c ON id=categorie WHERE ref=:ref');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute([':ref' => $ref]);
    // Récupère le résultat
    $table = $query->fetchAll();

    if (count($table) == 0) {
      throw new Exception("Erreur: Article $ref non trouvé");
    }
    if (count($table) > 1) {
      throw new Exception("Incohérence: ". count($table) ." articles avec ref $ref");
    }

    $row = $table[0];
    $cat = new Categorie($row['id'], $row['nom'], $row['pere']);
    return new Article($row['ref'], $row['libelle'], $cat, $row['prix'], $row['image']);
  }

  // Récupère des articles étant donné un No de page
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  public static function readPage(int $page, int $pageSize): array
  {
    $offset = $page * $pageSize;
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article a JOIN categorie c ON id=categorie ORDER BY :ref LIMIT :pageSize OFFSET :offset');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute([':ref' => $ref, ':pageSize' => $pageSize, ':offset' => $offset]);
    // Récupère le résultat
    $table = $query->fetchAll();
    
    if (count($table) == 0) return [];

    for($i=0;$i<count($table);$i++) {
      $row = $table[$i];
      $cat = new Categorie($row['id'], $row['nom'], $row['pere']);
      $result[] = new Article($row['ref'], $row['libelle'], $cat, $row['prix'], $row['image']);
    }

    return $result;
  }

  // Récupère des articles étant donné un No de page et une catégorie
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  // $categorie : la categorie qui sert de filtre
  public static function readPageCategorie(int $page, int $pageSize, Categorie $categorie): array
  {
    $off = $page * $pageSize;
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article WHERE categorie=:categorie ORDER BY :ref LIMIT :pageSize OFFSET :offset');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute(['categorie' => $categorie.getId(), ':ref' => $ref, ':pageSize' => $pageSize, ':offset' => $offset]);
    // Récupère le résultat
    $table = $query->fetchAll();
    
    if (count($table) == 0) return [];

    for($i=0;$i<count($table);$i++) {
      $row = $table[$i];
      $result[] = new Article($row['ref'], $row['libelle'], $row['categorie'], $row['prix'], $row['image']);
    }

    return $result;
  }

  /////////////////////////// UPDATE /////////////////////////////////////

  // Mise à jour d'un article
  public function update()
  {
    try {

        $dao = DAO::get();
        // Prépare la requête SQL
        $query = $dao->prepare('UPDATE Article SET libelle=:libelle, categorie=:categorie, prix=:prix, image=:imageURL WHERE ref=:ref');
        // Exécute la requête SQL
        $query->execute([':libelle' => $this->libelle, ':categorie' => $this->categorie->getId(), ':prix' => $this->prix, ':imageURL' => $this->getImage(), ':ref' => $this->ref]);
    } catch (Exception $e) {
      
      print($e->getMessage());
    }
  }

  /////////////////////////// DELETE /////////////////////////////////////

  // Suppression d'un article
  public function delete()
  {
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('DELETE FROM Article WHERE ref=:ref');
    // Exécute la requête SQL
    $query->execute(['ref' => $this->ref]);
  }
  
}
