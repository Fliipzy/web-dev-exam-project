<?php

class AlbumController extends BaseController
{
    /**
     * GET /api/albums
     */
    public function getAlbums() 
    {
        try 
        {
            $model = new AlbumModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }

    /**
     * GET /api/albums/:id
     */
    public function getAlbum($id)
    {
        try 
        {
            $model = new AlbumModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }

    /**
     * PUT /api/albums
     */
    public function updateAlbum($updatedAlbum)
    {
        try 
        {
            $model = new AlbumModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }

    /**
     * POST /api/albums
     */
    public function createAlbum($album)
    {
        try 
        {
            $model = new AlbumModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }

    /**
     * DELETE /api/albums/:id
     */
    public function deleteAlbum($id)
    {
        try 
        {
            $model = new AlbumModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }
}

?>