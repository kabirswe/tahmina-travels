<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Ticket extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'agent_id',
        'source_id',
        'departure',
        'destination',
        'ticket_issue_date',
        'travel_date',
        'corona_test_date',
        'quantity',
        'corona_test_result',
        'ticket_status',
        'payment_type_id',
        'price',
        'sell_price',
        'payment_status',
        'created_by',
        'updated_by'
    ];

    public static $logName = 'Ticket';

    protected static $logAttributes = [
        'user_id',
        'agent_id',
        'source_id',
        'departure',
        'destination',
        'ticket_issue_date',
        'travel_date',
        'corona_test_date',
        'quantity',
        'corona_test_result',
        'ticket_status',
        'payment_type_id',
        'price',
        'sell_price',
        'payment_status',
    ];

    protected static $logOnlyDirty = true;
}
