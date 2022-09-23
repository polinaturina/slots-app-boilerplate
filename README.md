# Slots App Symfony Boilerplate

This repository is based on PHP 8 and Symfony 5

## Installation

The project is dockerized and configured to work with docker-compose

 - to run the container, use `docker-compose up -d`
 - after a while, the app should be accessible on `http://localhost:3160`

# Code-challenge Polina

Add HTTP_USERNAME and HTTP_USERNAME values to .env file to run application

## Part I: The supplier
 - run migrations: ```make run-migrations ```
 - persist doctor table with data from api: ```make persist-doctor-table ```
 - persist slot table with data from api ```make persist-slot-table ```
 
Migrations will create doctor and slot table.

Persist commands will call created console commands to pull data from API to database

## Part II: Sorting

Implemented only one sorting algorithm - sorting by slot duration

## Part III: The API

Supported sorting types: duration

```http://localhost:3160/slots/sortType/{sortType}}```

