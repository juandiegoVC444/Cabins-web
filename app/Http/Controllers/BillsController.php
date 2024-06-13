<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Product;
use App\Models\Booking_members;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;
use Barryvdh\DomPDF\Facade\Pdf;

class BillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        return view('/customers/bills/bills');
       // return view('modules.bills.index', compact('bills'));
    }

    public function billsviews(){

      return view('customers.bills.billsviews');
    }





    public function pdf(){
      // return view('customers.bills.billsviews');

      $pdf = Pdf::loadView('customers.bills.billsviews');
      return $pdf->stream();
      //return $pdf->download('invoice.pdf');

    }


  }
