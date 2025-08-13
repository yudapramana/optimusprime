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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->decimal('tuition_fee', 12, 2);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('academic_semesters', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->date('start_date');
            $table->date('mid_date')->nullable();
            $table->date('end_date');
            $table->timestamps();
        });

        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->string('account_name');
            $table->string('account_number');
            $table->timestamps();
        });

        Schema::create('installment_schemes', function (Blueprint $table) {
            $table->id();
            $table->enum('scheme_name', ['one_time_payment', 'installment_three_times']);
            $table->timestamps();
        });

        Schema::create('three_installment_criterias', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['start_date', 'mid_date', 'end_date']);
            $table->integer('percentage');
            $table->timestamps();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nidn')->unique();
            $table->foreignId('faculty_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nim')->unique();
            $table->string('name');
            $table->enum('gender', ['L', 'P']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->text('address');
            $table->year('enrollment_year');
            $table->enum('entry_semester', ['ganjil', 'genap']);
            $table->enum('status', ['aktif', 'nonaktif', 'lulus', 'dropout'])->default('aktif');
            $table->enum('account_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('photo_url')->nullable();
            $table->foreignId('faculty_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('academic_semester_id')->constrained()->onDelete('cascade');
            $table->foreignId('installment_scheme_id')->constrained()->onDelete('cascade');
            $table->decimal('tuition_fee', 12, 2);
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('installment_id')->constrained()->onDelete('cascade');
            $table->string('reference_id')->unique();
            $table->string('academic_semester', 20)->nullable();
            $table->integer('installment_number'); // 1, 2, 3
            $table->integer('percentage'); // Misal: 50, 25, 25
            $table->decimal('amount_paid', 12, 2)->nullable();
            $table->unsignedInteger('bank_id')->nullable();
            $table->string('eviden_url')->nullable();
            $table->string('receipt_number')->nullable();
            $table->date('transfer_date')->nullable();
            $table->date('upload_date')->nullable();
            $table->date('due_date');
            $table->enum('status', ['not_uploaded', 'pending', 'approved', 'rejected'])->default('not_uploaded');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('installments');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('students');
        Schema::dropIfExists('three_installment_criterias');
        Schema::dropIfExists('installment_schemes');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('academic_semesters');
        Schema::dropIfExists('faculties');
    }
};
