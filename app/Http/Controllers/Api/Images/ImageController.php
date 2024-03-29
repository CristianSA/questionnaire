<?php

namespace App\Http\Controllers\Api\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image\Image;
use App\Models\Project\Project;

class ImageController extends Controller
{
    public function storeFile($file, $path)
    {
        if($file->file){
            $name           = time() . $file->file->getClientOriginalName();
            $route          = public_path($path);

            $file->file('file')->move($route, $name);
        }
    }


    public function store(Request $request)
    {
        //save file image
        $url = null;
        $file_path = "/images/".$request->imageable_id."/".$request->type."/";
        //$this->storeFile($request->file, $path);
        if($request->file){
            $file_name = time() .'_'.$request->file->getClientOriginalName();

            $url       = $file_path.$file_name;
            $route     = public_path($file_path);
            $request->file('file')->move($route, $file_name);
        }

        //save info
        $image                          = new Image();
        $image->title                   = $request->title;
        $image->description             = $request->description;
        $image->path                    = $url ? $url : null;
        $image->type                    = $request->type;
        $image->imageable_id            = $request->imageable_id;
        $image->imageable_type          = $request->imageable_type;
        $image->save();

        return $image;
    }

    public function update(Image $image, Request $request)
    {
        if($request->file){
            $file_name = time() .'_'.$request->file->getClientOriginalName();
            $file_path = "/images/".$request->imageable_id."/".$request->type."/";
            $url       = $file_path.$file_name;
            $route     = public_path($file_path);
            $storage = $request->file('file')->move($route, $file_name);
        }

        $image->title = $request->title;
        $image->description = $request->description;
        $image->path = $request->path;
        $image->type = $request->type;
        $image->save();

        return $image;
    }

    public function delete(Image $image)
    {
        //remove path
        unlink(public_path($image->path));

        $image->delete();
    }

    public function imageProject(Project $project)
    {
        return $project->images;
    }
}
