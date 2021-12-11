<?php

class MediaTypeModel extends Database
{
    public function getMediaTypes($limit)
    {
        return $this->select("SELECT * FROM `mediatype` ORDER BY `MediaTypeId` ASC LIMIT ?", $limit ? $limit : -1);
    }

    public function getMediaType($id)
    {
        $results = $this->select("SELECT * FROM `mediatype` WHERE `MediaTypeId` = ?", $id);
        return $results[0];
    }

    public function createMediaType($mediaType)
    {
        return $this->insert("INSERT INTO `mediatype` (`Name`) VALUES (?)", array_values($mediaType));
    }

    public function updateMediaType($updatedMediaType)
    {
        $updatedMediaTypeArray = [
            $updatedMediaType["name"],
            $updatedMediaType["mediaTypeId"]
        ];

        $statement = $this->executeStatement("UPDATE `mediatype` SET `Name` = ? WHERE `MediaTypeId` = ?", $updatedMediaTypeArray);
        return $statement->rowCount();
    }

    public function deleteMediaType($id)
    {
        $statement = $this->executeStatement("DELETE FROM `mediatype` WHERE `MediaTypeId` = ?", $id);
        return $statement->rowCount();
    }
}

?>