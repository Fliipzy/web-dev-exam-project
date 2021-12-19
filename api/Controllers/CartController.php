<?php

class CartController extends BaseController
{
    /**
     * GET /api/cart
     */
    public function getCart() {
        $this->responseData = json_encode(array_values($_SESSION["cart"]));
        $this->handleResponse();
    }

    /**
     * GET /api/cart/total
     */
    public function getTotal() {
        $tracksModel = new TrackModel();
        try {
            $this->responseData = json_encode($tracksModel->getTotalPriceFromIds($_SESSION["cart"]));
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }
        $this->handleResponse();
    }

    /**
     * GET /api/cart/tracks
     */
    public function getTracks() {
        $tracksModel = new TrackModel();
        try {
            $this->responseData = json_encode($tracksModel->getTracksFromIds($_SESSION["cart"]));
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }
        $this->handleResponse();
    }

    /**
     * GET /api/cart/add/:trackid
     */
    public function addTrack($trackId) {
        array_push($_SESSION["cart"], intval($trackId));
        $this->handleResponse();
    }

    /**
     * GET /api/cart/remove/:trackid
     */
    public function removeTrack($trackId) {
        $index = array_search($trackId, $_SESSION["cart"]);
        unset($_SESSION["cart"][$index]);
        $this->handleResponse();
    }

    /**
     * GET /api/cart/clear
     */
    public function clear() {
        $_SESSION["cart"] = array();
        $this->handleResponse();
    }
}
