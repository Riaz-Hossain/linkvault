<?php

namespace App\Http\Controllers;

use App\Models\Bookmark; 
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookmarks = Bookmark::where('user_id', auth()->id())->get(); // Get only the bookmarks for the logged-in user
        return view('bookmarks.index', compact('bookmarks'));
    }

    // We will fill out create, store, edit, update, and destroy later!


    // 1. Show the form to the user
    public function create()
    {
        return view('bookmarks.create');
    }

    // 2. Save the data the user sent
    public function store(Request $request)
    {

        // Ensure the URL starts with http:// or https://
        $url = $request->input('url');

        if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://')) {
        $url = 'http://' . $url;
        }

        $request->merge(['url' => $url]);

        // Basic validation
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        // Create the bookmark
        Bookmark::create([
            'user_id' => auth()->id(),
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('bookmarks.index')
        ->with('success', 'Bookmark created successfully');
    }


    public function update(Request $request, Bookmark $bookmark)
    {
        // Basic validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        // Update the bookmark
        $bookmark->update($validated);

        // Send the user back to the list
        return back()->with('success', 'Bookmark updated successfully');
    }

    public function destroy(Bookmark $bookmark)
    {
        // Laravel automatically finds the bookmark by the ID passed in the URL
        $bookmark->delete();

        // After deleting, go back to the list
        return redirect()->route('bookmarks.index')->with('success', 'Bookmark deleted successfully');
    }


}