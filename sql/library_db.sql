CREATE DATABASE library_db;
USE library_db;
CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  author VARCHAR(255),
  status VARCHAR(50) DEFAULT 'available',
  cover VARCHAR(255)
);

CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  password VARCHAR(100)
);

CREATE TABLE borrow_records (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT,
  book_id INT,
  borrow_date DATE,
  return_date DATE,
  FOREIGN KEY (student_id) REFERENCES students(id),
  FOREIGN KEY (book_id) REFERENCES books(id)
);

INSERT INTO books (title, author, status, cover) VALUES
('Atomic Habits', 'James Clear', 'available', 'atomic.jpg'),
('The Psychology of Money', 'Morgan Housel', 'issued', 'psychology.jpg'),
('Rich Dad Poor Dad', 'Robert Kiyosaki', 'available', 'richdad.jpg'),
('Ikigai', 'Héctor García', 'available', 'ikigai.jpg'),
('Think Like a Monk', 'Jay Shetty', 'issued', 'monk.jpg');
