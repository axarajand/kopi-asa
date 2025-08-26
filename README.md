# KopiAsa - Coffee Quality Prediction System

KopiAsa is a data-driven web application designed to assist coffee farmers and stakeholders in predicting the final quality score and pH level of coffee beans. It utilizes a combination of a machine learning model for quality assessment and a heuristic model for pH estimation, based on a comprehensive set of agronomic, environmental, and processing parameters.

This project serves as a complete demonstration of integrating a Python-based machine learning service with a robust Laravel backend, providing a powerful admin panel for data management and analysis.

---

## ✨ Key Features

### 1. Admin Dashboard
- **At-a-Glance Statistics:** Dynamic cards displaying total registered farmers, plantations, coffee varieties, and the number of predictions performed.
- **Recent Activity:** A table showing the 5 most recent prediction histories for quick review.

### 2. Data Management (Full CRUD)
- **Farmer Management:** Create, Read, Update, and Delete farmer accounts, complete with profile avatars.
- **Plantation Management:** Manage farm data, including location details determined via an interactive Leaflet.js map.
- **Coffee Variety & Region Management:** Full CRUD functionalities for coffee varieties and growing regions.

### 3. Real-time Parameter Data
- **Hybrid Data Model:** Each parameter page (Climate, Topography, Soil) displays a table of all registered plantations. It first shows data from the local database. If data is missing, it attempts to fetch it from a real-time API.
- **Automatic Saving:** Data successfully fetched from an API is automatically saved to the database for future use, optimizing speed and reducing API calls.
- **Manual Input Fallback:** If an API call fails or returns no data, a button appears, allowing the administrator to manually input the data, ensuring a complete dataset.

### 4. Analysis & Prediction
- **Quality Score Prediction:**
  - Utilizes a **Gradient Boosting Regressor** model trained in Python with Scikit-learn on the Coffee Quality Institute (CQI) dataset.
  - The model is served via a local **Flask API**, decoupling the ML service from the main application.
  - Predicts a score based on the Specialty Coffee Association (SCA) 100-point scale.
- **Coffee pH Prediction:**
  - Employs a "Smart Calculator"—a **heuristic model** built in PHP—based on scientific rules and correlations between plantation parameters and coffee acidity.
  - Provides an estimated pH range and a qualitative description (e.g., "Balanced Acidity", "Mild").
- **Prediction History:**
  - All predictions can be saved to a history log.
  - A dedicated page displays a full, searchable, and sortable DataTables log of all past predictions.

---

## 🛠️ Tech Stack
- **Backend:** Laravel 12 (PHP 8.3+)
- **Frontend:** Blade, Bootstrap 5, jQuery, DataTables, Leaflet.js
- **Database:** MySQL
- **Machine Learning Service:**
  - Python 3.11+
  - Flask (for serving the model as a local API)
  - Scikit-learn, Pandas, Joblib
- **Local Development:** XAMPP (Windows), Homebrew/Valet (macOS)

---

## ⚙️ Local Setup & Installation

Follow these instructions to set up the project on your local machine.

### Installation on Windows (with XAMPP)

**Prerequisites:**
- XAMPP (with PHP 8.3+, Apache, MySQL)
- Composer
- Git
- Python (3.11+ recommended)

**Steps:**
1. **Clone Repository:**
    ```bash
    git clone [YOUR_REPOSITORY_URL]
    cd kopi-asa
    ```
2. **Install PHP Dependencies:**
    ```bash
    composer install
    ```
3. **Environment Setup:**
    ```bash
    copy .env.example .env
    php artisan key:generate
    ```
4. **Database Setup:**
    - Open XAMPP Control Panel and start Apache & MySQL.
    - Go to `http://localhost/phpmyadmin` and create a new database named `kopiasa`.
    - Edit your `.env` file with your database credentials (by default, username is `root` and password is empty).
5. **Run Migrations & Seeding:**
    ```bash
    php artisan migrate:fresh --seed
    ```
6. **Storage Link:**
    ```bash
    php artisan storage:link
    ```
7. **Setup Python Environment:**
    ```bash
    python -m venv venv
    .\venv\Scripts\activate
    pip install -r requirements.txt
    ```
8. **Train the ML Model (run once):**
    ```bash
    python ml/train_model.py
    ```

### Installation on macOS

**Prerequisites:**
- Homebrew
- PHP 8.3+, Composer, Git, Python 3.11+
- MySQL

**Steps:**
1. **Clone Repository:**
    ```bash
    git clone [YOUR_REPOSITORY_URL]
    cd kopi-asa
    ```
2. **Install PHP Dependencies:**
    ```bash
    composer install
    ```
3. **Environment Setup:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4. **Database Setup:**
    - Start your MySQL server.
    - Create a new database: 
      ```bash
      mysql -u root -p -e "CREATE DATABASE kopiasa;"
      ```
    - Edit your `.env` file with database credentials.
5. **Run Migrations & Seeding:**
    ```bash
    php artisan migrate:fresh --seed
    ```
6. **Storage Link:**
    ```bash
    php artisan storage:link
    ```
7. **Setup Python Environment:**
    ```bash
    python3 -m venv venv
    source venv/bin/activate
    pip install -r requirements.txt
    ```
8. **Train the ML Model (run once):**
    ```bash
    python3 ml/train_model.py
    ```

---

## ▶️ Running the Application

To run the application, you need **two separate terminals** running concurrently inside the `kopi-asa` project directory.

**1. Terminal 1: Start the Python API Server**  
*This terminal runs the Machine Learning model. Leave it running in the background.*

```bash
# On Windows
.\venv\Scripts\activate
python ml/app.py

# On macOS
source venv/bin/activate
python3 ml/app.py
```

The Python API server will be available at `http://127.0.0.1:5000`.

---

**2. Terminal 2: Start the Laravel Web Server**  
*This terminal runs the main web application.*

```bash
php artisan serve
```

The web application will be available at:  
👉 `http://127.0.0.1:8000`

---

### 🔑 Default Credentials

Use the following login credentials to access the **Admin Dashboard**:

- **Email:** `admin@gmail.com`  
- **Password:** `123`

---

## 📜 License

MIT License © 2025 Axa Rajandrya