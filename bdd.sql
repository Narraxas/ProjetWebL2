/******************** Suppression des relations ************************/
prompt "Suppression des relations"
BEGIN
EXECUTE IMMEDIATE 'DROP TABLE CLIENTS';
EXCEPTION
WHEN OTHERS THEN
        IF SQLCODE != -942 THEN
        RAISE;
        END IF;
END;
/

BEGIN
EXECUTE IMMEDIATE 'DROP TABLE PRODUITS';
EXCEPTION
WHEN OTHERS THEN
        IF SQLCODE != -942 THEN
        RAISE;
        END IF;
END;
/

BEGIN
EXECUTE IMMEDIATE 'DROP TABLE COMMANDES';
EXCEPTION
WHEN OTHERS THEN
        IF SQLCODE != -942 THEN
        RAISE;
        END IF;
END;
/

BEGIN
EXECUTE IMMEDIATE 'DROP TABLE LIGNESCOMMANDES';
EXCEPTION
WHEN OTHERS THEN
        IF SQLCODE != -942 THEN
        RAISE;
        END IF;
END;
/

/********************** Création des tables **********************/

ALTER SESSION SET NLS_DATE_FORMAT='DD/MM/YYYY' ; /*Ajout du format date*/
CREATE TYPE etatCommande AS ENUM ('preparation', 'expedie', 'recu');

CREATE TABLE Clients (
    email VARCHAR(100) NOT NULL,
    motDePasse VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    ville VARCHAR(50),
    adresse VARCHAR(200),
    telephone VARCHAR(20),
    PRIMARY KEY (email)
);

CREATE TABLE Produits (
    idProduit VARCHAR(50) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    marque VARCHAR(50),
    categorie VARCHAR(50) NOT NULL,
    descriptif VARCHAR(400),
    photo VARCHAR(150),
    prix FLOAT CHECK(prix > 0),
    stock INT CHECK(stock >= 0),
    PRIMARY KEY (idProduit)
);

CREATE TABLE Commandes (
    idCommande VARCHAR(50) NOT NULL,
    dateCommande DATE,
    email VARCHAR(100) REFERENCES Clients(email) NOT NULL,
    etat etatCommande,
    PRIMARY KEY (idCommande)
);

CREATE TABLE Lignescommandes (
    idLigneCommande VARCHAR(50) NOT NULL,
    idCommande VARCHAR(50) REFERENCES Commandes(idCommande) NOT NULL,
    idProduit VARCHAR(50) REFERENCES Produits(idProduit) NOT NULL,
    quantite INT CHECK(stock >= 0),
    montant Float CHECK(stock >= 0.0),
    PRIMARY KEY (idCommande)
);

/********************** Insertion des données **********************/

INSERT INTO Clients('jean-louis.deurveilher@etu.umontpellier.fr', 'azerty', 'DEURVEILHER', 'Jean Louis', 'Montpellier', '17 rue de la poupée qui tousse', '0612345678');