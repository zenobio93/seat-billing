@extends('web::layouts.app')

@section('title', trans('billing::tax.corporation_tax_overview', ["corp"=>$corporation->name]))
@section('page_header', trans('billing::tax.corporation_tax_overview', ["corp"=>$corporation->name]))

@section('content')
    @include("treelib::giveaway")
    <div class="row">

        <div class="col-md-4 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-calculator"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('billing::tax.total_invoices') }} <small class="text-muted">({{ trans('billing::tax.total_invoices_desc') }})</small></span>
                    <span class="info-box-number">
                {{ number($total_invoices_count,0) }}
              </span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-red elevation-1"><i class="fa fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('billing::tax.open_invoices') }} <small class="text-muted">({{ trans('billing::tax.open_invoices_desc') }})</small></span>
                    <span class="info-box-number">
                {{ number($open_invoices_count,0) }}
              </span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-green elevation-1"><i class="fa fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('billing::tax.completed_invoices') }} <small
                                class="text-muted">({{ trans('billing::tax.completed_invoices_desc') }})</small></span>
                    <span class="info-box-number">
                {{ number($completed_invoices_count,0) }}
              </span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-yellow elevation-1"><i class="fa fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('billing::tax.pending_tax') }} <small
                                class="text-muted">({{ trans('billing::tax.pending_tax_desc') }})</small></span>
                    <span class="info-box-number">
                {{ number($open_isk,0) }}
              </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex flex-row- align-items-baseline justify-content-between">
            <h3 class="card-title flex-grow-1">{{ trans('billing::tax.corporation_tax_user_totals') }}</h3>
        </div>
        <div class="card-body">
            <table class="table DataTable table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('billing::tax.user') }}</th>
                        <th>{{ trans('billing::tax.tax_user_total_amount') }}</th>
                        <th>{{ trans('billing::tax.tax_user_open_amount') }}</th>
                        <th>{{ trans('billing::tax.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user_totals as $user)
                        <tr>
                            <td data-sort="{{$user->user->main_character_id}}">@include("web::partials.character",["character"=>$user->user->main_character])</td>
                            <td data-sort="{{$user->total}}">{{ number($user->total,0) }} ISK</td>
                            @if($user->total - $user->paid > 0)
                                <td data-sort="{{$user->total - $user->paid}}" class="table-warning">{{ number($user->total - $user->paid,0) }} ISK</td>
                            @else
                                <td data-sort="{{$user->total - $user->paid}}">{{ number($user->total - $user->paid,0) }} ISK</td>
                            @endif
                            <td><a href="{{route("tax.foreignUserTaxInvoices",["id"=>$user->user_id])}}">{{trans('billing::tax.view_tax_details')}}</a> </td>
                        </tr>
                    @endforeach
                </tbody>
                @if($user_totals->isEmpty())
                    <tfoot>
                        <tr>
                            <td colspan="4">{{ trans('billing::tax.no_corporation_user_overview_data') }}</td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

@endsection

@push('javascript')
    <script>
        $(".DataTable").DataTable();
    </script>
@endpush

