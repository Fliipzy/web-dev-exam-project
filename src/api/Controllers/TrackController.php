<?php
class TrackController extends BaseController
{
    /**
     * GET /api/tracks
     */
    public function getTracks()
    {
        $queryParams = array(); 
        $this->getQueryStringParams($queryParams);

        try 
        {
            $model = new TrackModel();
            $limit = null;

            if (isset($queryParams["limit"]) && $queryParams["limit"]) 
            {
                $limit = $queryParams["limit"];
            }

            if (isset($queryParams["search"]) && $queryParams["search"]) {
                $trackArray = $model->searchTracks($queryParams["search"], $limit);
                $this->responseData = json_encode($trackArray);
            }
            
            else 
            {
                $trackArray = $model->getTracks($limit);
                $this->responseData = json_encode($trackArray);
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
        } 
        catch (Exception $exception) 
        {
            
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
        } 
        catch (Exception $exception) 
        {
            
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
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }
}
?>