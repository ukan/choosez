<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use DB;
use Sentinel;
use Mail;

class AutoresponseEmail extends Model
{
    const MOS_REGISTER = 'mos_register';
    const STATUS = 'pending';
    const DELIVERED = 'delivered';

    protected $table = 'autoresponse_emails';

    protected $fillable = [
        'email',  
        'full_name', 
        'password', 
        'type', 
        'status',
    ];
    
    public static function email_blast()
    {
        $autoresponse_emails = self::where('status',self::STATUS)->get();
        if($autoresponse_emails){
            foreach ($autoresponse_emails as $key => $value) {
                if($value['type'] == 'mos_register'){
                    $find_data['email'] = $value['email'];
                    $find_data['full_name'] = $value['full_name'];
                    $find_data['password'] = $value['password'];
                    
                    Mail::send('email.new_mos_register', $find_data, function($message) use($find_data) {
                                $message->from("noreply@ponpesalihsancbr.id", 'Al-Ihsan No-Reply');
                                $message->to($find_data['email'], $find_data['full_name'])->subject('Notification');
                            });
                }
                
                if (Mail::failures()) {       
                
                }else{
                    $autoresponse = self::find($value['id']);
                    $autoresponse->status = self::DELIVERED;
                    $autoresponse->save();
                }
            }
        }
    }
}
