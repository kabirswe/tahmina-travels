<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
        'amount',
        'created_by',
        'updated_by'
    ];

    public static $logName = 'Payment';

    protected static $logAttributes = [
        'ticket_id',
        'amount'
    ];

    protected static $logOnlyDirty = true;
}
