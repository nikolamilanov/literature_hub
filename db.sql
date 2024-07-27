-- Users table
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name CHAR(30) NOT NULL,
    user_email CHAR(50) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_role ENUM('user', 'teacher', 'admin') NOT NULL
);

-- ChangesRequests table
CREATE TABLE ChangesRequests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    requested_by INT NOT NULL,
    request_timestamp DATETIME NOT NULL,
    request_status ENUM('pending', 'approved', 'rejected') NOT NULL,
    FOREIGN KEY (requested_by) REFERENCES Users(user_id)
);

-- ChangesLogs table
CREATE TABLE ChangesLogs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    log_timestamp DATETIME NOT NULL,
    changed_by INT NOT NULL,
    approved_by INT NULL,
    action_type ENUM('create', 'update', 'delete') NOT NULL,
    FOREIGN KEY (changed_by) REFERENCES Users(user_id),
    FOREIGN KEY (approved_by) REFERENCES Users(user_id)
);

-- Writers table
CREATE TABLE Writers (
    writer_id INT AUTO_INCREMENT PRIMARY KEY,
    writer_name CHAR(30) NOT NULL,
    writer_surname CHAR(30) NOT NULL,
    writer_nickname CHAR(50),
    birth_date DATE,
    death_date DATE,
    birth_place CHAR(50)
);

-- Creations table
CREATE TABLE Creations (
    creation_id INT AUTO_INCREMENT PRIMARY KEY,
    creation_genre CHAR(20) NOT NULL,
    creation_writer INT NOT NULL,
    creation_date DATE NOT NULL,
    FOREIGN KEY (creation_writer) REFERENCES Writers(writer_id)
);

-- WritersChangesList table
CREATE TABLE WritersChangesList (
    list_id INT AUTO_INCREMENT PRIMARY KEY,
    record_id INT NOT NULL,
    log_id INT NOT NULL,
    FOREIGN KEY (log_id) REFERENCES ChangesLogs(log_id),
    FOREIGN KEY (record_id) REFERENCES Writers(writer_id)
);

-- CreationsChangesList table
CREATE TABLE CreationsChangesList (
    list_id INT AUTO_INCREMENT PRIMARY KEY,
    record_id INT NOT NULL,
    log_id INT NOT NULL,
    FOREIGN KEY (log_id) REFERENCES ChangesLogs(log_id),
    FOREIGN KEY (record_id) REFERENCES Creations(creation_id)
);