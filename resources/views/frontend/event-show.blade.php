@extends('frontend.layouts.app')

@section('title', $event->title . ' - Event')

@section('content')
    <section style="position: relative; min-height: 48vh; background: #0f172a; overflow: hidden;">
        @if($event->banner_path)
            <div style="position:absolute; inset:0; background-image:url('{{ asset($event->banner_path) }}'); background-size:cover; background-position:center;"></div>
        @endif
        <div style="position:absolute; inset:0; background:linear-gradient(135deg, rgba(15,23,42,.88), rgba(37,99,235,.75));"></div>
        <div class="container position-relative" style="z-index:2; padding: 110px 0 70px;">
            <div class="row align-items-end">
                <div class="col-lg-8 text-white">
                    <div class="small text-uppercase mb-3" style="letter-spacing:.2em;">Event Details</div>
                    <h1 class="mb-3" style="font-size: clamp(2rem, 5vw, 3.5rem);">{{ $event->title }}</h1>
                    @if($event->sub_title)
                        <p class="mb-4" style="font-size:1.1rem; opacity:.92;">{{ $event->sub_title }}</p>
                    @endif
                    <div class="d-flex flex-wrap gap-3">
                        <span class="badge bg-light text-dark px-3 py-2">{{ $event->date->format('F d, Y') }}</span>
                        @if($event->start_time)
                            <span class="badge bg-light text-dark px-3 py-2">{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}{{ $event->end_time ? ' - ' . \Carbon\Carbon::parse($event->end_time)->format('h:i A') : '' }}</span>
                        @endif
                        @if($event->venue)
                            <span class="badge bg-light text-dark px-3 py-2">{{ $event->venue }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                    <div class="card-body p-4 p-lg-5">
                        <h3 class="mb-3">About This Event</h3>
                        <div class="text-muted">{!! $event->details ?: '<p>Event details will be shared soon.</p>' !!}</div>

                        @if($event->registration_notes)
                            <div class="mt-4 p-3" style="background:#eff6ff; border-radius:14px; border:1px solid #bfdbfe;">
                                <strong class="d-block mb-2">Registration Notes</strong>
                                <div class="mb-0 text-muted">{!! nl2br(e($event->registration_notes)) !!}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Event Summary</h4>
                        <div class="mb-2"><strong>Date:</strong> {{ $event->date->format('l, F d, Y') }}</div>
                        @if($event->venue)
                            <div class="mb-2"><strong>Venue:</strong> {{ $event->venue }}</div>
                        @endif
                        @if($event->registration_deadline)
                            <div class="mb-2"><strong>Registration Deadline:</strong> {{ $event->registration_deadline->format('F d, Y h:i A') }}</div>
                        @endif
                        @if($event->contact_person || $event->contact_phone)
                            <div class="mb-0"><strong>Contact:</strong> {{ $event->contact_person }}{{ $event->contact_person && $event->contact_phone ? ' | ' : '' }}{{ $event->contact_phone }}</div>
                        @endif
                    </div>
                </div>

                @if($member)
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0">Your Member Fees</h4>
                                <span class="badge bg-primary">{{ $memberType }}</span>
                            </div>
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="p-3 rounded" style="background:#f8fafc;">
                                        <div class="small text-muted">Adult</div>
                                        <strong>{{ number_format($memberFees['adult'], 2) }} BDT</strong>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 rounded" style="background:#f8fafc;">
                                        <div class="small text-muted">Child</div>
                                        <strong>{{ number_format($memberFees['child'], 2) }} BDT</strong>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 rounded" style="background:#f8fafc;">
                                        <div class="small text-muted">Spouse</div>
                                        <strong>{{ number_format($memberFees['spouse'], 2) }} BDT</strong>
                                    </div>
                                </div>
                            </div>
                            @if($gatewayActive && $event->requires_payment)
                                <p class="small text-muted mt-3 mb-0">Payment will be processed through bKash after you submit the registration form.</p>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                        <div class="card-body p-4">
                            <h4 class="mb-3">Not Registered User Fees</h4>
                            <div class="row text-center mb-3">
                                <div class="col-4">
                                    <div class="p-3 rounded" style="background:#f8fafc;">
                                        <div class="small text-muted">Adult</div>
                                        <strong>{{ number_format($guestFees['adult'], 2) }} BDT</strong>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 rounded" style="background:#f8fafc;">
                                        <div class="small text-muted">Child</div>
                                        <strong>{{ number_format($guestFees['child'], 2) }} BDT</strong>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 rounded" style="background:#f8fafc;">
                                        <div class="small text-muted">Spouse</div>
                                        <strong>{{ number_format($guestFees['spouse'], 2) }} BDT</strong>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mb-3">Guests use not-registered-user pricing. If you login as a member, your member pricing will be used automatically.</p>
                            <a href="{{ route('member.login') }}" class="btn btn-outline-primary">Member Login</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="container mb-5">
        <div class="card border-0 shadow-sm" style="border-radius: 24px;">
            <div class="card-body p-4 p-lg-5">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <h2 class="mb-2">Event Registration</h2>
                        <p class="text-muted mb-0">
                            {{ $member ? 'Your member profile will be used automatically, so only attendee counts and notes are needed.' : 'Guest registration requires your batch, name, address, position, phone, and related details.' }}
                        </p>
                    </div>
                    <span class="badge {{ $event->registrationIsOpen() ? 'bg-success' : 'bg-secondary' }} px-3 py-2">
                        {{ $event->registrationIsOpen() ? 'Registration Open' : 'Registration Closed' }}
                    </span>
                </div>

                @if($event->registrationIsOpen())
                    <form action="{{ route('events.register', $event) }}" method="POST">
                        @csrf

                        @if(!$member)
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Batch Number</label>
                                    <input type="text" name="batch_number" class="form-control @error('batch_number') is-invalid @enderror" value="{{ old('batch_number') }}">
                                    @error('batch_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}">
                                    @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Position</label>
                                    <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position') }}">
                                    @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Organization</label>
                                    <input type="text" name="organization" class="form-control @error('organization') is-invalid @enderror" value="{{ old('organization') }}">
                                    @error('organization')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address') }}</textarea>
                                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        @else
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="p-3 rounded" style="background:#f8fafc;">
                                        <div class="small text-muted">Member Name</div>
                                        <strong>{{ $member->full_name }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 rounded" style="background:#f8fafc;">
                                        <div class="small text-muted">Batch Number</div>
                                        <strong>{{ $member->intake_no ?: 'Not set' }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Adults</label>
                                <input type="number" min="0" name="adult_count" class="form-control @error('adult_count') is-invalid @enderror" value="{{ old('adult_count', $defaultCounts['adult']) }}">
                                @error('adult_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Children</label>
                                <input type="number" min="0" name="child_count" class="form-control @error('child_count') is-invalid @enderror" value="{{ old('child_count', $defaultCounts['child']) }}">
                                @error('child_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Spouses</label>
                                <input type="number" min="0" name="spouse_count" class="form-control @error('spouse_count') is-invalid @enderror" value="{{ old('spouse_count', $defaultCounts['spouse']) }}">
                                @error('spouse_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Special Note</label>
                                <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3" placeholder="Dietary request, accessibility note, or anything we should know">{{ old('notes') }}</textarea>
                                @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mt-4 p-4 rounded" style="background:#f8fafc; border:1px solid #e2e8f0;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Estimated Total</strong>
                                    <div class="small text-muted">
                                        {{ $member ? 'Calculated using your member fee settings.' : 'Calculated using not-registered-user pricing.' }}
                                    </div>
                                </div>
                                <div style="font-size:1.4rem; font-weight:700;" id="registration-total-preview">0.00 BDT</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-4">
                            <div class="text-muted small">
                                @if($gatewayActive && $event->requires_payment)
                                    Registrations with payment will continue to bKash after submission.
                                @else
                                    Registration will be saved immediately.
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg px-4">Submit Registration</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-secondary mb-0">Registration is currently closed for this event.</div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (function () {
            const fees = @json($member ? $memberFees : $guestFees);
            const preview = document.getElementById('registration-total-preview');
            const fields = {
                adult: document.querySelector('input[name="adult_count"]'),
                child: document.querySelector('input[name="child_count"]'),
                spouse: document.querySelector('input[name="spouse_count"]'),
            };

            function totalFor(type) {
                return Math.max(parseInt(fields[type].value || 0, 10), 0) * parseFloat(fees[type] || 0);
            }

            function updatePreview() {
                const total = totalFor('adult') + totalFor('child') + totalFor('spouse');
                preview.textContent = total.toFixed(2) + ' BDT';
            }

            Object.values(fields).forEach((field) => field.addEventListener('input', updatePreview));
            updatePreview();
        })();
    </script>
@endpush
