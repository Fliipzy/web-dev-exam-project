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
}

?>