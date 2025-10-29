<?php

namespace App\Http\Resources;

use App\Models\Instructor;
use App\Repositories\InstructorRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class InstructorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $instructor = InstructorRepository::query()
            ->with(['user'])
            ->withCount('courses')
            ->withCount([
                'courses as reviews_count' => function ($query) {
                    $query->join('reviews', 'reviews.course_id', '=', 'courses.id')
                        ->select(DB::raw('count(reviews.id)'));
                }
            ])
            ->withAvg([
                'courses as rating_avg' => function ($query) {
                    $query->join('reviews', 'reviews.course_id', '=', 'courses.id')
                        ->select(DB::raw('avg(reviews.rating)'));
                }
            ], 'rating')
            ->find($this->id);

        if (!$instructor) {
            return [];
        }

        $totalEnrollments = UserRepository::query()->whereHas('enrollments.course', function ($query) {
            $query->where('instructor_id', $this->id);
        })->get();


        return [
            'id' => $this->id,
            'name' => $this->user->name,
            'profile_picture' => $this->user->profilePicturePath,
            'title' => $this->title,
            'about' => $this->about,
            'is_featured' => $this->is_featured,
            'joining_date' => $this->created_at->format('d M, Y'),
            'average_rating' => number_format($instructor->rating_avg, 1) ?? 0,
            'reviews_count' => $instructor->reviews_count,
            'course_count' => $instructor->courses_count,
            'student_count' => $totalEnrollments->count(),
            'experiences' => $this->experiences,
            'educations' => $this->educations,
        ];
    }
}
