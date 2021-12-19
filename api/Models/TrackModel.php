<?php

class TrackModel extends Database
{
    public function getTracks($limit)
    {
        return $this->select("SELECT * FROM `track` ORDER BY `TrackId` ASC LIMIT ?", $limit ? $limit : -1);
    }

    public function getTracksFromIds($ids) {
        // the $ids input will not be able to cause a SQL injection because this function can only be invoked internally & ids will always be of type int.
        return $this->select("SELECT * FROM `track` WHERE `TrackId` IN (" . implode(", ", $ids) . ");");
    }

    public function getTotalPriceFromIds($ids) {
        // the $ids input will not be able to cause a SQL injection because this function can only be invoked internally & ids will always be of type int.
        return ($this->select("SELECT SUM(`UnitPrice`) AS `Total` FROM `track` WHERE `TrackId` IN (" . implode(", ", $ids) . ")"))[0];
    }

    public function searchTracks($query, $limit)
    {
        $query = "%" . $query . "%";
        return $this->select("SELECT * FROM `track` WHERE `Name` LIKE ? OR `Composer` LIKE ? LIMIT ?", [$query, $query, $limit ? $limit : -1]);
    }

    public function getTrack($id)
    {
        $tracks = $this->select("SELECT * FROM `track` WHERE `TrackId` = ?", $id);
        return $tracks ? $tracks[0] : null;
    }

    public function updateTrack($updatedTrack)
    {
        $updatedTrackArray = [
            $updatedTrack["name"],
            $updatedTrack["albumId"],
            $updatedTrack["mediaTypeId"],
            $updatedTrack["genreId"],
            $updatedTrack["composer"],
            $updatedTrack["milliseconds"],
            $updatedTrack["bytes"],
            $updatedTrack["unitPrice"],
            $updatedTrack["trackId"],
        ];

        $statement = $this->executeStatement(
            "UPDATE `track`
             SET `Name` = ?, `AlbumId` = ?, `MediaTypeId` = ?, `GenreId` = ?,
             `Composer` = ?, `Milliseconds` = ?, `Bytes` = ?, `UnitPrice` = ?
             WHERE `TrackId` = ?", $updatedTrackArray);

        return $statement->rowCount();
    }

    public function createTrack($track)
    {
        $trackArray = [
            $track["name"],
            $track["albumId"],
            $track["mediaTypeId"],
            $track["genreId"],
            $track["composer"],
            $track["milliseconds"],
            $track["bytes"],
            $track["unitPrice"]
        ];

        return $this->insert(
            "INSERT INTO `track` (`Name`, `AlbumId`, `MediaTypeId`, `GenreId`, `Composer`, `Milliseconds`, `Bytes`, `UnitPrice`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)", $trackArray);
    }

    public function deleteTrack($id)
    {
        $statement = $this->executeStatement("DELETE FROM `track` WHERE `TrackId` = ?", $id);
        return $statement->rowCount();
    }
}

?>