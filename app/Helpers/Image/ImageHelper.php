<?php

class ImageHelper
{
    public function storeFile($file, $path)
    {
        if($file->file){
            $name           = time() . $file->file->getClientOriginalName();
            $route          = public_path($path);

            $file->file('file')->move($route, $name);
        }
    }
}
