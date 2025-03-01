## **1. Users Table (`users`)**

Laravel’s default **users** table already exists, but you might need to modify it.

### **Columns:**

- `id` (Primary Key, UUID or Auto-Increment)
- `name` (VARCHAR, 255)
- `email` (VARCHAR, 255, unique)
- `email_verified_at` (TIMESTAMP, nullable)
- `password` (VARCHAR, 255)
- `role_id` (Foreign Key to `roles`)
- `profile_image` (VARCHAR, 255, nullable) → Stores profile picture path
- `created_at`, `updated_at` (TIMESTAMPS)

### **Relationships:**

- `role_id` → **Belongs to** a `roles` table entry.
- **HasMany** `posts` or `pages`.

---

## **2. Roles Table (`roles`)**

Used for managing user roles like **Admin, Editor, Author**.

### **Columns:**

- `id` (Primary Key, Auto-Increment)
- `name` (VARCHAR, 100, unique) → e.g., `Admin`, `Editor`, `Author`
- `created_at`, `updated_at` (TIMESTAMPS)

### **Relationships:**

- **HasMany** `users`.

---

## **3. Permissions Table (`permissions`)** _(Optional, for advanced role-based access)_

Define permissions like `can_edit_posts`, `can_publish_posts`, etc.

### **Columns:**

- `id` (Primary Key, Auto-Increment)
- `name` (VARCHAR, 100, unique) → e.g., `create_post`, `edit_post`, `delete_post`
- `created_at`, `updated_at` (TIMESTAMPS)

---

## **4. Role-Permissions Pivot Table (`role_permission`)**

Maps roles to permissions _(Many-to-Many relationship)_.

### **Columns:**

- `id` (Primary Key, Auto-Increment)
- `role_id` (Foreign Key to `roles`)
- `permission_id` (Foreign Key to `permissions`)

---

## **5. Posts Table (`posts`)**

Stores CMS articles, blogs, or pages.

### **Columns:**

- `id` (Primary Key, UUID or Auto-Increment)
- `title` (VARCHAR, 255)
- `slug` (VARCHAR, 255, unique) → SEO-friendly identifier
- `content` (LONGTEXT) → Post body
- `user_id` (Foreign Key to `users`) → Post author
- `category_id` (Foreign Key to `categories`, nullable)
- `status` (ENUM: `draft`, `published`, `archived`)
- `published_at` (TIMESTAMP, nullable)
- `created_at`, `updated_at` (TIMESTAMPS)

### **Relationships:**

- **BelongsTo** `users` (author).
- **BelongsTo** `categories`.
- **HasMany** `comments` (if implemented).

---

## **6. Categories Table (`categories`)** _(Optional, for organizing posts)_

### **Columns:**

- `id` (Primary Key, Auto-Increment)
- `name` (VARCHAR, 255, unique)
- `slug` (VARCHAR, 255, unique)
- `created_at`, `updated_at` (TIMESTAMPS)

### **Relationships:**

- **HasMany** `posts`.

---

## **7. Media Table (`media`)**

For handling file uploads (images, videos, documents).

### **Columns:**

- `id` (Primary Key, Auto-Increment)
- `file_name` (VARCHAR, 255)
- `file_path` (VARCHAR, 255)
- `user_id` (Foreign Key to `users`) → Uploaded by
- `type` (ENUM: `image`, `video`, `document`)
- `size` (INTEGER) → File size in KB/MB
- `created_at`, `updated_at` (TIMESTAMPS)

### **Relationships:**

- **BelongsTo** `users`.

---

## **8. Comments Table (`comments`)** _(Optional, if allowing comments on posts)_

### **Columns:**

- `id` (Primary Key, Auto-Increment)
- `post_id` (Foreign Key to `posts`)
- `user_id` (Foreign Key to `users`, nullable if guest comments are allowed)
- `content` (TEXT)
- `status` (ENUM: `pending`, `approved`, `rejected`)
- `created_at`, `updated_at` (TIMESTAMPS)

### **Relationships:**

- **BelongsTo** `posts`.
- **BelongsTo** `users`.

---

## **9. Settings Table (`settings`)** _(For site-wide settings like logo, site title, etc.)_

### **Columns:**

- `id` (Primary Key, Auto-Increment)
- `key` (VARCHAR, 255, unique) → e.g., `site_title`, `site_logo`, `footer_text`
- `value` (TEXT) → Stores setting values

---

## **10. Activity Logs (`activity_logs`)** _(Optional, for tracking admin actions)_

### **Columns:**

- `id` (Primary Key, Auto-Increment)
- `user_id` (Foreign Key to `users`, nullable)
- `action` (TEXT) → e.g., `"User X updated post Y"`
- `ip_address` (VARCHAR, 45)
- `created_at` (TIMESTAMP)

---

### **💡 Next Steps:**

1. **Create migrations for these tables** in the correct order (roles → users → posts, etc.).
2. **Seed essential data** (roles, admin user, etc.).
3. **Set up relationships** in Eloquent models.
4. **Test migrations and relationships** in Tinker before moving to API development.
