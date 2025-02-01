<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\Vendor;
use App\Models\Admin;

class VendorController extends Controller
{
    public function loginRegister() { // render vendor login_register.blade.php page    
        return view('front.vendors.login_register');
    }

    public function vendorRegister(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
    
            // Validation
            $rules = [
                'name'    => 'required',
                'mname'   => 'nullable',
                'lname'   => 'required',
                'email'   => 'required|email|unique:admins|unique:vendors',
                'mobile'  => 'required|min:10|numeric|unique:admins|unique:vendors',
                'accept'  => 'required'
            ];
    
            $customMessages = [
                'name.required'   => 'First Name is required',
                'lname.required'  => 'Last Name is required',
                'email.required'  => 'Email is required',
                'email.unique'    => 'Email already exists',
                'mobile.required' => 'Mobile is required',
                'mobile.unique'   => 'Mobile already exists',
                'accept.required' => 'Please accept Terms & Conditions',
            ];
    
            $validator = Validator::make($data, $rules, $customMessages);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
    
            DB::beginTransaction();
            try {
                // Insert into `vendors` table and get the inserted ID
                $vendor_id = DB::table('vendors')->insertGetId([
                    'name'       => $data['name'],
                    'mname'      => $data['mname'],
                    'lname'      => $data['lname'],
                    'mobile'     => $data['mobile'],
                    'email'      => $data['email'],
                    'rsbsaNumber'=> $data['rsbsaNumber'],
                    'commission' => 15.00,
                    'status'     => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
    
                // Insert into `admins` table with the same vendor ID
                DB::table('admins')->insert([
                    'id'         => $vendor_id, // Ensure the admin's ID matches the vendor's ID
                    'type'       => 'vendor',
                    'vendor_id'  => $vendor_id,
                    'name'       => $data['name'],
                    'mname'      => $data['mname'],
                    'lname'      => $data['lname'],
                    'mobile'     => $data['mobile'],
                    'email'      => $data['email'],
                    'rsbsaNumber'=> $data['rsbsaNumber'],
                    'password'   => bcrypt($data['password']),
                    'status'     => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
    
                // Send Confirmation Email
                $email = $data['email'];
                $messageData = [
                    'email' => $data['email'],
                    'name'  => $data['name'],
                    'code'  => base64_encode($data['email'])
                ];
    
                \Illuminate\Support\Facades\Mail::send('emails.vendor_confirmation', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Confirm your Breeder Account');
                });
    
                DB::commit();
    
                // Redirect back with success message
                return redirect()->back()->with('success_message', 'Thanks for registering as a Breeder. Please confirm your email to activate your account.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error_message', 'An error occurred. Please try again.');
            }
        }
    }
    

    public function confirmVendor($email) { // Confirm Vendor Account (the confirmation mail sent from 'vendor_confirmation.blade.php) from the mail by Mailtrap         // {code} $code is the base64 encoded vendor email with which they have registered which is a Route Parameters/URL Paramters which we received from the route: https://laravel.com/docs/9.x/routing#required-parameters    // this route is requested (accessed/opened) from inside the mail sent to vendor (vendor_confirmation.blade.php)
        // Note: Vendor CONFIRMATION occurs automatically through vendor clicking on the confirmation link sent in the email, but vendor ACTIVATION (active/inactive/disabled) occurs manually where 'superadmin' or 'admin' activates the `status` from the Admin Panel in 'Admin Management' tab, then clicks Status. Also, Vendor CONFIRMATION is related to the `confirm` columns in BOTH `admins` and `vendors` tables, but vendor ACTIVATION (active/inactive/disabled) is related to the `status` columns in BOTH `admins` and `vendors` tables!
        // Note: Vendor receives THREE emails: the first one when they register (please click on the confirmation link mail (in emails/vendor_confirmation.blade.php)), the second one when they click on the confirmation link sent in the first email (telling them that they have been confirmed and asking them to complete filling in their personal, business and bank details to get ACTIVATED/APPROVED (`status gets 1) (in emails/vendor_confirmed.blade.php)), the third email when the 'admin' or 'superadmin' manually activates (`status` becomes 1) the vendor from the Admin Panel from 'Admin Management' tab, then clicks Status (the email tells them they have been approved (activated and `status` became 1) and asks them to add their products on the website (in emails/vendor_approved.blade.php))

        $email = base64_decode($email); // we use the opposite (decode()) of what we used in the vendorRegister() (encode) 

        // For Security Reasons, check if the vendor email exists first (after the vendor has entered their mail while registering)
        $vendorCount = Vendor::where('email', $email)->count();
        if ($vendorCount > 0) { // if the vendor email exists
            // Check if the vendor is alreay active
            $vendorDetails = Vendor::where('email', $email)->first();
            if ($vendorDetails->confirm == 'Yes') { // if the vendor is already confirmed

                // Redirect vendor to vendor Login/Register page with an 'error' message
                $message = 'Your Vendor Account is already confirmed. You can login';
                return redirect('vendor/login-register')->with('error_message', $message);

            } else { // (!! DATABASE TRANSACTION !!) if the vendor account is not confirmed, then confirm it (by updating the `confirm` column to 'Yes' in BOTH `vendors` and `admins` tables) (!! DATABASE TRANSACTION !!)
                // Note: Vendor CONFIRMATION occurs automatically through vendor clicking on the confirmation link sent in the email, but vendor ACTIVATION (active/inactive/disabled) occurs manually where 'superadmin' or 'admin' activates the `status` from the Admin Panel in 'Admin Management' tab, then clicks Status. Also, Vendor CONFIRMATION is related to the `confirm` columns in BOTH `admins` and `vendors` tables, but vendor ACTIVATION (active/inactive/disabled) is related to the `status` columns in BOTH `admins` and `vendors` tables!
                // Note: Vendor receives THREE emails: the first one when they register (please click on the confirmation link mail (in emails/vendor_confirmation.blade.php)), the second one when they click on the confirmation link sent in the first email (telling them that they have been confirmed and asking them to complete filling in their personal, business and bank details to get ACTIVATED/APPROVED (`status gets 1) (in emails/vendor_confirmed.blade.php)), the third email when the 'admin' or 'superadmin' manually activates (`status` becomes 1) the vendor from the Admin Panel from 'Admin Management' tab, then clicks Status (the email tells them they have been approved (activated and `status` became 1) and asks them to add their products on the website (in emails/vendor_approved.blade.php))

                Admin::where( 'email', $email)->update(['confirm' => 'Yes']);
                Vendor::where('email', $email)->update(['confirm' => 'Yes']);


                // Send ANOTHER email to the vendor (The Registration Success email)
                // Send the Registration Success Email to the new vendor who has just registered    

                // The email message data/variables that will be passed in to the email view
                $messageData = [
                    'email'  => $email,
                    'name'   => $vendorDetails->name,
                    'mobile' => $vendorDetails->mobile
                ];
                \Illuminate\Support\Facades\Mail::send('emails.vendor_confirmed', $messageData, function ($message) use ($email) { // Sending Mail: https://laravel.com/docs/9.x/mail#sending-mail    // 'emails.vendor_confirmed' is the vendor_confirmed.blade.php file inside the 'resources/views/emails' folder that will be sent as an email    // We pass in all the variables that vendor_confirmed.blade.php will use    // https://www.php.net/manual/en/functions.anonymous.php
                    $message->to($email)->subject('Your Breeder Account is Confirmed');
                });


                // Redirect vendor to vendor Login/Register page with a 'success' message
                $message = 'Your Breeder Email account is confirmed. You can login and add your personal, business and bank details to activate your Breeder Account to add products';
                return redirect('vendor/login-register')->with('success_message', $message);
            }
        } else { // if the vendor email doesn't exist (hacking or cyber attack!!)
            abort(404);
        }
    }

    public function showProductAttributes($id){
        $vendor = Vendor::find(auth()->user()->id); // Get the logged-in vendor's details

        // Check if the vendor has an RSBSA number
        $hasRsbsa = !empty($vendor->rsbsaNumber); // This flag will be used to limit stock

        return view('admin.product.attributes', compact('hasRsbsa', 'id')); // Pass the flag to the view
    }

}