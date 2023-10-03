<form class="form" action="{{ $type === 'edit' ? URL::to('/panel/blog/' . $post->id) : URL::to('/panel/blog/') }}" method="POST" enctype="multipart/form-data">
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
    @if($type === 'edit')
        <input type="hidden" name="_method" value="PUT" />

        <div class="image-preview-wrapper">
            <img src="{{ asset('img/1x1.png') }}" data-src="{{ $post->image }}" class="image-preview lazyload" alt="Post image"/>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-row">
        <div class="col">
            <span>Cover Image (656×368) <span class="required">*</span></span>
        </div>
        <div class="col">
            <div class="input-group">
                <input type="file" name="image" accept="image/*" />
                @error('image') <span>{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <span>Title <span class="required">*</span></span>
        </div>
        <div class="col">
            <div class="input-group">
                <input type="text" value="{{ $type === 'edit' ? $post->title : old('title') }}" name="title" required/>
                @error('title') <span>{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <span>Slug <span class="required">*</span></span>
        </div>
        <div class="col">
            <div class="input-group">
                <input type="text" value="{{ $type === 'edit' ? $post->slug : old('slug') }}" name="slug" required/>
                @error('slug') <span>{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <span>Page Title</span>
        </div>
        <div class="col">
            <div class="input-group">
                <input type="text" value="{{ $type === 'edit' ? $post->page_title : old('page_title') }}" name="page_title" />
                @error('slug') <span>{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <span>Description <span class="required">*</span></span>
        </div>
        <div class="col">
            <div class="input-group">
                <textarea name="content" id="blogContent">{!! $type === 'edit' ? $post->content : old('content') !!}</textarea>
                @error('content') <span>{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="form-row post-status">
        <div class="col">
            <span>Status <span class="required">*</span></span>
        </div>
        <div class="input-group">
            <div class="booster-selection-wrapper boost-type-select select2-trigger">
                <div class="booster-rank-selection-wrapper">
                    <select
                        class="boost-type booster-rank-selection booster-rank-selection select2"
                        id="status"
                        name="status"
                        required>
                        <option value="">Choose option</option>
                        <option @if($type === 'edit' && $post->status === \App\BlogPost::STATUS_PUBLISHED) selected @endif value="{{ \App\BlogPost::STATUS_PUBLISHED }}">Published</option>
                        <option @if($type === 'edit' && $post->status === \App\BlogPost::STATUS_DRAFT) selected @endif value="{{ \App\BlogPost::STATUS_DRAFT }}">Draft</option>
                    </select>
                    <span class="dropdown-icon">
                        <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                    </span>
                </div>
            </div>
            @error('status') <span>{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="form-row scheduler">
        <div class="col">
            <span>Schedule Publish Date (Year-Month-Date)</span>
        </div>
        <div class="col">
            <div class="input-group">
                <input type="text" placeholder="eg. 2021-01-13" value="{{ $type === 'edit' ? $post->schedule_publish_at : ''}}" name="schedule_publish_at" />
                @error('schedule_publish_at') <span>{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <span>Category <span class="required">*</span></span>
        </div>
        <div class="input-group">
            <div class="booster-selection-wrapper boost-type-select select2-trigger">
                <div class="booster-rank-selection-wrapper">
                    <select
                        class="boost-type booster-rank-selection booster-rank-selection select2"
                        name="category"
                        required>
                        <option value="">Choose option</option>
                        <option @if($type === 'edit' && $post->category === 'csgo') selected @endif value="csgo">CS:GO</option>
                        <option @if($type === 'edit' && $post->category === 'valorant') selected @endif value="valorant">Valorant</option>
                        <option @if($type === 'edit' && $post->category === 'lol') selected @endif value="lol">League Of Legends</option>
                    </select>
                    <span class="dropdown-icon">
                        <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                    </span>
                </div>
            </div>
            @error('category') <span>{{ $error }}</span> @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <span>Meta Keyword</span>
        </div>
        <div class="col">
            <div class="input-group">
                <input type="text" value="{{ $type === 'edit' ? $post->meta_keywords : old('meta_keywords') }}" name="meta_keywords" />
                @error('meta_keywords') <span>{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <span>Meta Description</span>
        </div>
        <div class="col">
            <div class="input-group">
                <textarea class="input" name="meta_description" rows="5">{{ $type === 'edit' ? $post->meta_description : old('meta_description') }}</textarea>
                @error('meta_description') <span>{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <button class="button post-save-button">
        @if($type === 'edit')
            Save Changes
        @else
            Create New Blog Post
        @endif
    </button>
</form>
@push('head')
    <link href="{{ asset('/summernote/summernote-lite.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset("/summernote/summernote-lite.js") }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#blogContent').summernote({
                height: 400,
            });

            $('#status').on('change', function() {
                if ($(this).val() === 'published') {
                    $('.scheduler').hide();
                } else {
                    $('.scheduler').show();
                }
            })
        });
    </script>
@endpush
