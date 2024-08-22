-- Users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name CHAR(30) NOT NULL,
    user_email CHAR(50) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_role ENUM('user', 'teacher', 'admin') NOT NULL
);

-- ChangesRequests table
CREATE TABLE changes_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    requested_by INT NOT NULL,
    request_timestamp DATETIME NOT NULL,
    request_status ENUM('pending', 'approved', 'rejected') NOT NULL,
    FOREIGN KEY (requested_by) REFERENCES users(user_id)
);

-- Writers table
CREATE TABLE writers (
    writer_id INT AUTO_INCREMENT PRIMARY KEY,
    writer_name CHAR(60) NOT NULL,
    birth_date DATE,
    death_date DATE,
    birth_place CHAR(50)
);

-- Creations table
CREATE TABLE creations (
    creation_id INT AUTO_INCREMENT PRIMARY KEY,
    creation_name CHAR(60) NOT NULL,
    creation_genre CHAR(20) NOT NULL,
    creation_writer INT NOT NULL,
    creation_date DATE NOT NULL,
    is_deleted BOOLEAN NOT NULL
    FOREIGN KEY (creation_writer) REFERENCES writers(writer_id)
);

-- ChangesLogs table
CREATE TABLE changes_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    log_timestamp DATETIME NOT NULL,
    changed_by INT NOT NULL,
    approved_by INT NULL,
    action_type ENUM('create', 'update', 'delete') NOT NULL,
    FOREIGN KEY (changed_by) REFERENCES users(user_id),
    FOREIGN KEY (approved_by) REFERENCES users(user_id)
);
-- WritersChangesList table
CREATE TABLE writers_changes_list (
    list_id INT AUTO_INCREMENT PRIMARY KEY,
    record_id INT NOT NULL,
    log_id INT NOT NULL,
    FOREIGN KEY (log_id) REFERENCES changes_logs(log_id),
    FOREIGN KEY (record_id) REFERENCES writers(writer_id)
);

-- CreationsChangesList table
CREATE TABLE creations_changes_list (
    list_id INT AUTO_INCREMENT PRIMARY KEY,
    record_id INT NOT NULL,
    log_id INT NOT NULL,
    FOREIGN KEY (log_id) REFERENCES changes_logs(log_id),
    FOREIGN KEY (record_id) REFERENCES creations(creation_id)
);