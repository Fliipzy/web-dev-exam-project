<?php

class GenreModel extends Database
{
    public function getGenres($limit)
    {
        return $this->select("SELECT * FROM `genre` ORDER BY `GenreId` ASC LIMIT ?", $limit ? $limit : -1);
    }

    public function getGenre($id)
    {
        $results = $this->select("SELECT * FROM `genre` WHERE `GenreId` = ?", $id);
        return isset($results[0]) ? $results[0] : null;
    }

    public function createGenre($genre)
    {
        return $this->insert("INSERT INTO `genre` (`Name`) VALUES (?)", array_values($genre));
    }

    public function updateGenre($updatedGenre)
    {
        $updatedGenreArray = [
            $updatedGenre["name"],
            $updatedGenre["genreId"]
        ];

        $statement = $this->executeStatement("UPDATE `genre` SET `Name` = ? WHERE `GenreId` = ?", $updatedGenreArray);
        return $statement->rowCount();
    }

    public function deleteGenre($id)
    {
        $statement = $this->executeStatement("DELETE FROM `genre` WHERE `GenreId` = ?", $id);
        return $statement->rowCount();
    }
}

?>