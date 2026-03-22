# 🚀 SmartQueue - Turn Management System

**SmartQueue** is a high-performance web platform designed to streamline customer service workflows in university environments. It features dynamic turn management, intelligent window assignment, and real-time wait time estimation to improve user experience and operational efficiency.

## 🛠️ Tech Stack
* **Framework:** [Laravel 12.x](https://laravel.com/)
* **Frontend:** [Livewire 3](https://livewire.laravel.com/) & [Tailwind CSS](https://tailwindcss.com/)
* **Local Environment:** [Laravel Herd](https://herd.laravel.com/) & [DBngin](https://dbngin.com/)
* **Database:** MySQL

## ✨ Key Features
* **Smart Assignment:** Automated turn distribution to the advisor with the lowest current workload.
* **Estimated Wait Time:** Dynamic calculation of remaining minutes based on historical performance per queue.
* **Role-Based Access Control (RBAC):** Dedicated interfaces and permissions for Clients, Advisors (Operators), and Administrators.
* **Real-time Synchronization:** Instant UI updates without page refreshes, powered by Livewire.

## 🚀 Local Setup

Follow these steps to get the project running on your machine:

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/PFZepeda/smart-queue.git](https://github.com/PFZepeda/smart-queue.git)
   cd smart-queue
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment:**
   * Create your local environment file:
     ```bash
     cp .env.example .env
     ```
   * Open the `.env` file and configure your database credentials (compatible with MySQL via DBngin).
   * Generate the application security key:
     ```bash
     php artisan key:generate
     ```

4. **Run Migrations & Seeders:**
   * Prepare your database structure and initial data:
     ```bash
     php artisan migrate --seed
     ```

5. **Launch Application:**
   * If using **Laravel Herd**, simply access the site at `http://smart-queue.test`.
   * To compile and watch frontend assets, run in a separate terminal:
     ```bash
     npm run dev
     ```
