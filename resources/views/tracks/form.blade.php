@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($track->exists)
        <h2>Programma {{ $track->title }}</h2>
        <div data-controller="delete" data-delete-resource="coord/tracks" data-delete-id="{{ $track->id }}">
        <form method="POST" action="{{ route('tracks.update', $track) }}">
        {{ method_field('PATCH') }}
    @else
        <h2>Nieuw programma</h2>
        <div>
        <form method="POST" action="{{ route('tracks.store') }}">
    @endif

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Titel</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" required name="title" value="{{ old('title', $track->title) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Start</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" required name="start" value="{{ old('start', optional($track->start)->format('Y-m-d')) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Einde</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" required name="end" value="{{ old('end', optional($track->end)->format('Y-m-d')) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Opleiding</label>
                <div class="col-sm-10">
                    <select name="education" class="form-control">
                        <option value="0"> - kies een opleiding - </option>
                        @foreach($educations as $education)
                            <option value="{{ $education->id }}" @if(optional($track->education)->id == $education->id) selected @endif>{{ $education->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            {{ csrf_field() }}

            <button type="submit" class="btn btn-success">
                <i class="far fa-save" aria-hidden="true"></i> Opslaan
            </button>
            
            @if($track->exists)
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
                        Je staat op het punt om het programma <strong>{{ $track->title }}</strong> te verwijderen.
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