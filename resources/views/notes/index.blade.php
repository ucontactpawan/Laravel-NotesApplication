@extends('layouts.app')

@section('title', 'All Notes')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-journal-text me-2"></i>My Notes
    </h1>
    <p class="note-count">({{ $notes->count() }} notes)</p>
    <a href="{{ route('notes.create') }}" class="btn btn-new-note mt-3">
        <i class="bi bi-plus-lg me-2"></i>New Note
    </a>
</div>

@if($notes->count() > 0)
    <div class="row">
        @foreach($notes as $note)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card note-card {{ $note->color ?? 'color-yellow' }}" data-note-id="{{ $note->id }}">
                    <div class="note-content">
                        <div class="note-text">
                            {{ $note->note }}
                        </div>
                    </div>
                    <div class="note-actions">
                        <a href="{{ route('notes.show', $note->id) }}" class="btn btn-view btn-custom">
                            <i class="bi bi-eye me-1"></i>View
                        </a>
                        <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-edit btn-custom">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-custom"
                                    onclick="return confirm('Are you sure you want to delete this note?')">
                                <i class="bi bi-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                    <div class="color-picker-container" style="position: absolute; bottom: 10px; right: 15px; display: flex; gap: 5px;">
                        <div class="color-option yellow" data-color="color-yellow" title="Yellow"></div>
                        <div class="color-option orange" data-color="color-orange" title="Orange"></div>
                        <div class="color-option pink" data-color="color-pink" title="Pink"></div>
                        <div class="color-option purple" data-color="color-purple" title="Purple"></div>
                        <div class="color-option blue" data-color="color-blue" title="Blue"></div>
                        <div class="color-option green" data-color="color-green" title="Green"></div>
                        <div class="color-option red" data-color="color-red" title="Red"></div>
                        <div class="color-option teal" data-color="color-teal" title="Teal"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card p-5" style="background: #f8f9fa; border: none; border-radius: 12px;">
                <i class="bi bi-journal-x display-1 text-muted mb-3"></i>
                <h4 class="text-muted mb-3">No Notes Yet</h4>
                <p class="text-muted mb-4">Create your first note to get started!</p>
                <a href="{{ route('notes.create') }}" class="btn btn-new-note">
                    <i class="bi bi-plus-lg me-2"></i>Create First Note
                </a>
            </div>
        </div>
    </div>
@endif
@endsection
