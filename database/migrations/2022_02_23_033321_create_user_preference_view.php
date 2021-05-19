<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPreferenceView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS user_preference_view;");

        DB::statement("CREATE  VIEW user_preference_view as
SELECT subscribed_users.user_id, user_org_map_id,subscription_products.id AS subscription_product_id, subscription_products.stripe_product_name, subscription_pricing_plans.stripe_price_id, subscribed_users.trial_product_type, subscription_pricing_plans.plan_price, subscription_pricing_plans.final_price,  subscription_pricing_plans.interval as 'plan_interval',plan_start_date, plan_expiration_date, subscribed_users.is_active as 'plan_is_active', subscription_status, subscribed_users.is_trail as 'plan_is_trail'
FROM subscribed_users
INNER JOIN subscription_pricing_plans ON subscription_pricing_plans.stripe_price_id = subscribed_users.stripe_price_id
INNER JOIN subscription_products ON subscription_products.id = subscription_pricing_plans.subscription_product_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS user_preference_view;");
    }
}
