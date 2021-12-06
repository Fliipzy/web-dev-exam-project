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
        } 
        catch (Exception $exception) 
        {
            
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
        } 
        catch (Exception $exception) 
        {
            
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
        } 
        catch (Exception $exception) 
        {
            
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
        } 
        catch (Exception $exception) 
        {
            
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
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }
}

?>