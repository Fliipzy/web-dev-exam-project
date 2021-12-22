# General notes

The hosted server info can be found in the ../server.txt file.

The url for admin login is /webexam/admin.php

I chose to deploy with Azure without using any pre-packaged stack solution and oh god I encountered so many problems while deploying: php version mismatches, web configuration problems (Azure web app hosting doesn't allow PUT, DELETE requests), path problems in my code, MySQL security configuration... A million hours on X amount of forums later I got 99% of the deployed application to work. You may encounter some odd problems/behaviors if you chose to try out everything on the website. I recommend you test it locally though. 



# REST API Endpoints

## Albums

Requires login

**GET** /api/albums

**GET** /api/albums/:albumId

**PUT** /api/albums

**DELETE** /api/albums/:albumId

---

## Artists

Requires login

**GET** /api/artists

**GET** /api/artists/:artistId

**PUT** /api/artists

**DELETE** /api/artists/:artistId

---

## Authentication

**GET** /api/authentication/signout

**GET** /api/authentication/session

**POST** /api/authentication/signin

**POST** /api/authentication/admin-signin

**POST** /api/authentication/signup

---

## Cart

Requires login

**GET** /api/cart

**GET** /api/cart/tracks

**GET** /api/cart/total

**GET** /api/cart/add/:trackId

**GET** /api/cart/remove/:trackId

**GET** /api/cart/clear

---

## Customers

Requires login

**GET** /api/customers

**GET** /api/customers/:customerId

**PUT** /api/customers

---

## Genres

requires login

**GET** /api/genres

**GET** /api/genres/:genreId

---

## Invoices

Requires login

**GET** /api/invoices

**GET** /api/invoices/:invoiceId

**POST** /api/invoices

---

## Media types

Requires login

**GET** /api/mediatypes

**GET** /api/mediatypes/:mediatypeId

---

## Tracks

Requires login

**GET** /api/tracks/search

**GET** /api/tracks

**GET** /api/tracks/:trackId

**PUT** /api/tracks

**DELETE** /api/tracks/:trackId