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
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
    return $this->ref;
  }

  public function getLibelle(): string
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
    return $this->libelle;
  }

  public function getCategorie(): Categorie
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    //
    return $this->categorie; 
  }

  public function getCategorieNom(): string
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
    return $this->categorie->getNom();
  }

  public function getPrix(): float
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
    return $this->prix;
  }

  public function getImage(): string
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
    return $this->image;
  }

  // Retourne l'URL complete de l'image pour une utilisation dans la vue.
  public function getImageURL(): string
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
    return self::distantURL . $this->image;
  }

  // Setter
  public function setLibelle(string $libelle)
  {
    $this->libelle = $libelle;
  }

  public function setCategorie(Categorie $categorie)
  {
    $this->categorie = $categorie;
  }

  public function setCategorieId(int $categorie_id)
  {
    $this->categorie = Categorie::read($categorie_id);
  }

  public function setPrix(float $prix)
  {
    $this->prix = $prix;
  }

  public function setImage(string $image)
  {
    $this->image = $image;
  }



  // NB: on n'a pas le droit de changer la référence car cela devient un autre objet

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
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
    $dao = DAO::get();
    $request = $dao->prepare("SELECT COUNT(*) FROM article");
    $request->execute();
    $result = $request->fetch();
    return $result[0];
  }



  /////////////////////////// CREATE /////////////////////////////////////


  // Création d'un nouvel article dans la base de données
  // Si le résultat de excec sur la base de donnée ne retourne pas 1
  // alors lève une exception pour signaler que l'insertion a échoué
  public function create()
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
    $dao = DAO::get();
    
    $checkRequest = $dao->prepare("SELECT COUNT(*) FROM article WHERE ref = :ref");
    $checkRequest->execute(["ref" => $this->ref]);
    $count = $checkRequest->fetchColumn();
    
    if ($count > 0) {
      throw new Exception("Un article avec la référence {$this->ref} existe déjà.");
    }
    
    $request = $dao->prepare("INSERT INTO article (ref, libelle, categorie, prix, image) VALUES (:ref, :libelle, :categorie, :prix, :image)");
    $request->execute([
      "ref" => $this->ref,
      "libelle" => $this->libelle,
      "categorie" => $this->categorie->getNom(),
      "prix" => $this->prix,
      "image" => $this->image
    ]);
    
    if ($request->rowCount() != 1) {
      throw new Exception("Erreur lors de la création de l'article");
    }
    
    return $request->rowCount();
  }

  /////////////////////////// READ /////////////////////////////////////

  // Acces à un article connaissant sa référence
  // $ref : la référence de l'article
  public static function read(int $ref): Article
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    //
    $dao = DAO::get();
    $request = $dao->prepare("SELECT a.*, c.id as cat_id, c.nom as cat_nom, c.pere as cat_pere 
                             FROM article a 
                             JOIN categorie c ON a.categorie = c.id 
                             WHERE a.ref = :ref");
    $request->execute([
        "ref" => $ref
    ]);
    $result = $request->fetch();
    
    if ($result == NULL) {
        throw new Exception("Article $ref non trouvé");
    }
    
    // Crée et retourne l'article avec la catégorie appropriée
    $categorie = new Categorie($result['cat_id'], $result['cat_nom'], $result['cat_pere']);
    
    return new Article(
        $result['ref'],
        $result['libelle'], 
        $categorie,
        $result['prix'],
        $result['image']
    );
  }

  // Récupère des articles étant donné un No de page
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  public static function readPage(int $page, int $pageSize): array
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
    $dao = DAO::get();
    $request = $dao->prepare("SELECT * FROM article ORDER BY ref LIMIT :pageSize OFFSET :offset");
    $request->execute(array(":pageSize" => $pageSize, ":offset" => ($page - 1) * $pageSize));
    $result = $request->fetchAll();
    $articles = array();
    foreach ($result as $article) {
      $articles[] = new Article($article['ref'], $article['libelle'], Categorie::read($article['categorie']), $article['prix'], $article['image']);
    }
    return $articles;
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
    $dao = DAO::get();
    $request = $dao->prepare("SELECT * FROM article WHERE categorie = :categorie ORDER BY ref LIMIT :pageSize OFFSET :offset");
    $request->execute(array(":categorie" => $categorie->getId(), ":pageSize" => $pageSize, ":offset" => ($page - 1) * $pageSize));
    $result = $request->fetchAll();
    $articles = array();
    foreach ($result as $article) {
      $articles[] = new Article($article['ref'], $article['libelle'], Categorie::read($article['categorie']), $article['prix'], $article['image']);
    }
    return $articles;
  }

  /////////////////////////// UPDATE /////////////////////////////////////

  // Mise à jour d'un article
  public function update()
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
    $dao = DAO::get();
    $request = $dao->prepare("UPDATE article SET libelle = :libelle, categorie = :categorie, prix = :prix, image = :image WHERE ref = :ref");
    $request->execute([
      "ref" => $this->ref,
      "libelle" => $this->libelle,
      "categorie" => $this->categorie->getId(),
      "prix" => $this->prix,
      "image" => $this->image
    ]);
    if ($request->rowCount() != 1) {
      throw new Exception("Erreur lors de la mise à jour de l'article");
    }
    return "Article mis à jour";
  }

  /////////////////////////// DELETE /////////////////////////////////////

  // Suppression d'un article
  public function delete()
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
    $dao = DAO::get();
    $request = $dao->prepare("DELETE FROM article WHERE ref = :ref");
    $request->execute([
      "ref" => $this->ref
    ]);
    if ($request->rowCount() != 1) {
      throw new Exception("Erreur lors de la suppression de l'article");
    }
    return "Article supprimé";
  }
}
