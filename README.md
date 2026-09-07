# WeconnectU Full-Stack PHP Developer Assessment

## About

This is a simple contact management application built with PHP, MySQL, Bootstrap and Docker.

The application allows users to submit their contact details. We can also view submitted messages.

## Project Structure

```text
app/
├── Config/
├── Controllers/
├── Models/
├── Validators/
└── Views/

database/
public/

Dockerfile
compose.yaml
README.md
```

## Running the Application

Make sure Docker is installed, then run:

```bash
docker compose up --build -d
```

Open the application:

```text
http://localhost:8080/
```

To view the submissions:

```text
http://localhost:8080/contacts
```

## Database

The database is created automatically when the Docker containers are started.

The SQL file containing the database structure and sample data is located at:

```text
database/contact_app.sql
```

## Notes

The application uses PDO prepared statements, server-side validation, CSRF protection and output escaping.

Docker is used to make the application easier to set up and run consistently.

## Author

Blessing Dongo
