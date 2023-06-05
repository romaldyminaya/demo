<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Settings extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slogan',
        'nif_type',
        'nif',
        'email',
        'phone_number_1',
        'phone_number_2',
        'logo',
        'country_code',
        'state_id',
        'city',
        'address_line_1',
        'address_line_2',
        'zip_code',
        'local_currency',
        'functional_currency',
        'default_ar_control_account',
        'default_ap_control_account',
        'default_bank_control_account',
        'default_cashbox_control_account',
        'quotation_due_days',
        'primary_color',
        'secondary_color',
        'primary_color_light',
        'sales_invoice_footer',
        'quotation_footer',
        'disable_logo',
        'disable_tax',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::of($value)->lower(),
            get: fn ($value) => Str::of($value)->title(),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::of($value)->trim()->lower(),
            get: fn ($value) => $value,
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function addressLine1(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::of($value)->trim()->lower(),
            get: fn ($value) => $value,
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function addressLine2(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::of($value)->trim()->lower(),
            get: fn ($value) => $value,
        );
    }
}
