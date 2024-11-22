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
  private const URL = 'https://www-info.iut2.univ-grenoble-alpes.fr/intranet/enseignements/ProgWeb/data/bricomachin/img/';

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

  ////////////// Gestion de la persistance (méthodes CRUD) ////////////////

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

  ////////////// READ /////////////////////////////////////////////

  // Acces à un article connaissant sa référence
  // $ref : la référence de l'article
  public static function read(int $ref): Article
  {
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article WHERE ref = :ref');
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
    return new Article($row['ref'], $row['libelle'], $row['categorie'], $row['prix'], $row['image']);
  }

  // Récupère des articles étant donné un No de page
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  public static function readPage(int $page, int $pageSize): array
  {
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article ORDER BY ref');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute();
    // Récupère le résultat
    $table = $query->fetchAll();
    
    if (count($table) == 0) return [];

    $i = 0;

    for ($numPage = 1; ($numPage < $page) && ($i < count($table)); $numPage++) {
      $i += 8;
    }

    



  }

  // Récupère des articles étant donné un No de page et une catégorie
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  // $categorie : la categorie qui sert de filtre
  public static function readPageCategorie(int $page, int $pageSize, Categorie $categorie): array
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
  }
}
