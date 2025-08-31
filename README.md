# Mini-Twitter | Laravel & Tailwind CSS

A simple, modern social media application built with Laravel and styled with Tailwind CSS.  
This project replicates some of the core functionalities of Twitter, allowing users to create accounts, post short messages, follow other users, and view a timeline of posts from the users they follow.

---

## ✨ Features

- **User Authentication**: Secure user registration and login functionality powered by Laravel Breeze.  
- **Create Posts**: Authenticated users can create and share short text-based posts.  
- **Follow System**: Users can follow and unfollow other users on the platform.  
- **Personalized Timeline**: The main dashboard displays a feed of the latest posts only from users that the logged-in user follows.  
- **Commenting**: Users can leave comments on any post.  
- **User Profiles**: Viewable user profile pages that display a user's posts and their follower/following counts.  
- **User Discovery**:  
  - Search for other users by name or email.  
  - Explore a paginated list of all users on the platform.  
  - View lists of who a user follows and who follows them.  
- **Database Seeding**: Comes with pre-built seeders to quickly populate the application with sample data for easy testing.

---

## 🛠 Tech Stack

- **Backend**: Laravel 12  
- **Frontend**: Blade Templates with Tailwind CSS  
- **Database**: MySQL  
- **Authentication**: Laravel Breeze  

---

## 🚀 Installation Guide

Follow these steps to get the application running on your local machine.

### ✅ Prerequisites
- PHP >= 8.2  
- Composer  
- Node.js & NPM  
- A local database server (e.g., MySQL via Laragon, XAMPP)  

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/mini-twitter.git
cd mini-twitter
```
2. Install Dependencies
composer install
npm install

3. Set Up Environment File
cp .env.example .env


Now, open the .env file and configure your database connection details:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_twitter
DB_USERNAME=root
DB_PASSWORD=


(Ensure you create a database named mini_twitter in your database client.)

4. Generate Application Key
php artisan key:generate

5. Run Database Migrations and Seeding

This will create all the necessary tables and populate them with sample data:

php artisan migrate:fresh --seed

6. Compile Frontend Assets
npm run dev

7. Start the Development Server
php artisan serve