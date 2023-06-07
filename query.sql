CREATE TABLE parents (
  parent_id INT AUTO_INCREMENT PRIMARY KEY,
  father_name VARCHAR(255) NOT NULL,
  mother_name VARCHAR(255) NOT NULL
);

CREATE TABLE children (
  child_id INT AUTO_INCREMENT PRIMARY KEY,
  child_name VARCHAR(255) NOT NULL,
  image_path VARCHAR(255) NOT NULL,
  parent_id INT,
  FOREIGN KEY (parent_id) REFERENCES parents(parent_id) ON DELETE CASCADE
);
