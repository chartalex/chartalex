<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [	'user_id',
    						'amount',
    						'email',
    						'shipping_fees',
    						'shipto_firstname',
    						'shipto_lastname',
    						'shipto_street',
    						'shipto_street2',
    						'shipto_zip',
    						'shipto_city',
    						'shipto_country',
    						'transaction_id'];
}
