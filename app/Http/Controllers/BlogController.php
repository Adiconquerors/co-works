<?php

namespace App\Http\Controllers;

use App\SpaceType;
use Illuminate\Http\Request;

use App\Notifications\WL_EmailNotification;

use Notification;


class BlogController extends Controller
{

	

    public function blog(  $sub_space_type_id = '' )
    {

     $records = \App\Article::with(['sub_space_type'])->orderBy('created_at', 'desc')->paginate(6);

    if ( ! empty( $sub_space_type_id )  ) {
      
       $records = \App\Article::where( 'sub_space_type_id', $sub_space_type_id )->paginate(6);


    }

      return view('home-pages.blog',compact('records'));
    }


     public function eachArticle( $id )
    {

      $records = \App\Article::where('id', '=', $id)->first();

      return view('home-pages.eacharticle',compact('records'));
    }

     public function listBlog( $slug )
    {

      $records = \App\Article::where( 'sub_space_type_id', $slug )->paginate(3);

      return view('home-pages.blog',compact('records'));
    }

    public function getBlogs(Request $request) {
      $term = $request->term;
      if ( ! empty( $term ) ) {
        $records = \App\Article::where( 'name', 'like', "%$term%" )->take(10)->get();
      } else {
        $records = \App\Article::orderBy('created_at')->take(10)->get();
      }

      $final_records = [];
      if( $records->count() > 0 ) {
        foreach ($records as $record) {

          $final_records[] = [
            'label' => $record->name,
            'value' => $record->id,
          ];
        }
      }
      return json_encode($final_records);
    }

    //Subscribe to Newsletter
      public function subscribeToNewsLetter(Request $request)
    {

        if (request()->ajax())
        {

            $email = request('email');

                 //Multiple emails to the admin
         $admins   = \App\User::whereHas("roles",
              function ($query) {
                  $query->where('id', ADMIN_ROLE_ID);
              })->get();
        
            $site_logo = getSetting( 'site_logo', 'site_settings' );
            $country_code = getSetting('country_code','site_settings');

              $templatedata = array(
                    'email' => $email,
                    'content' => 'Subscriber To NewsLetter',

                    'site_address' => getSetting( 'site_address', 'site_settings'),
                    'site_phone' => getSetting( 'site_phone', 'site_settings'),
                    'site_email' => getSetting( 'contact_email', 'site_settings'),                
                    'site_title' => getSetting( 'site_title', 'site_settings'),
                    'country_code' => $country_code,
                    'site_logo' => asset( 'uploads/settings/' . $site_logo ),
                    'date' => date('Y-m-d'),
                    'site_url' => config('app.url'),
                     
                  );
            $data = [
                     "crud_name" => "User",
                      'template' => 'news-letter-subscriber-admin',
                      'model' => 'App\Blog',
                      'data' => $templatedata,
                  ];
              $notification = new WL_EmailNotification($data);
              Notification::send($admins, $notification);
             

           if( $email )
           {

            $action = 'news-letter-subscriber-customer';
            $data['toemail'] = $email;

                $site_logo = getSetting( 'site_logo', 'site_settings' );
                $country_code = getSetting('country_code','site_settings');

                $data[ 'site_address' ] = getSetting( 'site_address', 'site_settings');
                $data[ 'site_phone' ] = getSetting( 'site_phone', 'site_settings');
                $data[ 'site_email' ] = getSetting( 'contact_email', 'site_settings');                
                $data[ 'site_title' ] = getSetting( 'site_title', 'site_settings');
                $data[ 'country_code' ] = $country_code;
                $data[ 'site_logo' ] = asset( 'uploads/settings/' . $site_logo );
                $data[ 'date' ] = date('Y-m-d');
                $data[ 'site_url' ] = config('app.url');
  

               $res = sendEmail($action, $data);
                
              return response()->json(['success' => 'Mail Sent Successfully!','not_found' => 'Email not found']);   

           }

       

        }
    }
    //End SubScribe to newsletter

}