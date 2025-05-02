<?php

namespace App\Http\Controllers;

use App\Models\Haircut;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HaircutController extends Controller
{
    // Menyimpan layanan baru
    public function store(Request $request)
    {
        try {
            // Validasi data yang diterima
            $data = $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|numeric',
            ]);

            // Membuat layanan baru
            $haircut = Haircut::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
            ]);

            return response()->json($haircut, 201); // Status code 201 Created
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create haircut service', 'error' => $e->getMessage()], 400);
        }
    }

    // Mengambil daftar semua layanan
    public function index()
    {
        try {
            $haircuts = Haircut::all();  // Mengambil semua data layanan
            if ($haircuts->isEmpty()) {
                return response()->json(['message' => 'No haircut services found'], 404);  // Status code 404 Not Found
            }
            return response()->json($haircuts);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve haircuts', 'error' => $e->getMessage()], 500);
        }
    }

    // Mengambil data layanan berdasarkan ID
    public function show($id)
    {
        try {
            $haircut = Haircut::find($id);  // Mencari layanan berdasarkan ID

            if (!$haircut) {
                return response()->json(['message' => 'Haircut not found'], 404); // Status code 404 Not Found
            }

            return response()->json($haircut);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Haircut not found', 'error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve haircut', 'error' => $e->getMessage()], 500);
        }
    }

    // Mengupdate data layanan
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'name' => 'sometimes|required|string',
                'description' => 'sometimes|required|string',
                'price' => 'sometimes|required|numeric',
            ]);

            $haircut = Haircut::findOrFail($id); // Mencari layanan berdasarkan ID, jika tidak ada akan menghasilkan error 404
            $haircut->update($data);

            return response()->json($haircut);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Haircut not found', 'error' => $e->getMessage()], 404); // Status code 404 Not Found
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update haircut', 'error' => $e->getMessage()], 400); // Bad Request
        }
    }

    // Menghapus layanan
    public function destroy($id)
    {
        try {
            $haircut = Haircut::findOrFail($id); // Mencari layanan berdasarkan ID, jika tidak ada akan menghasilkan error 404
            $haircut->delete();

            return response()->json(['message' => 'Haircut deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Haircut not found', 'error' => $e->getMessage()], 404); // Status code 404 Not Found
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete haircut', 'error' => $e->getMessage()], 500); // Internal Server Error
        }
    }
}
