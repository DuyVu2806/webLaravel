<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $title = 'Bình luận';
        $comm = Comment::orderBy('created_at','DESC')->get();
        $count = Comment::count();
        return view('admin.comment.list',compact('title','comm','count'));
    }
}
