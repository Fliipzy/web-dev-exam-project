<?php

class ArtistModel extends Database
{
    public function getArtists($limit)
    {
        return $this->select("SELECT * FROM `artist` ORDER BY `ArtistId` ASC LIMIT ?", $limit ? $limit : -1);
    }

    public function getArtist($id)
    {
        return $this->select("SELECT * FROM `artist` WHERE `ArtistId` = ?", $id);
    }

    public function updateArtist($updatedArtist)
    {
        $updatedArtistArray = [
            $updatedArtist->name,
            $updatedArtist->artistId
        ];

        $statement = $this->executeStatement(
            "UPDATE `artist`
            SET `Name` = ?
            WHERE `ArtistId` = ?", $updatedArtistArray);
        
        return $statement->rowCount();
    }

    public function createArtist($artist)
    {
        return $this->insert("INSERT INTO `artist` (Name) VALUES (?)", $artist);
    }

    public function deleteArtist($id)
    {
        $statement = $this->executeStatement("DELETE FROM `artist` WHERE `ArtistId` = ?", $id);
        return $statement->rowCount();
    }
}

?>