@extends('panel.layout.main')
@section('content')
<div class="help-cener">
    <div class="help-nav">
        <h1>Help <span>Center</span></h1>
        <ul class="faq-list">
            <li class="faq-list__item active">
                <div class="faq-list-header">
                    <img src="{{ asset('img/panel/icons/rank-to.svg') }}" class="faq-list-header__img" alt="icon"/>
                    <div class="faq-list-header__title">
                        All Questions
                    </div>
                    <div class="faq-list-header__count">
                        <div class="number">
                            {{$all_questions->count()}}
                        </div>
                    </div>
                    <div class="faq-list-header__icon">
                        <img src="{{ asset('img/icons/dropdown.svg') }}" alt="icon"/>
                    </div>
                </div>
            </li>
            @foreach($all_categories as $category)
            <li class="faq-list__item">
                <div class="faq-list-header">
                    <img src="{{ asset('img/panel/icons/rank-to.svg') }}" class="faq-list-header__img" alt="icon"/>
                    <div class="faq-list-header__title">
                        {{ $category->name }}
                    </div>
                    <div class="faq-list-header__count">
                        <div class="number">
                            {{ $category->categories->count()}}
                        </div>
                    </div>
                    <div class="faq-list-header__icon">
                        <img src="{{ asset('img/icons/dropdown.svg') }}" alt="icon"/>
                    </div>
                </div>
            </li>
            @endforeach

        </ul>
    </div>
    <div class="help-content">
        <div class="help-content-header">
            <div class="help-content-header__wrapper">
                <ul class="help-content-list">
                    <li class="help-content-list__item active">
                        <h2>All <span>Questions</span></h2>
                    </li>
                    @foreach($all_categories as $category)
                    <li class="help-content-list__item">
                        <h2>{{ $category->name }}</h2>
                    </li>
                    @endforeach
                </ul>
                @role('admin')
                    <a href="{{ url('/panel/help/add') }}" class="button">Add Question</a>
                @endrole
            </div>
        </div>

        <div class="faq-list-content active">
            <ul class="faq-questions">
                @foreach($all_questions as $faq)
                <li class="faq-questions__item">
                    <div class="faq-questions__wrap">
                        <div class="faq-questions__title">
                            {{ $faq->question }}
                        </div>
                        <div class="faq-questions__text">
                            {{ $faq->answer }}
                        </div>
                        <div class="faq-questions__icons">
                            @foreach($faq->categories as $label)
                            <div class="order-addons order-addons--{{ str_replace(' ', '', str_replace(':','',strtolower($label)))}}">
                                <span>{{ $label }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        @foreach($all_categories as $category)
        <div class="faq-list-content">
            <ul class="faq-questions">
                @foreach($category->categories as $faq)
                <li class="faq-questions__item">
                    <div class="faq-questions__wrap">
                        <div class="faq-questions__title">
                            {{ $faq->question }}
                        </div>
                        <div class="faq-questions__text">
                            {{ $faq->answer }}
                        </div>
                        <div class="faq-questions__icons">
                            @foreach($faq->categories as $label)
                            <div class="order-addons order-addons--{{ str_replace(' ', '', str_replace(':','',strtolower($label)))}}">
                                <span>{{ $label }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach

    </div>
</div>
<div class="live-chat-btn" onclick="LC_API.open_chat_window();return false">
    <div class="live-chat-btn__icon">
        <img width="70" height="77" class="live-chat-btn__icon__img" src="{{ asset('img/panel/live-chat.png') }}" srcset="{{ asset('img/panel/live-chat@2x.png') }} 2x" alt="Live chat" />
    </div>
    <a class="live-chat-btn__content">
        <img src="{{ asset('img/panel/liv-chat-lines.png') }}" srcset="{{ asset('/img/panel/liv-chat-lines@2x.png') }}" alt="Live chat lines" class="live-chat-btn__lines" />
        <div class="live-chat-btn__title">
            Chat with us
        </div>
    </a>
</div>
@endsection
