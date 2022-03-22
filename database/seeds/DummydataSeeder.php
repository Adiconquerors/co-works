<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB as store;

class DummydataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();

        $portal_language = 'en';
        $super_admin_id = getSuperadmin();

        factory(App\User::class, 1)->create()->each(function ($user) use($faker, $super_admin_id, $portal_language) {

          $owner_id = $user->id;

          // Owner Permissions.
          $permissions_roles = \DB::table('permission_role')->where('role_id', ADMIN_TYPE)->get();
          if ( $permissions_roles->count() > 0 ) {
            foreach ($permissions_roles as $item) {
              $check = \DB::table('permission_owner')->where('permission_id', $item->permission_id)
              ->where('owner_id', $owner_id)->first();
              if ( ! $check ) {
                  $record = [
                    'owner_id' => $owner_id,
                    'permission_id' => $item->permission_id,
                  ];
                  \DB::table('permission_owner')->insert( $record );
              }
            }
          }

            $number = rand(3, 8);
            for( $i = 0; $i < $number; $i++ ) {
              $amount = $faker->randomFloat(2,1);
              $data = [
                  'owner_id' => $owner_id,
                    'slug' => $faker->md5(),
              'name' => $faker->company,
              'description' => $faker->text(200),
              'initial_balance' => $faker->randomFloat(2,1),
              'account_number' => $faker->bankAccountNumber,
              'contact_person' => $faker->name,
              'phone' => $faker->phoneNumber,
              'url' => $faker->domainName,
              ];
              $clientproject = \App\Account::create( $data );
            }

            $random_number = $faker->numberBetween(1, 5);
            factory(App\Currency::class, $random_number)->create([
                'owner_id' => $owner_id,
            ]);

            $random_number = $faker->numberBetween(1, 5);
            factory(App\Country::class, $random_number)->create([
              'owner_id' => $owner_id,
            ]);

            // Languages.
            $languages = \App\Language::where('owner_id', $super_admin_id)->where('status', 'Active')->get();
            if ( $languages->count() > 0 ) {
              foreach ($languages as $language) {
                $newlanguage = $language->replicate();
                $newlanguage->owner_id = $owner_id;
                $newlanguage->slug = md5(microtime() . randomString());
                $newlanguage->save();
              }
            }
            $default_language = \App\Language::where('owner_id', $owner_id)->where('status', 'Active')->inRandomOrder()->first();
            if ( $default_language ) {
                $default_language->update(['is_default' => 'yes']);
                $portal_language = $default_language->code;
            }

            \App\Currency::where('owner_id', $owner_id)->where('status', 'Active')->inRandomOrder()->first()->update(['is_default' => 'yes']);

            $random_number = $faker->numberBetween(1, 5);
            factory(App\Department::class, $random_number)->create([
                'owner_id' => $owner_id,
                'created_by_id' => $owner_id,
            ]);

            $random_number = $faker->numberBetween(1, 5);
            factory(App\Company::class, $random_number)->create([
                'owner_id' => $owner_id,
                'created_by_id' => $owner_id,
                'country_id' => \App\Country::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
            ]);



            $random_number = $faker->numberBetween(1, 5);
            factory(App\ContactGroup::class, $random_number)->create([
                'owner_id' => $owner_id,
            ]);

            $random_number = $faker->numberBetween(15, 20);
            factory(App\Contact::class, $random_number)->create([
                'owner_id' => $owner_id,
            ])->each(function ($contact) use($faker, $super_admin_id, $owner_id) {
                // To make sure at least one contact for each contact type/role.
                $already_created = \App\Contact::where('owner_id', $owner_id)->pluck('contact_type_id')->toArray();
                
                if ( ! empty( $already_created ) ) {
                	$role_contact_type = \App\Role::where('status', 'active')->whereNotIn('id', array_filter($already_created))->inRandomOrder()->first();
                	if ( ! $role_contact_type ) {
                		$role_contact_type = \App\Role::where('status', 'active')->inRandomOrder()->first();
                	}
                } else {
                	$role_contact_type = \App\Role::where('status', 'active')->inRandomOrder()->first();
            	}

                $contact->contact_type_id = $role_contact_type->id;
                $contact->currency_id = \App\Currency::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
                $contact->department_id = \App\Department::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
                if ( $role_contact_type->type == 'Leads' ) {
                    $contact->lead_source_id = \App\LeadSource::where('owner_id', $owner_id)->where('status', 'active')->inRandomOrder()->first()->id;
                }
				$contact->language_id = \App\Language::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
				$contact->company_id = \App\Company::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
				$contact->group_id = \App\ContactGroup::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
				$contact->country_id = \App\Country::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
                $contact->save();

                $contact_type = [ $role_contact_type->id ];
                $contact->contact_type()->sync($contact_type);

                $language = \App\Language::where('owner_id', $owner_id)->inRandomOrder()->take(1)->pluck('id')->toArray();
                $contact->language()->sync($language);

                if ( $role_contact_type->type == 'role' && $contact->is_user == 'yes' ) {
                    $role = [$role_contact_type->id];
                    $contact->role()->sync( $role );
                }
            });


            $user->owner_id = $owner_id;
            $free_trial_days = FREE_TRIAL_DAYS;
            $trial_until = now()->addDays($free_trial_days);

            $package = \App\Package::inRandomOrder()->first();
            if ( $package ) {
                $duration = $package->duration;
                $duration_type = $package->duration_type;
                $amount = $package->price;
                $user->package_id = $package->id;

                switch ($duration_type) {
                    case 'Day':
                        $user->plan_until = now()->addDays($duration);
                        break;
                    case 'Week':
                        $user->plan_until = now()->addWeeks($duration);
                        break;
                    case 'Month':
                        $user->plan_until = now()->addMonths($duration);
                        break;
                    case 'Year':
                        $user->plan_until = now()->addYears($duration);
                        break;
                }
                $paymentmethod = $faker->randomElement(['stripe','paypal','paystack','razorpay']);
                $data = array(
                    'date' => digiTodayDateDB(),
                    'amount' => $amount,
                    'transaction_id' => $faker->iban('IN'),
                    'account_id' => \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                    'paymentmethod' => $paymentmethod,
                    'slug' => md5(microtime() . rand()),
                    'payment_status' => $faker->randomElement(['pending','success']),
                    'package_id' => $package->package_id,
                    'transaction_data' => null,
                    'description' => 'Payment for subscription plan #' . $package->package_title,
                );
                \App\PackagesPayment::create( $data );
            } else {
                $user->trial_until = $trial_until;
            }
            $user->contact_type_id = ADMIN_TYPE;

            $user->department_id = \App\Department::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
            $user->language_id = \App\Language::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
            $user->company_id = \App\Company::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
            $user->group_id = \App\ContactGroup::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
            $user->country_id = \App\Country::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
            $user->currency_id = \App\Currency::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
          $user->save();

            $contact_type = [ ADMIN_TYPE ];
            $user->contact_type()->sync($contact_type);

            $language = \App\Language::where('owner_id', $user->id)->inRandomOrder()->take(1)->pluck('id')->toArray();
            $user->language()->sync($language);

            $role = [ADMIN_TYPE];
            $user->role()->sync( $role );

            $random_number = $faker->numberBetween(1, 5);
          factory(App\Warehouse::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\ExpenseCategory::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\IncomeCategory::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\FaqCategory::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\Article::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\ContentTag::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\ContentCategory::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\Brand::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\AssetsLocation::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\AssetsStatus::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\AssetsCategory::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\Asset::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\Tax::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\Discount::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\ProductCategory::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\MeasurementUnit::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

          $random_number = $faker->numberBetween(1, 5);
          factory(App\RecurringPeriod::class, $random_number)->create([
            'owner_id' => $owner_id,
          ]);

            $random_number = $faker->numberBetween(1, 5);
            factory(App\LeadSource::class, $random_number)->create([
                'owner_id' => $owner_id,
            ]);

            // Payment Gateways.
            $payment_gateways = \App\PaymentGateway::where('owner_id', $super_admin_id)->get();
            if ( $payment_gateways->count() > 0 ) {
              foreach ($payment_gateways as $payment_gateway) {
                $newgateway = $payment_gateway->replicate();
                $newgateway->owner_id = $user->id;
                $newgateway->slug = md5(microtime() . randomString());
                $newgateway->save();
              }
            }

            // Dynamic Options.
            $dynamic_options = \App\DynamicOption::where('owner_id', $super_admin_id)->get();
            if ( $dynamic_options->count() > 0 ) {
              foreach ($dynamic_options as $dynamic_option) {
                $newrecord = $dynamic_option->replicate();
                $newrecord->owner_id = $user->id;
                $newrecord->slug = md5(microtime() . randomString());
                $newrecord->save();
              }
            }


            $random_number = $faker->numberBetween(1, 5);
            factory(App\AssetsHistory::class, $random_number)->create([
                'owner_id' => $owner_id,
                'asset_id'=> \App\Asset::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                'status_id'=> \App\AssetsStatus::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                'location_id' => \App\AssetsLocation::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                'assigned_user_id' => \App\Contact::where('owner_id', $user->id)->inRandomOrder()->first()->id,
            ]);

            $number = rand(10, 20);
            for( $i = 0; $i < $number; $i++ ) {
              $amount = $faker->randomFloat(2,1);
              $data = [
                    'name' => $faker->name,
                    'description' => $faker->address,
              ];
              $clientproject = \App\ProjectStatus::create( $data );
            }

            //Client project start

            $number = rand(1, 10);
            for( $i = 0; $i < $number; $i++ ) {
              $client = \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CONTACT_CLIENT_TYPE);
                              })->first();
              if( $client ) {
                $client_id = $client->id;
              }
              $after_days = rand(1, 180);
              $data = [
                  'title' => $faker->sentence,
                  'slug' => $faker->md5(),
                  'budget' => $faker->randomFloat(2,1),
                  'phase' => $faker->randomElement(['I', 'II', 'III', 'IV', 'V']),
                  'start_date' => $faker->date('Y-m-d'),
                  'due_date' => $faker->date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$after_days.' days')),
                  'description' => $faker->text(200),
                  'priority' => $faker->randomElement(['Low', 'Medium', 'High', 'Urgent']),
                  'status_id' => \App\ProjectStatus::inRandomOrder()->first()->id,
                  'demo_url' => $faker->url,
                  'client_id' => \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CONTACT_CLIENT_TYPE);
                              })->first()->id,
                  'billing_type_id' => \App\ProjectBillingType::inRandomOrder()->first()->id,
                  'progress_from_tasks' => $faker->randomElement(['yes', 'no',]),
                  'project_rate_per_hour' => $faker->randomFloat(2,1),
                  'estimated_hours' => $faker->randomFloat(2,1),
                  'hourly_rate' => $faker->randomFloat(2,1),
                  'currency_id' => $client->currency_id,
              ];
              $data['owner_id'] = $owner_id;
              $project = \App\ClientProject::create( $data );

              $employees = \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', EMPLOYEES_TYPE);
                              })->get()->pluck('id')->toArray();
              $project->assigned_to()->sync( $employees );

              $tabs = \App\ProjectTab::inRandomOrder()->get()->pluck('id')->toArray();
              $project->project_tabs()->sync( $tabs );

              for ($t = 0; $t < rand(1, 10); $t++ ) {
                $startdate = date('Y-m-d H:i:s');
                $after_days = rand(1, 180);
                $task_data = [
                  'name' => $faker->word,
                  'description' => $faker->text(200),
                  'priority' => \App\DynamicOption::where('owner_id', $owner_id)->where('module', 'projecttasks')->where('type', 'priorities')->inRandomOrder()->first()->id,
                  'startdate' => $startdate,
                  'duedate' => date('Y-m-d H:i:s', strtotime($startdate. ' + '.$after_days.' days')),
                  'project_id' => $project->id,
                ];
                $task = \App\ProjectTask::create( $task_data );
              }
            }

            for ($t = 0; $t < rand(1, 10); $t++ ) {
                $startdate = date('Y-m-d H:i:s');
                $after_days = rand(1, 180);
                $task_data = [
                  'name' => $faker->word,
                  'description' => $faker->text(200),
                  'priority' => \App\DynamicOption::where('owner_id', $owner_id)->where('module', 'projecttasks')->where('type', 'priorities')->inRandomOrder()->first()->id,
                  'startdate' => $startdate,
                  'duedate' => date('Y-m-d H:i:s', strtotime($startdate. ' + '.$after_days.' days')),
                  'project_id' => \App\ClientProject::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                ];
                $task = \App\ProjectTask::create( $task_data );
              }

            for ($t = 0; $t < rand(1, 10); $t++ ) {
                $task_status_data = [
                  'owner_id' => $owner_id,
                  'name' => $faker->name,
                  'color' => $faker->name,
                  'slug' => $faker->slug,
                  'display_order' => $faker->numberBetween(1,10000 ),
                  
                ];
                $task = \App\TaskStatus::create( $task_status_data );
              }

              for ($t = 0; $t < rand(1, 10); $t++ ) {
                $task_status_data = [
                  'owner_id' => $owner_id,
                  'name' => $faker->name,
                  'description' => $faker->sentence,
                  'slug' => $faker->slug,
                  'todo_status' => $faker->numberBetween(1,10000 ),
                  'type' => $faker->name,
                  'start_date' => $faker->date('Y-m-d'),
                  'due_date' =>$faker->date('Y-m-d'),
                 
                  'user_id' => \App\User::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                ];
                $task = \App\Task::create( $task_status_data );
            }

            for ($t = 0; $t < rand(1, 10); $t++ ) {
                $task_status_data = [
                  'owner_id' => $owner_id,
                  'name' => $faker->sentence,
                  'description' => $faker->text(200),
                  'color' => $faker->sentence,
                  'milestone_order' => $faker->numberBetween(1,10000 ),
                  'description_visible_to_customer' => $faker->randomElement(['Yes', 'No']),
                  'due_date' => $faker->date('d-m-Y'),
                  'slug' => $faker->slug,
                  'project_id'=> \App\ClientProject::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                ];
                $task = \App\ProjectMilestone::create( $task_status_data );
            }

            for ($t = 0; $t < rand(1, 10); $t++ ) {
                $task_status_data = [
                  'owner_id' => $owner_id,
                  'name' => $faker->name,
                  'color' => $faker->name,
                  'slug' => $faker->slug,
                ];
                $task = \App\TicketitCategory::create( $task_status_data );
            }

            for ($t = 0; $t < rand(1, 10); $t++ ) {
                $task_status_data = [
                  'owner_id' => $owner_id,
                  'name' => $faker->name,
                  'color' => $faker->name,
                  'slug' => $faker->slug,
                ];
                $task = \App\TicketitStatus::create( $task_status_data );
            }

            for ($t = 0; $t < rand(1, 10); $t++ ) {
                $task_status_data = [
                  'owner_id' => $owner_id,
                  'name' => $faker->name,
                  'color' => $faker->name,
                  'slug' => $faker->slug,
                ];
                $task = \App\TitcketitPriority::create( $task_status_data );
            }

            for ($t = 0; $t < rand(1, 10); $t++ ) {
                $task_status_data = [
                  'owner_id' => $owner_id,
                  'subject' => $faker->sentence,
                  'content' => $faker->text(200),
                  'completed_at' => $faker->date('d-m-Y'),
                  'slug' => $faker->slug,
                  
                  'priority_id'=> \App\TitcketitPriority::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'status_id'=> \App\TicketitStatus::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'category_id'=> \App\TicketitCategory::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'user_id'=> \App\User::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'project_id'=> \App\ClientProject::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                ];
                $task = \App\Ticket::create( $task_status_data );
            }

            for ($t = 0; $t < rand(1, 10); $t++ ) {
                $task_status_data = [
                  'text' => $faker->sentence,
                  'link' => $faker->sentence,
                  'slug' => $faker->slug,
                ];
                $task = \App\InternalNotification::create( $task_status_data );
            }

            for ($t = 0; $t < rand(1, 10); $t++ ) {
              $task_timers_data = [
                'owner_id' => $owner_id,
                'note' => $faker->sentence,
                'slug' => $faker->slug,
                'hourly_rate' => $faker->numberBetween(1, 5),
                'start_time' => $faker->date('d-m-Y H:i:s'),
                'end_time' =>$faker->date('d-m-Y H:i:s'),
                'stop_start_timers' => $faker->randomElement(['1', '0']),
                'task_id' => \App\Task::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                'project_id' => \App\ClientProject::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                'user_id' => \App\User::where('owner_id', $user->id)->inRandomOrder()->first()->id,
              ];
              $task = \App\ProjectTaskTimer::create( $task_timers_data );
            }

              for ($t = 0; $t < rand(1, 10); $t++ ) {
                $task_timers_data = [
                  'owner_id' => $owner_id,
                  'subject' => $faker->name,
                  'description' => $faker->sentence,
                  'slug' => $faker->slug,
                  'last_activity' =>$faker->date('d-m-Y'),
                  'show_to_customer' => $faker->randomElement(['Yes', 'No']),
                  'created_by'=> \App\Contact::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                  'contact_id'=> \App\Contact::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                  'project_id' => \App\ClientProject::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                ];
                $task = \App\ProjectDiscussion::create( $task_timers_data );
              }

         

              $random_number = $faker->numberBetween(1, 20);
              for( $i = 1; $i <= $random_number; $i++ ) {
                $notes = [
                    'owner_id' => $owner_id,
                    'slug' => $faker->md5(),
                    'project_id' => $project->id,
                    'user_id' => App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                    function ($query) {
                    $query->where('id', ADMIN_TYPE);
                    })->first()->id,
                    'description' => $faker->paragraph,
                ];
                \App\ProjectNote::create($notes);
              }

              $random_number = $faker->numberBetween(1, 10);
          factory(App\Income::class, $random_number)->create([
            'owner_id' => $owner_id,
                'original_currency_id' => \App\Currency::where('status', '=', 'Active')->where('owner_id', $owner_id)->first()->id,
                'account_id' => \App\Account::where('owner_id', $owner_id)->first()->id,
                'payer_id' => \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                    function ($query) {
                    $query->where('id', CUSTOMERS_TYPE);
                    })->first()->id,
                'pay_method_id' => \App\PaymentGateway::where('owner_id', $owner_id)->where('status', '=', 'Active')->first()->id,
          ]);

          $random_number = $faker->numberBetween(1, 10);
          factory(App\Expense::class, $random_number)->create([
            'owner_id' => $user->id,
                'expense_category_id' => \App\ExpenseCategory::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                'account_id' => \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                'payee_id' => \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                    function ($query) {
                    $query->where('id', CUSTOMERS_TYPE);
                    })->first()->id,
                'payment_method_id' => \App\PaymentGateway::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
          ]);

            $random_number = $faker->numberBetween(1, 5);
            factory(App\Contracttype::class, $random_number)->create([
                'owner_id' => $user->id,
            ]);


            $random_number = $faker->numberBetween(1, 10);
            factory(App\Product::class, $random_number)->create([
                'owner_id' => $owner_id,
                'ware_house_id' => \App\Warehouse::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                'brand_id' => \App\Brand::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                'discount_id' => \App\Discount::where('owner_id', $user->id)->inRandomOrder()->first()->id,
                'measurement_unit_id' => \App\MeasurementUnit::where('owner_id', $user->id)->inRandomOrder()->first()->id,
            ])->each(function ($product) use($faker, $super_admin_id, $owner_id) {
                $currencies =  \App\Currency::where('status', '=', 'Active')->where('owner_id', $owner_id)->count('id');
                $prices_available = \App\Currency::where('status', '=', 'Active')->where('owner_id', $owner_id)->inRandomOrder()->take(rand(1, $currencies))->pluck('code')->toArray();

                $actual_price = $product->actual_price;
                $sale_price = $product->sale_price;

                $prices = [];
                foreach ($prices_available as $code ) {
                  $prices['actual'][ $code ] = $faker->randomFloat(2, 1, 99999);
                  $prices['sale'][ $code ] = $faker->randomFloat(2, 1, 99999);
                }

                $product->prices = json_encode( $prices );
                $product->prices_available = implode(',', $prices_available);
                $product->save();
            });

            // SMS Gateways.
          $sms_gateways = \App\SmsGateway::where('owner_id', $super_admin_id)->where('status', 'Active')->get();
          if ( $sms_gateways->count() > 0 ) {
            foreach ($sms_gateways as $sms_gateway) {
              $newgateway = $sms_gateway->replicate();
              $newgateway->owner_id = $user->id;
              $newgateway->slug = md5(microtime() . randomString());
              $newgateway->save();
            }
          }

      // Templates.
      $templates = \App\Template::where('owner_id', $super_admin_id)->where('status', 'active')->get();
      if ( $templates->count() > 0 ) {
        foreach ($templates as $template) {
            $newtemplate = $template->replicate();
            $newtemplate->owner_id = $user->id;
            $newtemplate->slug = md5(microtime() . randomString());
            $newtemplate->save();
        }
      }

      // Master Settings.
          $master_settings = \App\MasterSetting::where('owner_id', $super_admin_id)
          ->whereNotIn('key', ['login-settings', 'social_logins']) // Login settings for Super admin only.
          ->get();
          if ( $master_settings->count() > 0 ) {
            foreach ($master_settings as $setting) {
                  $number = rand(10, 20);
            for( $i = 0; $i < $number; $i++ ) {
              $yesno = $faker->randomElement(['yes', 'no']);
              $customer = \App\Contact::inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CUSTOMERS_TYPE);
                              })->where('owner_id', $owner_id)->first();
              $after_days = rand(1,99);
              $paymentstatus = $faker->randomElement(['unpaid', 'paid', 'due', 'partial', 'on-hold', 'rejected', 'cancelled']);
              $amount = $faker->randomFloat(2,1);
              $data = [
                  'title' => $faker->sentence,
                  'address' => $faker->address,
                  'invoice_prefix' => $faker->sentence( rand(3, 10) ),
                  'show_quantity_as' => $faker->randomElement(['Qty', 'Quantity']),
                  'invoice_no' => $faker->numberBetween(1,10000 ),
                  'status' => $faker->randomElement(['Published', 'Draft']),
                  'reference' => $faker->word,
                  'invoice_date' => $faker->date('Y-m-d'),
                  'invoice_due_date' => $faker->date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$after_days.' days')),
                  'invoice_notes' =>$faker->text(200),
                  'amount' => $amount,
                  'customer_id' => $customer->id,
                  'currency_id' => $customer->currency_id,
                  'tax_id' => \App\Tax::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'discount_id' => \App\Discount::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'products' => $faker->name,
                  'slug' => $faker->md5(),
                  'delivery_address' => $faker->address,
                  'admin_notes' => $faker->text(200),
                  'sale_agent' => \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CONTACT_SALE_AGENT);
                              })->first()->id,
                  'terms_conditions' => $faker->text(200),
                  'is_expiry_notified' => $faker->randomElement(['1', '0']),
                  'invoice_number_format' => $faker->randomElement(['numberbased', 'yearbased', 'year2digits', 'yearmonthnumber', 'yearbasedright', 'year2digitsright', 'numbermonthyear']),
                  'invoice_number_separator' => $faker->randomElement(['-', '#']),
                  'invoice_number_length' => $faker->numberBetween(1,6),
              ];

              $data['owner_id'] = $owner_id;
              $quote = \App\Quote::create( $data );

              $products_sync = $this->randomProducts( $owner_id );
              $quote->quote_products()->sync( $products_sync['products'] );
              $quote->amount = $products_sync['grand_total'];
              $quote->products = json_encode($products_sync['products']);
              $quote->save();

              $id = $quote->id;

              $history = [
                'id' => $id,
                'comments' => 'quote-created',
                'operation_type' => 'crud',
              ];
              $this->insertHistory($history, 'Quote');

              $random_number = $faker->numberBetween(1, 20);
              for( $i = 1; $i <= $random_number; $i++ ) {
                $notes = [
                    'quote_id' => $id,
                    'created_by_id' => App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                    function ($query) {
                    $query->where('id', ADMIN_TYPE);
                    })->first()->id,
                    'description' => $faker->paragraph,
                    'date_contacted' => $faker->date('Y-m-d'),
                ];
                \App\QuotesNote::create($notes);
              }
            }
            // Quotes End.
                  $new_setting = $setting->replicate();
                  $new_setting->owner_id = $user->id;
                  $new_setting->slug = md5(microtime() . randomString());
                  if ( in_array($new_setting->moduletype, ['payment', 'sms']) ) { // We need to remove all default values for the payment, sms gateways!
                      $settings_data = json_decode( $setting->settings_data, true );
                      $settings_data_temp = [];
                      if ( ! empty( $settings_data ) ) {
                          foreach ($settings_data as $key => $value) {
                              $settings_data_temp[ $key ]['value'] = '';
                          }
                      }
                      $new_setting->settings_data = json_encode( $settings_data_temp );
                  } elseif( in_array($new_setting->key, ['mailchimp-settings'])) {
                      $settings_data = json_decode( $setting->settings_data, true );
                      $settings_data_temp = [];
                      if ( ! empty( $settings_data ) ) {
                          foreach ($settings_data as $key => $value) {
                              $settings_data_temp[ $key ]['value'] = '';
                          }
                      }
                      $new_setting->settings_data = json_encode( $settings_data_temp );
                  }
                  $new_setting->save();
              }
          }

          // Cart Orders.
            $random_number = $faker->numberBetween(1, 20);
            $customer = \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                                function ($query) {
                                $query->where('id', CUSTOMERS_TYPE);
                                })->first();
            factory(App\CartOrder::class, $random_number)->create([
                'owner_id' => $owner_id,
                'customer_id' => $customer->id,
                'currency_id' => $customer->currency_id,
                'billing_cycle_id' => \App\RecurringPeriod::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
            ])->each(function ($order) use($faker, $super_admin_id, $owner_id) {
                $products_sync = $this->randomProducts( $owner_id );
                $order->order_products()->sync( $products_sync['products'] );
                $order->price = $products_sync['grand_total'];
                $stock_updated = $faker->randomElement(['Yes', 'No']);
                $order->stock_updated = $stock_updated;
                $order->products = json_encode($products_sync['products']);
                $order->save();

                if ( ( 'Yes' === $stock_updated ) && ! empty( $products_sync['products'] ) ) {
                    foreach ($products_sync['products'] as $item) {
                        
                    }
                }

                $customer = $order->customer;
                $generate_invoice = $faker->randomElement(['Yes','No']);
                $status = $faker->randomElement(['Active','Pending']);
                if ( $customer && 'Yes' === $generate_invoice ) {
                    $paymentstatus = 'unpaid';
                    if ( 'Active' === $status ) {
                        $paymentstatus = 'paid';
                    }
                    $data = [
                        'invoice_no' => $faker->numberBetween(1,10000 ),
                        'address' => $customer->fulladdress,
                        'invoice_prefix' => getSetting( 'invoice-prefix', 'invoice-settings', '', $owner_id ),
                        'show_quantity_as' => getSetting( 'show_quantity_as', 'invoice-settings', '', $owner_id ),
                        'status' => 'Published',
                        'invoice_date' => date('d-m-Y'),
                        'invoice_due_date' => date('d-m-Y'),
                        'customer_id' => $customer->id,
                        'currency_id' => $customer->currency_id,
                        'amount' => $products_sync['grand_total'],
                        'paymentstatus' => $paymentstatus,
                        'created_by_id' => $owner_id,
                        'delivery_address' => $customer->fulladdress,
                        'terms_conditions' => $faker->text(200),
                        'admin_notes' => $faker->text(200),
                        'invoice_notes' => $faker->text(200),
                        'order_id' => $order->id,
                        'invoice_number_format' => $faker->randomElement(['numberbased', 'yearbased', 'year2digits', 'yearmonthnumber', 'yearbasedright', 'year2digitsright', 'numbermonthyear']),
                        'invoice_number_separator' => $faker->randomElement(['-', '#']),
                        'invoice_number_length' => $faker->numberBetween(1,6),
                    ];
                    $invoice = \App\Invoice::create( $data );

                    $order->generate_invoice = 'Yes';
                    $order->save();

                    if ( 'Active' === $status ) {
                        $data = array();
                        $data['date'] = date('Y-m-d');
                        $data['amount'] = $products_sync['grand_total'];
                        $data['transaction_id'] = null;
                        $data['account_id'] = \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
                        $data['invoice_id'] = $invoice->id;
                        $data['paymentmethod'] = PAYMENT_METHOD_OFFLINE;
                        $data['description'] = trans('custom.invoices.payment-for') . ' #' . $invoice->invoice_no;
                        \App\InvoicePayment::create( $data );
                    }
                }

                if ( 'Active' === $status ) {
                    $data = array(
                        'date' => digiTodayDateDB(),
                        'amount' => $products_sync['grand_total'],
                        'transaction_id' => '',
                        'account_id' => \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                        'order_id' => $order->id,
                        'paymentmethod' => PAYMENT_METHOD_OFFLINE,
                        'description' => trans('orders::global.orders.payment-description') . $order->id,
                        'slug' => md5(microtime() . $order->id . rand()),
                        'payment_status' => PAYMENT_STATUS_SUCCESS,
                    );
                    \App\OrdersPayments::create( $data );
                }

                //start add to income
                $amount = $products_sync['grand_total'];
                $account_details = \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first();
                $add_to_income = $faker->randomElement(['Yes','No']);

                if ( ! empty( $account_details ) && 'Yes' === $add_to_income ) {

                    $basecurrency = \App\Currency::where('owner_id', $owner_id)->where('is_default', 'yes')->first();
                    if ( $order && $basecurrency ) {
                        $amount = ( $amount / $order->currency->rate ) * $basecurrency->rate;
                    }

                    if ( $account_details && ! empty( $account_id ) ) {
                        // Let us add thhis account to the specified account.
                        \App\Account::find( $account_id )->increment('initial_balance', $amount);
                    }

                    // As this is the Invoice payment, so it was Income, lets add it in income.
                    $pay_method = $faker->randomElement(['paypal','paystack', 'razorpay', 'stripe']);
                    $default_currency = \App\Currency::where('owner_id', $owner_id)->where('is_default', 'yes')->first();
                    $income = array(
                        'slug' => md5(microtime() . rand()),
                        'entry_date' => date('Y-m-d', time()),
                        'amount' =>  $amount,
                        'original_amount' =>  $amount,
                        'original_currency_id' => ( $default_currency ) ? $default_currency->id : null,
                        'description' => trans('others.orders.payment-for') . $order->id,
                        'ref_no' => $order->id,
                        'account_id' => ( $account_details ) ? $account_details->id : null,
                        'payer_id' => $order->customer_id,
                        'pay_method_id' => \App\PaymentGateway::where('owner_id', $owner_id)->where('key', '=', $pay_method )->first()->id,
                    );
                    \App\Income::create( $income );

                    $order->add_to_income = 'Yes';
                    $order->save();
                }
            });
            // Cart Orders.

            //Proposal start
            $number = rand(10, 20);
            for( $i = 0; $i < $number; $i++ ) {
              $yesno = $faker->randomElement(['yes', 'no']);
              $customer = \App\Contact::inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CUSTOMERS_TYPE);
                              })->where('owner_id', $owner_id)->first();
              $after_days = rand(1,99);
              $paymentstatus = $faker->randomElement(['unpaid', 'paid', 'due', 'partial', 'on-hold', 'rejected', 'cancelled']);
              $amount = $faker->randomFloat(2,1);
              $data = [
                  'title' => $faker->sentence,
                  'address' => $faker->address,
                  'invoice_prefix' => $faker->sentence( rand(3, 10) ),
                  'show_quantity_as' => $faker->randomElement(['Qty', 'Quantity']),
                  'invoice_no' => $faker->numberBetween(1,10000 ),
                  'status' => $faker->randomElement(['Published', 'Draft']),
                  'reference' => $faker->word,
                  'invoice_date' => $faker->date('Y-m-d'),
                  'invoice_due_date' => $faker->date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$after_days.' days')),
                  'invoice_notes' =>$faker->text(200),
                  'amount' => $amount,
                  'customer_id' => $customer->id,
                  'currency_id' => $customer->currency_id,
                  'tax_id' => \App\Tax::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'discount_id' => \App\Discount::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'products' => $faker->name,
                  'slug' => $faker->md5(),
                  'delivery_address' => $faker->address,
                  'admin_notes' => $faker->text(200),
                  'sale_agent' => \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CONTACT_SALE_AGENT);
                              })->first()->id,
                  'terms_conditions' => $faker->text(200),
                  'is_expiry_notified' => $faker->randomElement(['1', '0']),
                  'invoice_number_format' => $faker->randomElement(['numberbased', 'yearbased', 'year2digits', 'yearmonthnumber', 'yearbasedright', 'year2digitsright', 'numbermonthyear']),
                  'invoice_number_separator' => $faker->randomElement(['-', '#']),
                  'invoice_number_length' => $faker->numberBetween(1,6),
              ];

              $data['owner_id'] = $owner_id;
              $quote = \App\Proposal::create( $data );

              $products_sync = $this->randomProducts( $owner_id );
              $quote->proposal_products()->sync( $products_sync['products'] );
              $quote->amount = $products_sync['grand_total'];
              $quote->products = json_encode($products_sync['products']);
              $quote->save();

              $id = $quote->id;

              $history = [
                'id' => $id,
                'comments' => 'proposal-created',
                'operation_type' => 'crud',
              ];
              $this->insertHistory($history, 'Proposal');

              $random_number = $faker->numberBetween(1, 20);
              for( $i = 1; $i <= $random_number; $i++ ) {
                $notes = [
                    'proposal_id' => $id,
                    'created_by_id' => App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                    function ($query) {
                    $query->where('id', ADMIN_TYPE);
                    })->first()->id,
                    'description' => $faker->paragraph,
                    'date_contacted' => $faker->date('d-m-Y'),
                    'slug' => $faker->slug,
                    'owner_id' => $owner_id
                ];
                \App\ProposalsNote::create($notes);
              }
            }
            // Proposal End.

          //Internal notitfications start
          $number = rand(10, 20);
            for( $i = 0; $i < $number; $i++ ) {
              $amount = $faker->randomFloat(2,1);
              $data = [
                    'text' => $faker->sentence,
                    'link' => $faker->sentence,
                    'slug' => $faker->slug,
              ];

              $data['owner_id'] = $owner_id;
              $internal_notification = \App\InternalNotification::create( $data );
            }
            //End of internal notitfication

            // Purchase Orders.
            $random_number = $faker->numberBetween(1, 10);
            factory(App\PurchaseOrder::class, $random_number)->create([
                'owner_id' => $owner_id,
                'customer_id' => \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                    function ($query) {
                    $query->where('id', SUPPLIERS_TYPE);
                    })->first()->id,
                'currency_id' => \App\Currency::where('owner_id', $owner_id)->where('status', '=', 'Active')->inRandomOrder()->first()->id,
                'tax_id' => \App\Tax::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                'discount_id' => \App\Discount::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                'sale_agent' => App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                    function ($query) {
                    $query->where('id', CONTACT_SALE_AGENT);
                    })->first()->id,
                'invoice_number_format' => $faker->randomElement(['yearbased', 'year2digits', 'yearmonthnumber', 'yearbasedright', 'year2digitsright', 'numbermonthyear']),
            ])->each(function ($invoice) use($faker, $super_admin_id, $owner_id) {
              $products_sync = $this->randomProducts( $owner_id );
              $invoice->purchase_order_products()->sync( $products_sync['products'] );
              $invoice->amount = $products_sync['grand_total'];
              $amount = $products_sync['grand_total'];
              $update_stock = $faker->randomElement(['Yes', 'No']);
              $invoice->update_stock = $update_stock;
              $invoice->products = json_encode($products_sync['products']);
              $invoice->save();

              $id = $invoice->id;

              $history = [
                'id' => $id,
                'comments' => 'purchase-order-created',
                'operation_type' => 'crud',
              ];
              $this->insertHistory($history, 'PO');

              if ( 'Yes' == $update_stock ) {
                foreach ($products_sync['products'] as $item) {
                    
                }
              }

              $after_days = $faker->numberBetween(10, 40);
              $data = array();
              $data['date'] = $faker->date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$after_days.' days') );
              $data['amount'] = $amount;
              $data['transaction_id'] = $faker->sentence( rand(3, 10) );
              $data['account_id'] = \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
              $data['purchase_order_id'] = $id;
              $data['paymentmethod'] = \App\PaymentGateway::where('owner_id', $owner_id)->where('status', '=', 'Active')->inRandomOrder()->first()->key;
              $data['description'] = $faker->text(200);
              $data['payment_status'] = 'Success';
              $record = \App\PurchaseOrderPayment::create( $data );

              $add_to_expense_po = $faker->randomElement(['Yes', 'No']);
              $pay_method = \App\PaymentGateway::where('owner_id', $owner_id)->where('status', '=', 'Active')->inRandomOrder()->first();
              if ( $add_to_expense_po == 'Yes' ) {
                $expense = array(
                    'name' => trans('custom.invoices.payment-for-po') . $invoice->invoice_no,
                    'slug' => md5(microtime() . rand()),
                    'entry_date' => $faker->date('Y-m-d'),
                    'amount' => $amount, // Let is save amount in  currency.
                    'currency_id' => $invoice->currency_id,
                    'description' => $faker->text(200),
                    'ref_no' => $faker->sentence( rand(3, 10) ),
                    'account_id' => \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                    'payee_id' => $invoice->customer_id,
                   
                    'expense_category_id' => \App\ExpenseCategory::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                    'credit_notes_id' => $invoice->id,
                    'payment_method_id' => $pay_method->id,
                );
                \App\Expense::create( $expense );
              }

            });
            // Purchse Orders End.

            // Invoices.
            $number = rand(10, 20);
            for( $i = 0; $i < $number; $i++ ) {
              $yesno = $faker->randomElement(['yes', 'no']);
              $customer = \App\Contact::inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CUSTOMERS_TYPE);
                              })->where('owner_id', $owner_id)->first();
              $after_days = rand(1,99);
              $paymentstatus = $faker->randomElement(['unpaid', 'paid', 'due', 'partial', 'on-hold', 'rejected', 'cancelled']);
              $amount = $faker->randomFloat(2,1);
              $data = [
                  'title' => $faker->sentence,
                  'address' => $faker->address,
                  'invoice_prefix' => $faker->sentence( rand(3, 10) ),
                  'show_quantity_as' => $faker->randomElement(['Qty', 'Quantity']),
                  'invoice_no' => $faker->numberBetween(1,10000 ),
                  'status' => $faker->randomElement(['Published', 'Draft']),
                  'reference' => $faker->word,
                  'invoice_date' => $faker->date('Y-m-d'),
                  'invoice_due_date' => $faker->date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$after_days.' days')),
                  'invoice_notes' =>$faker->text(200),
                  'amount' => $amount,
                  'customer_id' => $customer->id,
                  'currency_id' => $customer->currency_id,
                  'tax_id' => \App\Tax::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'discount_id' => \App\Discount::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'products' => $faker->name,
                  'slug' => $faker->md5(),
                  'delivery_address' => $faker->address,
                  'admin_notes' => $faker->text(200),
                  'sale_agent' => \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CONTACT_SALE_AGENT);
                              })->first()->id,
                  'terms_conditions' => $faker->text(200),
                  'is_recurring' => $yesno,
                  'invoice_number_format' => $faker->randomElement(['numberbased', 'yearbased', 'year2digits', 'yearmonthnumber', 'yearbasedright', 'year2digitsright', 'numbermonthyear']),
                  'invoice_number_separator' => $faker->randomElement(['-', '#']),
                  'invoice_number_length' => $faker->numberBetween(1,6),
              ];
              if ( 'yes' === $yesno ) {
                  $data['recurring_value'] = $faker->numberBetween(1,50 );
                  $data['recurring_type'] = $faker->randomElement(['day', 'week', 'month', 'year']);
              }
              $data['owner_id'] = $owner_id;
              $invoice = \App\Invoice::create( $data );

              $products_sync = $this->randomProducts( $owner_id );
              $invoice->invoice_products()->sync( $products_sync['products'] );
              $invoice->amount = $products_sync['grand_total'];
              $invoice->products = json_encode($products_sync['products']);
              $invoice->save();

              $allowed_paymodes = [ \App\PaymentGateway::where('owner_id', $owner_id)->inRandomOrder()->first()->id ];
              $invoice->allowed_paymodes()->sync( $allowed_paymodes );

              $id = $invoice->id;

              $history = [
                'id' => $id,
                'comments' => 'invoice-created',
                'operation_type' => 'crud',
              ];
              $this->insertHistory($history, 'Invoice');

              if ( 'unpaid' == $paymentstatus && 'yes' === $yesno ) {
                $history = [
                  'id' => $id,
                  'comments' => 'Status change to ' . $paymentstatus,
                  'operation_type' => 'crud',
                ];
                $this->insertHistory($history, 'Invoice');
              }

              if ( in_array( $paymentstatus, ['paid', 'partial']) ) {
                $data = array();
                $after_days = rand(1,$after_days);

                if ( 'partial' === $paymentstatus ) {
                  $amount = $faker->randomFloat(1, $amount);
                }
                $data['date'] = $faker->date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$after_days.' days') );
                $data['amount'] = $amount;
                $data['transaction_id'] = $faker->sentence( rand(3, 10) );
                $data['account_id'] = \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
                $data['invoice_id'] = $id;
                $data['paymentmethod'] = \App\PaymentGateway::where('owner_id', $owner_id)->where('status', '=', 'Active')->inRandomOrder()->first()->key;
                $data['description'] = $faker->text(200);
                if ( 'partial' === $paymentstatus ) {
                  $data['payment_status'] = 'Success';
                }

                \App\InvoicePayment::create( $data );
                $this->insertHistory( array('id' => $id, 'comments' => 'invoices-payment-inserted', 'operation_type' => 'payment' ), 'Invoice' );

        $add_to_income_invoice = $faker->randomElement(['yes', 'no']);
        $account_details = \App\Account::find($data['account_id']);
        $pay_method = \App\PaymentGateway::where('owner_id', $owner_id)->where('status', '=', 'Active')->inRandomOrder()->first();
        if (!empty($account_details) && 'yes' === $add_to_income_invoice) {
          /**
                 * Let us convert amount to base currency
                 */

                $basecurrency = \App\Currency::where('is_default', 'yes')->first();

                if ($invoice && $basecurrency && !empty($invoice->currency_id)) {
                    $amount = ($amount / $invoice->currency->rate) * $basecurrency->rate;
                }

                if ($account_details && !empty($data['account_id'])) {
                    \App\Account::find($data['account_id'])->increment('initial_balance', $amount);
                }
          $income = array(
                    'slug' => md5(microtime() . rand()) ,
                    'entry_date' => date('d-m-Y', strtotime($invoice->invoice_date)),
                    'amount' => $amount, // Let is save amount in base currency.
                    'original_amount' => $data['amount'],
                    'original_currency_id' => $invoice->currency_id,
                    'description' => $data['description'],
                    'ref_no' => $data['transaction_id'],
                    'account_id' => ($account_details) ? $account_details->id : null,
                    'payer_id' => $invoice->customer_id,
                    'pay_method_id' => $pay_method->id,
                    'income_category_id' => \App\IncomeCategory::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                );
                \App\Income::create($income);
        }
              }

              $random_number = $faker->numberBetween(1, 20);
              for( $i = 1; $i <= $random_number; $i++ ) {
                $notes = [
                    'invoice_id' => $id,
                    'created_by_id' => App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                    function ($query) {
                    $query->where('id', ADMIN_TYPE);
                    })->first()->id,
                    'description' => $faker->paragraph,
                    'date_contacted' => $faker->date('Y-m-d'),
                ];
                \App\InvoiceNote::create($notes);
              }
            }
            // Invoices End.

            // Cart Orders.
            $random_number = $faker->numberBetween(1, 20);
            $customer = \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                                function ($query) {
                                $query->where('id', CUSTOMERS_TYPE);
                                })->first();
            factory(App\CartOrder::class, $random_number)->create([
                'owner_id' => $owner_id,
                'customer_id' => $customer->id,
                'currency_id' => $customer->currency_id,
                'billing_cycle_id' => \App\RecurringPeriod::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
            ])->each(function ($order) use($faker, $super_admin_id, $owner_id) {
                $products_sync = $this->randomProducts( $owner_id );
                $order->order_products()->sync( $products_sync['products'] );
                $order->price = $products_sync['grand_total'];
                $stock_updated = $faker->randomElement(['Yes', 'No']);
                $order->stock_updated = $stock_updated;
                $order->products = json_encode($products_sync['products']);
                $order->save();

                if ( ( 'Yes' === $stock_updated ) && ! empty( $products_sync['products'] ) ) {
                    foreach ($products_sync['products'] as $item) {
                        //digiUpdateProduct( $item['product_id'], $item['product_qty'], 'desc' );
                    }
                }

                $customer = $order->customer;
                $generate_invoice = $faker->randomElement(['Yes','No']);
                $status = $faker->randomElement(['Active','Pending']);
                if ( $customer && 'Yes' === $generate_invoice ) {
                    $paymentstatus = 'unpaid';
                    if ( 'Active' === $status ) {
                        $paymentstatus = 'paid';
                    }
                    $data = [
                        'invoice_no' => $faker->numberBetween(1,10000 ),
                        'address' => $customer->fulladdress,
                        'invoice_prefix' => getSetting( 'invoice-prefix', 'invoice-settings', '', $owner_id ),
                        'show_quantity_as' => getSetting( 'show_quantity_as', 'invoice-settings', '', $owner_id ),
                        'status' => 'Published',
                        'invoice_date' => date('d-m-Y'),
                        'invoice_due_date' => date('d-m-Y'),
                        'customer_id' => $customer->id,
                        'currency_id' => $customer->currency_id,
                        'amount' => $products_sync['grand_total'],
                        'paymentstatus' => $paymentstatus,
                        'created_by_id' => $owner_id,
                        'delivery_address' => $customer->fulladdress,
                        'terms_conditions' => $faker->text(200),
                        'admin_notes' => $faker->text(200),
                        'invoice_notes' => $faker->text(200),
                        'order_id' => $order->id,
                        'invoice_number_format' => $faker->randomElement(['numberbased', 'yearbased', 'year2digits', 'yearmonthnumber', 'yearbasedright', 'year2digitsright', 'numbermonthyear']),
                        'invoice_number_separator' => $faker->randomElement(['-', '#']),
                        'invoice_number_length' => $faker->numberBetween(1,6),
                    ];
                    $invoice = \App\Invoice::create( $data );

                    $order->generate_invoice = 'Yes';
                    $order->save();

                    if ( 'Active' === $status ) {
                        $data = array();
                        $data['date'] = date('Y-m-d');
                        $data['amount'] = $products_sync['grand_total'];
                        $data['transaction_id'] = null;
                        $data['account_id'] = \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
                        $data['invoice_id'] = $invoice->id;
                        $data['paymentmethod'] = PAYMENT_METHOD_OFFLINE;
                        $data['description'] = trans('custom.invoices.payment-for') . ' #' . $invoice->invoice_no;
                        \App\InvoicePayment::create( $data );
                    }
                }

                if ( 'Active' === $status ) {
                    $data = array(
                        'date' => digiTodayDateDB(),
                        'amount' => $products_sync['grand_total'],
                        'transaction_id' => '',
                        'account_id' => \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                        'order_id' => $order->id,
                        'paymentmethod' => PAYMENT_METHOD_OFFLINE,
                        'description' => trans('orders::global.orders.payment-description') . $order->id,
                        'slug' => md5(microtime() . $order->id . rand()),
                        'payment_status' => PAYMENT_STATUS_SUCCESS,
                    );
                    \App\OrdersPayments::create( $data );
                }

                //start add to income
                $amount = $products_sync['grand_total'];
                $account_details = \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first();
                $add_to_income = $faker->randomElement(['Yes','No']);

                if ( ! empty( $account_details ) && 'Yes' === $add_to_income ) {

                    $basecurrency = \App\Currency::where('owner_id', $owner_id)->where('is_default', 'yes')->first();
                    if ( $order && $basecurrency ) {
                        $amount = ( $amount / $order->currency->rate ) * $basecurrency->rate;
                    }

                    if ( $account_details && ! empty( $account_id ) ) {
                        // Let us add thhis account to the specified account.
                        \App\Account::find( $account_id )->increment('initial_balance', $amount);
                    }

                    // As this is the Invoice payment, so it was Income, lets add it in income.
                    $pay_method = $faker->randomElement(['paypal','paystack', 'razorpay', 'stripe']);
                    $default_currency = \App\Currency::where('owner_id', $owner_id)->where('is_default', 'yes')->first();
                    $income = array(
                        'slug' => md5(microtime() . rand()),
                        'entry_date' => date('Y-m-d', time()),
                        'amount' =>  $amount,
                        'original_amount' =>  $amount,
                        'original_currency_id' => ( $default_currency ) ? $default_currency->id : null,
                        'description' => trans('others.orders.payment-for') . $order->id,
                        'ref_no' => $order->id,
                        'account_id' => ( $account_details ) ? $account_details->id : null,
                        'payer_id' => $order->customer_id,
                        'pay_method_id' => \App\PaymentGateway::where('owner_id', $owner_id)->where('key', '=', $pay_method )->first()->id,
                    );
                    \App\Income::create( $income );

                    $order->add_to_income = 'Yes';
                    $order->save();
                }
            });
            // Cart Orders.

      // Credit Notes.
            $number = rand(1, 10);
            for( $i = 0; $i < $number; $i++ ) {
                $paymentstatus = $faker->randomElement(['unpaid', 'paid', 'due', 'partial', 'on-hold', 'rejected', 'cancelled']);
                $customer = \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CUSTOMERS_TYPE);
                              })->first();
                $after_days = rand(1,99);
                $total_amount = $faker->randomFloat(2,1);
                $data = [
                  'title' => $faker->word,
                  'address' => $faker->address,
                  'invoice_prefix' => $faker->sentence( rand(3, 10) ),
                  'show_quantity_as' => $faker->randomElement(['Qty', 'Quantity']),
                  'invoice_no' => $faker->numberBetween(1,10000 ),
                  'status' => $faker->randomElement(['Published', 'Draft']),
                  'reference' => $faker->word,
                  'invoice_date' => $faker->date('Y-m-d'),
                  'invoice_due_date' => $faker->date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$after_days.' days')),
                  'invoice_notes' =>implode( "\n\n", $faker->paragraphs ),
                  'amount' => $total_amount,
                  'customer_id' => $customer->id,
                  'currency_id' => $customer->currency_id,
                  'tax_id' => \App\Tax::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'discount_id' => \App\Discount::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'created_by_id' => \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', ADMIN_TYPE);
                              })->first(),
                  'slug' => $faker->slug,
                  'delivery_address' => $faker->address,
                  'admin_notes' => implode( "\n\n", $faker->paragraphs ),
                  'sale_agent' => \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CONTACT_SALE_AGENT);
                              })->first()->id,
                  'terms_conditions' => implode( "\n\n", $faker->paragraphs ),
                  'invoice_number_format' => $faker->randomElement(['numberbased', 'yearbased', 'year2digits', 'yearmonthnumber', 'yearbasedright', 'year2digitsright', 'numbermonthyear']),
                  'invoice_number_separator' => $faker->randomElement(['-', '#']),
                  'invoice_number_length' => $faker->numberBetween(1,6),
              ];
              $data['owner_id'] = $owner_id;
              $credit_note = \App\CreditNote::create( $data );

              $products_sync = $this->randomProducts( $owner_id );
              $credit_note->credit_note_products()->sync( $products_sync['products'] );
              $credit_note->amount = $products_sync['grand_total'];
              $credit_note->products = json_encode($products_sync['products']);
              $credit_note->save();

              $id = $credit_note->id;

              $history = [
                'id' => $id,
                'comments' => 'credit-note-created',
                'operation_type' => 'crud',
              ];
              $this->insertHistory($history, 'CreditNote');

              if ( in_array( $paymentstatus, ['paid', 'partial']) ) {
                $data = array();
                $after_days = rand(1,$after_days);

                $amount = $total_amount;
                if ( 'partial' === $paymentstatus ) {
                  $amount = $faker->randomFloat(1, $amount);
                }
                $data['date'] = $faker->date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$after_days.' days') );
                $data['amount'] = $amount;
                $data['transaction_id'] = $faker->sentence( rand(3, 10) );
                $data['account_id'] = \App\Account::where('owner_id', $owner_id)->inRandomOrder()->first()->id;
                $data['credit_note_id'] = $id;
                $data['paymentmethod'] = \App\PaymentGateway::where('owner_id', $owner_id)->where('status', '=', 'Active')->inRandomOrder()->first()->key;
                $data['description'] = $faker->text(200);
                if ( 'partial' === $paymentstatus ) {
                  $data['payment_status'] = 'Success';
                }

                if ( $amount >=  $total_amount ) {
                  $credit_note->credit_status = 'Closed';
                  $credit_note->save();
                }

                \App\CreditNotePayment::create( $data );
                $this->insertHistory( array('id' => $id, 'comments' => 'invoices-payment-inserted', 'operation_type' => 'payment' ), 'CreditNote' );
              }
            }
            // Credit notes end.

            // Contracts.
            $number = rand(1, 10);
            for( $i = 0; $i < $number; $i++ ) {
              $customer = \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CUSTOMERS_TYPE);
                              })->first();
              $after_days = rand(1, 99);
              $data = [
                  'subject' => $faker->sentence,
                  'address' => $faker->address,
                  'invoice_prefix' => $faker->sentence( rand(3, 10) ),
                  'show_quantity_as' => $faker->randomElement(['Qty', 'Quantity']),
                  'contract_value' => $faker->randomFloat(2,1),
                  'contract_type_id' => \App\Contracttype::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'visible_to_customer' => $faker->randomElement(['yes', 'no']),
                  'invoice_no' => $faker->numberBetween(1,10000 ),
                  'status' => $faker->randomElement(['Published', 'Draft']),
                  'reference' => $faker->word,
                  'invoice_date' => $faker->date('Y-m-d'),
                  'invoice_due_date' => $faker->date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$after_days.' days')),
                  'invoice_notes' =>$faker->paragraph,

                  'customer_id' => $customer->id,
                  'currency_id' => $customer->currency_id,
                  'tax_id' => \App\Tax::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'discount_id' => \App\Discount::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  //'products' => $faker->name,
                  'slug' => $faker->md5(),
                  'recurring_period_id' => \App\RecurringPeriod::where('owner_id', $owner_id)->inRandomOrder()->first()->id,
                  'amount' => $faker->randomFloat(2,1),
                  'delivery_address' => $faker->address,
                  'admin_notes' => $faker->text(200),
                  'sale_agent' => \App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                              function ($query) {
                              $query->where('id', CONTACT_SALE_AGENT);
                              })->first()->id,
                  'terms_conditions' => $faker->text(200),
                  'paymentstatus' => $faker->randomElement(['Delivered', 'On-Hold', 'Accepted', 'Rejected']),
                  'invoice_number_format' => $faker->randomElement(['numberbased', 'yearbased', 'year2digits', 'yearmonthnumber', 'yearbasedright', 'year2digitsright', 'numbermonthyear']),
                  'invoice_number_separator' => $faker->randomElement(['-', '#']),
                  'invoice_number_length' => $faker->numberBetween(1,6),
              ];
              $data['owner_id'] = $owner_id;
              $contract = \App\Contract::create( $data );

              $id = $contract->id;

              $history = [
                'id' => $id,
                'comments' => 'contract-created',
                'operation_type' => 'crud',
              ];
              $this->insertHistory($history, 'Contract');

              $random_number = $faker->numberBetween(1, 20);
              for( $i = 1; $i <= $random_number; $i++ ) {
                $notes = [
                    'owner_id' => $owner_id,
                    'slug' => $faker->md5(),
                    'contract_id' => $id,
                    'created_by_id' => App\Contact::where('owner_id', $owner_id)->inRandomOrder()->whereHas("contact_type",
                    function ($query) {
                    $query->where('id', ADMIN_TYPE);
                    })->first()->id,
                    'description' => $faker->paragraph,
                    'date_contacted' => $faker->date('Y-m-d'),
                ];
                \App\ContractsNote::create($notes);
              }
            }
          });
        }
            // Contract End.

          private function randomProducts( $owner_id = '' )
          {
            $faker = Faker::create();
            $qty = rand(1,10);
            $products_sync = [];
            $grand_total = 0;
            for( $i = 0; $i < $qty; $i++ ) {
              $product = \App\Product::where('owner_id', $owner_id)->inRandomOrder()->first();
              $tax_type = $discount_type = $faker->randomElement( [ 'percent', 'value' ] );

              $product_price = rand(1, $product->sale_price);
              $product_qty = rand(1, $product->stock_quantity );
              $product_amount = $product_price * $product_qty;

              $product_tax = $tax_value = rand(1,99);
              if ( $tax_type == 'percent' ) {
                $tax_value = ( $product_amount * $product_tax) / 100;
              }

              $product_discount = $discount_value = rand(1,99);
              if ( $discount_type == 'percent' ) {
                $discount_value = ( $product_amount * $discount_value) / 100;
              }

              $amount = ($product_qty * $product_price) + $tax_value - $discount_value;

              $grand_total += $amount;

              $sync_product = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'name'=> $product->name,
                'product_qty' => $product_qty,
                'product_price' => $product_price,

                'product_tax' => $product_tax, // Rate
                'tax_type' => $tax_type,
                'tax_value' => $tax_value,

                'product_discount' => $product_discount, // Rate
                'discount_type' => $discount_type,
                'discount_value' => $discount_value,

                'product_subtotal' => $amount,
                'product_amount' => $amount,
                'pid' => $product->id,
                'stock_quantity' => $product->stock_quantity,
                'product_description' => $product->product_description,
              ];
              $products_sync[] = $sync_product;
            }
            return [ 'products' => $products_sync, 'grand_total' => $grand_total];
          }

        function insertHistory( $data, $type )
        {
          $faker = Faker::create();

          $id = ! empty( $data['id'] ) ? $data['id'] : 0;
          $comments = ! empty( $data['comments'] ) ? $data['comments'] : 0;
          $operation_type = ! empty( $data['operation_type'] ) ? $data['operation_type'] : 'general';

          $log = array(
              'ip_address' => $faker->ipv4,
              'country' => $faker->country,
              'city' => $faker->city,
              'browser' => $faker->userAgent,
              'comments' => $comments,
              'operation_type' => $operation_type,
          );
          switch( $type ) {
            case 'PO':
              $log['purchase_order_id'] = $data['id'];
              \App\PurchaseOrderHistory::create( $log );
              break;
            case 'Invoice':
              $log['invoice_id'] = $data['id'];
              \App\InvoicesHistory::create( $log );
              break;
            case 'CreditNote':
              $log['credit_note_id'] = $data['id'];
              \App\CreditNoteHistory::create( $log );
              break;
            case 'Quote':
              $log['quote_id'] = $data['id'];
              \App\QuoteHistory::create( $log );
              break;
            case 'Proposal':
              $log['proposal_id'] = $data['id'];
              \App\ProposalHistory::create( $log );
              break;
            case 'Contract':
              $log['contract_id'] = $data['id'];
              \App\ContractHistory::create( $log );
              break;
          }
        }

        // });
    // }
}