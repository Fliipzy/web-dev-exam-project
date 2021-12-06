<?php

class AlbumModel extends Database
{
    public function getAlbums($limit)
    {
        return $this->select("SELECT * FROM `album` ORDER BY `AlbumId` ASC LIMIT ?", $limit ? $limit : -1);
    }

    public function getAlbum($id)
    {
        $results = $this->select("SELECT * FROM `album` WHERE `AlbumId` = ?", $id);
        return $results ? $results[0] : null;
    }

    public function updateAlbum($updatedAlbum)
    {
        $updatedAlbumArray = [
            $updatedAlbum->Title,
            $updatedAlbum->ArtistId,
            $updatedAlbum->AlbumId
        ];

        $statement = $this->executeStatement(
            "UPDATE `album`
            SET `Title` = ?, SET `ArtistId` = ?
            WHERE `AlbumId` = ?", $updatedAlbumArray);

        return $statement->rowCount();
    }

    public function createAlbum($album)
    {
        $this->executeStatement("INSERT INTO `album` (`Title`, `ArtistId`) VALUES (?, ?)", $album);
    }

    public function deleteAlbum($id)
    {
        $statement = $this->executeStatement("DELETE FROM `album` WHERE `AlbumId` = ?", $id);
        return $statement->rowCount();
    }
}

?>