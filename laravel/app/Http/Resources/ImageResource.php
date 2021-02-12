<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Intervention\Image\ImageManagerStatic as ImageManager;
use Illuminate\Support\Facades\Storage;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $dataUrlImg = ImageManager::make(Storage::get($this->path))
            ->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode('data-url');

        return [
            'id' => $this->id,
            'path' => $this->path,
            'data_url' => (string) $dataUrlImg,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}