<?php

class GenreController extends BaseController
{
    /**
     * GET /api/genres
     */
    public function getGenres()
    {
        $queryParams = array();
        $this->getQueryStringParams($queryParams);

        try 
        {
            $model = new GenreModel();
            $limit = isset($queryParams["limit"]) ? $queryParams["limit"] : null;
            $genres = $model->getGenres($limit);
            $this->responseData = json_encode($genres);
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * GET /api/genres/:id
     */
    public function getGenre($id)
    {
        try 
        {
            $model = new GenreModel();
            $genre = $model->getGenre($id);

            if (!$genre) {
                $this->errorDescription = "Genre not found";
                $this->errorHeader = "HTTP/1.1 404 Not Found";
            }
            else 
            {
                $this->responseData = json_encode($genre);
            }
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