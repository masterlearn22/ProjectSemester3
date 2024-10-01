<?php

namespace App\Http\Controllers;

use App\Models\PostingLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class LikeController extends Controller
{
    public function store(Request $request) {
        PostingLike::create([
            'like_id' => Str::random(30),
            'posting_id' => $request->posting_id,
            'id_user' => $request->id_user,
            'create_by' => Auth::user()->name,
        ]);

        return redirect()->route('postings.index')->with('success', 'Like berhasil ditambahkan!');
    }

    public function destroy($id) {
        $like = PostingLike::where('like_id', $id)->first();
        $like->update(['delete_mark' => '1']);

        return redirect()->route('postings.index')->with('success', 'Like berhasil dihapus!');
    }
}

