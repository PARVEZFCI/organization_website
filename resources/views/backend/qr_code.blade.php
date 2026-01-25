@extends('backend.admin-layout')
@section('title', 'QR Code - ')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Generated QR Code</h4>
                </div>
                <div class="card-body text-center">
                    <div class="qr-code-container mb-3">
                        {!! $qrCodeImage !!}
                    </div>
                    <div class="encoded-data mb-3">
                        <strong>Encoded Data:</strong> {{ $encodedData }}
                    </div>
                    <a href="{{ route('Admin.deshboard') }}" class="btn btn-primary">Back to Dashboard</a>
                    <a href="{{ route('Admin.qr-code-download') }}?data={{ urlencode($encodedData) }}" class="btn btn-success">Download QR Code</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection