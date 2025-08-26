# KopiAsa - Coffee Quality Prediction System

KopiAsa is a data-driven web application designed to assist coffee farmers and stakeholders in predicting the final quality score and pH level of coffee beans. It utilizes a combination of a machine learning model for quality assessment and a heuristic model for pH estimation, based on a comprehensive set of agronomic, environmental, and processing parameters.

This project serves as a complete demonstration of integrating a Python-based machine learning service with a robust Laravel backend, providing a powerful admin panel for data management and analysis.

---

## Key Features

### 1. Admin Dashboard
- **At-a-Glance Statistics:** Dynamic cards displaying total registered farmers, plantations, coffee varieties, and the number of predictions performed.
- **Recent Activity:** A table showing the 5 most recent prediction histories for quick review.

### 2. Data Management (Full CRUD)
- **Farmer Management:** Create, Read, Update, and Delete farmer accounts, complete with profile avatars.
- **Plantation Management:** Manage farm data, including location details determined via an interactive Leaflet.js map.
- **Coffee Variety Management:** A complete CRUD for coffee varieties (Arabica, Robusta, etc.).
- **Coffee Region Management:** A complete CRUD for coffee growing regions.

### 3. Real-time Parameter Data
- **Hybrid Data Model:** Each parameter page displays a table of all registered plantations. It first shows data from the local database. If data is missing, it attempts to fetch it from a real-time API.
- **Automatic Saving:** Data successfully fetched from an API is automatically saved to the database for future use, optimizing speed and reducing API calls.
- **Manual Input Fallback:** If an API call fails or returns no data, a button appears, allowing the administrator to manually input the data, ensuring a complete dataset.
- **Data Sources:**
  - **Climate:** Temperature, humidity, and yearly precipitation from Open-Meteo.
  - **Topography:** Elevation, slope, and aspect calculated using the Open-Elevation API.
  - **Soil:** pH, texture, organic matter, and drainage data from the ISRIC SoilGrids API.

### 4. Analysis & Prediction
- **Quality Score Prediction:**
  - Utilizes a **Gradient Boosting Regressor** model trained in Python with Scikit-learn.
  - The model is served via a local **Flask API**, decoupling the ML service from the main application.
  - Predicts a score based on the Specialty Coffee Association (SCA) 100-point scale.
  - Provides a qualitative description (e.g., "Excellent", "Very Good") for the score.
- **Coffee pH Prediction:**
  - Employs a "Smart Calculator"—a **heuristic model** built in PHP—based on scientific rules and correlations between plantation parameters and coffee acidity.
  - Provides an estimated pH range and a qualitative description (e.g., "Balanced Acidity", "Mild").
- **Prediction History:**
  - All predictions can be saved to a history log.
  - A dedicated page displays a full, searchable, and sortable DataTables log of all past predictions.
  - Users can view the detailed results of any past prediction in a modal pop-up.

---

## Tech Stack
- **Backend:** Laravel 12 (PHP 8.3+)
- **Frontend:** Blade, Bootstrap 5, jQuery, DataTables, Leaflet.js
- **Database:** MySQL
- **Machine Learning Service:**
  - Python 3.11+
  - Flask (for serving the model as a local API)
  - Scikit-learn, Pandas, Joblib
- **Local Development:** XAMPP (Windows), Homebrew/Valet (macOS)

---

## Local Setup & Installation

Follow these instructions to set up the project on your local machine.

### Installation on Windows (with XAMPP)

**Prerequisites:**
- XAMPP (with PHP 8.3+, Apache, MySQL)
- Composer
- Git
- Python (3.11+ recommended)

**Steps:**
1.  **Clone Repository:**
    ```bash
    git clone [YOUR_REPOSITORY_URL]
    cd kopi-asa
    ```
2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```
3.  **Environment Setup:**
    ```bash
    copy .env.example .env
    php artisan key:generate
    ```
4.  **Database Setup:**
    - Open XAMPP Control Panel and start Apache & MySQL.
    - Go to `http://localhost/phpmyadmin` and create a new database named `kopiasa`.
    - Edit your `.env` file with your database credentials (by default, username is `root` and password is empty).
5.  **Run Migrations & Seeding:** This will create all tables and populate them with initial data (admin account, varieties, etc.).
    ```bash
    php artisan migrate:fresh --seed
    ```
6.  **Storage Link:**
    ```bash
    php artisan storage:link
    ```
7.  **Setup Python Environment:**
    ```bash
    # Create a virtual environment
    python -m venv venv
    # Activate it
    .\venv\Scripts\activate
    # Install required libraries
    pip install -r requirements.txt
    ```
8.  **Train the ML Model (run once):**
    ```bash
    python ml/train_model.py
    ```

### Installation on macOS

**Prerequisites:**
- Homebrew
- PHP 8.3+, Composer, Git, Python 3.11+ (can be installed via Homebrew)
- MySQL (can be installed via Homebrew or a GUI tool like DBngin)

**Steps:**
1.  **Clone Repository:**
    ```bash
    git clone [YOUR_REPOSITORY_URL]
    cd kopi-asa
    ```
2.  **Install PHP Dependencies:** `composer install`
3.  **Environment Setup:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4.  **Database Setup:**
    - Start your MySQL server.
    - Create a new database: `mysql -u root -p -e "CREATE DATABASE kopiasa;"`
    - Edit your `.env` file with your database credentials.
5.  **Run Migrations & Seeding:** `php artisan migrate:fresh --seed`
6.  **Storage Link:** `php artisan storage:link`
7.  **Setup Python Environment:**
    ```bash
    # Create a virtual environment
    python3 -m venv venv
    # Activate it
    source venv/bin/activate
    # Install required libraries
    pip install -r requirements.txt
    ```
8.  **Train the ML Model (run once):**
    ```bash
    python3 ml/train_model.py
    ```

---

## Running the Application

To run the application, you need **two separate terminals** running concurrently inside the `kopi-asa` project directory.

**1. Terminal 1: Start the Python API Server**
```bash
# On Windows
.\venv\Scripts\activate
python ml/app.py

# On macOS
source venv/bin/activate
python3 ml/app.py