<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageManager;


class ImageController extends Controller
{
    public function download(Request $request)
    {
        $image = Image::findOrFail($request->id);
        return Storage::download($image->path);
    }

    public function apagar(Request $request)
    {
        try {
            $image = Image::findOrFail($request->id);
            Storage::delete($image->path);
            $image->delete();

            return response()->json([
                "success" => true,
                "message" => "Arquivo excluido com sucesso.",
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "success" => true,
                "message" => "Imagem não existe.",
            ]);
        }
    }

    public function consultar(Request $request)
    {
        try {
            return response()->json([
                "success" => true,
                "image" => new ImageResource(Image::findOrFail($request->id))
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "success" => true,
                "message" => "Imagem não existe.",
            ]);
        }
    }

    public function list(Request $request)
    {
        return response()->json([
            "success" => true,
            "list" => ImageResource::collection(Image::all())
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:png,jpg'
        ]);

        if ($file = $request->file('file')) {

            //store file into document folder
            $path = $request->file->store('public/images');

            // $img = ImageManager::make($file->path());
            // $img->width(200);
            // $img->save('public/images/'.$file->getClientOriginalName());
            
            //store your file into database
            $image = new Image();
            $image->path = $path;
            $image->mime_type = $file->getMimeType();
            $image->name = $file->getClientOriginalName();
            $image->user_id = $request->user()->id;
            $image->save();

            return response()->json([
                "success" => true,
                "message" => "Arquivo enviado com sucesso.",
                "file" => $image
            ]);
        }
        return response()->json([
            "success" => false,
            "message" => "Erro no parametro file.",
        ], 400);
    }
}
