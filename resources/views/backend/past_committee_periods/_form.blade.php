@csrf

<div class="form-group mb-3">
    <label for="title" class="form-label">Period Title <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $period->title ?? '') }}" placeholder="e.g. 2015 - 2017" required>
    @error('title')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="start_year" class="form-label">Start Year</label>
            <input type="number" class="form-control @error('start_year') is-invalid @enderror" id="start_year" name="start_year" value="{{ old('start_year', $period->start_year ?? '') }}" placeholder="e.g. 2015">
            @error('start_year')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="end_year" class="form-label">End Year</label>
            <input type="number" class="form-control @error('end_year') is-invalid @enderror" id="end_year" name="end_year" value="{{ old('end_year', $period->end_year ?? '') }}" placeholder="e.g. 2017">
            @error('end_year')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="sort_order" class="form-label">Sort Order</label>
            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $period->sort_order ?? 0) }}" min="0">
            <small class="form-text text-muted">Lower values appear first.</small>
            @error('sort_order')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label class="form-label d-block">Status</label>
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', isset($period) ? $period->status : true) ? 'checked' : '' }}>
                <label class="form-check-label" for="status">
                    Active
                </label>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i> {{ $submitLabel }}
    </button>
    <a href="{{ route('Admin.past-committee-periods.index') }}" class="btn btn-secondary">
        <i class="fa fa-times"></i> Cancel
    </a>
</div>
