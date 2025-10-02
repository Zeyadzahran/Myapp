# Laravel API Implementation Summary

This project implements a complete REST API for a blog system with authentication using Laravel Sanctum.

## 🚀 Features Implemented

### 1. Authentication System
- User registration and login
- JWT-like token authentication using Laravel Sanctum
- Protected routes with middleware

### 2. Models & Relationships
- **User Model**: Has many posts
- **Category Model**: Has many posts  
- **Post Model**: Belongs to user and category

### 3. API Endpoints

#### Authentication Routes
```
POST /api/register    - User registration
POST /api/login       - User login  
POST /api/logout      - User logout (protected)
GET  /api/user        - Get authenticated user info (protected)
```

#### Posts Routes (All protected with auth:sanctum)
```
GET    /api/posts     - List all posts with pagination
GET    /api/posts/{id} - Get specific post
POST   /api/posts     - Create new post
PUT    /api/posts/{id} - Update post (owner only)
DELETE /api/posts/{id} - Delete post (owner only)
```

#### Categories Routes (All protected with auth:sanctum)
```
GET    /api/categories     - List all categories with post counts
GET    /api/categories/{id} - Get specific category with posts
POST   /api/categories     - Create new category
PUT    /api/categories/{id} - Update category
DELETE /api/categories/{id} - Delete category (only if no posts)
```

### 4. Controllers Created

- **PostController**: Full CRUD operations with authorization
- **CategoryController**: Full CRUD operations with relationship checks
- **LoginController**: Authentication logic
- **RegisterController**: User registration logic

### 5. Database Structure

#### Users Table
- id, name, email, password, email_verified_at, timestamps

#### Categories Table
- id, name (unique), description, timestamps

#### Posts Table
- id, title, content, user_id (foreign), category_id (foreign), timestamps

#### Personal Access Tokens Table (Sanctum)
- For API token management

### 6. Factories & Seeders

#### CategoryFactory
- Generates unique category names and descriptions

#### PostFactory  
- Creates posts with random titles, content, and relationships

#### CategorySeeder
- Seeds 8 predefined categories + 2 random ones

#### PostSeeder
- Creates multiple posts per user with random categories

### 7. Middleware

#### CorsMiddleware
- Handles CORS headers for API requests
- Supports preflight OPTIONS requests
- Allows cross-origin requests

### 8. Security Features

- **Input Validation**: All endpoints validate incoming data
- **Authorization**: Users can only edit/delete their own posts
- **CSRF Protection**: Not needed for API (Sanctum handles this)
- **Rate Limiting**: Can be added to routes as needed

## 🔧 Setup Instructions

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Configure Database**
   - Update `.env` with database credentials

3. **Run Migrations & Seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

4. **Start Development Server**
   ```bash
   php artisan serve
   ```

## 📡 API Usage Examples

### 1. Register a User
```bash
POST /api/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com", 
    "password": "password123",
    "password_confirmation": "password123"
}
```

### 2. Login
```bash
POST /api/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password123"
}
```

### 3. Create a Post (Protected)
```bash
POST /api/posts
Authorization: Bearer {your-token}
Content-Type: application/json

{
    "title": "My First Post",
    "content": "This is the content of my post...",
    "category_id": 1
}
```

### 4. Get All Posts (Protected)
```bash
GET /api/posts
Authorization: Bearer {your-token}
```

## 🛡️ Security Notes

- All API routes (except auth) require authentication
- Users can only modify their own posts
- Categories cannot be deleted if they have associated posts
- Input validation prevents malicious data
- CORS middleware allows frontend integration

## 🔄 Response Format

All API responses follow this consistent format:

```json
{
    "success": true,
    "message": "Operation successful",
    "data": {
        // Response data here
    }
}
```

Error responses:
```json
{
    "success": false,
    "message": "Error description",
    "errors": {
        // Validation errors if applicable
    }
}
```

## 📦 Files Created/Modified

### Controllers
- `app/Http/Controllers/api/PostController.php`
- `app/Http/Controllers/api/CategoryController.php`  
- `app/Http/Controllers/auth/LoginController.php`
- `app/Http/Controllers/auth/RegisterController.php`

### Models
- `app/Models/Post.php`
- `app/Models/Category.php`
- `app/Models/User.php` (updated with relationships & Sanctum)

### Migrations
- `database/migrations/create_categories_table.php`
- `database/migrations/create_posts_table.php`
- Sanctum migration (auto-generated)

### Factories
- `database/factories/CategoryFactory.php`
- `database/factories/PostFactory.php`

### Seeders  
- `database/seeders/CategorySeeder.php`
- `database/seeders/PostSeeder.php`
- `database/seeders/DatabaseSeeder.php` (updated)

### Middleware
- `app/Http/Middleware/CorsMiddleware.php`

### Routes
- `routes/api.php` (created with all API routes)

