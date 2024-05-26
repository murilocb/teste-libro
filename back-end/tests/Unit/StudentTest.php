<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_requires_name_email_and_date_of_birth()
    {
        $this->expectException(ValidationException::class);

        Student::create([
            // Intentionally leaving out 'name', 'email', and 'date_of_birth'
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_creates_a_student_with_valid_data()
    {
        $student = Student::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'gender' => 'male',
            'date_of_birth' => '2000-01-01',
        ]);

        $this->assertDatabaseHas('students', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'gender' => 'male',
            'date_of_birth' => '2000-01-01',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_allows_optional_gender()
    {
        $student = Student::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'date_of_birth' => '2002-05-15',
        ]);

        $this->assertDatabaseHas('students', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'date_of_birth' => '2002-05-15',
        ]);
    }
}


