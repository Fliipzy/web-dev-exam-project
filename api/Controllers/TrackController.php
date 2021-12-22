<?php
class TrackController extends BaseController
{
    /**
     * GET /api/tracks
     */
    public function getTracks()
    {
        try {
            $model = new TrackModel();
            $limit = null;

            if (isset($queryParams["limit"]) && $queryParams["limit"]) {
                $limit = $queryParams["limit"];
            }
            else  {
                $trackArray = $model->getTracks($limit);
                $this->responseData = json_encode($trackArray);
            }

        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * GET /api/tracks/search
     */
    public function getTracksFromSearch($searchQuery) {
        try {
            $model = new TrackModel();
            $tracks = $model->searchTracks($searchQuery["searchTerm"], $searchQuery["genreId"]);
            $this->responseData = json_encode($tracks);
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * GET /api/tracks/:id
     */
    public function getTrack($id)
    {
        try 
        {
            $model = new TrackModel();
            $track = $model->getTrack($id);

            if ($track) 
            {
                $this->responseData = json_encode($track);
            }
            else 
            {
                $this->errorDescription = "Customer not found";
                $this->errorHeader = "HTTP/1.1 404 Not Found";
            }
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * PUT /api/tracks
     */
    public function updateTrack($updatedTrack)
    {
        try 
        {
            $model = new TrackModel();

            // if album id is not specified, then album name must be there
            if (!isset($updatedTrack["albumId"])) {

                $albumModel = new AlbumModel();
                $album = $albumModel->getAlbumByName($updatedTrack["album"]);

                if (!is_null($album)) {
                    $updatedTrack["albumId"] = $album["AlbumId"];
                }
                // Create new album
                else {
                    // check if artist id is available in the request body
                    if (!isset($updatedTrack["artistId"])) {
                        $artistModel = new ArtistModel();
                        $artist = $artistModel->findArtistByName($updatedTrack["artist"]);

                        if (!is_null($artist)) {
                            $updatedTrack["artistId"] = $artist["ArtistId"];
                        }
                        else {
                            $newArtistId = $artistModel->createArtist($updatedTrack["artist"]);
                            $updatedTrack["artistId"] = $newArtistId;
                        }
                    }
                    $newAlbumId = $albumModel->createAlbum(array("title" => $updatedTrack["album"], "artistId" => $updatedTrack["artistId"]));
                    $updatedTrack["albumId"] = $newAlbumId;
                }
            }

            $model->updateTrack($updatedTrack);
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * POST /api/tracks
     */
    public function createTrack($track)
    {
        try 
        {
            $model = new TrackModel();

            if (!isset($track["albumId"])) {
                // search for existing album by name
                $albumModel = new AlbumModel();
                $album = $albumModel->getAlbumByName($track["album"]);

                if (!is_null($album)) {
                    $track["albumId"] = $album["AlbumId"];
                }
                else {
                    $artistModel = new ArtistModel();
                    $artist = $artistModel->findArtistByName($track["artist"]);
                    $artistId = null;

                    if (!is_null($artist)) {
                        $artistId = $artist["ArtistId"];
                    }
                    else {
                        $artistId = $artistModel->createArtist($track["artist"]);
                    }

                    // now create album & get the new album id
                    $track["albumId"] = $albumModel->createAlbum(array("title" => $track["album"], "artistId" => $artistId));
                }
            }

            $model->createTrack($track);
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * DELETE /api/tracks/:id
     */
    public function deleteTrack($id)
    {
        try 
        {
            $model = new TrackModel();
            $model->deleteTrack($id);
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }
}
?>