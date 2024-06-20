<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function indexhome()
    {
        $slides = Slide::all();
        return view('home', compact('slides'));
    }
    public function index()
    {
        $slides = Slide::all();
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'link' => 'nullable|url',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Slide::create([
            'image' => $imagePath,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.slides.index')->with('success', 'Слайд успешно создан.');
    }

    public function destroy(Slide $slide)
    {
        Storage::disk('public')->delete($slide->image);

        $slide->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Слайд успешно удален.');
    }
}
