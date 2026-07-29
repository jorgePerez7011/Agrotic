<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('evidences', function (Blueprint $table) {
            $table->string('crop')->nullable()->after('date');
            $table->decimal('total_area', 12, 2)->nullable()->after('crop');
            $table->decimal('cultivable_area', 12, 2)->nullable()->after('total_area');
            $table->text('terrain_zones')->nullable()->after('cultivable_area');
            $table->text('planting_plan')->nullable()->after('terrain_zones');
            $table->text('irrigation_system')->nullable()->after('planting_plan');
            $table->text('transit_route')->nullable()->after('irrigation_system');
            $table->text('collection_plan')->nullable()->after('transit_route');
            $table->text('additional_considerations')->nullable()->after('collection_plan');
            $table->text('summary')->nullable()->after('additional_considerations');
            $table->decimal('estimated_investment', 12, 2)->nullable()->after('summary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evidences', function (Blueprint $table) {
            $table->dropColumn([
                'crop',
                'total_area',
                'cultivable_area',
                'terrain_zones',
                'planting_plan',
                'irrigation_system',
                'transit_route',
                'collection_plan',
                'additional_considerations',
                'summary',
                'estimated_investment'
            ]);
        });
    }
};
