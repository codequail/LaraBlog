<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Exploring Laravel',
                'body' => "Laravel is a powerful PHP framework designed for building web applications with an expressive, elegant syntax. It provides a robust set of tools for common tasks like routing, authentication, and caching. Its architecture promotes clean and maintainable code, making it a popular choice for developers aiming to create scalable applications efficiently.",
            ],
            [
                'title' => 'Understanding Database Migrations',
                'body' => "Database migrations are a way to version control your database schema. Laravel makes it easy to create and manage migrations with simple commands, allowing you to keep track of changes and ensure consistency across different environments. This feature is crucial for collaborative projects, as it helps synchronize database changes among team members seamlessly.",
            ],
            [
                'title' => 'Building APIs with Laravel',
                'body' => "Laravel offers powerful tools for building APIs, including support for RESTful routing, authentication, and request validation. By using Laravel’s API resources and routes, you can quickly create robust and scalable APIs for your applications. The framework's built-in features simplify tasks like authentication and rate limiting, ensuring your API is both secure and efficient.",
            ],
            [
                'title' => 'Mastering Eloquent ORM',
                'body' => "Eloquent ORM is Laravel’s built-in ORM that provides an elegant and expressive way to interact with your database. It allows you to define models, relationships, and query your database using a fluent and intuitive syntax. Eloquent’s capabilities enhance productivity by reducing the need for raw SQL queries and making data manipulation straightforward.",
            ],
            [
                'title' => 'Testing Laravel Applications',
                'body' => "Testing is a critical part of software development. Laravel provides a comprehensive testing suite that includes support for unit tests, feature tests, and browser tests, helping you ensure the reliability and functionality of your applications. By writing tests, you can catch bugs early and verify that your code behaves as expected across different scenarios.",
            ],
            [
                'title' => 'Securing Laravel Applications',
                'body' => "Security is a fundamental aspect of web development, and Laravel offers numerous tools to help secure your applications. Features such as encryption, CSRF protection, and validation rules contribute to safeguarding your application from common vulnerabilities. Leveraging these built-in security measures helps protect user data and maintain the integrity of your application.",
            ],
            [
                'title' => 'Optimizing Laravel Performance',
                'body' => "Performance optimization is essential for delivering fast and responsive web applications. Laravel provides various tools and techniques for performance enhancement, including caching, query optimization, and efficient use of database indexes. Implementing these strategies can significantly improve the speed and scalability of your Laravel applications.",
            ],
            [
                'title' => 'Integrating Laravel with Frontend Frameworks',
                'body' => "Integrating Laravel with frontend frameworks like Vue.js or React can enhance the user experience by creating dynamic and interactive interfaces. Laravel’s support for frontend scaffolding and API routes simplifies the process of building full-stack applications. Combining Laravel with modern JavaScript frameworks enables you to create powerful and engaging web applications.",
            ],
        ];

        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'title' => $post['title'],
                'body' => $post['body'],
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
