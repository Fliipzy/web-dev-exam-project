<?php

class ArtistModel extends Database
{
    public function getArtists($limit)
    {
        return $this->select("SELECT * FROM `artist` ORDER BY `ArtistId` ASC LIMIT ?", $limit ? $limit : -1);
    }

    public function getArtist($id)
    {
        $result = $this->select("SELECT * FROM `artist` WHERE `ArtistId` = ?", $id);
        return $result ? $result[0] : null;
    }

    public function updateArtist($updatedArtist)
    {
        $updatedArtistArray = [
            htmlspecialchars($updatedArtist["name"]),
            htmlspecialchars($updatedArtist["artistId"])
        ];

        $statement = $this->executeStatement(
            "UPDATE `artist`
            SET `Name` = ?
            WHERE `ArtistId` = ?", $updatedArtistArray);
        
        return $statement->rowCount();
    }

    public function findArtistByName($name) {
        $result = $this->select("SELECT * FROM `artist` WHERE `Name` = ? LIMIT 1", $name);
        return $result ? $result[0] : null;
    }

    public function createArtist($artist)
    {
        $artistArray = [
           htmlspecialchars($artist["name"])
        ];

        $this->insert("INSERT INTO `artist` (`Name`) VALUES (?)", $artistArray);
        return $this->getLastInsertedId();
    }

    public function deleteArtist($id)
    {
        try {
            $this->startTransaction();

            // first, find every album that the artist have created
            $albums = $this->select("SELECT `AlbumId` FROM `album` WHERE `ArtistId` = ?", $id);

            // set `AlbumId` column to null for every track that is in one of these albums
            // after that, we need to delete the album because of the NOT NULL constraint between the album and artist table.
            foreach ($albums as $album) {
                $this->executeStatement("UPDATE `track` SET `AlbumId` = NULL WHERE `AlbumId` = ?", $album["AlbumId"]);
                $this->executeStatement("DELETE FROM `album` WHERE `AlbumId` = ?", $album["AlbumId"]);
            }
            
            // finally, we can delete the artist
            $this->executeStatement("DELETE FROM `artist` WHERE `ArtistId` = ?", $id);

            $this->commitTransaction();
        } 
        catch (PDOException $exception) {
            $this->rollBackTransaction();
            throw $exception;
        }
    }
}

?>