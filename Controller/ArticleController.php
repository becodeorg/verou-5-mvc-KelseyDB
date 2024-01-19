<?php

declare(strict_types = 1);

class ArticleController
{
  private DatabaseManager $databaseManager;

    // This class needs a database connection to function
  public function __construct(DatabaseManager $databaseManager)
  {
      $this->databaseManager = $databaseManager;
  }


  public function index()
  {
      // Load all required data
      $articles = $this->getArticles();

      // Load the view
      require 'View/articles/index.php';
  }

  // Note: this function can also be used in a repository - the choice is yours
  private function getArticles()
  {
    try {
      // TODO: fetch all articles as $rawArticles (as a simple array)
      $query = "SELECT * FROM articles";

      $statement = $this->databaseManager->connection->query($query);
      $rawArticles = $statement->fetchAll();

      $articles = [];
      foreach ($rawArticles as $rawArticle) {
        // We are converting an article from a "dumb" array to a much more flexible class
        $articles[] = new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
      }

      return $articles;
      print_r($articles);

    } catch (PDOException $error) {
    echo "Error: " . $error->getMessage();
    }

      // $rawArticles = [];

      

  }

  public function show()
  {
      // TODO: this can be used for a detail page
  }
}