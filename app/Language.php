<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Language
 *
 * @package App
 * @property string $language
 * @property string $code
 * @property enum $is_rtl
*/
class Language extends Model
{
   

    protected $fillable = ['language', 'code', 'is_rtl'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    public static $enum_is_rtl = ["Yes" => "Yes", "No" => "No"];

    /**
    * [This method is used to get the language phrase based on default language with specific key, If key is not available, it will add new key to db and inserts an english key and returns an english string as language key ]
    * @param  [type] $key [Language Key]
    * @return [type]      [description]
    */
    public static function getPhrase($key)
    {
        return trans( 'custom.settings.' . $key );
    }
    
}
