@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($unit->exists)
        <h2>Afdeling {{ $unit->title }}</h2>
        <div data-controller="delete" data-delete-resource="admin/units" data-delete-id="{{ $unit->id }}">
        <form method="POST" action="{{ route('units.update', $unit) }}">
        {{ method_field('PATCH') }}
    @else
        <h2>Nieuwe afdeling</h2>
        <div>
        <form method="POST" action="{{ route('units.store') }}">
    @endif

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Titel</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" required name="title" value="{{ old('title', $unit->title) }}">
                </div>
            </div>

            {{ csrf_field() }}

            <button type="submit" class="btn btn-success">
                <i class="far fa-save" aria-hidden="true"></i> Opslaan
            </button>
            
            @if($unit->exists)
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
                        Je staat op het punt om de afdeling <strong>{{ $unit->title }}</strong> te verwijderen.
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