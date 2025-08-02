@extends('layouts.app')

@section('title', 'View Note')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header bg-transparent border-0 p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 fw-bold" style="color: #333;">
                        <i class="bi bi-journal-text me-2"></i>Note Details
                    </h2>
                    <small class="text-muted">
                        Created: {{ \Carbon\Carbon::parse($note->created_at)->format('M d, Y \a\t g:i A') }}
                        @if($note->updated_at != $note->created_at)
                            <br>Updated: {{ \Carbon\Carbon::parse($note->updated_at)->format('M d, Y \a\t g:i A') }}
                        @endif
                    </small>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="note-content-view p-3 mb-4" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #00b894;">
                    <div style="white-space: pre-wrap; line-height: 1.8; font-size: 1.1rem; color: #2d3436;">
                        {{ $note->note }}
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('notes.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="bi bi-arrow-left me-2"></i>Back to Notes
                    </a>
                    <div>
                        <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-edit btn-lg px-4 me-2" style="background: #00b894; border: none; color: white;">
                            <i class="bi bi-pencil me-2"></i>Edit
                        </a>
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display: inline-block;"
                              onsubmit="return confirm('Are you sure you want to delete this note? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-lg px-4" style="background: #e84393; border: none; color: white;">
                                <i class="bi bi-trash me-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
