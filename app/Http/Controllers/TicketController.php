<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Place;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DataTables;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $places = Ticket::all();
            return DataTables::of($places)
                ->addIndexColumn()
                ->addColumn('action-btn', function($row) {
                    return $row->id;
                })
                ->rawColumns(['action-btn'])
                ->make(true);
        }
        return view('admin.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select('name', 'id')->whereHas('roles', function ($query) {
            $query->where('roles.name', 'user');
        })->get();
        $vendors = User::select('name', 'id')->whereHas('roles', function ($query) {
            $query->where('roles.name', 'vendor');
        })->get();
        $places = Place::select('name', 'id')->get();
        $payment_types = PaymentType::select('name', 'id')->get();
        return view('admin.ticket.create', compact('users', 'vendors', 'places', 'payment_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_user(Request $request, $id)
    {
        $user = User::find($id);
        $data['status'] = true;
        $data['data'] = $user;
        return response()->json($data);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $data = $request->all();
        $validation = Validator::make($data, [
            'user_id' => 'required',
            'source_id' => 'required',
            'departure' => 'required',
            'destination' => 'required',
            'ticket_issue_date' => 'required',
            'travel_date' => 'required',
            'corona_test_date' => 'required',
            'quantity' => 'required',
            'corona_test_result' => 'required',
            'price' => 'required',
            'sell_price' => 'required',
            'payment_status' => 'required',
            'paid_amount' => 'required'
        ],[
            'user_id.required' => 'user id is required',
            'source_id.required' => 'source id is required',
            'departure.required' => 'departure is required',
            'destination.required' => 'destination is required',
            'ticket_issue_date.required' => 'ticket issue date is required',
            'travel_date.required' => 'travel date is required',
            'corona_test_date.required' => 'corona test_date is required',
            'quantity.required' => 'quantity is required',
            'corona_test_result.required' => 'corona test result is required',
            'price.required' => 'price is required',
            'sell_price.required' => 'sell price is required',
            'payment_status.required' => 'payment status is required',
            'paid_amount.required' => 'paid amount is required'
        ]);
        if($validation->fails()){
            return redirect()->back()->withInput()->with([
                'errors' => $validation->errors()
            ]);
        }

        $data['ticket_status'] = "ongoing";
        $data['created_by'] = $user->id;
        $data['updated_by'] = $user->id;

        $ticketData = Ticket::create($data);

        dd($ticketData);

        return redirect()->route('ticket.index')->with([
            'success' => trans('ticket create successfully')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
