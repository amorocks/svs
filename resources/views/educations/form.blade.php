@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($education->exists)
        <h2>Opleiding {{ $education->title }}</h2>
        <div data-controller="delete" data-delete-resource="admin/educations" data-delete-id="{{ $education->id }}">
        <form method="POST" action="{{ route('educations.update', $education) }}">
        {{ method_field('PATCH') }}
    @else
        <h2>Nieuwe opleiding</h2>
        <div>
        <form method="POST" action="{{ route('educations.store') }}">
    @endif

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Titel</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" required name="title" value="{{ old('title', $education->title) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Crebo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" required name="crebo" value="{{ old('crebo', $education->crebo) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Team</label>
                <div class="col-sm-10">
                    <select name="unit" class="form-control">
                        <option value="0"> - kies een team - </option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" @if(($education->unit ?? \Auth::user()->unit)->id == $unit->id) selected @endif>{{ $unit->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Punten</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" required name="points" value="{{ old('points', $education->points) }}">
                </div>
            </div>
            
            {{ csrf_field() }}

            <button type="submit" class="btn btn-success">
                <i class="far fa-save" aria-hidden="true"></i> Opslaan
            </button>
            
            @if($education->exists)
                <button class="btn btn-danger" data-action="click->delete#open">
                    <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
                </button>
            @endif

        </form>

        <!-- Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-target="delete.modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Weet je het zeker?</h5>
                    </div>
                    <div class="modal-body">
                        Je staat op het punt om de opleiding <strong>{{ $education->title }}</strong> te verwijderen.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-gray" data-action="click->delete#close">Annuleren</button>
                        <button type="button" class="btn btn-danger" data-action="click->delete#continue">
                            <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection