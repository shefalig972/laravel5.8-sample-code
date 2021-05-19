<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCombineTaskView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("DROP VIEW IF EXISTS combinedTasksView;");
        \Illuminate\Support\Facades\DB::statement("CREATE VIEW combinedTasksView AS
            SELECT contact_tasks.id, contact_tasks.contact_id, NULL AS booking_id, NULL AS lead_id, NULL AS user_id, contact_tasks.task_due_type, contact_tasks.custom_date, contact_tasks.task_type, contact_tasks.refer_to, contact_tasks.detail, contact_tasks.status, contact_tasks.created_by, contact_tasks.updated_by, contact_tasks.created_at, CONCAT(contacts.first_name,' ',contacts.last_name) AS related_to FROM contact_tasks LEFT JOIN contacts ON contact_tasks.contact_id = contacts.id
            UNION ALL
            SELECT booking_tasks.id, NULL AS contact_id, booking_tasks.booking_id, NULL AS lead_id, NULL AS user_id, booking_tasks.task_due_type, booking_tasks.custom_date, booking_tasks.task_type, booking_tasks.refer_to, booking_tasks.detail, booking_tasks.status, booking_tasks.created_by, booking_tasks.updated_by, booking_tasks.created_at, bookings.name as realted_to FROM booking_tasks LEFT JOIN bookings ON booking_tasks.booking_id=bookings.id
            UNION ALL
            SELECT lead_tasks.id, NULL AS contact_id, NULL AS booking_id, lead_tasks.lead_id, NULL AS user_id, lead_tasks.task_due_type, lead_tasks.custom_date, lead_tasks.task_type, NULL AS refer_to, lead_tasks.detail, lead_tasks.status, lead_tasks.created_by, lead_tasks.updated_by, lead_tasks.created_at, leads.name as related_at FROM lead_tasks LEFT JOIN leads ON lead_tasks.lead_id=leads.id
            UNION ALL
            SELECT id, NULL AS contact_id, NULL AS booking_id, NULL AS lead_id, user_id, task_due_type, custom_date, task_type, refer_to, detail, status, created_by, updated_by, created_at, NULL as related_at FROM user_tasks");
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement("DROP VIEW IF EXISTS combinedTasksView;");
    }
}
