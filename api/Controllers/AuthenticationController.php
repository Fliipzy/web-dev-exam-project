<?php

class AuthenticationController extends BaseController
{
    /**
     * POST /api/authentication/signin
     */
    public function signIn($signInRequest)
    {
        try 
        {
            // first check if login is from admin
            $authenticationModel = new AuthenticationModel();
            $admin = $authenticationModel->getAdminObject();

            if (password_verify($signInRequest["password"], $admin["Password"])) 
            {
                $_SESSION["email"] = $signInRequest["email"];
                $_SESSION["role"] = "ADMIN";
            }
            else
            {
                // retrieve the customer by email
                $customerModel = new CustomerModel();
                $customer = $customerModel->getCustomerByEmail($signInRequest["email"]);
        
                if ($customer) 
                {
                    // verify that password is correct
                    if (password_verify($signInRequest["password"], $customer["Password"]))
                    {
                        $_SESSION["email"] = $signInRequest["email"];
                        $_SESSION["role"] = "CUSTOMER";
                    }
                    else 
                    {
                        $this->errorDescription = "Wrong credentials";
                        $this->errorHeader = "HTTP/1.1 401 Unautorized";
                    }
                }
                else 
                {
                    $this->errorDescription = "Could not find user";
                    $this->errorHeader = "HTTP/1.1 401 Unautorized";
                }
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
     * GET /api/authentication/signout
     */
    public function signOut()
    {
        // destroy the session object
        session_unset();
        session_destroy();
        $_SESSION = array();
        $this->handleResponse();
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