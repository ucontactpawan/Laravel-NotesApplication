@extends('layouts.app')

@section('title', 'Edit Note')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header bg-transparent border-0 p-4">
                <h2 class="mb-0 fw-bold" style="color: #333;">
                    <i class="bi bi-pencil-square me-2"></i>Edit Note
                </h2>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('notes.update', $note->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="note" class="form-label fw-semibold" style="color: #333;">Your Note</label>
                        <textarea
                            class="form-control form-control-custom @error('note') is-invalid @enderror"
                            id="note"
                            name="note"
                            rows="8"
                            placeholder="Write your thoughts, ideas, or reminders here..."
                            required>{{ old('note', $note->note) }}</textarea>
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
                        <div>
                            <a href="{{ route('notes.show', $note->id) }}" class="btn btn-outline-info btn-lg px-4 me-2">
                                <i class="bi bi-eye me-2"></i>View
                            </a>
                            <button type="submit" class="btn btn-new-note btn-lg px-4">
                                <i class="bi bi-save me-2"></i>Update Note
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
