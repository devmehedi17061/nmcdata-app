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
        Schema::table('employees', function (Blueprint $table) {
            // Basic Information
            $table->string('employee_id')->unique()->nullable()->after('id'); // Auto-generated unique ID
            $table->date('date_of_birth')->nullable()->after('email');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            $table->string('blood_group')->nullable()->after('gender');
            $table->string('photo')->nullable()->after('blood_group');
            $table->string('emergency_contact_name')->nullable()->after('phone');
            $table->string('emergency_contact_phone')->nullable()->after('emergency_contact_name');

            // Job Information
            $table->enum('employment_type', ['full-time', 'part-time', 'contract', 'intern'])->default('full-time')->after('department');
            $table->enum('work_shift', ['morning', 'evening', 'night'])->default('morning')->after('employment_type');
            $table->enum('salary_type', ['monthly', 'hourly'])->default('monthly')->after('salary');
            $table->foreignId('reporting_manager_id')->nullable()->after('salary_type')->constrained('employees')->onDelete('set null');
            $table->string('work_location')->nullable()->after('reporting_manager_id');
            $table->date('confirmation_date')->nullable()->after('hire_date');

            // Address - State, Zip and Permanent Address
            $table->string('state')->nullable()->after('city');
            $table->string('zip_code')->nullable()->after('state');
            $table->text('permanent_address')->nullable()->after('address');
            $table->string('permanent_city')->nullable()->after('permanent_address');
            $table->string('permanent_state')->nullable()->after('permanent_city');
            $table->string('permanent_zip_code')->nullable()->after('permanent_state');
            $table->string('permanent_country')->nullable()->after('permanent_zip_code');

            // Document Uploads
            $table->string('cv_file')->nullable();
            $table->string('nid_file')->nullable();
            $table->string('appointment_letter_file')->nullable();
            $table->string('offer_letter_file')->nullable();
            $table->string('academic_certificate_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['reporting_manager_id']);
            
            // Basic Information
            $table->dropColumn([
                'employee_id',
                'date_of_birth',
                'gender',
                'blood_group',
                'photo',
                'emergency_contact_name',
                'emergency_contact_phone',
            ]);

            // Job Information
            $table->dropColumn([
                'employment_type',
                'work_shift',
                'salary_type',
                'reporting_manager_id',
                'work_location',
                'confirmation_date',
            ]);

            // Address
            $table->dropColumn([
                'state',
                'zip_code',
                'permanent_address',
                'permanent_city',
                'permanent_state',
                'permanent_zip_code',
                'permanent_country',
            ]);

            // Documents
            $table->dropColumn([
                'cv_file',
                'nid_file',
                'appointment_letter_file',
                'offer_letter_file',
                'academic_certificate_file',
            ]);
        });
    }
};
