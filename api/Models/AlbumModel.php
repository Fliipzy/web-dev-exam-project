<?php

class AlbumModel extends Database
{
    public function getAlbums()
    {
        return $this->select(
            "SELECT `album`.*, `Artist`.`Name` AS `Artist`
             FROM `album` 
             INNER JOIN `artist`
                 ON `album`.`ArtistId` = `artist`.`ArtistId`
             ORDER BY `AlbumId` ASC");
    }

    public function getAlbum($id)
    {
        $results = $this->select("SELECT * FROM `album` WHERE `AlbumId` = ?", $id);
        return $results ? $results[0] : null;
    }

    public function getAlbumByName($name) 
    {
        $result = $this->select("SELECT * FROM `album` WHERE `Title` = ? LIMIT 1", $name);
        return $result ? $result[0] : null;
    }

    public function updateAlbum($updatedAlbum)
    {
        $updatedAlbumArray = [
            htmlspecialchars($updatedAlbum["title"]),
            htmlspecialchars($updatedAlbum["artistId"]),
            htmlspecialchars($updatedAlbum["albumId"])
        ];

        $statement = $this->executeStatement(
            "UPDATE `album`
            SET `Title` = ?, `ArtistId` = ? 
            WHERE `AlbumId` = ?", $updatedAlbumArray);

        return $statement->rowCount();
    }

    public function createAlbum($album)
    {
        $albumArray = [
            htmlspecialchars($album["title"]),
            htmlspecialchars($album["artistId"])
        ];

        $this->insert("INSERT INTO `album` (`Title`, `ArtistId`) VALUES (?, ?)", $albumArray);
        return $this->getLastInsertedId();
    }

    public function deleteAlbum($id)
    {
        try {
            $this->startTransaction();

            // update every track that has this album and set their AlbumId to null
            $this->executeStatement("UPDATE `tracks` SET `AlbumId` = NULL WHERE `AlbumId` = ?", $id);

            // now we can safely delete the album
            $statement = $this->executeStatement("DELETE FROM `album` WHERE `AlbumId` = ?", $id);

            // commit
            $this->commitTransaction();
        } 
        catch (PDOException $exception) {
            $this->rollBackTransaction();
            throw $exception;
        }
    }
}

?>