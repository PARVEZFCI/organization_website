@php
    $feeConfig = old('fees', $event->feeConfigWithDefaults() ?? (new \App\Models\UpcomingEvent())->feeConfigWithDefaults());
@endphp

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $event->title ?? '') }}" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Sub Title</label>
            <input type="text" name="sub_title" class="form-control" value="{{ old('sub_title', $event->sub_title ?? '') }}">
            @error('sub_title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Event Date <span class="text-danger">*</span></label>
            <input type="date" name="date" class="form-control" value="{{ old('date', isset($event->date) ? $event->date->format('Y-m-d') : '') }}" required>
            @error('date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Start Time</label>
            <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $event->start_time ?? '') }}">
            @error('start_time')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>End Time</label>
            <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $event->end_time ?? '') }}">
            @error('end_time')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Venue</label>
            <input type="text" name="venue" class="form-control" value="{{ old('venue', $event->venue ?? '') }}" placeholder="Event venue or address">
            @error('venue')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Registration Deadline</label>
            <input type="datetime-local" name="registration_deadline" class="form-control"
                value="{{ old('registration_deadline', isset($event->registration_deadline) ? $event->registration_deadline->format('Y-m-d\TH:i') : '') }}">
            @error('registration_deadline')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Contact Person</label>
            <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $event->contact_person ?? '') }}">
            @error('contact_person')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Contact Phone</label>
            <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $event->contact_phone ?? '') }}">
            @error('contact_phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Event Banner</label>
            <input type="file" name="banner" class="form-control">
            @error('banner')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            @if(!empty($event->banner_path))
                <div class="mt-2">
                    <img src="{{ asset($event->banner_path) }}" alt="{{ $event->title }}" style="max-height: 120px; border-radius: 8px;">
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Max Registrations</label>
            <input type="number" min="1" name="max_registrations" class="form-control" value="{{ old('max_registrations', $event->max_registrations ?? '') }}">
            @error('max_registrations')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group mt-4 pt-2">
            <div class="form-check mb-2">
                <input type="hidden" name="is_registration_enabled" value="0">
                <input type="checkbox" class="form-check-input" id="is_registration_enabled" name="is_registration_enabled" value="1"
                    {{ old('is_registration_enabled', $event->is_registration_enabled ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_registration_enabled">Registration Enabled</label>
            </div>
            <div class="form-check">
                <input type="hidden" name="requires_payment" value="0">
                <input type="checkbox" class="form-check-input" id="requires_payment" name="requires_payment" value="1"
                    {{ old('requires_payment', $event->requires_payment ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="requires_payment">Collect Payment</label>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Description</label>
            <textarea name="details" id="details" class="form-control" rows="6">{{ old('details', $event->details ?? '') }}</textarea>
            @error('details')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Registration Notes</label>
            <textarea name="registration_notes" class="form-control" rows="3" placeholder="Instructions shown before registration">{{ old('registration_notes', $event->registration_notes ?? '') }}</textarea>
            @error('registration_notes')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="card border">
            <div class="card-header bg-light">
                <strong>Fee Setup</strong>
                <div class="small text-muted mt-1">Use tabs to configure separate pricing for not registered users and each member type.</div>
            </div>
            <div class="card-body">
                @php
                    $feeTabs = array_merge(
                        ['default' => 'Not Registered User'],
                        collect(\App\Models\UpcomingEvent::MEMBER_TYPES)->mapWithKeys(fn ($type) => [$type => $type . ' Member'])->all()
                    );
                @endphp

                <ul class="nav nav-tabs" role="tablist">
                    @foreach($feeTabs as $key => $label)
                        <li class="nav-item">
                            <a
                                class="nav-link {{ $loop->first ? 'active' : '' }}"
                                id="fee-tab-{{ \Illuminate\Support\Str::slug($key) }}"
                                data-toggle="tab"
                                href="#fee-pane-{{ \Illuminate\Support\Str::slug($key) }}"
                                role="tab"
                            >
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content border border-top-0 p-4">
                    @foreach($feeTabs as $key => $label)
                        <div
                            class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="fee-pane-{{ \Illuminate\Support\Str::slug($key) }}"
                            role="tabpanel"
                        >
                            <h6 class="mb-3">{{ $label }} Fees</h6>
                            <div class="row">
                                @foreach(\App\Models\UpcomingEvent::PARTICIPANT_TYPES as $participantType)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ ucfirst($participantType) }} Fee</label>
                                            <input
                                                type="number"
                                                min="0"
                                                step="0.01"
                                                name="fees[{{ $key }}][{{ $participantType }}]"
                                                class="form-control"
                                                value="{{ old("fees.$key.$participantType", $feeConfig[$key][$participantType] ?? 0) }}"
                                            >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
