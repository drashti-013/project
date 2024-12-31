<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalQtyAndTotalAmountToCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->integer('total_qty')->default(0)->after('is_watchlist'); // Adjust 'last_column_name' as needed.
            $table->decimal('total_amount', 10, 2)->default(0.00)->after('total_qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['total_qty', 'total_amount']);
        });
    }
}
