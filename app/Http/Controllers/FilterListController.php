<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class FilterListController extends Controller
{
    public function listBook(){
        $bookWithHighestRating = Book::select('books.id', 'books.name')
        ->leftJoin('ratings', 'ratings.book_id', '=', 'books.id')
        ->selectRaw('books.id, books.name, AVG(ratings.rating) as average_rating')
        ->groupBy('books.id', 'books.name')
        ->orderByDesc('average_rating')
        ->first();
        return view('list-filter', [
            'books'=> $bookWithHighestRating
        ]);

    }
}
