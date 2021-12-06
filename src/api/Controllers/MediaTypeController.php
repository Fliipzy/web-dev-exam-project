<?php

class MediaTypeController extends BaseController
{
    /**
     * GET /api/mediatypes
     */
    public function getMediaTypes()
    {
        try 
        {
            $model = new MediaTypeModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }

    /**
     * GET /api/mediatypes/:id
     */
    public function getMediaType($id)
    {
        try 
        {
            $model = new MediaTypeModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }

    /**
     * POST /api/mediatypes
     */
    public function createMediaType($id)
    {
        try 
        {
            $model = new MediaTypeModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }

    /**
     * DELETE /api/mediatypes/:id
     */
    public function deleteMediaType($id)
    {
        try 
        {
            $model = new MediaTypeModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }
}

?>