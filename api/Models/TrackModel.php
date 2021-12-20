<?php

class TrackModel extends Database
{
    public function getTracks($limit)
    {
        return $this->select("SELECT * FROM `track` ORDER BY `TrackId` ASC LIMIT ?", $limit ? $limit : -1);
    }

    public function getTracksFromIds($ids) {
        $tracks = [];
        foreach ($ids as $id) {
            $track = $this->select("SELECT * FROM `track` WHERE `TrackId` = ? LIMIT 1", $id)[0];
            array_push($tracks, $track);
        }
        return $tracks;
    }

    public function getTotalPriceFromIds($ids) {
        $result["total"] = 0;
        foreach ($ids as $id) {
            $unitPrice = $this->select("SELECT `track`.`UnitPrice` FROM `track` WHERE `TrackId` = ? LIMIT 1", $id)[0]["UnitPrice"];
            $result["total"] += $unitPrice;
        }
        $result["total"] = round($result["total"], 2);
        return $result;
    }

    public function searchTracks($searchTerm, $genreId = 0)
    {
        $searchTerm = "%" . $searchTerm . "%";
        if ($genreId != 0) {
            return $this->select(
                "SELECT `track`.`TrackId`, `track`.`Name`, `track`.`Composer`, `track`.`Milliseconds`, `track`.`Bytes`, `track`.`UnitPrice`,
                    `album`.`Title` AS `Album`, `genre`.`Name` AS `Genre`, `mediatype`.`Name` AS `MediaType`
                 FROM `track` 
                 INNER JOIN `album`
                    ON `track`.`AlbumId` = `album`.`AlbumId`
                 INNER JOIN `genre`
                    ON `track`.`GenreId` = `genre`.`GenreId`
                INNER JOIN `mediatype`
                    ON `track`.`MediaTypeId` = `mediatype`.`MediaTypeId`
                 WHERE (`track`.`Name` LIKE ? OR `Composer` LIKE ? OR `album`.`Title` LIKE ?) AND `track`.`GenreId` = ?
                 ORDER BY `Track`.`TrackId`",
                [$searchTerm, $searchTerm, $searchTerm, $genreId]);
        }
        else {
            return $this->select(
                "SELECT `track`.`TrackId`, `track`.`Name`, `track`.`Composer`, `track`.`Milliseconds`, `track`.`Bytes`, `track`.`UnitPrice`,
                    `album`.`Title` AS `Album`, `genre`.`Name` AS `Genre`, `mediatype`.`Name` AS `MediaType`
                 FROM `track` 
                 INNER JOIN `album`
                    ON `track`.`AlbumId` = `album`.`AlbumId`
                 INNER JOIN `genre`
                    ON `track`.`GenreId` = `genre`.`GenreId`
                INNER JOIN `mediatype`
                    ON `track`.`MediaTypeId` = `mediatype`.`MediaTypeId`
                 WHERE `track`.`Name` LIKE ? OR `Composer` LIKE ? OR `album`.`Title` LIKE ?
                 ORDER BY `Track`.`TrackId`",
                [$searchTerm, $searchTerm, $searchTerm]);
        }
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