# Petcube - test APP

web application that consists of two pages: a main landing page and a dashboard page.

*(landing page design in Figma [Petcube Landing](https://www.figma.com/file/MzvPht5mycZ5Tr1P0gwIEV/Petcube-App-Test))*

---

## Requirements

PHP 7.4.x
Symfony 4.4.x
Docker 18.03.x
Docker-compose 1.20.x
---

## Installation

### Step 1: :

download an unzip repository or use git clone command:

``git clone https://github.com/petrenkodesign/petcube.git``

navigate to project directory 

``cd petcube ``

### Step 2: 

run docker-compose builder in project directory:

``docker-compose up -d --build``

or use bash script 

``./buld_project.sh``

### Step 3:

run the following command to create a database

``php bin/console doctrine:database:create``

migration, create table from entry

``php bin/console doctrine:schema:update --force``


### Step 4: Change variables in .env file:

the project must be opened in the browser at the address:

``http://localhost:8080``

you may need to do docker [port forwarding](https://docs.docker.com/config/containers/container-networking/)

for link to dashboard use link below

``http://localhost:8080/profile``

or click to qr code in navigation menu on start landing page


#### Additional

To clear Symfony cache, run the following command:

``php bin/console cache:clear``

Regenerate the list of all classes in the app

``composer dump-autoload``
