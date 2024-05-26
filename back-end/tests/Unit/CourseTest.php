<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_requires_title()
    {
        $this->expectException(ValidationException::class);

        Course::create([
            // Intentionally leaving out 'title'
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_creates_a_course_with_valid_data()
    {
        $course = Course::create([
            'title' => 'Mathematics 101',
            'description' => 'An introductory course to Mathematics.',
        ]);

        $this->assertDatabaseHas('courses', [
            'title' => 'Mathematics 101',
            'description' => 'An introductory course to Mathematics.',
        ]);
    }
}





