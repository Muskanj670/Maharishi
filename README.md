# Maharishi Website

## Overview

The **Maharishi Website** is a platform that provides detailed information about various Maharishis (sages) from Indian history. The website presents their life stories, contributions, philosophies, and spiritual significance in an organized manner. The site uses SEO-friendly URLs with slugs instead of numeric IDs to enhance readability and improve search engine rankings.

## Features

- Dynamic content fetching from MySQL database
- SEO-friendly URLs using slugs
- Structured presentation of Maharishis' biographies
- Clean and responsive UI built with HTML, CSS, Bootstrap
- Backend powered by PHP and MySQL
- Efficient data management and retrieval

## Technologies Used

- **Frontend:** HTML, CSS, Bootstrap
- **Backend:** PHP
- **Database:** MySQL
- **Web Server:** Apache (XAMPP)

## Installation and Setup

### Prerequisites

Ensure you have the following installed on your system:

- XAMPP (or any Apache + MySQL server)
- PHP (7.4 or later)
- MySQL Database

### Steps to Set Up

1. **Clone the Repository** (if applicable)

   ```sh
   git clone https://github.com/your-repository-url.git
   ```

2. **Move the Project Folder** to your local server directory:

   ```sh
   C:/xampp/htdocs/maharishi/
   ```

3. **Create Database & Import SQL:**

   - Open **phpMyAdmin** (`http://localhost/phpmyadmin`)
   - Create a database (e.g., `maharishi_db`)
   - Import the `maharishi.sql` file into the database

4. **Configure Database Connection:** Edit `config.php` and update the database credentials:

   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "maharishi_db";
   ```

5. **Enable URL Rewriting:**

   - Open `.htaccess` in the project folder and ensure the following rules exist:
     ```apache
     RewriteEngine On
     RewriteRule ^maharishi/([a-zA-Z0-9-]+)/?$ slug.php?slug=$1 [L,QSA]
     ```
   - Ensure **mod\_rewrite** is enabled in Apache (`httpd.conf`).

6. **Run the Website:** Open your browser and go to:

   ```sh
   http://localhost/maharishi/
   ```

## Slug Generation for SEO

If you have existing entries without slugs, run the following script:

```php
$result = $conn->query("SELECT id, name FROM maharishis");
while ($row = $result->fetch_assoc()) {
    $slug = createSlug($row['name']);
    $checkSlug = $slug;
    $counter = 1;
    while ($conn->query("SELECT id FROM maharishis WHERE slug = '$checkSlug'")->num_rows > 0) {
        $checkSlug = $slug . '-' . $counter;
        $counter++;
    }
    $conn->query("UPDATE maharishis SET slug = '$checkSlug' WHERE id = " . $row['id']);
}
echo "Slugs updated successfully!";
```

## Troubleshooting

- If URLs still show `slug.php?slug=xyz`, check `.htaccess` and enable **mod\_rewrite**.
- If data contains `\r\n` characters, use `str_replace(["\r", "\n"], '', $data)` while retrieving content.
- If slashes (`\`) appear before apostrophes, enable `stripslashes()` when displaying data.

## Contributing

- Fork the repository
- Create a new branch (`git checkout -b feature-branch`)
- Commit your changes (`git commit -m 'Add new feature'`)
- Push to the branch (`git push origin feature-branch`)
- Open a Pull Request

## License

This project is open-source under the MIT License.

## Contact

For any issues or queries, contact [muskanj8642@gmail.com](mailto\:muskanj8642@gmail.com).

