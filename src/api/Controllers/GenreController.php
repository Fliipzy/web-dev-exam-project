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

    /**
     * POST /api/genres
     */
    public function createGenre($genre)
    {
        try 
        {
            $model = new GenreModel();
            $id = $model->createGenre($genre);

            if ($id) 
            {
                $this->responseData = json_encode(["genreId" => intval($id)]);
                $this->successStatusCode = "201 Created";
            }
            else 
            {
                $this->errorDescription = "Could not create genre, make sure you sent the required JSON object.";
                $this->errorHeader = "HTTP/1.1 400 Bad Request";
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
     * PUT /api/genres
     */
    public function updateGenre($updatedGenre)
    {
        try 
        {
            $model = new GenreModel();
            $count = $model->updateGenre($updatedGenre);
            $this->responseData = json_encode(array("updated" => $count));
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * DELETE /api/genres/:id
     */
    public function deleteGenre($id)
    {
        try 
        {
            $model = new GenreModel();
            $count = $model->deleteGenre($id);
            $this->responseData = json_encode(array("deleted" => $count));
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