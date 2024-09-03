<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Setup Guide</title>
</head>
<body>
    <h1>Application Setup Guide</h1>
    <h2>Overview</h2>
    <p>This guide provides instructions on setting up and running this application using XAMPP with SQL.</p>
    <h2>Prerequisites</h2>
    <ul>
        <li><strong>XAMPP:</strong> Ensure you have XAMPP installed. You can download it from <a href="https://www.apachefriends.org/index.html">Apache Friends</a>.</li>
        <li><strong>Composer:</strong> Install Composer for PHP package management. You can get it from <a href="https://getcomposer.org/">getcomposer.org</a>.</li>
        <li><strong>PHP:</strong> Make sure PHP is installed and configured in your XAMPP environment.</li>
        <li><strong>Laravel:</strong> The application is built with Laravel. Familiarity with Laravel will be beneficial.</li>
    </ul>
    <h2>Setup Instructions</h2>
    <ol>
        <li>
            <h3>Clone the Repository</h3>
            <p>Clone the repository to your local machine:</p>
            <pre><code>git clone https://github.com/fatiimzi/PropertyManagment.gitcd PropertyManagment</code></pre>
        </li>
        <li>
            <h3>Install Dependencies</h3>
            <p>Run Composer to install PHP dependencies:</p>
            <pre><code>composer install</code></pre>
        </li>
        <li>
            <h3>Configure Environment</h3>
            <p>Copy the <code>.env.example</code> file to create a new <code>.env</code> file:</p>
            <pre><code>cp .env.example .env</code></pre>
            <p>Open the <code>.env</code> file and update the database configuration to match your XAMPP settings:</p>
            <pre><code>DB_CONNECTION=mysql
          DB_HOST=127.0.0.1
           DB_PORT=3306
          DB_DATABASE=propertymanagment
          DB_USERNAME=root
         DB_PASSWORD=</code></pre>
        </li>
        <li>
            <h3>Generate Application Key</h3>
            <p>Generate a new application key:</p>
            <pre><code>php artisan key:generate</code></pre>
        </li>
        <li>
            <h3>Create the Database</h3>
            <ol>
                <li>Open XAMPP Control Panel and start Apache and MySQL.</li>
                <li>Access phpMyAdmin via <a href="http://localhost/phpmyadmin">http://localhost/phpmyadmin</a>.</li>
                <li>Create a new database with the name specified in your <code>.env</code> file (propertymanagment).</li>
            </ol>
        </li>
        <li>
            <h3>Run Migrations</h3>
            <p>Apply migrations to set up the database schema:</p>
            <pre><code>php artisan migrate</code></pre>
        </li>
        <li>
            <h3>Seed the Database (Optional)</h3>
            <p>If you have seeders set up, you can populate the database with sample data:</p>
            <pre><code>php artisan db:seed</code></pre>
        </li>
        <li>
            <h3>Start the Development Server</h3>
            <p>Run the Laravel development server:</p>
            <pre><code>php artisan serve</code></pre>
            <p>The application will be available at <a href="http://localhost:8000">http://localhost:8000</a>.</p>
        </li>
        <li>
            <h3>Access the Application</h3>
            <p>Open your web browser and navigate to <a href="http://localhost:8000">http://localhost:8000</a> to view the application.</p>
        </li>
    </ol>

    <h2>Additional Commands</h2>
    <ul>
	    <li><strong>Clear Cache:</strong> <pre><code>php artisan cache:clear</code></pre></li>
        <li><strong>View Routes:</strong> <pre><code>php artisan route:list</code></pre></li>
        <li><strong>Run Tests:</strong> <pre><code>php artisan test</code></pre></li>
    </ul>
</body>
</html>


