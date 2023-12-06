<?php
/**
 * Invoice Ninja (https://invoiceninja.com).
 *
 * @link https://github.com/invoiceninja/invoiceninja source repository
 *
 * @copyright Copyright (c) 2023. Invoice Ninja LLC (https://invoiceninja.com)
 *
 * @license https://www.elastic.co/licensing/elastic-license
 */

namespace App\Models;

use App\Models\Filterable;
use App\Models\Traits\Excludable;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankIntegration extends BaseModel
{
    use SoftDeletes;
    use Filterable;
    use Excludable;

    protected $fillable = [
        'bank_account_name',
        'provider_name',
        'bank_account_number',
        'bank_account_status',
        'bank_account_type',
        'balance',
        'currency',
        'from_date',
        'auto_sync',
    ];

    protected $dates = [
    ];

    const INTEGRATION_TYPE_YODLEE = 'YODLEE';

    const INTEGRATION_TYPE_NORDIGEN = 'NORDIGEN';

    public function getEntityType()
    {
        return self::class;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function transactions()
    {
        return $this->hasMany(BankTransaction::class)->withTrashed();
    }

}
