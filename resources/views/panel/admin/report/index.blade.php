@extends('panel.layout.main')
@push('head')
    <link rel="stylesheet" href="{{ asset('/css/daterangepicker.css') }}" />
@endpush
@section('content')
    <div class="content panel-action-edit">
        <div class="container inner header">
            <h1>Reports</h1>
        </div>
        <div class="container">
            @if (session('success'))
                <div class="alert success">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            <div class="table">
                <div class="filters">
                    <form id="filter-form" action="{{ URL::to('/panel/report    ') }}" method="GET">
                        <input type="hidden" id="sortBy" name="sortBy" />
                        <input type="hidden" id="sortOrder" name="sortOrder" />
                        <div class="row">
                            <div class="date-range-picker-wrapper space-right">
                                <input type="text" class="date-range-picker" name="dates" />
                            </div>
                            <div class="booster-selection-wrapper mw240 boost-type-select select2-trigger">
                                <div class="booster-rank-selection-wrapper">
                                    <select
                                        class="boost-type booster-rank-selection booster-rank-selection select2"
                                        name="invoice-type">
                                        <option value="both-invoices">Customer & Eloking</option>
                                        <option value="eloking">Just Eloking</option>
                                        <option value="customer">Just Customer</option>
                                    </select>
                                    <span class="dropdown-icon">
                                        <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                    </span>
                                </div>
                            </div>
                            <div class="download-invoice-button-wrapper">
                                <button class="button primary">
                                    Download Invoice
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('/js/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[name="dates"]').daterangepicker();
        });
    </script>
@endpush
