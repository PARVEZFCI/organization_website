<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PastCommitteeMember;
use App\Models\PastCommitteePeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PastCommitteeMemberController extends Controller
{
    public function create(PastCommitteePeriod $period)
    {
        return view('backend.past_committee_members.create', compact('period'));
    }

    public function store(Request $request, PastCommitteePeriod $period)
    {
        $data = $this->validatedData($request);
        $data['past_committee_period_id'] = $period->id;

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request);
        }

        PastCommitteeMember::create($data);
        Cache::forget('past_committee_periods');

        return redirect()
            ->route('Admin.past-committee-periods.show', $period)
            ->with('success', 'Past committee member added successfully.');
    }

    public function edit(PastCommitteePeriod $period, PastCommitteeMember $member)
    {
        $this->ensureBelongsToPeriod($period, $member);

        return view('backend.past_committee_members.edit', compact('period', 'member'));
    }

    public function update(Request $request, PastCommitteePeriod $period, PastCommitteeMember $member)
    {
        $this->ensureBelongsToPeriod($period, $member);

        $data = $this->validatedData($request);

        if ($request->hasFile('image')) {
            $this->deleteImage($member->image);
            $data['image'] = $this->storeImage($request);
        }

        $member->update($data);
        Cache::forget('past_committee_periods');

        return redirect()
            ->route('Admin.past-committee-periods.show', $period)
            ->with('success', 'Past committee member updated successfully.');
    }

    public function destroy(PastCommitteePeriod $period, PastCommitteeMember $member)
    {
        $this->ensureBelongsToPeriod($period, $member);

        $this->deleteImage($member->image);
        $member->delete();
        Cache::forget('past_committee_periods');

        return redirect()
            ->route('Admin.past-committee-periods.show', $period)
            ->with('success', 'Past committee member deleted successfully.');
    }

    protected function validatedData(Request $request): array
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'serial' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        return $data;
    }

    protected function storeImage(Request $request): string
    {
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        if (! file_exists(public_path('storage/past-committee'))) {
            mkdir(public_path('storage/past-committee'), 0755, true);
        }

        $image->move(public_path('storage/past-committee'), $imageName);

        return 'past-committee/' . $imageName;
    }

    protected function deleteImage(?string $path): void
    {
        if ($path && file_exists(public_path('storage/' . $path))) {
            unlink(public_path('storage/' . $path));
        }
    }

    protected function ensureBelongsToPeriod(PastCommitteePeriod $period, PastCommitteeMember $member): void
    {
        abort_unless($member->past_committee_period_id === $period->id, 404);
    }
}
