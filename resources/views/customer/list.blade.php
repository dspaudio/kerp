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
			<table id="grid"></table>
			<div id="pager"></div>
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
						<tr class="get_info" data-id="{{ $customer->id }}">
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
								<input type="text" id="customer_name" name="customer_name" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">원장 이름</span>
								<input type="text" id="director_name" name="director_name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">원장 이름(日)</span>
								<input type="text" id="director_name_jp" name="director_name_jp" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">병원 이름</span>
								<input type="text" id="clinic_name" name="clinic_name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">병원 이름(日)</span>
								<input type="text" id="clinic_name_jp" name="clinic_name_jp" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">담당 직원</span>
								<select name="staff" id="staff" class="form-control">
									@foreach($staff_list as $staff)
										<option value="{{ $staff->id }}">{{ $staff->staff_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">기본 주문 방식</span>
								<select name="default_order_type_code" id="default_order_type_code" class="form-control">
									@foreach($customer_list['default_order_type_code'] as $default_order_type_code => $value)
										<option value="{{ $default_order_type_code }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon addon_medium">기본 결제 방식</span>
								<select name="default_payment_type_code" id="default_payment_type_code" class="form-control">
									@foreach($customer_list['default_payment_type_code'] as $default_payment_type_code => $value)
										<option value="{{ $default_payment_type_code }}">{{ $value }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label">메모</label>
							<textarea name="memo" id="memo" rows="6" class="form-control"></textarea>
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
								<tbody id="address_list">
									<tr data-toggle="modal" data-target="#addressModal" data-id="">
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

<!-- Modal2 -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="addressModalLabel">주소 정보</h4>
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
@section('script')
	<style>
		.modal-lg {
			width: 98%;
		}
		.addon_medium {
			font-weight: bold;
			text-align: left;
			min-width: 120px;
		}
	</style>
	<script>
        $.jgrid.defaults.styleUI = 'Bootstrap';
        var dataArray = [
            {name: 'Bob', phone: '232-532-6268'},
            {name: 'Jeff', phone: '365-267-8325'}
        ];

        $("#grid").jqGrid({
            datatype: 'local',
            autowidth: true,
//            data: dataArray,
            colModel: [
				{name:'customer_name', label:'고객 이름'},
				{name:'director_name', label:'원장 이름'},
				{name:'director_name_jp', label:'원장 이름(日)'},
				{name:'clinic_name', label:'병원 이름'},
				{name:'clinic_name_jp', label:'병원 이름(日)'},
				{name:'staff', label:'담당 직원'},
//				{name:'default_order_type_code', label:'기본 주문 방식'},
//				{name:'default_payment_type_code', label:'기본 결제 방식'},
				{name:'memo', label:'메모'}
            ],
            caption: 'Customer',
            height: 'auto',
            rowNum: 20,
            pager: '#pager'
        });
        fetchGridData();

        function fetchGridData() {

            var gridArrayData = [];
            // show loading message
            $("#grid")[0].grid.beginReq();
            $.ajax({
                url: "{{ route('customer.list.json') }}",
                success: function (result) {
                    console.log(result);
                    for (var i = 0; i < result.length; i++) {
                        var item = result[i];
                        gridArrayData.push({
                            customer_name:item.customer_name,
                            director_name:item.director_name,
                            director_name_jp:item.director_name_jp,
                            clinic_name:item.clinic_name,
                            clinic_name_jp:item.clinic_name_jp,
                            staff:item.staff,
//                            default_order_type_code:item.default_order_type_code,
//                            default_payment_type_code:item.default_payment_type_code,
                            memo:item.memo
                        });
                    }
                    // set the new data
                    $("#grid").jqGrid('setGridParam', {data: gridArrayData});
                    // hide the show message
                    $("#grid")[0].grid.endReq();
                    // refresh the grid
                    $("#grid").trigger('reloadGrid');
                }
            });
        }
        $(function () {
            $('tr[data-toggle="modal"] > td').css('cursor','pointer');
            $('tr.get_info').click(function () {
	            var id = $(this).data('id');
	            $.get('{{ route('customer.view') }}/'+id, function (result) {
		            // 데이터 리셋
		            $('#customerModal input[type="text"]').val("");
		            $('#staff > option').prop('selected', false);
		            $('#default_order_type_code > option').prop('selected', false);
		            $('#default_payment_type_code > option').prop('selected', false);
					$('#memo').text("");
					$('#address_list').html("");

		            $('#customer_name').val(result.customer_name);
		            $('#director_name').val(result.director_name);
		            $('#director_name_jp').val(result.director_name_jp);
		            $('#clinic_name').val(result.clinic_name);
		            $('#clinic_name_jp').val(result.clinic_name_jp);
		            $('#staff > option['+result.staff+']').prop('selected', true);
		            $('#default_order_type_code > option['+result.default_order_type_code+']').prop('selected', true);
		            $('#default_payment_type_code > option['+result.default_payment_type_code+']').prop('selected', true);
					$('#memo').text(result.memo);
					console.log(result.address);
					result.address.forEach(function (index) {
					    console.log(index);
						var address_list_template = '<tr class="address_info" data-id="' + index.id + '">';
                        address_list_template += '<td>'+ index.addressee +'</td>';
                        address_list_template += '<td>'+ index.addressee_jp +'</td>';
                        address_list_template += '<td>'+ index.address +'</td>';
                        address_list_template += '<td>'+ index.address_jp +'</td>';
                        address_list_template += '<td>'+ index.zip_code +'</td>';
                        address_list_template += '<td>'+ index.memo +'</td>';
                        address_list_template += '</tr>';
                        $('#address_list').append(address_list_template);
                        $('.address_info').click(function () {
	                        var id = $(this).data('id');
	                        $('#addressModal').modal('show');
                        })
                    });
                });
	            $('#customerModal').modal('show');
            })
            $('#myModal').on('hidden.bs.modal', function (e) {
                // do something...
            })
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