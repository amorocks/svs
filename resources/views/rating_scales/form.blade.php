@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($rating_scale->exists)
        <h2>Beoordelingsschaal {{ $rating_scale->title }}</h2>
        <div data-controller="delete" data-delete-resource="coord/rating_scales" data-delete-id="{{ $rating_scale->id }}">
        <form method="POST" action="{{ route('rating_scales.update', $rating_scale) }}">
        {{ method_field('PATCH') }}
    @else
        <h2>Nieuwe beoordelingsschaal</h2>
        <div>
        <form method="POST" action="{{ route('rating_scales.store') }}">
    @endif

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Titel</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" required name="title" value="{{ old('title', $rating_scale->title) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Globaal</label>
                <div class="col-sm-10 form-check">
                    <input type="checkbox" value="1" id="global" name="global" @if($rating_scale->unit_id == null) checked @endif>
                    <label class="form-check-label" for="global">
                        Maak beschikbaar voor alle afdelingen
                    </label>
                </div>
            </div>
            
            {{ csrf_field() }}

            <button type="submit" class="btn btn-success">
                <i class="far fa-save" aria-hidden="true"></i> Opslaan
            </button>
            
            @if($rating_scale->exists)
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
                        Je staat op het punt om het programma <strong>{{ $rating_scale->title }}</strong> te verwijderen.
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