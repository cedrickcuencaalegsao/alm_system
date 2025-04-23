<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
            'image' => null,
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
            'isDeleted' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create 5 regular users
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
            [
                'firstname' => 'Robert',
                'lastname' => 'Johnson',
                'email' => 'robert.johnson@example.com',
                'address' => '101 Pine Road',
                'contactnumber' => '9123456792',
            ],
            [
                'firstname' => 'Emily',
                'lastname' => 'Williams',
                'email' => 'emily.williams@example.com',
                'address' => '202 Maple Lane',
                'contactnumber' => '9123456793',
            ],
            [
                'firstname' => 'Michael',
                'lastname' => 'Brown',
                'email' => 'michael.brown@example.com',
                'address' => '303 Cedar Blvd',
                'contactnumber' => '9123456794',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'userID' => 'USR'.Str::random(12),
                'isAdmin' => false,
                'email' => $user['email'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'address' => $user['address'],
                'contactnumber' => $user['contactnumber'],
                'image' => null,
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'isDeleted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $categories = ['Fiction', 'Non-Fiction', 'Science', 'Technology', 'History', 'Biography', 'Fantasy', 'Romance'];
        $authors = ['J.K. Rowling', 'Stephen King', 'George Orwell', 'Agatha Christie', 'Ernest Hemingway', 'Jane Austen', 'Mark Twain', 'Leo Tolstoy'];

        // Create 50 books for more variety
        for ($i = 1; $i <= 50; $i++) {
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
                'stocks' => rand(5, 1000),
                'bookcategory' => $category,
                'datepublish' => "$year-$month-$day",
                'image' => null,
                'bookprice' => rand(100, 1000) + (rand(0, 99) / 100),
                'isDeleted' => false,
                'createdAt' => now()->toDateTimeString(),
                'updatedAt' => now()->toDateTimeString(),
            ]);
        }

        // Get existing user IDs and book IDs
        $userIDs = DB::table('users')->where('isAdmin', false)->pluck('userID')->toArray();
        $bookIDs = DB::table('tbl_books')->pluck('bookID')->toArray();

        // Create 20 cart items - exclude admin
        for ($i = 1; $i <= 20; $i++) {
            $userID = $userIDs[array_rand($userIDs)];
            $bookID = $bookIDs[array_rand($bookIDs)];

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

        // Create sales data for the last 36 months with varying transaction counts
        $successStatuses = ['delivered', 'processing', 'delivering'];
        $failedStatuses = ['cancelled', 'pending'];

        for ($monthOffset = 0; $monthOffset < 36; $monthOffset++) {
            $startDate = Carbon::now()->subMonths($monthOffset)->startOfMonth();
            $endDate = Carbon::now()->subMonths($monthOffset)->endOfMonth();

            // Random number of transactions per month (between 15-50)
            $transactionsThisMonth = rand(15, 50);

            for ($i = 1; $i <= $transactionsThisMonth; $i++) {
                $userID = $userIDs[array_rand($userIDs)];
                $book = $books->random();
                $quantity = rand(1, 5);

                // 95% success rate
                $status = (rand(1, 100) <= 95)
                    ? $successStatuses[array_rand($successStatuses)]
                    : $failedStatuses[array_rand($failedStatuses)];

                $tax = $book->bookprice * $quantity * 0.12;
                $totalSales = ($book->bookprice * $quantity) + $tax;

                // Random date within the month with time
                $transactionDate = Carbon::createFromTimestamp(
                    rand($startDate->timestamp, $endDate->timestamp)
                )->toDateTimeString();

                DB::table('tbl_sales')->insert([
                    'salesID' => 'SLS'.Str::random(12),
                    'userID' => $userID,
                    'bookID' => $book->bookID,
                    'refID' => 'REF'.Str::random(12),
                    'quantity' => $quantity,
                    'status' => $status,
                    'tax' => $tax,
                    'totalsales' => $totalSales,
                    'isDeleted' => false,
                    'createdAt' => $transactionDate,
                    'updatedAt' => $transactionDate,
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