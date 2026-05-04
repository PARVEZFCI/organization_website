<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PastCommitteePeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PastCommitteePeriodController extends Controller
{
    public function index()
    {
        $periods = PastCommitteePeriod::withCount('members')->ordered()->get();

        return view('backend.past_committee_periods.index', compact('periods'));
    }

    public function create()
    {
        return view('backend.past_committee_periods.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        PastCommitteePeriod::create($data);
        Cache::forget('past_committee_periods');

        return redirect()
            ->route('Admin.past-committee-periods.index')
            ->with('success', 'Past committee period created successfully.');
    }

    public function show(PastCommitteePeriod $past_committee_period)
    {
        $past_committee_period->load(['members' => function ($query) {
            $query->orderBy('serial')->orderBy('name');
        }]);

        return view('backend.past_committee_periods.show', [
            'period' => $past_committee_period,
        ]);
    }

    public function edit(PastCommitteePeriod $past_committee_period)
    {
        return view('backend.past_committee_periods.edit', [
            'period' => $past_committee_period,
        ]);
    }

    public function update(Request $request, PastCommitteePeriod $past_committee_period)
    {
        $data = $this->validatedData($request);

        $past_committee_period->update($data);
        Cache::forget('past_committee_periods');

        return redirect()
            ->route('Admin.past-committee-periods.index')
            ->with('success', 'Past committee period updated successfully.');
    }

    public function destroy(PastCommitteePeriod $past_committee_period)
    {
        foreach ($past_committee_period->members as $member) {
            $this->deleteImage($member->image);
        }

        $past_committee_period->delete();
        Cache::forget('past_committee_periods');

        return redirect()
            ->route('Admin.past-committee-periods.index')
            ->with('success', 'Past committee period deleted successfully.');
    }

    protected function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'start_year' => 'nullable|integer|digits:4|min:1900|max:2100',
            'end_year' => 'nullable|integer|digits:4|min:1900|max:2100|gte:start_year',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = $request->has('status');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }

    protected function deleteImage(?string $path): void
    {
        if ($path && file_exists(public_path('storage/' . $path))) {
            unlink(public_path('storage/' . $path));
        }
    }
}
