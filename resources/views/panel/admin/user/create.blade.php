@extends('panel.layout.main')
@section('content')
    <div class="content panel-action-edit panel-user-profile-edit">
        <div class="container inner header">
            <h1>
                User
                <span>Create</span>
                <a href="{{ URL::to('/panel/admin/user') }}" class="move-back">
                    <img src="{{ asset('img/icons/arrow-right.svg') }}" alt="Arrow back" />
                </a>
            </h1>
        </div>
        <div class="container inner">
            @if (session('success'))
                <div class="alert success">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ URL::to('/panel/admin/user/') }}" method="POST">
                <div class="table">
                    <x-user-form type="create" />
                </div>
            </form>
        </div>
    </div>
@endsection
