<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;
use Entity\Film;
use Entity\Genre;
class GenreCollection
{

    public function findByMovieId(int $id) : array {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
                SELECT *
                FROM genre g
                JOIN movie_genre m ON m.genreId = g.id
                WHERE g.movieId = :movieId
            SQL);

        $stmt->execute([':movieId' => $id]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Genre::class);
    }
}