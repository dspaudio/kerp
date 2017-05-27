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
							<option id="order_create" value="customer_name"
									{{ $parameter['sort_field']=="customer_name"?"selected":"" }}> 고객 이름
							</option>
							<option id="order_create" value="director_name"
									{{ $parameter['sort_field']=="director_name"?"selected":"" }}> 원장 이름
							</option>
							<option id="order_create" value="clinic_name"
									{{ $parameter['sort_field']=="clinic_name"?"selected":"" }}> 병원 이름
							</option>
							<option id="생성일"
							        value="created_at"{{ $parameter['sort_field']=="created_at"?"selected":"" }}>
								생성일
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
							<th>원장 이름(日)</th>
							<th>병원 이름</th>
							<th>병원 이름(日)</th>
							<th>담당 직원</th>
							<th>기본 주문 방식</th>
							<th>기본 결제 방식</th>
							<th>메모</th>
						</tr>
					</thead>
					<tbody>
					@foreach($customer_list['customer'] as $customer)
						<tr data-toggle="modal" data-target="#customerModal" data-id="{{ $customer->id }}">
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
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="customerModalLabel">상세 정보</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">고객 이름</span>
								<input type="text" name="customer_name" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">원장 이름</span>
								<input type="text" name="director_name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">원장 이름(日)</span>
								<input type="text" name="director_name_j" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">병원 이름</span>
								<input type="text" name="clinic_name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">병원 이름(日)</span>
								<input type="text" name="clinic_name_j" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">담당 직원</span>
								<select name="staff" id="" class="form-control">
									@foreach($staff_list as $staff)
										<option value="{{ $staff->id }}">{{ $staff->staff_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">기본 주문 방식</span>
								<select name="" id="" class="form-control">
									@foreach($customer_list['default_order_type_code'] as $default_order_type_code => $value)
										<option value="{{ $default_order_type_code }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">기본 결제 방식</span>
								<select name="" id="" class="form-control">
									@foreach($customer_list['default_payment_type_code'] as $default_payment_type_code => $value)
										<option value="{{ $default_payment_type_code }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label">메모</label>
							<textarea name="" id="" rows="6" class="form-control"></textarea>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-condensed table-hover table-stripe">
								<thead>
								<tr>
									<th>수신인</th>
									<th>수신인1</th>
									<th>주소</th>
									<th>주소1</th>
									<th>우편번호</th>
									<th>메모</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i> 저장</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<style>
		.addon_medium {
			font-weight: bold;
			text-align: left;
			min-width: 120px;
		}
	</style>
	<script>
        $(function () {
            $('tr[data-toggle="modal"] > td').css('cursor','pointer');
            $(".order_desc").click(function () {
                $("#orderby").val('desc');
                $("#search_form").submit();
            });
            $(".order_asc").click(function () {
                $("#orderby").val('asc');
                $("#search_form").submit();
            });
            $("#sort_by_status").click(function () {
                $("#orderby").val('asc');
                $("#sort_field").children("option").prop('selected', false);
                $("#order_status").prop('selected', true);
                $("#search_form").submit();
            });
        });
	</script>
@endsection