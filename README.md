# Laravel Book Borrowing System

This project is a **Laravel-based Book Borrowing System** designed to manage authors, books, publishers, users, and borrow transactions efficiently. It implements various relationships and business logic for handling book availability and user interactions.

---

## 📚 Features
- **User Authentication** using Laravel Fortify and Jetstream.
- **CRUD Operations** for Authors, Books, Publishers, and Reviews.
- **Book Borrowing and Returning System** with real-time updates on book availability.
- **Role Management**: Admin and regular users with specific permissions.
- **Reviews System** for books, authors, and publishers.
- **Admin Panel** integration using Filament.

---

## 🛠 Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Bibesh10/btech-lms.git
   ```
2. Navigate to the project directory:
   ```bash
   cd laravel-book-borrowing-system
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Create a `.env` file:
   ```bash
   cp .env.example .env
   ```
5. Generate the application key:
   ```bash
   php artisan key:generate
   ```
6. Configure your `.env` file with the database credentials.
7. Run the migrations:
   ```bash
   php artisan migrate
   ```
8. Start the development server:
   ```bash
   php artisan serve
   ```

---


## 📄 Models and Relationships

### **Author**
- `name`
- `email`
- Relationships:
  - Belongs to many `Book`

### **Book**
- `name`
- `quantity`
- `publisher_id`
- `available_quantity`
- `is_available`
- Relationships:
  - Belongs to many `Author`
  - Belongs to `Publisher`
  - Has many `BorrowTransaction`

### **BorrowTransaction**
- `user_id`
- `book_id`
- `borrowed_at`
- `return_by`
- `returned_at`
- `status`
- Relationships:
  - Belongs to `User`
  - Belongs to `Book`

### **Publisher**
- `name`
- Relationships:
  - Has many `Book`

### **Review**
- `stars`
- `user_id`
- `title`
- `description`
- Relationships:
  - Morph to `reviewable`

### **User**
- `name`
- `email`
- `password`
- `is_admin`
- Relationships:
  - Has one `UserProfile`
  - Has many `BorrowTransaction`

### **UserProfile**
- `user_id`
- `address`
- `contact_number`
- Relationships:
  - Belongs to `User`

---

## ⚙️ Traits

### **HasReviews**
A reusable trait for handling reviews across different models.

---

## 🚀 Admin Panel Integration
The project uses **Filament** to build the admin panel for managing users, books, transactions, and publishers.

### Admin Panel Access
- URL: `/admin`
- Use admin credentials to access the panel.

---
