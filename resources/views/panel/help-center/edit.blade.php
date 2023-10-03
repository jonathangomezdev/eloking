@extends('panel.layout.main')
@section('content')
<div class="content panel-action-edit">
    <div class="container inner header">
        <h1>Edit <span>Help Desk FAQ</span></h1>
        <a href="{{ URL::to('/panel/help') }}" class="button red">Cancel</a>
    </div>
    <div class="container">
        <div class="user-form">
            <form class="form" action="{{ url('/panel/help/update') }}" method="POST">
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
                            <input type="text" value="{{ $faq->question }}" name="question" />
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <span>Answer</span>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="text" value="{{ $faq->answer }}" name="answer" />
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <span>Category</span>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <select name="help_desk_faq_category_id" class="select2" required>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" 
                                    @if($faq->help_desk_faq_category_id === $category->id) selected @endif >
                                    {{$category->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <span>Labels</span>
                    </div>
                    <div class="col">

                        <input type="checkbox" name="labels['lol']" value="LOL" @if(in_array('LOL', $faq->labels)) checked @endif />
                        <label>LOL</label>
  
                        <input type="checkbox" name="labels['valorant']" value="Valorant" @if(in_array('Valorant', $faq->labels)) checked @endif />
                        <label>Valorant</label>

                        <input type="checkbox" name="labels['cs:go']" value="CS:GO" @if(in_array('CS:GO', $faq->labels)) checked  @endif />
                        <label>CS:GO</label>

                        <input type="checkbox" name="labels['eloking']" value="Eloking" @if(in_array('Eloking', $faq->labels)) checked @endif />
                        <label>Eloking</label>

                    </div>
                </div>

                <input type="hidden" name="id" value="{{$faq->id}}" required />

                <div class="form-row">
                    <div class="col"></div>
                    <div class="col save-changes-button">
                        <button type="submit" class="button">
                            <div>
                                Update
                            </div>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection