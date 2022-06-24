@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Detail Message</h2>
    </div>

    <div class="col-lg-8">
        <a href="/dashboard/messages" class="btn btn-success">Back to all messages</a>
        <form action="/dashboard/messages/{{ $message->id }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <h3 class="mb-2 mt-2">{{ $message->subject }}</h3>
            <p class="mt-3 mb-3" style="font-weight: 500">From : {{ $message->name }} | Email : {{ $message->email }}</p>
            <article class="my-3 fs-6">
                {!! $message->body !!}
            </article>
        </div>
    </div>
@endsection