@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<form action="">
			<div class="col-md-10">

			</div>
			<div class="col-md-2">

			</div>
		</form>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if (count($customer_list['customer']) >0 )
			<div class="table-response">
				<table class="table table-striped table-hover">
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
							<td>{{ $customer->staff_id }}</td>
							<td>{{ $customer_list['default_order_type_code'][$customer->default_order_type_code??0] }}</td>
							<td>{{ $customer_list['default_payment_type_code'][$customer->default_payment_type_code??0] }}</td>
							<td>{{ $customer->memo }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="text-center">
{{--				{{ $customer_list['customer']->appends(Input::except('page'))->links() }}--}}
				{{ $customer_list['customer']->links() }}
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