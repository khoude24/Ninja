@extends('layout')
@section('content')
    <word></word>

    <table id="datatable" class="hidden">
        <tbody>
            <tr>
                <th>Time found</th>
                <td>Time found</td>
            </tr>
            @foreach ($words as $word)
                @if ($word['hits'] > 0)
                    <tr>
                        <th>{{$word['word']}}</th>
                        <td>{{$word['hits']}}</td>
                    </tr>
                @endif
           @endforeach
        </tbody>
    </table>

    <div class="container admin">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Awesome words found by users
                    </div>
                    <div class="panel-body">
                        <div id="container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




