<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 *
 * @package App
 * @property string $text
 * @property string $link
*/
class Menu extends Model
{
    protected $fillable = ['text', 'link','type','icon_id'];
    protected $hidden = [];
    public static $searchable = [ 'text'
    ];
    

    public static function getRecordWithId($id)
    {
        return Menu::where('id', '=', $id)->first();
    }

     public function icon()
    {
        return $this->belongsTo(Icon::class, 'icon_id')->withDefault();
    }

    
}
