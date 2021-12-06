<?php
class TrackController extends BaseController
{
    /**
     * GET /api/tracks
     */
    public function getTracks()
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
     * GET /api/tracks/:id
     */
    public function getTrack($id)
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