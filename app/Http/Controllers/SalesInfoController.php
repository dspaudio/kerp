<?php

namespace App\Http\Controllers;

use App\Product;
use App\SalesInfo;
use Illuminate\Http\Request;

class SalesInfoController extends Controller
{
	// 목록 표시
	public function index(Request $request)
	{
		$parameter = [
			// 검색 내용
		];

		$sales_info_list = SalesInfo::sales_info_list($parameter);

		return view('sales_info.list', compact('sales_info_list', 'parameter'));
	}

	// 매출 상세
	public function view(SalesInfo $sales_info, Request $request)
	{
		$sales_info->load('customer', 'orderer', 'staff');

		return response()->json($sales_info);
	}

	// 매출 추가
	public function store(Request $request)
	{
		//자동완성기능덕에 제품정보가 이미 리퀘스트 안에 다있음 제품테이블 갈필요없음
		$sales_info_data = [

		];

		$sales_info = SalesInfo::create($sales_info_data);
//		$addresses_data = [
//
//		];
//		foreach ($aaa as $a) {
//			$address_data = [
//
//			];
//			array_push($addresses_data, $address_data);
//		}
//		$customer->address->insert($addresses_data);
//		$customer->orderer->insert($ordereres_data); // 대충 이런식

		return redirect()->intended(route('sales_info.list'));
	}

	// 매출 수정
	public function modify(SalesInfo $sales_info, Request $request)
	{//sales_progress_code,shipped_quantity,pended_quantity,is_order_in,event_memo,
		//payment_date,ship_out_complete_date,payment_type_code,order_type_code,sales_cancel_date,memo
		$sales_info_data = [

		];

		$sales_info->update($sales_info_data);
		return redirect()->intended(route('sales_info.list'));
	}

	// 매출 삭제
	public function delete(SalesInfo $sales_info)
	{
		$sales_info->delete(); // softDelete
//		$customer->forceDelete(); // 완전히 삭제

		return redirect()->intended(route('sales_info.list'));
	}
}
