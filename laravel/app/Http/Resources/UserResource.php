<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Intervention\Image\ImageManagerStatic as ImageManager;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $images = $this->images;
        foreach($images as &$image){
            $dataUrlImg = ImageManager::make(Storage::get($image->path))
                ->resize(null, 200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('data-url');

            $image->data_url = (string) $dataUrlImg;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'administrador' => $this->administrador,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'images' => $images->sortByDesc('created_at')->toArray()
        ];
    }
}