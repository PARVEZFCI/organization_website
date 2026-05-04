@csrf

<div class="form-group mb-3">
    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $member->name ?? '') }}" required>
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $member->designation ?? '') }}" placeholder="e.g. President, Secretary" required>
    @error('designation')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="serial" class="form-label">Serial <span class="text-danger">*</span></label>
    <input type="number" class="form-control @error('serial') is-invalid @enderror" id="serial" name="serial" value="{{ old('serial', $member->serial ?? 0) }}" min="0" required>
    @error('serial')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="image" class="form-label">Image</label>
    @if(isset($member) && $member->image)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" style="max-height: 150px; max-width: 150px; border-radius: 8px; object-fit: cover;">
            <p class="small text-muted mt-1">Current Image</p>
        </div>
    @endif
    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
    <small class="form-text text-muted">Accepted formats: jpeg, png, jpg, gif, webp (Max: 2MB)</small>
    @error('image')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i> {{ $submitLabel }}
    </button>
    <a href="{{ route('Admin.past-committee-periods.show', $period) }}" class="btn btn-secondary">
        <i class="fa fa-times"></i> Cancel
    </a>
</div>
