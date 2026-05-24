<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Tutor;
use Illuminate\Http\Request;

class FindTutorsController extends Controller
{
    public function index(Request $request)
    {
        $slug    = $request->query('subject', 'english');
        $subject = Subject::findBySlug($slug);

        // Fallback: if subject not found, use first available
        if (!$subject) {
            $subject = Subject::first();
        }

        // ── Build tutor query ─────────────────────────────────
        $query = Tutor::where('subject_id', $subject?->id ?? 0);

        // Price filter
        if ($request->filled('min_price')) {
            $query->where('hourly_rate', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('hourly_rate', '<=', $request->max_price);
        }

        // Availability filter
        if ($request->filled('availability') && $request->availability !== 'any') {
            $query->where('availability', $request->availability);
        }

        // Tutor type filter
        if ($request->filled('tutor_type') && $request->tutor_type !== 'any') {
            $query->where('tutor_type', $request->tutor_type);
        }

        // Rating filter
        if ($request->filled('min_rating')) {
            $query->where('rating', '>=', $request->min_rating);
        }

        // Sorting
        $sort = $request->query('sort', 'top_rated');
        match ($sort) {
            'price_low'  => $query->orderBy('hourly_rate', 'asc'),
            'price_high' => $query->orderBy('hourly_rate', 'desc'),
            'newest'     => $query->orderBy('created_at', 'desc'),
            default      => $query->orderBy('rating', 'desc')->orderBy('reviews_count', 'desc'),
        };

        $tutors      = $query->paginate(8)->withQueryString();
        $totalCount  = Tutor::where('subject_id', $subject?->id ?? 0)->count();
        $allSubjects = Subject::all();

        return view('find-tutors', compact(
            'subject', 'tutors', 'totalCount', 'allSubjects', 'sort', 'slug'
        ));
    }
}
