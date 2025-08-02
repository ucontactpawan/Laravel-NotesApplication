@extends('layouts.app')

@section('title', 'Create Note')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header bg-transparent border-0 p-4">
                <h2 class="mb-0 fw-bold" style="color: #333;">
                    <i class="bi bi-plus-circle me-2"></i>Create New Note
                </h2>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('notes.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="note" class="form-label fw-semibold" style="color: #333;">Your Note</label>
                        <textarea
                            class="form-control form-control-custom @error('note') is-invalid @enderror"
                            id="note"
                            name="note"
                            rows="8"
                            placeholder="Write your thoughts, ideas, or reminders here..."
                            required>{{ old('note') }}</textarea>
                        @error('note')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('notes.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                            <i class="bi bi-arrow-left me-2"></i>Back to Notes
                        </a>
                        <button type="submit" class="btn btn-new-note btn-lg px-4">
                            <i class="bi bi-save me-2"></i>Save Note
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
