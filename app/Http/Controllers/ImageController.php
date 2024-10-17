<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $query = Image::query();
        // // Pencarian berdasarkan nama atau jenis kelamin jika diperlukan
        // if ($request->has('search')) {
        //     $search = $request->input('search');
        //     $query->where(function ($q) use ($search) {
        //         $q->where('image_name', 'like', "%{$search}%");
        //     });
        // }
        $images = $query->paginate(10);
        return view("images.images-table", compact('images'));
    }

    public function create()
    {
        // Menampilkan form tambah gambar
        return view("images.add-images");
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_name' => 'required|string',
        ]);

        if ($request->hasFile('image_path')) {
            // Mengunggah gambar
            $image = $request->file('image_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');

            // Debugging: cek apakah path sudah terisi setelah gambar diunggah
            // dd($imagePath);

            // Menyimpan informasi gambar ke database
            Image::create([
                'image_name' => $request->input('image_name'),
                'image_path' => $imagePath,
            ]);

            return redirect()->route('images.index')->with('success', 'Image uploaded successfully.');
        } else {
            // Jika tidak ada gambar yang diunggah, kembalikan pesan kesalahan
            return redirect()->back()->with('error', 'No image uploaded.');
        }
    }

    public function show($id)
    {
        $image = Image::findOrFail($id); // Mencari gambar berdasarkan ID
        return view('images.add-images', compact('image')); // Mengembalikan view dengan data gambar
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id); // Mencari gambar berdasarkan ID
        return view('images.edit', compact('image')); // Mengembalikan view untuk mengedit gambar
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'image_name' => 'required|string',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Menyimpan informasi gambar ke database
        $imageModel = Image::findOrFail($id);
        $imageModel->image_name = $request->input('image_name');
        // Jika ada gambar baru yang diunggah
        if ($request->hasFile('image_path')) {
            $newImage = $request->file('image_path');
            $imageName = time() . '.' . $newImage->getClientOriginalExtension();
            $imagePath = $newImage->storeAs('images', $imageName, 'public');
            $imageModel->image_path = $imagePath;
        }
        $imageModel->save();
        return redirect()->route('images.index')->with('success', 'Image updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $image = Image::findOrFail($id);
            $image->delete();
            return redirect()->route('images.index')->with('success', 'Image deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('images.index')->with('error', 'Failed to delete image: ' . $e->getMessage());
        }
    }
}
