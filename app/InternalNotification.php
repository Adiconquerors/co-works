<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternalNotification
 *
 * @package App
 * @property string $text
 * @property string $link
*/
class InternalNotification extends Model
{
    protected $fillable = ['text', 'link'];
    protected $hidden = [];
    public static $searchable = [ 'text'
    ];
    

    public static function getRecordWithId($id)
    {
        return InternalNotification::where('id', '=', $id)->first();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'internal_notification_user');
    }
    
}
