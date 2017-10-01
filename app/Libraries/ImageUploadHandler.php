<?php

namespace App\Libraries;

//use App\Models\User;
use Image;
//use Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Models\Trash;

use Illuminate\Support\Facades\Storage;
class ImageUploadHandler
{
    /**
     * @var UploadedFile $file
     */
    protected $file;
    protected $f;
    protected $allowed_extensions = ["png", "jpg", "gif", 'jpeg'];

    /**
     * @param UploadedFile $file
     * @param User $user
     * @return array
     */
    public function uploadAvatar($file , $f)
    {
        $this->file = $file;
        $this->f = $f;
        $this->checkAllowedExtensionsOrFail();

        $avatar_name = $f . '_' . md5(uniqid()) . '.' . $file->getClientOriginalExtension() ?: 'png';
        return $this->saveImageToLocal('avatar', 380, $avatar_name);

        //return ['filename' => $avatar_name];
    }

    public function uploadImage($file , $f)
    {
        $this->file = $file;
        $this->f = $f;
        $this->checkAllowedExtensionsOrFail();

        return $this->saveImageToLocal('fujian', 1440);
        //return ['filename' => get_user_static_domain() . $local_image];
    }

    protected function checkAllowedExtensionsOrFail()
    {
        $extension = strtolower($this->file->getClientOriginalExtension());
        if ($extension && !in_array($extension, $this->allowed_extensions)) {
            throw new \Exception('You can only upload image with extensions: ' . implode($this->allowed_extensions, ','));
        }
    }

    protected function saveImageToLocal($type, $resize ,$filename = '')
    {
        $folderName = ($type == 'avatar')
            ? 'uploads/avatars'
            : 'uploads/images/' . date("Ym", time()) .'/'.date("d", time()) .'/'. $this->f;

        //$destinationPath = asset('storage'.$folderName); //public_path() . '/' . $folderName;

        $extension = $this->file->getClientOriginalExtension() ?: 'png';
        $safeName  = $filename ? : md5(uniqid()) . '.' . $extension;


        //$this->file->move($destinationPath, $safeName);

          $path = Storage::putFileAs(
              $folderName, $this->file, $safeName
          );
          $local_path = Storage::path($path);

        if ($this->file->getClientOriginalExtension() != 'gif') {
            $img = Image::make($local_path);
            $img->resize($resize, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save();
        }
        $local_image = '/storage/'.$path;
        //$this->saveTrash($local_image);
        return  $local_image;
    }

    public function saveTrash($local_image,int $id , $type){
      try {
        Trash::create(['body'=>$local_image ,'trashestable_id'=>$id,'trashestable_type'=>$type]);
      } catch (\Exception $e) {
        $realpath = str_replace('/storage/','',$local_image);
        Storage::delete($realpath);
        throw new \Exception( $e->getMessage() );
      }

    }
}
