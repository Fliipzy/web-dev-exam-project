<?php

class AuthenticationController extends BaseController
{
    /**
     * POST /api/authentication/signin
     */
    public function signIn($signInRequest)
    {
        $userId = null;

        // retrieve password from database
        $authenticationModel = new AuthenticationModel();
        $hashedPassword = $authenticationModel->getCustomerPassword($userId);

        // verify that password is correct
        if (password_verify($signInRequest->password, $hashedPassword))
        {

        }
        else 
        {
            
        }
    }

    /**
     * POST /api/authentication/signup
     */
    public function signUp($signUpRequest)
    {
        try 
        {
            $model = new AuthenticationModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }

    /**
     * GET /api/authentication/signout
     */
    public function signOut()
    {
        try 
        {
            $model = new AuthenticationModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }

    /**
     * PATCH /api/authentication/reset-password
     */
    public function resetPassword($newPassword)
    {
        try 
        {
            $model = new AuthenticationModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }

    /**
     * PATCH /api/authentication/:userid/active-status
     */
    public function setUserActiveStatus($id, $activeStatus)
    {
        try 
        {
            $model = new AuthenticationModel();
        } 
        catch (Exception $exception) 
        {
            
        }

        $this->handleResponse();
    }
}

?>