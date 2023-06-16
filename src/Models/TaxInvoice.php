<?php

namespace Denngarr\Seat\Billing\Models;

use Illuminate\Database\Eloquent\Model;
use Seat\Eveapi\Models\Character\CharacterInfo;
use Seat\Eveapi\Models\Corporation\CorporationInfo;
use Seat\Web\Models\User;

class TaxInvoice extends Model
{
    protected $fillable = ["group_id","tax_rate"];

    public $timestamps = false;

    protected $table = 'seat_billing_tax_invoices';

    protected $casts = [
        'reason_translation_data' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class,'id','user_id');
    }

    public function character(){
        return $this->belongsTo(CharacterInfo::class,'character_id','character_id');
    }

    public function receiver_corporation(){
        return $this->belongsTo(CorporationInfo::class,'corporation_id','receiver_corporation_id');
    }
}
