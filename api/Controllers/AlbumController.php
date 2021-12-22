<?php

class AlbumController extends BaseController
{
    /**
     * GET /api/albums
     */
    public function getAlbums()
    {
        try {
            $model = new AlbumModel();
            $this->responseData = json_encode($model->getAlbums());
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }
        $this->handleResponse();
    }

    /**
     * GET /api/albums/:id
     */
    public function getAlbum($id) {
        try {
            $model = new AlbumModel();
            $album = $model->getAlbum($id);

            if (!$album) {
                $this->errorDescription = "Album not found";
                $this->errorHeader = "HTTP/1.1 404 Not Found";
            } 
            else {
                $this->responseData = json_encode($album);
            }
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * PUT /api/albums
     */
    public function updateAlbum($updatedAlbum) {
        try {

            $model = new AlbumModel();
            
            // if artist id is not in body
            if (!isset($updatedAlbum["artistId"])) {
                $artistModel = new ArtistModel();

                // try to find artist
                $artist = $artistModel->findArtistByName($updatedAlbum["artist"]);

                if (is_null($artist)) {
                    $newArtistId = $artistModel->createArtist($updatedAlbum["artist"]);
                    $updatedAlbum["artistId"] = $newArtistId;
                }
                else {
                    $updatedAlbum["artistId"] = $artist["ArtistId"];
                }
            }

            $model->updateAlbum($updatedAlbum);
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }
        
        $this->handleResponse();
    }

    /**
     * POST /api/albums
     */
    public function createAlbum($album) {
        try {
            $model = new AlbumModel();

            if (!isset($album["artistId"])) {
                $artistModel = new ArtistModel();
                $artist = $artistModel->findArtistByName($album["artist"]);

                if (!is_null($artist)) {
                    $album["artistId"] = $artist["ArtistId"];
                }
                else {
                    $newArtistId = $artistModel->createArtist(array("name" => $album["artist"]));
                    $album["artistId"] = $newArtistId;
                }
            }

            $model->createAlbum($album);
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * DELETE /api/albums/:id
     */
    public function deleteAlbum($id) {
        try {
            $model = new AlbumModel();
            $model->deleteAlbum($id);
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }
        $this->handleResponse();
    }
}
