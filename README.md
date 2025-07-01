# ClinicEMR

ClinicEMR is a modular, full-featured Electronic Medical Record (EMR) system designed for clinics and small hospitals. Built using Laravel/CodeIgniter, it supports patient management, appointments, billing, pharmacy, labs, inventory, HR, and accounting.

---

## 🚀 Features

- 🧑‍⚕️ **Patient Management**
  - Registration, visit tracking (OPD/IP/Emergency)
  - Vitals, consultations, and medications
- 🗓 **Appointments & Queue System**
  - Booking, scheduling, patient flow
- 💳 **Billing & Invoicing**
  - Automatic invoice generation for services, drugs, labs, imaging
  - PDF receipts
- 💊 **Pharmacy & Stock**
  - Pharmacy sales with stock deduction
  - Sales reports
- 🧪 **Laboratory & Radiology**
  - Order, result entry, and reporting
- 🧾 **Accounting**
  - Integrated accounting ledger for patient and procurement transactions
- 🧍‍♂️ **Human Resource Management**
  - Employees, leaves, payroll, and deductions
- 🏪 **Inventory & Procurement**
  - Item management, requisitions, purchase orders, goods received notes
- 🔒 **Role-Based Access Control (RBAC)**
  - Admin panel to manage users, roles, and permissions

---

## 🛠️ Tech Stack

- Backend: Laravel 10 / CodeIgniter 4
- Frontend: Blade, Bootstrap 5, jQuery
- PDF Generation: DomPDF / Snappy
- Authentication: Laravel Breeze or custom auth
- DB: MySQL/MariaDB

---

## 📦 Installation

```bash
git clone https://github.com/your-username/ClinicEMR.git
cd ClinicEMR

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure DB in .env
php artisan migrate --seed

# Serve
php artisan serve

