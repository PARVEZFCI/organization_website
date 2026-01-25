@extends('backend.admin-layout')
@section('title', 'Dashboard - ')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <br>
            @if(session('success'))
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <div class="alert-icon contrast-alert"><i class="icon-check"></i></div>
                        <div class="alert-message"><span>{{ session('success') }}</span></div>
                    </div>
                </div>
            @endif

            @if(session('message'))
                <div class="col-lg-12">
                    <div class="alert alert-{{ session('class') }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <div class="alert-icon contrast-alert"><i class="icon-close"></i></div>
                        <div class="alert-message"><span>{{ session('message') }}</span></div>
                    </div>
                </div>
            @endif

            <br>

            <div class="col-md-12">
                <div class="card bg-white">
                    <div class="card-header border-0 text-white bg-info">
                        <i class="fa fa-image"></i>
                        Photo Gallery
                    </div>

                    <div class="card">
                        <div class="card-header bg-white">
                            <div style="display:inline-block; padding-top:5px;">
                                <i class="fa fa-images"></i>
                                All Photos
                            </div>
                            <div style="display:inline-block; float:right; padding-top:5px;">
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#uploadModal">
                                    <i class="fa fa-upload"></i> Upload Photo
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                @forelse($photos as $photo)
                                    <div class="col-md-3 col-sm-4 col-6 mb-4">
                                        <div class="card">
                                            <img src="/{{ $photo->image }}" class="card-img-top" alt="Gallery Photo" style="height: 200px; object-fit: cover;">
                                            <div class="card-body text-center p-2">
                                                <form action="{{ route('Admin.photo_gallery.destroy', $photo->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block"
                                                        onclick="return confirm('Are you sure you want to delete this photo?')">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info text-center">
                                            <i class="fa fa-info-circle"></i> No photos in gallery. Upload some photos to get started!
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.container-fluid -->
    </div> <!-- /.content-wrapper -->

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Upload Photo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('Admin.photo_gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="image">Select Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control" required accept="image/*">
                            <small class="form-text text-muted">Accepted formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div id="imagePreview" style="display:none;">
                                <label>Preview:</label>
                                <img id="preview" src="" alt="Preview" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-upload"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    // Image preview functionality
    $('input[name="image"]').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
                $('#imagePreview').show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#imagePreview').hide();
        }
    });

    // Reset preview when modal is closed
    $('#uploadModal').on('hidden.bs.modal', function () {
        $('input[name="image"]').val('');
        $('#imagePreview').hide();
    });
</script>
@endsection
