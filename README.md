# KopiAsa - Coffee Quality Prediction System

KopiAsa is a web application designed to assist coffee farmers and stakeholders in predicting the final quality of coffee beans based on various agronomic, environmental, and post-harvest processing parameters. This application combines a machine learning model and a heuristic model to provide data-driven insights.

## Key Features

### Admin Panel
- **Master Data Management:**
  - Full CRUD (Create, Read, Update, Delete) for Coffee Varieties.
  - Full CRUD for Coffee Regions.
  - Full CRUD for Farmer Account Management (complete with avatars).
  - Full CRUD for Plantation Management, including location pinning via an interactive map (Leaflet.js).
- **Real-time Parameter Data:**
  - Displays real-time Climate data (temperature, humidity, yearly precipitation) for each plantation using external APIs.
  - Displays Topography data (elevation, slope, and aspect) calculated from external APIs.
  - Displays Soil data (pH, texture, etc.) using a hybrid system: attempts to fetch from an API, and provides a manual input option upon failure.
- **Analysis & Prediction:**
  - **Quality Score Prediction:** Utilizes a **Gradient Boosting** machine learning model (Python/Scikit-learn) integrated via a local Flask API.
  - **Coffee pH Prediction:** Employs a "Smart Calculator" (heuristic model) built within Laravel based on scientific rules.
  - **Prediction History:** Saves and displays a log of all predictions made for tracking and analysis.

### Architecture & Technology
- **Backend:** Laravel 12 (PHP 8.3+)
- **Frontend:** Blade, Bootstrap 5, jQuery, DataTables, Leaflet.js
- **Database:** MySQL
- **Machine Learning:**
  - Python 3.12+
  - Scikit-learn, Pandas, Joblib
  - Flask (for serving the model as a local API)
- **Deployment:** XAMPP (for the local development environment)

## Local Setup & Installation

1.  **Clone this repository:**
    ```bash
    git clone [YOUR_REPOSITORY_URL]
    cd kopi-asa
    ```
2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```
3.  **Set up the `.env` file:**
    ```bash
    cp .env.example .env
    ```
4.  **Generate the application key:**
    ```bash
    php artisan key:generate
    ```
5.  **Configure your database in the `.env` file:**
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=kopiasa
    DB_USERNAME=root
    DB_PASSWORD=
    ```
6.  **Run migrations and seed the database to create tables and initial data:**
    ```bash
    php artisan migrate:fresh --seed
    ```
7.  **Create the storage symbolic link:**
    ```bash
    php artisan storage:link
    ```
8.  **Install Python dependencies:**
    ```bash
    pip install pandas scikit-learn joblib Flask
    ```
9.  **Train the Machine Learning model (only needs to be run once):**
    ```bash
    python ml/train_model.py
    ```

## Running the Application

To run this application, you need to run **two processes** in two separate terminals:

1.  **Terminal 1: Run the Python API Server:**
    ```bash
    python ml/app.py
    ```
2.  **Terminal 2: Run the Laravel Server:**
    ```bash
    php artisan serve
    ```

The web application will be available at `http://127.0.0.1:8000`.