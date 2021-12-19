<?php

class AuthenticationController extends BaseController
{
    /**
     * POST /api/authentication/signin
     */
    public function signIn($signInRequest) {
        try {
            $model = new AuthenticationModel();
            
            // retrieve the customer by email
            $customerModel = new CustomerModel();
            $customer = $customerModel->getCustomerByEmail($signInRequest["email"]);

            if (!is_null($customer)) {
                // verify that password is correct
                if (password_verify($signInRequest["password"], $customer["Password"])) {
                    $_SESSION["email"] = $signInRequest["email"];
                    $_SESSION["role"] = "CUSTOMER";
                    $_SESSION["id"] = $customer["CustomerId"];
                    $_SESSION["customer"] = $customer;
                } 
                else {
                    $this->errorDescription = "Wrong credentials";
                    $this->errorHeader = "HTTP/1.1 401 Unautorized";
                }
            } 
            else {
                $this->errorDescription = "Could not find user";
                $this->errorHeader = "HTTP/1.1 401 Unautorized";
            }
            
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * POST /api/authentication/admin-signin
     */
    public function adminSignin($signInRequest) {
        try {
            // first check if login is from admin
            $model = new AuthenticationModel();
            $admin = $model->getAdminObject();

            if (password_verify($signInRequest["password"], $admin["Password"])) {
                $_SESSION["email"] = "admin@tunestore.com";
                $_SESSION["role"] = ADMIN_ROLE;
            }
            else {
                $this->errorDescription = "Provided password was incorrect";
                $this->errorHeader = "HTTP/1.1 401 Unautorized";
            }
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }
        $this->handleResponse();
    }

    /**
     * GET /api/authentication/signout
     */
    public function signOut() {
        // destroy the session object
        session_destroy();
        
        $this->handleResponse();
    }

    /**
     * POST /api/authentication/signup
     */
    public function signUp($customer) {
        try {
            // first check if email is already signed up
            $customerModel = new CustomerModel();
            $customerByEmail = $customerModel->getCustomerByEmail($customer["email"]);

            if (!is_null($customerByEmail)) {
                $this->errorDescription = "User with that email already exists";
                $this->errorHeader = "HTTP/1.1 409 Conflict";
            } 
            else {
                // validate that provided passwords match
                if ($customer["password"] != $customer["confirmedPassword"]) {
                    $this->errorDescription = "Passwords did not match";
                    $this->errorHeader = "HTTP/1.1 400 Bad Request";
                } 
                else {
                    // hash clear text password before inserting it into db
                    $customer["password"] = password_hash($customer["password"], PASSWORD_BCRYPT);
                    
                    $model = new AuthenticationModel();
                    $customerId = $model->createCustomer($customer);

                    if (is_null($customerId)) {
                        $this->errorDescription = "Something went wrong while inserting customer";
                        $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
                    } 
                    else {
                        // create a session for the new customer
                        $_SESSION["email"] = $customer["email"];
                        $_SESSION["role"] = "CUSTOMER";
                        $_SESSION["id"] = $customerId;
                        $_SESSION["customer"] = $customer;
                    }
                }
            }
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }


    /**
     * PATCH /api/authentication/reset-password
     */
    public function resetPassword($newPasswordRequest) {

        try {
            // first validate that the new password & confirmed new password matches
            if ($newPasswordRequest["newPassword"] != $newPasswordRequest["newPasswordConfirmed"]) {
                $this->errorDescription = "'newPassword' and 'newPasswordConfirmed' did not match";
                $this->errorHeader = "HTTP/1.1 400 Bad Request";
            }
            else {
                // check if old password is correct
                if (!password_verify($newPasswordRequest["oldPassword"], $_SESSION["customer"]["Password"])) {
                    $this->errorDescription = "'oldPassword' and users current password did not match";
                    $this->errorHeader = "HTTP/1.1 401 Unauthorized";
                }
                else {
                    // hash new password
                    $hashedNewPassword = password_hash($newPasswordRequest["newPassword"], PASSWORD_BCRYPT);

                    // update user password
                    $model = new AuthenticationModel();
                    if ($model->changeCustomerPassword($_SESSION["id"], $hashedNewPassword) == 0) {
                        $this->errorDescription = "Password could not be updated";
                        $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
                    }
                    // update session
                    $_SESSION["customer"]["Password"] = $hashedNewPassword;
                }
            }
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * PATCH /api/authentication/:userid/active-status
     */
    public function setUserActiveStatus($id, $activeStatus) {
        try {
            $model = new AuthenticationModel();
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }
}