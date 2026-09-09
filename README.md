# Furniro API (Laravel Backend)

A robust, RESTful API built with Laravel to power the Furniro e-commerce frontend. This backend handles the product catalog, category relationships, inventory status, and provides optimized, slug-based routing for a seamless shopping experience.

## 🚀 Features

* **RESTful Architecture:** Clean and predictable API endpoints for products, categories, and reviews.
* **Slug-Based Lookups:** Route model binding configured to fetch products via URL slugs for SEO-friendly frontend routing.
* **Eager Loading:** Optimized database queries utilizing Laravel's `with()` method to prevent N+1 query problems when fetching product categories and reviews.
* **Structured Responses:** Standardized JSON payloads including pagination metadata for product catalogs and nested relationships for single-product views.
* **Database Seeders:** Pre-configured factories and seeders to quickly populate the database with mock furniture data for development.

## 🛠️ Tech Stack

* **Framework:** [Laravel](https://laravel.com/) (PHP)
* **Database:** MySQL / PostgreSQL Supabase
* **Authentication:** Laravel Sanctum (Optional/Planned for Cart/User management)

## 📦 Getting Started

### Prerequisites

* PHP 8.1+
* Composer
* MySQL or PostgreSQL database

### Installation

1. Clone the repository:
   ```bash
   git clone [https://github.com/shinobikoda/furniro-api.git](https://github.com/shinobikoda/furniro-api.git)
   cd furniro-api