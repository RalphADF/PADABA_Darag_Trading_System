<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;


    
    public static function getShippingCharges($total_weight, $country = null) {
        // Retrieve shipping details for the given country
        $shippingDetails = ShippingCharge::where('country', $country)->first();
    
        // If no shipping details are found, return a default rate
        if (!$shippingDetails) {
            return 10; // Return default rate if no shipping details are found
        }
    
        // Convert shipping details to array
        $shippingDetails = $shippingDetails->toArray();
    
        // Default to rate 10 if municipality is null
        if (is_null($country)) {
            $rate = 100;
        } else {
            // Calculate rate based on weight
            if ($total_weight > 0) {
                if ($total_weight > 0 && $total_weight <= 500) {
                    $rate = $shippingDetails['0_500g'];
                } elseif ($total_weight > 500 && $total_weight <= 1000) {
                    $rate = $shippingDetails['501g_1000g'];
                } elseif ($total_weight > 1000 && $total_weight <= 2000) {
                    $rate = $shippingDetails['1001_2000g'];
                } elseif ($total_weight > 2000 && $total_weight <= 5000) {
                    $rate = $shippingDetails['2001g_5000g'];
                } elseif ($total_weight > 5000) {
                    $rate = $shippingDetails['above_5000g'];
                } else {
                    $rate = 0;
                }
            } else {
                $rate = 0;
            }
        }
    
        return $rate; 
    }
    

}