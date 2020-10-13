<?php

namespace App\Tenant\Rules;

use App\Tenant\ManagerTenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class UniqueTenant implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $tenantId = app(ManagerTenant::class)->getTenantIdentify();

        $register = DB::table($this->table)
            ->where($attribute, $value)
            ->where('tenant_id', $tenantId)
            ->first();

        if (is_null($register)) {
            return true;
        } else {
            return false;
        }
        //return is_null($register);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O valor para attribute já esta em uso!';
    }
}
