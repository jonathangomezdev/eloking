@extends('panel.layout.main')
@section('content')
<div class="content panel-action-edit">
    <div class="container inner header">
        <h1>Create <span>Help Desk FAQ</span></h1>
        <a href="{{ URL::to('/panel/help') }}" class="button red">Cancel</a>
    </div>
    <div class="container">
        <div class="user-form">
            <form class="form" action="{{ url('/panel/help/save') }}" method="POST">
                @if ($errors->any())
                <div class="form-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @csrf
                <div class="form-row">
                    <div class="col">
                        <span>Question</span>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="text" value="{{ old('question') }}" name="question" />
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <span>Answer</span>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="text" value="{{ old('answer') }}" name="answer" />
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <span>Categories</span>
                    </div>
                    <div class="col">
                        @foreach($categories as $category)
                            <label>{{$category->name}}</label>
                            <input type="checkbox" name="categories[{{strtolower($category->name)}}]" value="{{$category->name}}" />
                        @endforeach
                    </div>
                </div>

                <div class="form-row">
                    <div class="col"></div>
                    <div class="col save-changes-button">
                        <button type="submit" class="button">
                            <div>
                                Save
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection