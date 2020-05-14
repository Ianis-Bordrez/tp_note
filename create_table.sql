DROP DATABASE IF EXISTS tp_note;
CREATE DATABASE tp_note;

CREATE TABLE account (
    account_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(61) NOT NULL,
    firstname VARCHAR(20) NOT NULL,
    name VARCHAR(20) NOT NULL,
    description LONGTEXT,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(10) NULL,
    job VARCHAR(30) NULL,
    compagny_id INT(11) NOT NULL REFERENCES company(compagny_id),
    create_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status ENUM('CANDIDAT','ENTREPRISE','ADMIN') DEFAULT 'CANDIDAT'
);

CREATE TABLE offer (
    offer_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    account_id INT(11) NOT NULL REFERENCES account(account_id),
    title VARCHAR(50) NOT NULL,
    content LONGTEXT NOT NULL,
    offer_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE company (
    company_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    boss_id INT(11) NOT NULL REFERENCES account(account_id),
    name VARCHAR(30) NOT NULL,
    description LONGTEXT NULL,
    member INT(11) NULL,
    activity_area VARCHAR(30) NULL
);

CREATE TABLE offer_response (
    resp_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    offer_id INT(11) NOT NULL REFERENCES offer(offer_id),
    account_id INT(11) NOT NULL REFERENCES account(account_id),
    response LONGTEXT NOT NULL,
    response_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

