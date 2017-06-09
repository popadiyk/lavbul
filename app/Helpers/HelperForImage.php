<?php


class HelperForImage {
    public static function storeImage($image, $name){
        $data = $image;
        list(, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);
        $imageName = $name.'.jpg';
        $path = 'products_photo/'.$imageName;

        file_put_contents($path, $data);
        $img = Image::make($path);
        $img->save($path);

        return '/'.$path;
    }

    public static function whatImage($path){
        if (strpos($path, '(1)') != false){
            return 1;
        }
        
        if (strpos($path, '(2)') != false){
            return 2;
        }
    }
}