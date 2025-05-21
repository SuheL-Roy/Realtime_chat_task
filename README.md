# one-to-one chat system

A real-time one-to-one chat application built with Laravel, Pusher, and Laravel Echo. This system allows authenticated users to send and receive private messages, search for users, and interact through a modern chat interface with instant updates.

## Setup Instructions

1.  **Clone the repository:**
    ```bash
    git clone <repository_url>
    cd <project_directory>
    ```

2.  **Install Composer dependencies:**
    ```bash
    composer install
    ```

3.  **Copy the `.env.example` file to `.env` and configure your database:**
    ```bash
    cp .env.example .env
    # Edit the .env file with your database credentials
    ```

4.  **Generate the application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Run database migrations and seed:**
    ```bash
    php artisan migrate:fresh --seed
    ```
9.  **Serve the application:**
    ```bash
    php artisan serve
    npm run dev
    php artisan reverb:start
    ```
10.  **Login Credentials:**
    Email: suhel@gmail.com
    Password: 12345678
    Email: john@gmail.com
    Password: 12345678
    Email: jane@gmail.com
    Password: 12345678

## 🚀 Features

- ✅ User Authentication (Login & Registration)
- ✅ Real-time Messaging using Laravel Echo + Pusher(Reverb)
- ✅ Private Conversations (1-to-1 Chat)
- ✅ Message Privacy (Only sender & receiver can view)
- ✅ Dynamic User Search (by name or email)
- ✅ Responsive Chat Interface

## Accessing the Application

* **Users:** Users can log in using their credentials on the `/login` page. Upon successful authentication, they are redirected to the Chat Inbox, where they can engage in real-time conversations with other users and dynamically search through the user list.
* **Registration:** New users who do not have an account can `/register` page to create one. Upon successful Registration, they are redirected to the Chat Inbox, where they can engage in real-time conversations with other users and dynamically search through the user list.