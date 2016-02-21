<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sellerList(Request $request, $flag)
    {
        $request_data = $request->except('_token');
        $sort_by = 'first_name-0';
        if(!empty($request_data['sort_by']))
            $sort_by = $request_data['sort_by'];

        $sort_settings = explode('-', $sort_by);
        $user_service = app(UserService::class);

        switch($flag){
            case 'find':
                if(!empty($request_data['seller_name']))
                {
                    session(['seller_name' => $request_data['seller_name']]);
                    $seller_name = $request_data['seller_name'];
                }
                else
                    $seller_name = $request->session()->get('seller_name');

                $sellers = $user_service->getUsersByRole('seller', $sort_settings[0], intval($sort_settings[1]), $seller_name);
                break;

            default:
                $sellers = $user_service->getUsersByRole('seller', $sort_settings[0], intval($sort_settings[1]));
                break;
        }

        return view('sellers.seller-list')->with(['sellers' => $sellers]);
    }
}
