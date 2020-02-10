@extends('layouts.app')

@section('buttons')
    <a href="{{ route('rating_scales.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe schaal</a>
@endsection

@section('content')
    @if(count($rating_scales) < 1)
        @include('layouts.empty', ['type' => 'beoordelingsschaal'])    
    @else

    <h2>Beoordelingsschalen</h2>
    <table class="table table-striped table-hover" data-controller="filter" data-filter-display="table-row">
        <tr>
            <th>Titel</th>
            <th>Afdeling</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td colspan="3"><input class="form-control" placeholder="Filter lijst" type="text" data-target="filter.query" data-action="input->filter#filter"></td>
        </tr>

        @foreach($rating_scales as $rating_scale)
            <tr data-target="filter.list">
                <td>{{ $rating_scale->title }}</td>
                <td>{{ $rating_scale->unit ?? '(globaal)'}}</td>
                <td>
                    <a href="{{ route('rating_scales.edit', $rating_scale->id) }}"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        @endforeach

    </table>
    @endif
@endsection