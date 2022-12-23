@extends('admin.layout.master')

@section('title','Contact List Page')

@section('content')

    @if(count($contacts)!==0)
        <div class="row" style="margin-top:100px;">
            @foreach ($contacts as $c)
                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <span class="">{{ $c->name }}</span>
                            <span class="">{{ $c->created_at->format('d-F-Y H:i:s') }}</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $c->subject }}</h5>
                            <p class="card-text">{{ Str::words($c->message, 40, ' .......') }}</p>
                        </div>
                        <div class="card-footer text-right">
                            <a href="mailto:{{ $c->email }}" class="btn btn-primary">Reply to {{ $c->email }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-10 offset-1">
                <span>{{ $contacts->links() }}</span>
            </div>
        </div>
    @else
        <h2 class="text-center text-warning">There is no current contact</h2>
    @endif

@endsection
