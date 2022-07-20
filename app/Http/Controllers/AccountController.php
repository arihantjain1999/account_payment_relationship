<?php

namespace App\Http\Controllers;

use App\Account;
use App\Payment;
use App\userCreated;
use Illuminate\Http\Request;
use SebastianBergmann\Type\VoidType;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\campaignevent;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $unpaid  = DB::table('accounts')->selectRaw('count(*) as count , status')->groupBy('status')->get();
        $payment_pending  = DB::table('accounts')->sum('payment_pending');
        $payment_recived  = DB::table('accounts')->sum('payment_recived');
        $unpaid->push((object)['count' => '₹ ' . $payment_pending, 'status' => 'Payment Pending']);
        $unpaid->push((object)['count' => '₹ ' . $payment_recived, 'status' => 'Payment Recived']);


        $accounts = Account::all();
        if ($request->ajax()) {
            $table =   DataTables::of($accounts)
                ->addIndexColumn()
                // ->removeColumn('status')
                ->addcolumn('status', function ($row) {
                    if ($row->status == 'unpaid') {
                        $str = '<span class="border border-danger rounded-pill text-danger p-2">' . $row->status . '</span>';
                        return $str;
                    } elseif ($row->status == 'fullpaid') {
                        $str = '<span class="border border-success rounded-pill text-success p-2">' . $row->status . '</span>';
                        return $str;
                    } else {
                        $str = '<span class="border border-primary rounded-pill text-primary p-2">' . $row->status . '</span>';
                        return $str;
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-success " href="payments/create/' . $row->id . '"  >Create Payment</a>';
                    // $btn .= '<a class="btn btn-primary " href="payments/reletedpayments/'.$row->id.'"  >All Payments</a>';
                    $btn .= '<button class="btn btn-secondary  mx-1 datadelete" value="' . $row->id . '">delete</button>';
                    // $btn .= '<a class="btn btn-danger" href="accounts/'.$row->id.'">edit</a>';
                    return $btn;
                })
                ->addColumn('releted_payments', function ($row) {
                    $accountpayments = Account::find($row->id);
                    $string = [];
                    foreach ($accountpayments->payments as $payments) {
                        array_push($string, "<button class='showpayment badge rounded-pill bg-primary' data-bs-toggle='modal' data-bs-target='#staticBackdrop'  value=" . $payments->id . ">" . $payments->id . "</button>");
                    }
                    return implode('', $string);
                })
                ->rawColumns(['action', 'checkbox', 'releted_payments', 'status'])
                ->make(true);
            return $table;
        }

        return view('account.index', ['unpaid' => $unpaid]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account = new Account();
        $account->name = $request->name;
        $account->email = $request->email;
        $account->address = $request->address;
        $account->phone = $request->phone;
        $account->payment_pending = $request->payment_pending;
        $account->status = $request->status;
        $account->payment_recived = $request->payment_recived;
        $account->save();
        event(new userCreated($request->all()));
        return redirect('accounts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Payment::find($id);
        return $account;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        Account::find($account->id)->payments()->delete();
        Account::find($account->id)->delete();
        return 'nice';
        // dd($account); 
    }


    public function mail(Request $request)
    {
        // dd($request->body);
        $allaccountemails = Account::select('email')->groupBy('email')->get();
        // dd($allaccountemails);
        // dispatch(function ($allaccountemails, $request) {
            foreach ($allaccountemails as $accountmail) {
                event(new  campaignevent($accountmail->email, $request->body));
            }
        // });
        return $allaccountemails;
    }
}
