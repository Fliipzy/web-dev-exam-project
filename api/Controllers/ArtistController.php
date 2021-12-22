<?php

class ArtistController extends BaseController
{
    /**
     * POST /api/artists
     */
    public function createArtist($artist)
    {
        try 
        {
            $model = new ArtistModel();
            $model->createArtist($artist);
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * GET /api/artists
     */
    public function getArtists()
    {
        try 
        {
            $model = new ArtistModel();
            $this->responseData = json_encode($model->getArtists(null));
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * GET /api/artists/:id
     */
    public function getArtist($id)
    {
        try 
        {
            $model = new ArtistModel();
            $this->responseData = json_encode($model->getArtist($id));
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * PUT /api/artists
     */
    public function updateArtist($updatedArtist)
    {
        try 
        {
            $model = new ArtistModel();
            $model->updateArtist($updatedArtist);
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * DELETE /api/artists/:id
     */
    public function deleteArtist($id)
    {
        try 
        {
            $model = new ArtistModel();
            $model->deleteArtist($id);
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