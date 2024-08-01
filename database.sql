-- Create database
CREATE DATABASE voting_system;
USE voting_system;

-- Create Departments table
CREATE TABLE Departments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

-- Create Districts table
CREATE TABLE Districts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES Departments(id)
);

-- Create Candidates table
CREATE TABLE Candidates (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

-- Create Voters table
CREATE TABLE Voters (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    alias VARCHAR(255) NOT NULL,
    dni VARCHAR(8) NOT NULL,
    email VARCHAR(255) NOT NULL,
    how_know_us SET('Web', 'TV', 'Redes Sociales', 'Amigos', 'Otro') NOT NULL,
    department_id INT,
    district_id INT,
    candidate_id INT,
    FOREIGN KEY (department_id) REFERENCES Departments(id),
    FOREIGN KEY (district_id) REFERENCES Districts(id),
    FOREIGN KEY (candidate_id) REFERENCES Candidates(id),
    UNIQUE (dni)
);

-- Insert Department data
INSERT INTO Departments (name) VALUES ('Lima'), ('Arequipa'), ('Cusco'),('Tacna');

-- Insert District data
INSERT INTO Districts (name, department_id) VALUES ('Lima Metropolitana', 1), ('Miraflores', 1), ('Arequipa', 2), ('Cusco', 3), ('Tacna', 4);

-- Insert Candidate data
INSERT INTO Candidates (name) VALUES ('Pedro Castillo'), ('Keiko Fujimori'), ('Veronika Mendoza'), ('Rafael Lopez Aliaga');