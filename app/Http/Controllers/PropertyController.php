<?php
namespace App\Http\Controllers;

use App\Property;
use App\SpaceType;
use App\Amenity;
use App\EmailTemplate;
use App\ContactHost;
use Auth;
use App\User;
use App\Enquire;
use DB;

use App\Notifications\WL_EmailNotification;
use Notification;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Mail;
use Validator;

use Illuminate\Support\Facades\Gate;

use App\Exports\PropertyExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class PropertyController extends Controller
{

    //use FileUploadTrait;
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $location = $request->input('location');

        $wstype = $request->input('wstype');
       
        if (empty($wstype))
        {
            $wstype = SPACE_TYPE_COWORKING;
        }
        $clear = 'no';
        $excludefilters = $filter_available_date = $filter_months = $filter_seats = $price_range_start = $price_range_end = $requestfrom = '';
        if (request()->ajax())
        {
            $location = request('location');
            $space_type = request('wstype');
            
            if ('all' === $space_type)
            {
                $space_type = ''; // To display all space types!
                
            }
            $clear = request('clear');
            if (empty($clear))
            {
                $clear = 'no';
            }
            $excludefilters = request('excludefilters');

            // More Filters
            $filter_available_date = request('filter_available_date');
            $filter_months = request('filter_months');
            $filter_seats = request('filter_seats');
            $price_range_start = request('price_range_start');
            $price_range_end = request('price_range_end');
            $requestfrom = request('requestfrom');

            // When zoom changed we are getting properties based on boundaries
            $displayingMarkers = request('displayingMarkers');

           
            $query = \App\Property::query();
            $query->where('is_approved', 'yes')
          
            
                ->with(['property_sub_space_types', 'property_amenities', 'property_timings']);

            if (!empty($displayingMarkers))
            {

                $query->when($location, function ($q, $location)
                {
                    $parts = explode(',', $location);

                    $country = $state = $city = $property_address_street_number = '';
                    $size = sizeof($parts) - 1;
                    for ($i = sizeof($parts);$i >= 0;$i--)
                    {
                        if ($i == $size)
                        {
                            $country = !empty($parts[$i]) ? $parts[$i] : '';
                        }
                        if ($i == $size - 1)
                        {
                            $state = !empty($parts[$i]) ? $parts[$i] : '';
                        }
                        if ($i == $size - 2)
                        {
                            $city = !empty($parts[$i]) ? $parts[$i] : '';
                        }
                        if ($i == $size - 3)
                        {
                            $property_address_street_number = !empty($parts[$i]) ? $parts[$i] : '';
                        }
                    }

                    if (!empty($country))
                    {
                        $q->where('property_address_country', trim($country));
                    }
                    if (!empty($state))
                    {
                        $q->where('property_address_state', trim($state));
                    }
                    if (!empty($city))
                    {
                        $q->where('property_address_city', trim($city));
                    }
                    if (!empty($property_address_street_number))
                    {
                        $q->where('property_address_street_number', trim($property_address_street_number));
                    }
                    return $q;
                });
              

                if (is_array($displayingMarkers))
                {
                    $query->whereIn('properties.id', $displayingMarkers);
                }
                else
                {
                    $query->where('properties.id', 0); // Cheating to hide all properties!
                    
                }
            }
            else
            {

                $query->when($location, function ($q, $location)
                {
                    return $q->where('properties.property_address', 'like', "%$location%");
                });

                $query->when($space_type, function ($q, $space_type)
                {
                    return $q->whereHas("property_sub_space_types", function ($query) use ($space_type)
                    {
                        $query->where('space_type_id', $space_type);
                    });
                });

              
                if (!empty($filter_seats))
                {
                    $query->join('property_sub_space_types as property_sub_space_types_seats', 'property_sub_space_types_seats.property_id', 'properties.id')
                        ->where('property_sub_space_types_seats.avaliable_seats', $filter_seats);
                }

                if (!empty($price_range_start) && !empty($price_range_end))
                {
                    $query->join('property_sub_space_types as property_sub_space_types_price', 'property_sub_space_types_price.property_id', 'properties.id')
                        ->where('property_sub_space_types_price.price_per_month', '>=', $price_range_start)->where('property_sub_space_types_price.price_per_month', '<=', $price_range_end);
                }

                $query->when($excludefilters, function ($q, $excludefilters)
                {
                    return $q->whereHas("property_sub_space_types", function ($query) use ($excludefilters)
                    {
                        $parts = explode(',', $excludefilters);
                        $query->whereNotIn('sub_space_type_id', $parts);
                    });
                });
            }

            
            $records = $query->paginate(PROPERTIES_PER_PAGE);

            return view('home-pages.explore-list', compact('records', 'location', 'wstype', 'clear', 'excludefilters', 'filter_available_date', 'filter_months', 'filter_seats', 'filter_seats', 'price_range_start', 'price_range_end', 'requestfrom'));

        }

        $query = \App\Property::where('is_approved', 'yes')
       
        ->with(['property_sub_space_types', 'property_amenities', 'property_timings']);
        if (!empty($location))
        {
            $parts = explode(',', $location);

            $country = $state = $city = $property_address_street_number = '';
            $size = sizeof($parts) - 1;
            for ($i = sizeof($parts);$i >= 0;$i--)
            {
                if ($i == $size)
                {
                    $country = $parts[$i];
                }
                if ($i == $size - 1)
                {
                    $state = !empty($parts[$i]) ? $parts[$i] : '';
                }
                if ($i == $size - 2)
                {
                    $city = !empty($parts[$i]) ? $parts[$i] : '';
                }
                if ($i == $size - 3)
                {
                    $property_address_street_number = !empty($parts[$i]) ? $parts[$i] : '';
                }
            }

            if (!empty($country))
            {
                $query->where('property_address_country', trim($country));
            }
            if (!empty(trim($state)))
            {
                $parts = explode(' ', trim($state));
                $query->where('property_address_state', trim($parts[0]));
            }
            if (!empty($city))
            {
                $query->where('property_address_city', trim($city));
            }
            if (!empty($property_address_street_number))
            {
                $query->where('property_address_street_number', trim($property_address_street_number));
            }
        }

        $query->when($wstype, function ($q, $wstype)
        {
            return $q->whereHas("property_sub_space_types", function ($query) use ($wstype)
            {
                $query->where('space_type_id', $wstype);
            });
        });

      
       
        $records = $query->paginate(PROPERTIES_PER_PAGE);
        
        return view('home-pages.property-explore', compact('records', 'location', 'wstype', 'clear', 'excludefilters', 'filter_available_date', 'filter_months', 'filter_seats', 'filter_seats', 'price_range_start', 'price_range_end', 'requestfrom'));

    }

    public function listingIndex(Request $request)
    {

        $title = trans('others.add-new-property');
        $active_class = trans('others.listings');
        $property_manager_name = request('property_manager_name');

        if (isAdmin())
        {
            $items = \App\Property::latest('updated_at')->paginate(PROPERTIES_PER_PAGE);
        }
        elseif(isAgent()){
            $items = \App\Property::where('is_approved','yes')->latest('updated_at')->paginate(PROPERTIES_PER_PAGE);
        }
        elseif (isCustomer())
        {
            $items = \App\Property::where('customer_id', Auth::id())->latest('updated_at')->paginate(PROPERTIES_PER_PAGE);
        }
        elseif (isLandLord())
        {
            $items = \App\Property::where('customer_id', Auth::id())->latest('updated_at')->paginate(PROPERTIES_PER_PAGE);
        }

        return view('admin.listings.list', compact('title', 'items', 'active_class', 'property_manager_name'));

    }

    //ListingSubType Index
    public function listingSubTypeIndex(Request $request)
    {

        $title = trans('others.add-new-property');
        $active_class = trans('others.listings');
        $property_manager_name = request('property_manager_name');
        if (isAdmin() || isAgent())
        {    
            $items = \App\PropertySubSpaceType::orderBy('property_id', 'ASC')->paginate(PROPERTIES_PER_PAGE);
        }
        elseif (isCustomer())
        {
            $items = \App\PropertySubSpaceType::where('customer_id', Auth::id())->paginate(PROPERTIES_PER_PAGE);
        }
        elseif (isLandLord())
        {
            $items = \App\PropertySubSpaceType::where('customer_id', Auth::id())->paginate(PROPERTIES_PER_PAGE);
        }

        return view('admin.listings.list', compact('title', 'items', 'active_class', 'property_manager_name'));

    }
    //End ListingSubType Index


    public function listingFilter(Request $request)
    {

        if (request()->ajax())
        {

            $property_manager_name = request('property_manager_name');
            $property_manager_email = request('property_manager_email');
            $property_address = request('property_address');
            $property_id = request('property_id');
            $space_type = request('space_type');
            $pagination_value = request('pagination_value');
            $active_class = 'listings';

            if (isAdmin())
            {
                $query = \App\Property::query();
            }elseif( isAgent() ){
                $query = \App\Property::query()->where('is_approved', 'yes');
            }
            elseif (isCustomer())
            {
                $query = \App\Property::query()->where('customer_id', Auth::id());
            }
            elseif (isLandLord())
            {
                $query = \App\Property::query()->where('customer_id', Auth::id());
            }

            $query->with(['property_sub_space_types', 'property_amenities', 'property_timings']);

            $query->when($property_manager_name, function ($q, $property_manager_name)
            {
                return $q->where('properties.property_manager_name', 'like', "%$property_manager_name%");
            });

            $query->when($property_manager_email, function ($q, $property_manager_email)
            {
                return $q->where('properties.property_manager_email', 'like', "%$property_manager_email%");
            });

            $query->when($property_address, function ($q, $property_address)
            {
                return $q->where('properties.property_address', 'like', "%$property_address%");
            });

            $query->when($property_id, function ($q, $property_id)
            {
                return $q->where('properties.id', 'like', "%$property_id%");
            });

            // space type
            $query->when($space_type, function ($q, $space_type)
            {
                return $q->whereHas("property_sub_space_types", function ($query) use ($space_type)
                {
                    $query->where('space_type_id', $space_type);
                });
            });
            // end space type
            if (isAdmin() || isAgent())
            {
                $items = $query->paginate($pagination_value);
            }
            elseif (isCustomer())
            {
                $items = $query->where('customer_id', Auth::id())
                    ->paginate($pagination_value);
            }
            elseif (isLandLord())
            {
                $items = $query->where('customer_id', Auth::id())
                    ->paginate($pagination_value);
            }

            

            return view('admin.listings.listing-list', compact('property_manager_name', 'property_manager_email', 'property_address', 'property_id', 'space_type', 'pagination_value', 'items', 'active_class'));

        }

    }

    public function create()
    {

        if ( isAdmin() || isAgent() || isLandLord())
        {

            $data = ['record' => false, 'active_class' => trans('others.listings'), 'agents' => \App\User::get()->whereIn('role_id', [1, 4])
                ->pluck('name', 'id') , 'title' => trans('others.add-new-property') ,

            ];

            return view('home-pages.property-add-edit', $data);
        }

        elseif (isCustomer() || isLandLord())
        {
            return view('home-pages.property');
        }

    }

    public function store(Request $request)
    {

         $rules = [
              'name'                 => 'required',
              'cotact_person_name'   => 'required',
              'phone_number'   => 'required',
              'email'   => 'required',
              'alter_email'   => 'nullable',
              'property_manager_name'   => 'required',
              'property_manager_email'   => 'required',
              'property_manager_number'   => 'required',
              'sub_space_type_id'   => 'required',
              'account_number'   => 'nullable',
              'pan_no'           => 'nullable',
          ];
        $selected_subtypes = $request->sub_space_type_id;
          $selected_days = $request->day_id;
          
             if (!empty($selected_days))
                    {
                        foreach ($selected_days as $day_id)              
                        list( $day_id ) = explode('_', $day_id);
                        {
                            $rules['time_from.' . $day_id] = 'required';
                            $rules['time_to.' . $day_id] = 'required';
                        }
                    }
            

        if(! empty($selected_subtypes)){
           foreach ($selected_subtypes as $sub_space_type_id) {
              list($space_id, $sub_space_type) = explode('_', $sub_space_type_id);
              if ( $sub_space_type == SUBSPACE_TYPE_VIRTUAL ) {
                  $rules['vo_reg_no.'.$sub_space_type] = 'required';
                  $rules['vo_mailing_address.'.$sub_space_type] = 'required';
              } else {
                  $rules['avaliable_seats.'.$sub_space_type] = 'required';
                  $rules['price_per_month.'.$sub_space_type] = 'required';
              }
           }
          }
        

          $request->validate( $rules );


        if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        

        // multiple files upload
        $record = new Property();



        $record->name = $request->name;
        $record->cotact_person_name = $request->cotact_person_name;
        $record->email = $request->email;
        $record->phone_number = $request->phone_number;
        $record->alter_cotact_person_name = $request->alter_cotact_person_name;
        $record->alter_email = $request->alter_email;
        $record->property_address = $request->property_address;
        $record->property_address_latitude = $request->property_address_latitude;
        $record->property_address_longitude = $request->property_address_longitude;
        if (!empty($request->property_address) && (empty($request->property_address_latitude) || empty($request->property_address_longitude)))
        {
            $latlng = get_google_location_reverse($request->property_address);
            if ($latlng)
            {
                $record->property_address_latitude = $latlng['latitude'];
                $record->property_address_longitude = $latlng['longitude'];
            }
        }

        $record->area = $request->area;
        $record->agent_id = $request->agent_id;
        $record->schedule_visit = 'yes';

        $record->capacity = $request->capacity;
        $record->cin_no = $request->cin_no;
        $record->gst = $request->gst;

        $record->property_address_street_number = $request->property_address_street_number;
        $record->property_address_city = $request->property_address_city;
        $record->property_address_state = $request->property_address_state;
        $record->property_address_country = $request->property_address_country;
        $record->property_addrress_postal_code = $request->property_addrress_postal_code;

       
        $record->near_by_landmark = $request->near_by_landmark;
        $record->near_by_landmark_latitude = $request->near_by_landmark_latitude;
        $record->near_by_landmark_longitude = $request->near_by_landmark_longitude;
        if (!empty($request->near_by_landmark) && (empty($request->near_by_landmark_latitude) || empty($request->near_by_landmark_longitude)))
        {
            $latlng = get_google_location_reverse($request->near_by_landmark);
            if ($latlng)
            {
                $record->near_by_landmark_latitude = $latlng['latitude'];
                $record->near_by_landmark_longitude = $latlng['longitude'];
            }
        }

        $record->no_of_workstation = $request->no_of_workstation;
        $record->no_of_private_office = $request->no_of_private_office;
        $record->no_of_meeting_office = $request->no_of_meeting_office;
        $record->no_of_training_office = $request->no_of_training_office;

        $record->alter_cotact_person_number = $request->alter_cotact_person_number;

        $record->offer_title = $request->offer_title;
        $record->description = $request->description;
        $record->property_manager_name = $request->property_manager_name;
        $record->property_manager_email = $request->property_manager_email;
        $record->property_manager_number = $request->property_manager_number;
        $record->company = $request->company;
        $record->pan_no = $request->pan_no;
        $record->billing_address = $request->billing_address;
        $record->registered_address = $request->registered_address;
        $record->bank_name = $request->bank_name;

        $record->account_holder_name = $request->account_holder_name;
        $record->account_number = $request->account_number;
        $record->ifsc_code = $request->ifsc_code;
        $record->is_approved = $request->is_approved;
        $record->customer_id = Auth::id();

    

        if ($request->hasfile('image'))
        {

            foreach ($request->file('image') as $file)
            {

                $image_name = $file->getClientOriginalName();
                $file->move(public_path() . '/thumb/', $image_name);
                $image_data[] = $image_name;
            }
        }

        $record->image = $request->image ? json_encode($image_data) : '-';

        $record->save();

        $this->processUpload($request, $record, "cover_image");

          $property_agent = \App\User::find($record->agent_id);
          $property_landlord = \App\User::find($record->customer_id);
          
      
        //Multiple emails to the admin
        $admins   = \App\User::whereHas("roles",
             function ($query) {
                 $query->where('id', ADMIN_ROLE_ID);
             })->get();

         $property_landlord = \App\User::find($record->customer_id);
        
            $logo = $record->cover_image ?? '';
            $site_logo = getSetting( 'site_logo', 'site_settings' );
            $country_code = getSetting('country_code','site_settings');

             $templatedata = array(
                     'property_name' => $record->name,
                     'content' => 'Property has been created',
                     'property_url' => route( 'properties.show', [ 'slug' => $record->slug ] ),
                     'property_address'=> $request->property_address,
                     'logo' => $logo,

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
                     "action" => "Created",
                     "crud_name" => "User",
                     'template' => 'property-created',
                     'model' => 'App\Property',
                     'data' => $templatedata,
                 ];
             $notification = new WL_EmailNotification($data);
             Notification::send($admins, $notification);
        // // end multiple emails to admin
        
        //  //Notify to the Landlord

         if($property_landlord){

                 $logo = $record->cover_image;

                 $templatedata = array(
                    'property_name' => $record->name,
                    'content' => 'Property has been created',
                    'property_url' => route( 'properties.show', [ 'slug' => $record->slug ] ),
                    'property_address'=> $request->property_address,
                    'logo' => $logo,

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
                         'template' => 'property-created',
                         'model' => 'App\Property',
                         'data' => $templatedata,
                    ];
                $property_landlord->notify(new WL_EmailNotification($data));   
         }    

        //End Notify to the Landlord             

           //Notify to the Agent

         if($property_agent){

                 $logo = $record->cover_image;

                 $templatedata = array(
                    'property_name' => $record->name,
                    'content' => 'Property has been created',
                    'property_url' => route( 'properties.show', [ 'slug' => $record->slug ] ),
                    'property_address'=> $request->property_address,
                    'logo' => $logo,

                     
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
                         'template' => 'property-created',
                         'model' => 'App\Property',
                         'data' => $templatedata,
                    ];
                $property_agent->notify(new WL_EmailNotification($data));   
         }    

        //End Notify to the Agent   
        
        $selected_space_types = [];

        $avaliable_seats = $request->avaliable_seats;
        $price_per_day = $request->price_per_day;
        $price_per_month = $request->price_per_month;

        $vo_reg_no = $request->vo_reg_no; // Virtual space has special fieds.
        $vo_mailing_address = $request->vo_mailing_address; // Virtual space has special fieds.
        if (!empty($request->sub_space_type_id))
        {

            foreach ($request->sub_space_type_id as $key => $value)
            {
                list($space_type_id, $sub_space_type_id) = explode('_', $value);
                $row = ['space_type_id' => $space_type_id, 'sub_space_type_id' => $sub_space_type_id, 'avaliable_seats' => (!empty($avaliable_seats[$sub_space_type_id])) ? $avaliable_seats[$sub_space_type_id] : null, 'price_per_day' => (!empty($price_per_day[$sub_space_type_id])) ? $price_per_day[$sub_space_type_id] : null, 'price_per_month' => (!empty($price_per_month[$sub_space_type_id])) ? $price_per_month[$sub_space_type_id] : null, ];
                if ($sub_space_type_id === SUBSPACE_TYPE_VIRTUAL)
                {
                    $row = ['space_type_id' => $space_type_id, 'sub_space_type_id' => $sub_space_type_id, 'vo_reg_no' => (!empty($vo_reg_no[$sub_space_type_id])) ? $vo_reg_no[$sub_space_type_id] : null, 'vo_mailing_address' => (!empty($vo_mailing_address[$sub_space_type_id])) ? $vo_mailing_address[$sub_space_type_id] : null,

                    ];
                }
                $selected_space_types[] = $row;
            }
        }

        //property timings
        $selected_timings = [];

        $time_from = $request->time_from;
        $time_to = $request->time_to;

        if (!empty($request->day_id))
        {
            foreach ($request->day_id as $key => $value)
            {
                list($day_id) = explode('_', $value);
                $row = ['day_id' => $day_id, 'time_from' => (!empty($time_from[$day_id])) ? $time_from[$day_id] : null, 'time_to' => (!empty($time_to[$day_id])) ? $time_to[$day_id] : null, ];
                $selected_timings[] = $row;
            }
        }

        $record->property_sub_space_types()
            ->sync($selected_space_types);

        $record->property_amenities()
            ->sync(array_filter((array)$request->input('amenity_id')));

        $record->property_timings()
            ->sync($selected_timings);


       $venues = array(
        'property_name' => $request->name,    
        'property_address' => $request->property_address,    
        'manager_name'  => $request->property_manager_name,
        'manager_email' => $request->property_manager_email,
        'manager_phone' => $request->property_manager_number,
        'slug' => $request->name.'-'.$request->id,

        );
        \App\Venue::create($venues);

        flashMessage( 'success', 'create' );    
        return redirect()->route('properties.index');

        
    }

    public function processUpload(Request $request, $record, $file_name)
    {
        if ($request->hasFile($file_name))
        {
            $path = public_path("thumb/coverimages/");

            $fileName = $record->id . '-' . $request
                ->$file_name->getClientOriginalName();
            $request->file($file_name)->move($path, $fileName);
            $record->cover_image = $fileName;

            $record->save();
        }
    }

    public function edit($slug, $sub_space_type_id)
    {
        $record = Property::getRecordWithSlug($slug);

         $sub_space_type = SpaceType::find($sub_space_type_id);
        
        return view('home-pages.single-page', compact('record','sub_space_type'));

    }

    public function propEdit($slug)
    {
        $record = Property::getRecordWithSlug($slug);

        $agents = \App\User::get()->whereIn('role_id', [1, 4])
            ->pluck('name', 'id');

        
        return view('home-pages.property-add-edit', compact('record', 'agents'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {


         $rules = [
              'name'                 => 'required',
              'cotact_person_name'   => 'required',
              'phone_number'   => 'required',
              'email'   => 'required',
              'alter_email'   => 'nullable',
              'property_manager_name'   => 'required',
              'property_manager_email'   => 'required',
              'property_manager_number'   => 'required',
              'account_number'   => 'nullable',
              'pan_no'           => 'nullable',
          ];

        if ($request->isMethod('put'))
        {

              
        }
    $record = Property::getRecordWithSlug($slug);
       
        $selected_subtypes = $request->sub_space_type_id;

        $selected_days = $request->day_id;

        if (!empty($selected_days))
        {
            foreach ($selected_days as $day_id)
            
            {
                $rules['time_from.' . $day_id] = 'required';
                $rules['time_to.' . $day_id] = 'required';
            }
        }

        if(! empty($selected_subtypes)){
         foreach ($selected_subtypes as $sub_space_type_id) {
            list($space_id, $sub_space_type) = explode('_', $sub_space_type_id);
            if ( $sub_space_type == SUBSPACE_TYPE_VIRTUAL ) {
                $rules['vo_reg_no.'.$sub_space_type] = 'required';
                $rules['vo_mailing_address.'.$sub_space_type] = 'required';
            } else {
                $rules['avaliable_seats.'.$sub_space_type] = 'required';
                $rules['price_per_month.'.$sub_space_type] = 'required';
            }
         }
        }
        

        
        $request->validate($rules);

         if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }
        
        
        $record->name = $request->name;
       
        $record->cotact_person_name = $request->cotact_person_name;
        $record->email = $request->email;
        $record->alter_email = $request->alter_email;
        $record->property_address = $request->property_address;
        $record->property_address_latitude = $request->property_address_latitude;
        $record->property_address_longitude = $request->property_address_longitude;

        if (!empty($request->property_address) && (empty($request->property_address_latitude) || empty($request->property_address_longitude)))
        {
            $latlng = get_google_location_reverse($request->property_address);
            if ($latlng)
            {
                $record->property_address_latitude = $latlng['latitude'];
                $record->property_address_longitude = $latlng['longitude'];
            }
        }

        $record->area = $request->area;
        $record->capacity = $request->capacity;

        $record->property_address_street_number = $request->property_address_street_number;
        $record->property_address_city = $request->property_address_city;
        $record->property_address_state = $request->property_address_state;
        $record->property_address_country = $request->property_address_country;
        $record->property_addrress_postal_code = $request->property_addrress_postal_code;
        $record->gst = $request->gst;

       
        $record->near_by_landmark = $request->near_by_landmark;
        $record->near_by_landmark_latitude = $request->near_by_landmark_latitude;
        $record->near_by_landmark_longitude = $request->near_by_landmark_longitude;

        if (!empty($request->near_by_landmark) && (empty($request->near_by_landmark_latitude) || empty($request->near_by_landmark_longitude)))
        {
            $latlng = get_google_location_reverse($request->near_by_landmark);
            if ($latlng)
            {
                $record->near_by_landmark_latitude = $latlng['latitude'];
                $record->near_by_landmark_longitude = $latlng['longitude'];
            }
        }

        $record->no_of_workstation = $request->no_of_workstation;
        $record->no_of_private_office = $request->no_of_private_office;
        $record->no_of_meeting_office = $request->no_of_meeting_office;
        $record->no_of_training_office = $request->no_of_training_office;

        $record->alter_cotact_person_name = $request->alter_cotact_person_name;
        $record->alter_cotact_person_number = $request->alter_cotact_person_number;
        $record->phone_number = $request->phone_number;

        $record->offer_title = $request->offer_title;
        $record->description = $request->description;
        $record->property_manager_name = $request->property_manager_name;
        $record->property_manager_email = $request->property_manager_email;
        $record->property_manager_number = $request->property_manager_number;
        $record->company = $request->company;
        $record->pan_no = $request->pan_no;
        $record->billing_address = $request->billing_address;
        $record->registered_address = $request->registered_address;
        $record->bank_name = $request->bank_name;

        $record->account_holder_name = $request->account_holder_name;
        $record->account_number = $request->account_number;
        $record->ifsc_code = $request->ifsc_code;
        $record->is_approved = $request->is_approved;

        $record->agent_id = $request->agent_id;


        $image_data = [];

        if ($request->hasfile('image'))
        {
            foreach ($request->file('image') as $file)
            {
                $image_name = $file->getClientOriginalName();
                $file->move(public_path() . '/thumb/', $image_name);
                $image_data[] = $image_name;
            }
        }

        if (!empty($image_data))
        {
            $record->image = json_encode($image_data);
        }

        $record->save();

        $selected_space_types = [];

        $avaliable_seats = $request->avaliable_seats;
        $price_per_day = $request->price_per_day;
        $price_per_month = $request->price_per_month;

        $vo_reg_no = $request->vo_reg_no; // Virtual space has special fieds.
        $vo_mailing_address = $request->vo_mailing_address; // Virtual space has special fieds.
        if (!empty($request->sub_space_type_id))
        {

            foreach ($request->sub_space_type_id as $key => $value)
            {
                list($space_type_id, $sub_space_type_id) = explode('_', $value);
                if ($sub_space_type_id == SUBSPACE_TYPE_VIRTUAL)
                {

                    $row = ['space_type_id' => $space_type_id, 'sub_space_type_id' => $sub_space_type_id, 'vo_reg_no' => (!empty($vo_reg_no[$sub_space_type_id])) ? $vo_reg_no[$sub_space_type_id] : null, 'vo_mailing_address' => (!empty($vo_mailing_address[$sub_space_type_id])) ? $vo_mailing_address[$sub_space_type_id] : null,

                    ];
                    $selected_space_types[] = $row;
                }
                else
                {

                    $row = ['space_type_id' => $space_type_id, 'sub_space_type_id' => $sub_space_type_id, 'avaliable_seats' => (!empty($avaliable_seats[$sub_space_type_id])) ? $avaliable_seats[$sub_space_type_id] : null, 'price_per_day' => (!empty($price_per_day[$sub_space_type_id])) ? $price_per_day[$sub_space_type_id] : null, 'price_per_month' => (!empty($price_per_month[$sub_space_type_id])) ? $price_per_month[$sub_space_type_id] : null, ];

                    $selected_space_types[] = $row;
                }
            }
        }

        //property timings
        $selected_timings = [];

        $time_from = $request->time_from;
        $time_to = $request->time_to;

        if (!empty($request->day_id))
        {
            foreach ($request->day_id as $key => $value)
            {
                list($day_id) = explode('_', $value);
                $row = ['day_id' => $day_id, 'time_from' => (!empty($time_from[$day_id])) ? $time_from[$day_id] : null, 'time_to' => (!empty($time_to[$day_id])) ? $time_to[$day_id] : null, ];
                $selected_timings[] = $row;
            }
        }

        $this->processUpload($request, $record, "cover_image");

        $record->property_sub_space_types()
            ->sync($selected_space_types);

        
        $record->property_amenities()
            ->sync(array_filter((array)$request->input('amenity_id')));

        $record->property_timings()
            ->sync($selected_timings);

        flashMessage( 'success', 'update' );    
        return redirect()->route('properties.index');
      
    }

    /**
     * Display Listing.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function listingShow($slug)
    {
        $record = Property::getRecordWithSlug($slug);
        $active_class = trans('others.listings');
        return view('admin.listings.show', compact('record', 'active_class'));
    }

    public function getAgentProfile($slug, $agent_id)
    {

        $record = Property::getRecordWithSlug($slug);

        $property_agent = \App\User::find($record->agent_id);

        if (request()
            ->ajax())
        {

            $name = request('name');
            $email = request('email');
            $subject = request('subject');
            $message = request('message');

            $contact_host = ContactHost::create($request->all());
            $contact_host->property_id = $record->id;

            $contact_host->save();

            $validator = Validator::make($request->all() , ['name' => 'required']);

            if ($property_agent)
            {
                $logo = $record->cover_image;
                $site_logo = getSetting( 'site_logo', 'site_settings' );
                $country_code = getSetting('country_code','site_settings');

                $templatedata = array(
                    'contact_name'  =>  $name ? $name : '', 
                    'contact_email'  =>  $email ? $email : '', 
                    'property_name' => $record->name,
                    'content' => 'Property has been created',
                    'property_url' => route('properties.show', ['slug' => $record
                        ->slug]) ,
                    'agent_id' => $property_agent ? $property_agent->name : '-',
                    'property_address' => $record->property_address,
                    'subject' => $subject ? $subject : '-',
                    'message' => $message ? $message : '-',
                    'logo' => $logo,

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

                'template' => 'contact-host', 'model' => 'App\Property', 'data' => $templatedata, ];
                $property_agent->notify(new WL_EmailNotification($data));

                return response()->json(['success' => 'Mail Sent Successfully!']);

            }

        }

        return view('home-pages.profile', compact('record'));

    }

    public function enquireStore(Request $request, $slug)
    {
        if (request()->ajax())
        {

            $validator = Validator::make($request->all() , ['name' => 'required', 'email' => 'required', 'phone_number' => 'required', 'address' => 'required', 'city' => 'required', 'company' => 'required',

            ]);

            $record = Property::getRecordWithSlug($slug);

            if ( isDemo() ) {
             return prepareBlockUserMessage( 'info', 'crud_disabled' );
            }

            $enquire = Enquire::create($request->all());
            $enquire->property_id = $record->id;
            $enquire->agent_id = $record->agent_id;
            $enquire->customer_id = Auth::id();
            $enquire->enquire_from = $request->enquire_from;

            $enquire->save();

            $agent = \App\User::find($record->agent_id);

            if ($validator->passes())
            {
                $response = array(
                    'status' => 'success',
                    'message' => trans('others.record-saved')
                );
            }
            else
            {
                $response = array(
                    'error' => $validator->errors()
                        ->all()
                );
            }
            return json_encode($response);
        }
    }


    

    public function contactSend(Request $request, $slug)
    {
        if (request()->ajax())
        {

            $name = request('name');
            $email = request('email');
            $subject = request('subject');
            $message = request('message');

            $validator = Validator::make($request->all() , ['name' => 'required', ]);

            $record = Property::getRecordWithSlug($slug);

            if ( isDemo() ) {
             return prepareBlockUserMessage( 'info', 'crud_disabled' );
            }

            $contact_host = ContactHost::create($request->all());
            $contact_host->property_id = $record->id;

            $contact_host->save();

            $property_agent = \App\User::find($record->agent_id);

            if (!$validator->passes())
            {
                return response()
                    ->json(['error' => $validator->errors()
                    ->all() ]);
            }

        if ($property_agent)
            {
                $logo = $record->cover_image;
                $site_logo = getSetting( 'site_logo', 'site_settings' );
                $country_code = getSetting('country_code','site_settings');

                $templatedata = array(
                    'contact_name'  =>  $name ? $name : '', 
                    'contact_email'  =>  $email ? $email : '', 
                    'property_name' => $record->name,
                    'content' => 'Property has been created',
                    'property_url' => route('properties.show', ['slug' => $record
                        ->slug]) ,
                    'agent_id' => $property_agent ? $property_agent->name : '-',
                    'property_address' => $record->property_address,
                    'subject' => $subject ? $subject : '-',
                    'message' => $message ? $message : '-',
                    'logo' => $logo,

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

                'template' => 'contact-host', 'model' => 'App\Property', 'data' => $templatedata, ];
                $property_agent->notify(new WL_EmailNotification($data));
            }

            return response()->json(['success' => 'Mail Sent Successfully!']);

        }

    }

    public function getProperties(Request $request)
    {

        $spacetypes_id = $request->parent_id;
        $sub_id = $request->sub_id;

        $subtypes = \App\SpaceType::where('parent_id', $spacetypes_id)->get()
            ->pluck('id')
            ->toArray();

        $properties = \App\Property::whereIn('space_type_id', $subtypes)->paginate(10);

        $listings = view('home-pages.explore-list', compact('properties'));
        return json_encode(['status' => 'success', 'html' => $listings]);

    }

    public function likeProperty(Request $request)
    {
        if (request()->ajax())
        {
            $property_id = request('property_id');
            $user_id = Auth::id();
            $ip_address = GetIP();

            $check = DB::table('property_likes')->where('ip_address', $ip_address)->where('property_id', $property_id)->count();
            if ($check > 0)
            {
                $output = ['status' => 'Error', 'message' => 'You already liked it!'];
            }
            else
            {
                $data = ['property_id' => $property_id, 'user_id' => $user_id, 'ip_address' => $ip_address, ];
                DB::table('property_likes')->insert($data);

                $output = ['status' => 'success', 'message' => 'Thank you for your interest', 'count' => DB::table('property_likes')->count() ];
            }

            echo json_encode($output);
        }
    }

    public function reviewProperty(Request $request)
    {
        if (request()->ajax())
        {

            $validator = Validator::make($request->all() , ['rating' => 'required', 'message' => 'required|min:10', ]);

            $property_id = request('property_id');
            $name = $request->name;
            $message = $request->message;
            $rating = $request->rating;
            $user_id = Auth::id();
            $ip_address = GetIP();

            if ($validator->passes())
            {

                $data = ['property_id' => $property_id, 'user_id' => $user_id, 'ip_address' => $ip_address, 'rating' => $rating, 'name' => $name, 'message' => $message, ];

                DB::table('property_reviews')->insert($data);

                $total_reviews = DB::table('property_reviews')->where('property_id', $property_id)->count();

                $total_rating = DB::table('property_reviews')->where('property_id', $property_id)->sum('rating');

                $total_star_ratings = number_format(($total_rating / $total_reviews) , 0);

                return response()->json(['success' => 'Review Successfully submitted', 'success_rating' => $rating]);

            }

            else
            {
                return response()->json(['error' => $validator->errors()
                    ->all() ]);
            }

        }
    }

    //Mail Invoice
    public function mailInvoice()
    {

        if (request()
            ->ajax())
        {
            //new invoice form
            $action = request('action');
            $id = request('property_id');

            $item = Property::findOrFail($id);
            $sub = substr($action, -3);

            if ('per' === $sub)
            {
                $action = substr($action, 0, -4);
            }
            elseif ('tax' === $sub)
            {
                $action = substr($action, 0, -4);
            }

            if ('per' === $sub)
            {
                $template = EmailTemplate::where('key', '=', $action)->first();
                return view('admin.listings.mail.proforma-invoice-form', compact('item', 'action', 'sub', 'template'));
            }
            elseif ('tax' === $sub)
            {
                $template = EmailTemplate::where('key', '=', $action)->first();
                return view('admin.listings.mail.tax-invoice-form', compact('item', 'action', 'sub', 'template'));
            }

        }
    }

    //send Invoice
    public function sendInvoice()
    {
        if (request()
            ->ajax())
        {

            $post = request('data');
            $sub = $post['sub'];

            $id = $post['property_id'];
            $action = $post['action'];

            $response = array(
                'status' => 'danger',
                'message' => 'Something went wrong'
            );

            $item = Property::findOrFail($id);

            if ($action == 'raise-proforma-invoice')
            {

                $data = array();

                $id = !empty($post['property_id']) ? $post['property_id'] : '';
                if (!empty($id))
                {
                    $data['id'] = $id;
                }

                $company_name = !empty($post['company_name']) ? $post['company_name'] : '';
                if (!empty($company_name))
                {
                    $data['company_name'] = $company_name;
                }

                 $invoice_random_number = !empty($post['invoice_random_number']) ? $post['invoice_random_number'] : '';
                if (!empty($invoice_random_number))
                {
                    $data['invoice_random_number'] = $invoice_random_number;
                }


                $to_name = !empty($post['toname']) ? $post['toname'] : '';
                if (!empty($to_name))
                {
                    $data['toname'] = $to_name;
                }

                $to_email = !empty($post['toemail']) ? $post['toemail'] : '';
                if (!empty($to_email))
                {
                    $data['toemail'] = $to_email;
                }

                $cc_email = !empty($post['ccemail']) ? $post['ccemail'] : '';
                if (!empty($cc_email))
                {
                    $data['ccemail'] = $cc_email;
                }

                $no_of_seats = !empty($post['no_of_seats']) ? $post['no_of_seats'] : '';
                if (!empty($no_of_seats))
                {
                    $data['no_of_seats'] = $no_of_seats;
                }

                $invoice_amount = !empty($post['invoice_amount']) ? $post['invoice_amount'] : '';
                if (!empty($invoice_amount))
                {
                    $data['invoice_amount'] = $invoice_amount;
                }

                $mail_description = !empty($post['mail_description']) ? $post['mail_description'] : '';
                if (!empty($mail_description))
                {
                    $data['mail_description'] = $mail_description;
                }

                $mail_mobile = !empty($post['mail_mobile']) ? $post['mail_mobile'] : '';
                if (!empty($mail_mobile))
                {
                    $data['mail_mobile'] = $mail_mobile;
                }

                $company_address = !empty($post['company_address']) ? $post['company_address'] : '';
                if (!empty($company_address))
                {
                    $data['company_address'] = $company_address;
                }

                $state = !empty($post['state']) ? $post['state'] : '';
                if (!empty($state))
                {
                    $data['state'] = $state;
                }

                $radiogroup1 = !empty($post['radiogroup1']) ? $post['radiogroup1'] : '';
                if (!empty($radiogroup1))
                {
                    $data['radiogroup1'] = $radiogroup1;
                }

                $venue_share = !empty($post['venue_share']) ? $post['venue_share'] : '';
                if (!empty($venue_share))
                {
                    $data['venue_share'] = $venue_share;
                }

                $invoice_gstin = !empty($post['invoice_gstin']) ? $post['invoice_gstin'] : '';
                if (!empty($invoice_gstin))
                {
                    $data['invoice_gstin'] = $invoice_gstin;
                }


                  if ($invoice_gstin == "" || $invoice_gstin == 0)
                {
                    $invoice_gstin = 0;
                    $total_amount = $invoice_amount;

                }
                else
                {

                    $total_amount = $invoice_amount + ($invoice_gstin / 100 * $invoice_amount);
                }

                if (!empty($total_amount))
                {
                    $data['total_amount'] = $total_amount;
                }

                $data['content'] = $post['message'];


                $res = sendEmail( $action, $data );

                $listing_invoices = array(
                    'property_id' => $id,
                    'action' => $action,
                    'customer_id' => $item->customer_id,
                    'no_of_seats' => !empty($no_of_seats) ? $no_of_seats : '',
                    'customer_name' => !empty($to_name) ? $to_name : '',
                    'customer_email' => !empty($to_email) ? $to_email : '',
                    'customer_mobile' => !empty($mail_mobile) ? $mail_mobile : '',
                    'company_address' => !empty($company_address) ? $company_address : '',
                    'amount' => !empty($invoice_amount) ? $invoice_amount : '',
                    'gstin' => $invoice_gstin,
                    'total_amount' => $total_amount,
                    'description' => !empty($mail_description) ? $mail_description : '',
                    'invoice_id' => $invoice_random_number,
                );
                \App\Invoice::create($listing_invoices);

                return response()->json(['status' => 'success']);

                
            }

            elseif ('raise-tax-invoice')
            {
                $data = array();

                $id = !empty($post['property_id']) ? $post['property_id'] : '';
                if (!empty($id))
                {
                    $data['id'] = $id;
                }

                 $company_name = !empty($post['company_name']) ? $post['company_name'] : '';
                if (!empty($company_name))
                {
                    $data['company_name'] = $company_name;
                }

                 $invoice_random_number = !empty($post['invoice_random_number']) ? $post['invoice_random_number'] : '';
                if (!empty($invoice_random_number))
                {
                    $data['invoice_random_number'] = $invoice_random_number;
                }

                $to_name = !empty($post['toname']) ? $post['toname'] : '';
                if (!empty($to_name))
                {
                    $data['toname'] = $to_name;
                }

                $to_email = !empty($post['toemail']) ? $post['toemail'] : '';
                if (!empty($to_email))
                {
                    $data['toemail'] = $to_email;
                }

                $cc_email = !empty($post['ccemail']) ? $post['ccemail'] : '';
                if (!empty($cc_email))
                {
                    $data['ccemail'] = $cc_email;
                }

              

                $no_of_seats = !empty($post['no_of_seats']) ? $post['no_of_seats'] : '';
                if (!empty($no_of_seats))
                {
                    $data['no_of_seats'] = $no_of_seats;
                }

                $invoice_amount = !empty($post['invoice_amount']) ? $post['invoice_amount'] : '';
                if (!empty($invoice_amount))
                {
                    $data['invoice_amount'] = $invoice_amount;
                }

                $mail_description = !empty($post['mail_description']) ? $post['mail_description'] : '';
                if (!empty($mail_description))
                {
                    $data['mail_description'] = $mail_description;
                }

                $mail_mobile = !empty($post['mail_mobile']) ? $post['mail_mobile'] : '';
                if (!empty($mail_mobile))
                {
                    $data['mail_mobile'] = $mail_mobile;
                }

                $company_address = !empty($post['company_address']) ? $post['company_address'] : '';
                if (!empty($company_address))
                {
                    $data['company_address'] = $company_address;
                }

                $state = !empty($post['state']) ? $post['state'] : '';
                if (!empty($state))
                {
                    $data['state'] = $state;
                }

                $radiogroup1 = !empty($post['radiogroup1']) ? $post['radiogroup1'] : '';
                if (!empty($radiogroup1))
                {
                    $data['radiogroup1'] = $radiogroup1;
                }

                $venue_share = !empty($post['venue_share']) ? $post['venue_share'] : '';
                if (!empty($venue_share))
                {
                    $data['venue_share'] = $venue_share;
                }

                $invoice_gstin = !empty($post['invoice_gstin']) ? $post['invoice_gstin'] : '';
                if (!empty($invoice_gstin))
                {
                    $data['invoice_gstin'] = $invoice_gstin;
                }


                $data['content'] = $post['message'];

                if ($invoice_gstin == "" || $invoice_gstin == 0)
                {
                    $invoice_gstin = 0;
                    $total_amount = $invoice_amount;

                }
                else
                {

                    $total_amount = $invoice_amount + ($invoice_gstin / 100 * $invoice_amount);
                }

                 if (!empty($total_amount))
                {
                    $data['total_amount'] = $total_amount;
                }


                $res = sendEmail( $action, $data );

               
                
                $listing_invoices = array(
                    'property_id' => $id,
                    'action' => $action,
                    'customer_id' => $item->customer_id,
                    'no_of_seats' => !empty($no_of_seats) ? $no_of_seats : '',
                    'customer_name' => !empty($to_name) ? $to_name : '',
                    'customer_email' => !empty($to_email) ? $to_email : '',
                    'customer_mobile' => !empty($mail_mobile) ? $mail_mobile : '',
                    'company_address' => !empty($company_address) ? $company_address : '',
                    'amount' => !empty($invoice_amount) ? $invoice_amount : '',
                    'gstin' => $invoice_gstin,
                    'total_amount' => $total_amount,
                    'description' => !empty($mail_description) ? $mail_description : '',
                    'invoice_id' => $invoice_random_number,
                );
                \App\Invoice::create($listing_invoices);

                $success_msg = trans('others.success-msg');

                 return response()->json(['status' => $success_msg]);

                

            }

        }
    }

    //end Send Invoice
    

    //Property Visits Share
    public function visitsShare(Request $request)
    {
        if (request()->ajax())
        {
            $action = $request->action;

            $toname = $request->toname;
            $toemail = $request->toemail;
            $ccemail = $request->ccemail;
            $mailmobile = $request->mail_mobile;
            $maildescription = $request->mail_description;
            $message = $request->message;
            $must_visit = $request->must_visit;
            $visit_date = $request->visit_date;
            $visit_time = $request->visit_time;

            $properties_visits = \App\Property::where('schedule_visit', 'no')->get();

            $data = array();

            $to_name = !empty($toname) ? $toname : '';
            if (!empty($to_name))
            {
                $data['toname'] = $to_name;
            }

            $to_email = !empty($toemail) ? $toemail : '';
            if (!empty($to_email))
            {
                $data['toemail'] = $to_email;
            }

            $cc_email = !empty($ccemail) ? $ccemail : '';
            if (!empty($cc_email))
            {
                $data['ccemail'] = $cc_email;
            }

            $mail_mobile = !empty($mailmobile) ? $mailmobile : '';
            if (!empty($mail_mobile))
            {
                $data['mailmobile'] = $mail_mobile;
            }

            $msg = !empty($message) ? $message : '';
            if (!empty($msg))
            {
                $data['content'] = $msg;
            }

            $mail_description = !empty($maildescription) ? $maildescription : '';
            if (!empty($mail_description))
            {
                $data['maildescription'] = $mail_description;
            }

            foreach ($properties_visits as $property_visit)
            {
                $data['property_visit_company'] = $property_visit->company;
                $data['must_visit'] = $must_visit;
                $data['visit_date'] = $visit_date;
                $data['visit_time'] = $visit_time;
                $cover_image = $property_visit->cover_image;
                $property_sub_space_types = $property_visit->property_sub_space_types;

            }

            $res = sendEmail($action, $data);

        }
    }
    //end share
    

  /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
       if( ! ( isAdmin() ) )
       {
           return prepareBlockUserMessage( 'danger', 'not_allowed' );
       } 

       if ( isDemo() ) {
         return prepareBlockUserMessage( 'info', 'crud_disabled' );
        }

     $record = Property::getRecordWithSlug($slug);
        $enquires = Enquire::get();
            foreach ($enquires as  $enquire) {
              $property_id = $enquire->property_id;
              $booking_initiated = json_decode($enquire->booking_initiated, true);
              $booking_initiated_id = $booking_initiated ? $booking_initiated["booking_initiated_property_id"] : '';
              
                if($record->id == $property_id){     
                return redirect()->back()->with('enquire', trans('others.delete-disable') );                  
                }
                if(!empty($booking_initiated_id) ){

                    if($record->id == $booking_initiated_id)
                    {
                        return redirect()->back()->with('initiated',  trans('others.delete-initiated') );
                    }

                }
               
            }

           
        $record->delete();

        return redirect()
            ->route('properties.index');
    }


    
    /**
     * Display Listing.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function availabilityStatus($slug, $is_approved)
    {
        if( ! ( isAdmin() ) )
       {
           return prepareBlockUserMessage( 'danger', 'not_allowed' );
       }

       
       
        $record = Property::getRecordWithSlug($slug);
        $active_class = 'listings';
        $record->is_approved = $is_approved;
        $record->save();

        return redirect()
            ->route('properties.index');
    }

    // Provider Dashboard
    public function providersDashboard()
    {
        
       if( ! ( isAdmin() || isAgent() ) ){
        return redirect()->back();
       }   

       if( isAdmin() ){
        $data = ['items' => Property::get() , 'active_class' => trans('others.providers')];
       }
       if(isAgent()){
        $data = ['items' => Property::where('is_approved','yes')->get() , 'active_class' => trans('others.providers')];
       }

        return view('admin.listings.providers.provider', $data);
    }

    //End Provider

       //Exporting the properties data in excel format
    public function propertiesExport() 
    {
        return Excel::download(new PropertyExport, 'properties.xlsx');
    }
    
}

