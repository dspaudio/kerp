@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<form id="search_form" action="{{ route('customer.list') }}" method="get">
			<div class="col-md-10">

			</div>
			<div class="col-md-2 text-right">
				<div class="form-group">
					<div class="input-group">
						<select name="sort_field" id="sort_field"
						        class="form-control s_select">
							<option id="order_create" value="created_at"
									{{ $parameter['sort_field']=="customer_name"?"selected":"" }}> 고객 이름
							</option>
							<option id="order_status"
							        value="ca_status"{{ $parameter['sort_field']=="ca_status"?"selected":"" }}>
								작성기사 우선
							</option>
							<option id="order_admission"
							        value="ca_admission_ntime"{{ $parameter['sort_field']=="ca_admission_ntime"?"selected":"" }}>
								웹출고시간
							</option>
						</select>
						<input type="hidden" id="orderby" name="orderby" value="{{ $parameter['orderby'] }}">
						<span class="input-group-btn">
					                                            <button class="btn btn-white order_asc" type="button" style="background-color:#fff">
					                                                <i class="fa fa-caret-up" aria-hidden="true"></i>
					                                            </button>
					                                        </span>
						<span class="input-group-btn">
					                                            <button class="btn btn-white order_desc" type="button"
					                                                    style="background-color:#fff">
					                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
					                                            </button>
					                                        </span>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if (count($customer_list['customer']) >0 )
			<div class="table-response">
				<table class="table table-striped table-hover table-condensed">
					<thead>
						<tr>
							<th>고객 이름</th>
							<th>원장 이름</th>
							<th>원장이름(日)</th>
							<th>병원이름</th>
							<th>병원이름(日)</th>
							<th>담당직원</th>
							<th>기본 주문 방식</th>
							<th>기본 결제 방식</th>
							<th>메모</th>
						</tr>
					</thead>
					<tbody>
					@foreach($customer_list['customer'] as $customer)
						<tr>
							<td>{{ $customer->customer_name }}</td>
							<td>{{ $customer->director_name }}</td>
							<td>{{ $customer->director_name_jp }}</td>
							<td>{{ $customer->clinic_name }}</td>
							<td>{{ $customer->clinic_name_jp }}</td>
							<td>{{ $customer->staff_id ? $customer->staff->staff_name : '' }}</td>
							<td>{{ $customer_list['default_order_type_code'][$customer->default_order_type_code ?? 0] }}</td>
							<td>{{ $customer_list['default_payment_type_code'][$customer->default_payment_type_code ?? 0] }}</td>
							<td style="width:300px">{{ $customer->memo }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{{ $customer_list['customer']->appends(Input::except('page'))->links() }}
			</div>
			@else
				<div class="text-center">
					고객이 없습니다
				</div>
			@endif
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="customer_modal" tabindex="-1" role="dialog" aria-labelledby="customer_modal_label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="customer_modal_label">Modal title</h4>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
@endsection