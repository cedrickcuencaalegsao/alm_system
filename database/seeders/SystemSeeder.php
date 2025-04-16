<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=SystemSeeder
     */
    public function run(): void
    {
        // Create admin user
        DB::table('users')->insert([
            'userID' => 'ADM'.Str::random(12),
            'isAdmin' => true,
            'email' => 'admin@example.com',
            'firstname' => 'Admin',
            'lastname' => 'User',
            'address' => '123 Admin Street, Admin City',
            'contactnumber' => '9123456789',
            'image' => 'admin-profile.jpg',
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
            'isDeleted' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create 2 regular users
        $users = [
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'john.doe@example.com',
                'address' => '456 Main Street',
                'contactnumber' => '9123456790',
            ],
            [
                'firstname' => 'Jane',
                'lastname' => 'Smith',
                'email' => 'jane.smith@example.com',
                'address' => '789 Oak Avenue',
                'contactnumber' => '9123456791',
            ],
        ];

        foreach ($users as $index => $user) {
            DB::table('users')->insert([
                'userID' => 'USR'.Str::random(12),
                'isAdmin' => false,
                'email' => $user['email'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'address' => $user['address'],
                'contactnumber' => $user['contactnumber'],
                'image' => 'user-'.($index + 1).'.jpg',
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'isDeleted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $categories = ['Fiction', 'Non-Fiction', 'Science', 'Technology', 'History', 'Biography', 'Fantasy', 'Romance'];
        $authors = ['J.K. Rowling', 'Stephen King', 'George Orwell', 'Agatha Christie', 'Ernest Hemingway', 'Jane Austen', 'Mark Twain', 'Leo Tolstoy'];

        for ($i = 1; $i <= 20; $i++) {
            $category = $categories[array_rand($categories)];
            $author = $authors[array_rand($authors)];
            $year = rand(2000, 2023);
            $month = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
            $day = str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);

            DB::table('tbl_books')->insert([
                'bookID' => 'BK'.strtoupper(Str::random(12)),
                'bookname' => $this->generateBookTitle($category),
                'bookdetails' => $this->generateBookDescription(),
                'author' => $author,
                'stocks' => rand(5, 100),
                'bookcategory' => $category,
                'datepublish' => "$year-$month-$day",
                'image' => 'book-'.$i.'.jpg',
                'bookprice' => rand(100, 1000) + (rand(0, 99) / 100),
                'isDeleted' => false,
                'createdAt' => now()->toDateTimeString(),
                'updatedAt' => now()->toDateTimeString(),
            ]);
        }

        // Get existing user IDs and book IDs
        $userIDs = DB::table('users')->pluck('userID')->toArray();
        $bookIDs = DB::table('tbl_books')->pluck('bookID')->toArray();

        // Create 10 cart items
        for ($i = 1; $i <= 10; $i++) {
            $userID = $userIDs[array_rand($userIDs)];
            $bookID = $bookIDs[array_rand($bookIDs)];
            $bookPrice = DB::table('tbl_books')
                ->where('bookID', $bookID)
                ->value('bookprice');

            DB::table('tbl_cart')->insert([
                'cartID' => 'CRT'.Str::random(12),
                'userID' => $userID,
                'bookID' => $bookID,
                'isDeleted' => false,
                'createdAt' => now()->toDateTimeString(),
                'updatedAt' => now()->toDateTimeString(),
            ]);
        }

        // Get all books
        $books = DB::table('tbl_books')->get();

        // Create 3 sales for each book
        foreach ($books as $book) {
            for ($i = 1; $i <= 3; $i++) {
                $userID = $userIDs[array_rand($userIDs)];
                $quantity = rand(1, 3);
                $statuses = ['pending', 'delivered', 'delivering', 'cancelled'];
                $status = $statuses[array_rand($statuses)];
                $tax = $book->bookprice * $quantity * 0.12; // Assuming 12% tax
                $totalSales = ($book->bookprice * $quantity) + $tax;

                DB::table('tbl_sales')->insert([
                    'salesID' => 'SLS'.Str::random(12),
                    'userID' => $userID,
                    'bookID' => $book->bookID,
                    'quantity' => $quantity,
                    'booksold' => $quantity,
                    'status' => $status,
                    'tax' => $tax,
                    'totalsales' => $totalSales,
                    'isDeleted' => false,
                    'createdAt' => now()->toDateTimeString(),
                    'updatedAt' => now()->toDateTimeString(),
                ]);
            }
        }
    }

    private function generateBookTitle($category)
    {
        $prefixes = [
            'Fiction' => ['The Last', 'A Tale of', 'The Secret', 'Beyond the'],
            'Non-Fiction' => ['Understanding', 'The Complete Guide to', 'Exploring'],
            'Science' => ['Principles of', 'Advances in', 'The Science of'],
            'Technology' => ['Mastering', 'The Future of', 'Essential'],
            'History' => ['A History of', 'The Rise and Fall of', 'Chronicles of'],
            'Biography' => ['The Life of', 'Memoirs of', 'The Story of'],
            'Fantasy' => ['The Legend of', 'The Sword of', 'The Kingdom of'],
            'Romance' => ['Love in', 'Forever', 'The Heart of'],
        ];

        $suffixes = [
            'Fiction' => ['Forgotten Kingdom', 'Lost Time', 'Hidden Truth', 'Silent Echo'],
            'Non-Fiction' => ['Modern World', 'Human Mind', 'Global Economy'],
            'Science' => ['Quantum Physics', 'Molecular Biology', 'Astrophysics'],
            'Technology' => ['Artificial Intelligence', 'Blockchain', 'Cybersecurity'],
            'History' => ['Ancient Civilizations', 'World Wars', 'Great Empires'],
            'Biography' => ['a Genius', 'an Icon', 'a Visionary'],
            'Fantasy' => ['the Dark Lord', 'Eternal Fire', 'Ancient Prophecy'],
            'Romance' => ['Paris', 'the Storm', 'Destiny'],
        ];

        $prefix = $prefixes[$category][array_rand($prefixes[$category])];
        $suffix = $suffixes[$category][array_rand($suffixes[$category])];

        return "$prefix $suffix";
    }

    private function generateBookDescription()
    {
        $descriptions = [
            'A groundbreaking work that explores new frontiers in its field.',
            'This compelling narrative weaves together multiple storylines into a cohesive whole.',
            'An essential read for anyone interested in this subject matter.',
            "The author's masterpiece, representing years of research and insight.",
            'A timeless classic that continues to resonate with readers today.',
            'This edition includes new material not found in previous versions.',
            'A controversial but thought-provoking examination of its topic.',
            'Beautifully written with vivid descriptions and memorable characters.',
        ];

        return $descriptions[array_rand($descriptions)];
    }
}
