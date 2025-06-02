<a id="readme-top"></a>

<!-- PROJECT SHIELDS -->

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/HumphreyLidwaji/ClinicEMR">
    <img src="images/logo.png" alt="ClinicEMR Logo" width="80" height="80">
  </a>

<h3 align="center">ClinicEMR</h3>

  <p align="center">
    A modern, modular Electronic Medical Records system for hospitals and clinics.
    <br />
    <a href="https://github.com/HumphreyLidwaji/ClinicEMR"><strong>Explore the Docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/HumphreyLidwaji/ClinicEMR">View Demo</a>
    ·
    <a href="https://github.com/HumphreyLidwaji/ClinicEMR/issues/new?labels=bug">Report Bug</a>
    ·
    <a href="https://github.com/HumphreyLidwaji/ClinicEMR/issues/new?labels=enhancement">Request Feature</a>
  </p>
</div>

---

## Table of Contents

- [About The Project](#about-the-project)
  - [Built With](#built-with)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
- [Roadmap](#roadmap)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)
- [Acknowledgments](#acknowledgments)

---

## About The Project

[![ClinicEMR Screenshot][product-screenshot]](https://example.com)

**ClinicEMR** is a comprehensive Electronic Medical Record system designed to streamline clinic and hospital workflows including patient registration, visit management, billing, diagnostics, pharmacy, HR, inventory, accounts, and reporting.

It is developed using **Laravel 12** with a modern Bootstrap UI, AJAX-based interactions, and Role-Based Access Control (RBAC). It supports both outpatient (OPD) and inpatient (IPD) processes with complete invoice tracking and reporting.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

---

### Built With

* [Laravel 12](https://laravel.com/)
* [Bootstrap 5](https://getbootstrap.com)
* [jQuery](https://jquery.com)
* [Select2](https://select2.org/)
* [MySQL](https://www.mysql.com/)
* [Font Awesome](https://fontawesome.com)
* [DataTables](https://datatables.net/)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

---

## Getting Started

To run this project locally:

### Prerequisites

- PHP >= 8.1
- MySQL
- Composer
- Bootstrap 5

### Installation

1. Clone the repo:
   ```sh
   git clone https://github.com/HumphreyLidwaji/ClinicEMR.git
   cd ClinicEMR
2.Install Php Dependancies
composer install
3.Install frontend Dependancies
npm install
npm run build
4. Copy .env.example to .env and set your environment variables
cp .env.example .env
php artisan key:generate
5.Run Migrations and Seeders
6. Start the development server
php artisan serve

<p align="right">(<a href="#readme-top">back to top</a>)</p>
Usage
Access the application at http://localhost:8000
Login with the seeded admin credentials or register a new user.
Roadmap
<input disabled="" type="checkbox"> Advanced reporting and analytics
<input disabled="" type="checkbox"> API for mobile integration
<input disabled="" type="checkbox"> HL7/FHIR interoperability
<input disabled="" type="checkbox"> More modules (insurance, SMS, etc.)
Contributing
Contributions are welcome! Please fork the repo and submit a pull request.

License
Distributed under the MIT License.

Contact
Project Link: https://github.com/HumphreyLidwaji/ClinicEMR

Acknowledgments
Laravel
Bootstrap
Select2
DataTables
Font Awesome
All open source contributors
