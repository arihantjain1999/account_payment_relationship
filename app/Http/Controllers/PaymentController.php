<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;
use App\paymentCreated;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // dd(Payment::onlyTrashed()->get());
        $accounts = Payment::all();
        if ($request->ajax()) {
            $table =   DataTables::of($accounts)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-secondary mx-1" href = "payments/' . $row->id . '/edit" >edit  </a>';
                    $btn .= '<button class="btn btn-danger  mx-1 datadelete" value="' . $row->id . '">delete</button>';
                    return $btn;
                })
                ->addcolumn('account_name', function($row){
                    // $account = Account::find($row->account_id);
                    $account = Payment::find($row->id);
                    return $account->account->name;
                })
                // ->removeColumn('account_id')
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
            return $table;
        }
        return view('payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Payment $payment, $id)
    {
        $account  = Account::find($id);
        // dd($account);
        return view('payment.create', compact('account'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all(       ));
        // event(new paymentCreated($request->all()));
        $account = Account::find($request->account_id);
        // dd($request->all()); $account->payment_pending + $request->payment_pending;
        $payment_pending = $account->payment_pending + $request->payment_pending;
        if ($account->payment_recived <=  $payment_pending * .5) {
            $account->update([
                'payment_pending' => $account->payment_pending + $request->payment_pending,
                'status' => 'unpaid'
            ]);
        } else {
            // i    f($account->payment_recived <=  $payment_pending * .5){
            $account->update([
                'payment_pending' => $account->payment_pending + $request->payment_pending,
                'status' => 'halfpaid'
            ]);
        }
        $payment = new Payment();
        $payment->subject = $request->subject;
        // $payment->account_id = $request->account_id;
        $payment->payment_date = $request->payment_date;
        $payment->payment_pending = $request->payment_pending;
        $payment->payment_recived = $request->payment_recived;
        $payment->pending_amount = $request->pending_amount;
        $accountdetails = Account::find($request->account_id);
        $payment->account()->associate($accountdetails);
        $payment->save();

        event(new paymentCreated($payment->account , $payment));

        return redirect('payments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);
        return view('payment.form', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $payment)
    {
        // dd($request->all());
        $paymetdetails = [];
        $paymetdetails['subject'] = $request->subject;
        $paymetdetails['payment_date'] = $request->payment_date;
        $paymetdetails['payment_recived'] = $request->payment_recived;
        $paymetdetails['payment_pending'] = $request->payment_pending;
        $paymetdetails['pending_amount'] = $request->pending_amount;
        Payment::where('id', $payment)->update($paymetdetails);
        $accountdata = Account::find($request->account_id);
        $totalamountrecived = $accountdata->payment_recived + $request->payment_recived;
        $pendingamountpercenntage = $accountdata->payment_pending * .5;
        if ($pendingamountpercenntage > $totalamountrecived) {
            $accountdata->update(
                array(
                    'status' => 'unpaid',
                    'payment_recived' => $totalamountrecived
                )
            );
        } elseif ($accountdata->payment_pending == $totalamountrecived) {
            $accountdata->update(
                array(
                    'status' => 'fullpaid',
                    'payment_recived' => $totalamountrecived
                )
            );
        } else {
            $accountdata->update(
                array(
                    'status' => 'halfpaid',
                    'payment_recived' => $totalamountrecived
                )
            );
        }

        $payment = Payment::find($payment)->first();
        event(new paymentCreated($payment->account , $payment));

        return redirect('payments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        // $payment->id;
        Payment::find($payment->id)->delete();
    }



    public function restore($id)
    {
        dd($id);
        Payment::where('id', $id)->withTrashed()->restore();

        return redirect()->route('payments.index');
        // ->withSuccess(__('User restored successfully.'));
    }

    public function forceDelete($id)
    {
        Payment::where('id', $id)->withTrashed()->forceDelete();

        return redirect()->route('payments.index', ['status' => 'archived']);
        // ->withSuccess(__('User force deleted successfully.'));
    }



    public function restoreAll()
    {
        Payment::onlyTrashed()->restore();
        return redirect()->route('payments.index')->withSuccess(__('All users restored successfully.'));
    }


    public function deletedpayments()
    {
        // dD('hell');
        $deletedpayments = Payment::onlyTrashed()->get();
        return view('payment.deletedpayments', compact('deletedpayments'));
    }



    public function chart()
    {

        $users  =DB::table('payments')->selectRaw('count(*) as count , account_id')->groupBy('account_id')->pluck('account_id');
        $companyname  =DB::table('accounts')->pluck('name');
        $payment_pending  =DB::table('accounts')->select('payment_pending')->pluck('payment_pending');
        $payment_recived  =DB::table('accounts')->select('payment_recived')->pluck('payment_recived');
        // $status  =DB::table('accounts')->selectRaw('count(*) as count , status')->groupBy('status')->pluck('status');
        $status  =DB::table('accounts')->selectRaw('count(*) as count , status')->groupBy('status')->get();

            $statusarr = [];
            $countarr = [];
            foreach ($status as $stat) {
                     array_push( $statusarr , $stat->status); 
                     array_push( $countarr , $stat->count); 
                }
// dd($countarr , $statusarr);
        // dump($payment_pending);
        return view('payment.chart', compact('companyname' , 'users' , 'payment_pending' , 'payment_recived' , 'statusarr' , 'countarr'));
    }

}
