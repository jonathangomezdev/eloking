@extends('panel.layout.main')
@section('content')
<div class="tooltip"></div>
<div class="content users-content">
    <div class="container inner header">
        <h1>Manage <span>Users</span></h1>
        <a href="{{ URL::to('/panel/admin/user/create') }}" class="button">New User</a>
    </div>
    <div class="container">
        @if (session('success'))
        <div class="alert success">
            <span>{{ session('success') }}</span>
        </div>
        @endif
        <div class="table">
            <div class="filters">
                <form id="filter-form" action="{{ URL::to('/panel/admin/user') }}" method="GET">
                    <input type="hidden" id="sortBy" name="sortBy" />
                    <input type="hidden" id="sortOrder" name="sortOrder" />
                    <div class="row">
                        <div class="booster-selection-wrapper mw240 boost-type-select select2-trigger">
                            <div class="booster-rank-selection-wrapper">
                                <select
                                    onChange="this.form.submit()"
                                    class="boost-type booster-rank-selection booster-rank-selection select2"
                                    name="role">
                                    <option value="">Choose an Option</option>
                                    <option @if(request('role') === 'admin') selected @endif value="admin">Admin</option>
                                    <option @if(request('role') === 'booster') selected @endif value="booster">Booster</option>
                                    <option @if(request('role') === 'member') selected @endif value="member">Member</option>
                                </select>
                                <span class="dropdown-icon">
                                    <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                </span>
                            </div>
                        </div>
                        <div class="booster-selection-wrapper mw240 boost-type-select select2-trigger">
                            <div class="booster-rank-selection-wrapper">
                                <select
                                    onChange="this.form.submit()"
                                    class="boost-type booster-rank-selection booster-rank-selection select2"
                                    name="active">
                                    <option value="">Choose an Option</option>
                                    <option @if(request('active') === 'active') selected @endif value="active">Active</option>
                                    <option @if(request('active') === 'disabled') selected @endif value="disabled">Disabled</option>
                                </select>
                                <span class="dropdown-icon">
                                    <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                </span>
                            </div>
                        </div>
                        <div class="search-input">
                            <img src="{{ asset('/img/panel/icons/search.svg') }}" alt="Search"
                                class="search-input__icon">
                            <input type="search" class="search-input__search" name="search" value="{{ request('search') }}" placeholder="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="re-table-wrap">
            <table class="re-table">
                <tr class="re-table__row">
                    <th data-label="name" @if(request('sortBy')=='name' ) data-order="{{ request('sortOrder') }}" @else
                        data-order="asc" @endif class="re-table__h">
                        <div>
                            Username
                        </div>
                    </th>
                    <th data-label="email" @if(request('sortBy')=='email' ) data-order="{{ request('sortOrder') }}"
                        @else data-order="asc" @endif class="re-table__h">
                        <div>
                            Email
                        </div>
                    </th>
                    <th data-label="role" @if(request('sortBy')=='role' ) data-order="{{ request('sortOrder') }}" @else
                        data-order="asc" @endif class="re-table__h">
                        <div>
                            Roles
                        </div>
                    </th>
                    <th data-label="active" @if(request('sortBy')=='active' ) data-order="{{ request('sortOrder') }}"
                        @else data-order="asc" @endif class="re-table__h">
                        <div>
                            Status
                        </div>
                    </th>
                    <th data-label="id" @if(request('sortBy')=='id' ) data-order="{{ request('sortOrder') }}" @else
                        data-order="asc" @endif class="re-table__h">
                        <div>
                            ID
                        </div>
                    </th>
                </tr>
                @forelse($users as $user)
                <tr class="re-table__row tooltip-link" data-tooltip="Click to Open">
                    <td data-label="Name" class="re-table__cell">
                        <a href="{{ URL::to('/panel/admin/user/' . $user->id . '/edit') }}">
                            <div class="user-letter {{ strtolower(substr($user->username, 0, 1)) }}">
                                {{ substr($user->username, 0, 1) }}
                            </div>
                            <span class="text-white">{{ $user->username }}</span>
                        </a>
                    </td>
                    <td data-label="Email" class="re-table__cell">
                        <a href="{{ URL::to('/panel/admin/user/' . $user->id . '/edit') }}">
                            <span class="colored">{{ $user->email }}</span>
                        </a>
                    </td>
                    <td data-label="Roles" class="re-table__cell">
                        <a href="{{ URL::to('/panel/admin/user/' . $user->id . '/edit') }}">
                            <span>{{ ucfirst($user->roles->pluck('name')->join(', ')) }}</span>
                        </a>
                    </td>
                    <td data-label="Status" class="re-table__cell">
                        <a href="{{ URL::to('/panel/admin/user/' . $user->id . '/edit') }}">
                            <div class="order-addons order-addons--active order-addons--large">
                                <span>{{ $user->active ? 'Active' : 'Disabled' }}</span>
                            </div>
                        </a>
                    </td>
                    <td data-label="ID" class="re-table__cell">
                        <a href="{{ URL::to('/panel/admin/user/' . $user->id . '/edit') }}">
                            <span>#{{ $user->id }}</span>
                            <div class="rank-to img-grad hidden-cell last-arrow"></div>
                        </a>
                    </td>
                </tr>
                @empty
                    <tr class="re-table__row">
                        <td class="re-table__cell" colspan="6">
                            <p class="p15-v">No completed orders</p>
                        </td>
                    </tr>
                @endforelse
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('.re-table__h:not(.actions)').click(function() {
        let oldOrder = $(this).data('order');
        if (!oldOrder) {
            oldOrder = 'asc';
        }
        let newOrder = oldOrder === 'asc' ? 'desc' : 'asc';

        $('#sortBy').val($(this).data('label'));
        $('#sortOrder').val(newOrder);

        $('#filter-form').trigger('submit');
    })
    $('.search-input').on('click', function() {
        $('.search-input__search').focus();
    });
});
</script>
@endpush
