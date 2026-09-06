-- BD06.09.2026 creating a sql database for storing user contact data

CREATE TABLE contacts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- BD06.09.2026 inserting dummy data for testing MySQL

INSERT INTO contacts (name, email, phone, message) VALUES
('John Doe', 'john.doe@example.com', '+27821234567', 'Hello, I am testing the contact form functionality.'),
('Jane Smith', 'jane.smith@example.net', '+27711234567', 'Could you please send me more information about your services?'),
('Carlos Mendez', 'carlos.m@example.org', '+27831234567', 'Ran into a small bug on your site, just FYI.'),
('Amina Diop', 'amina.diop@example.com', '+27761234567', 'An excellent user experience so far! Keep up the great work.'),
('Liam Chen', 'liam.chen@example.edu', '+27841234567', 'Hi there, interested in partnership opportunities. Thanks.');