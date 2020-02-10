@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($term->exists)
        <h2>Blok {{ $term->title }}</h2>
        <div data-controller="delete" data-delete-resource="coord/terms" data-delete-id="{{ $term->id }}">
        <form method="POST" action="{{ route('terms.update', $term) }}">
        {{ method_field('PATCH') }}
    @else
        <h2>Nieuw blok</h2>
        <div>
        <form method="POST" action="{{ route('terms.store') }}">
    @endif

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Titel</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" required name="title" value="{{ old('title', $term->title) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Vanaf</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" required name="valid_from" value="{{ old('valid_from', optional($term->valid_from)->format('Y-m-d')) }}">
                    <small class="form-text text-muted">Geldig vanaf</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tot</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="valid_to" value="{{ old('valid_to', optional($term->valid_to)->format('Y-m-d')) }}">
                    <small class="form-text text-muted">Geldig tot, mag leeg blijven</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Punten</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" required name="points" value="{{ old('points', $term->points) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Beoordelingsschaal</label>
                <div class="col-sm-10">
                    <select name="rating_scale" class="form-control">
                        <option value="0"> - kies een schaal - </option>
                        @foreach($rating_scales as $rating_scale)
                            <option value="{{ $rating_scale->id }}" @if(optional($term->rating_scale)->id == $rating_scale->id) selected @endif>{{ $rating_scale->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Afdeling</label>
                <div class="col-sm-10">
                    <select name="unit" class="form-control">
                        <option value="0"> - kies een afdeling - </option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" @if(optional($term->unit)->id == $unit->id) selected @endif>{{ $unit->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            {{ csrf_field() }}

            <button type="submit" class="btn btn-success">
                <i class="far fa-save" aria-hidden="true"></i> Opslaan
            </button>
            
            @if($term->exists)
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
                        Je staat op het punt om het programma <strong>{{ $term->title }}</strong> te verwijderen.
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