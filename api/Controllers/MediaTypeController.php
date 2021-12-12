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
            $mediaType = $model->getMediaType($id);

            if (!$mediaType) {
                $this->errorDescription = "Album not found";
                $this->errorHeader = "HTTP/1.1 404 Not Found";
            }
            else 
            {
                $this->responseData = json_encode($mediaType);
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