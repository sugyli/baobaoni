<?php

namespace App\Models;


class Message extends Model
{
    protected $table = 'jieqi_system_message';
    protected $primaryKey = 'messageid';
    public $timestamps = false;
    //protected $guarded = ['messageid'];

    /*
    public function images()
    {
        return $this->hasMany(Image::class ,'relation_id' ,'messageid');
    }
    */
    public function collectImages()
    {
        // For update topic logic
        //$this->images()->delete();

        $links = get_images_from_html($this->content);

        if (count($links)) {
          foreach ($links as $key => $value) {
            $value = trim($value);
            /*
            $data = [
                'relation_id' => $this->messageid,
                'link' => $value,
            ];
            */

            Trash::where('body',$value)
                  ->delete();
            //Image::updateOrCreate($data, $data);
          }
          //  $link = array_shift($links);
        }
    }


    public function markAsRead()
    {
        if($this->isread <= 0) {
            $this->forceFill(['isread' => 1])->save();
        }
    }

    public function getFromnameAttribute($value)
    {
        return empty($value) ? '管理员' : $value;
    }
    public function getTonameAttribute($value)
    {
        return empty($value) ? '管理员' : $value;
    }
    public function getContentAttribute($value)
    {
        return \Purifier::clean($value,'default');
    }

    public function getTitleAttribute($value)
    {
        return t($value);
    }
}
