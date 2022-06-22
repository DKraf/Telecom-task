<?php
/**
 * @author REDHEAD-DEV => Kravchenko Dmitriy
 */
namespace App\Http\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SaveImage
{
    /**
     * Метод сохраняет полученное изображение
     *
     * @param string $image_64
     * @return string
     */
    public static function upload(string $image_64): string
    {
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = 'image-'. rand(1, 100).uniqid().'.'.$extension;

        Storage::disk('public')->put($imageName, base64_decode($image));

        return $imageName;
    }
}
