@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')
    
    <div data-controller="delete" data-delete-resource="admin/users" data-delete-id="{{ $user->id }}">

        <form method="POST" action="{{ route('users.update', $user) }}">
            {{ method_field('PATCH') }}

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Naam</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" value="{{ $user->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Code</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" value="{{ $user->id }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Team</label>
                <div class="col-sm-10">
                    <select name="unit" class="form-control">
                        <option value="0"> - kies een team - </option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" @if(optional($user->unit)->id == $unit->id) selected @endif>{{ $unit->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Level</label>
                <div class="col-sm-10">
                    <select name="level" class="form-control">
                        <option value="0" @if($user->level == '0') selected @endif>Student</option>
                        <option value="1" @if($user->level == '1') selected @endif>Docent</option>
                        <option value="2" @if($user->level == '2') selected @endif>Onderwijsco</option>
                        <option value="3" @if($user->level == '3') selected @endif>Admin</option>
                    </select>
                </div>
            </div>


            {{ csrf_field() }}

            <button type="submit" class="btn btn-success">
                <i class="far fa-save" aria-hidden="true"></i> Opslaan
            </button>
            <button class="btn btn-danger" data-action="click->delete#open">
                <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
            </button>

        </form>

        <!-- Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-target="delete.modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Weet je het zeker?</h5>
                    </div>
                    <div class="modal-body">
                        Je staat op het punt om de gebruiker <strong>{{ $user->id }} / {{ $user->name }}</strong> te verwijderen.
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