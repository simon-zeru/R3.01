<?php
require_once(__DIR__ . "/dao.class.php");

// Description d'une musique
class Music
{
  private int $id;
  private string $author;
  private string $title;
  private string $cover;
  private string $mp3;
  private string $category;
  // Chemin URL à ajouter pour avoir l'URL du MP3 et du COVER
  private const URL = 'http://www-info.iut2.upmf-grenoble.fr/intranet/enseignements/ProgWeb/data/musiques/';

  function __construct(int $id, string $author, string $title, string $cover, string $mp3, string $category)
  {
    // TODO
    $this->id = $id;
    $this->author = $author;
    $this->title = $title;
    $this->cover = $cover;
    $this->mp3 = $mp3;
    $this->category = $category;
  }


  ////////////// READ /////////////////////////////////////////////

  // Acces à une musique connaissant sa référence
  // $id : l'identifiant de la musique
  public static function read(int $id): Music
  {
    // Ouverture le la BD par création d'un DAO
    $dao = new DAO();

    static $QUERY = 'SELECT * FROM music WHERE id = :id';
    $requete = $dao->prepare($QUERY);
    $requete->execute([':id' => $id]);
    $data = $requete->fetchAll();

    return new Music($data['id'],$data['author'],$data['title'],$data['cover'],$data['mp3'],$data['category']);
  }

  // Max Id 
  public static function maxId() : int
  { 
    return 554;
  }

  public function getId() : int
  {
    return $this->id;
  }

  public function getAuthor() : string
  {
    return $this->author;
  }

  public function getTitle() : string
  {
    return $this->title;
  }

  public function getCover() : string
  {
    return self::URL . 'img/' . $this->cover;
  }

  public function getMp3() : string
  {
    return self::URL . 'mp3/' . $this->mp3;
  }

  public function getCategory() : string
  {
    return $this->category;
  }
}
