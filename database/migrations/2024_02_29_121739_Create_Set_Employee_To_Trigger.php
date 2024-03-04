<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateSetEmployeeToTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER set_employee_to AFTER INSERT ON procedures FOR EACH ROW
            BEGIN
                UPDATE transactions
                SET to_employee = NEW.to_employee
                WHERE NEW.to_employee IS NOT NULL
                AND id = NEW.transaction_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS set_employee_to');
    }
}
