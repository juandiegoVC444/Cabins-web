<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Booking_members;
use App\Models\detail_booking;
use App\Models\Product;
use App\Models\product_bills;
use App\Models\detail_product_bills;
use App\Models\Detail_service;
use App\Models\detail_service_bills;
use App\Models\service_bills;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $bookings = Bookings::select(
            'bookings.id',
            'detail_service_bills.tittle',
            'bookings.create_time',
            'bookings.initial_date',
            'payment_methods.title_payment',
            'users.name',
            'bookings.pay_status'
        )

            ->join('users', 'bookings.users_id', '=', 'users.id')
            ->join('payment_methods', 'bookings.payment_methods_id', '=', 'payment_methods.id')
            ->join('detail_booking', 'bookings.id', '=', 'detail_booking.booking_id')
            ->join('service_bills', 'detail_booking.service_bills_id', '=', 'service_bills.id')
            ->join('detail_service_bills', 'service_bills.id', '=', 'detail_service_bills.service_bills_id')
            ->distinct()->get();
        return view('modules.bookings.index', ['bookings' => $bookings]);
    }
    public function create(Request $request)
    {
        $user = auth()->user();

        $keys = Product::all()->pluck('id')->toArray(); # se consultan todos los productos y los convertimos a arreglo
        $keyDetails = Detail_service::all()->pluck('id')->toArray();
        $contDetail = 0;
        $cont = 0;
        foreach ($keys as $key) {
            $keys[$cont] = 'product' . $user?->id . $key;
            $cont++;
        }

        foreach ($keyDetails as $keyDetail) {
            $keyDetails[$contDetail] = 'detail_service' . $user?->id . $keyDetail;
            $contDetail++;
        }

        $products = Cache::many($keys);
        $detailServices = Cache::many($keyDetails);

        // Obtener los valores de los parámetros enviados en la solicitud GET
        $totalProductos = $request->input('totalproductos');
        $totalServicios = $request->input('totalservicios');
        $total = $request->input('total');
        $bookingcode = $request->input('bookingcode');

        $insertarp['id_user'] = $user->id;
        $insertarp['total'] = $totalProductos;
        $insertarp['state_record'] = 'PROCESO';

        $product_bill = product_bills::create($insertarp);

        foreach ($products as $p) {

            if ($p) {

                $insertarpdetail['name_product'] = $p->nombre;
                $insertarpdetail['price'] = $p->precio;
                $insertarpdetail['amount_product'] = $p->cantidad;
                $insertarpdetail['state_record'] = 'PROCESO';
                $insertarpdetail['product_bills_id'] = $product_bill->id;
                $insertarpdetail['products_id'] = $p->id;

                $detail_product_bill = detail_product_bills::create($insertarpdetail);
            }
        }

        $insertars['id_user'] = $user->id;
        $insertars['total'] = $totalServicios;
        $insertars['state_record'] = 'PROCESO';

        $service_bill = service_bills::create($insertars);

        $fechainicialG  = Carbon::parse($detailServices[0]?->fecha_inicial  ?? date('Y-m-d'));
        $fechafinalG  = Carbon::parse($detailServices[0]?->fecha_final ?? date('Y-m-d'));

        foreach ($detailServices as $s) {
            if ($s) {
                $fecha_inicio = Carbon::parse($s->fecha_inicial);
                if($fecha_inicio->lessThan($fechainicialG )){

                    $fechainicialG = $fecha_inicio;

                }

                $fecha_final = Carbon::parse($s->fecha_final);
                if($fecha_final -> greaterThan($fechafinalG)){

                    $fechafinalG = $fecha_final;

                }

                $insertarsdetail['amount_adults'] = $s->cantidad_adultos;
                $insertarsdetail['amount_child'] = $s->cantidad_ninos;
                $insertarsdetail['tittle'] = $s->nombre;
                $insertarsdetail['state_record'] = 'PROCESO';
                $insertarsdetail['service_bills_id'] = $service_bill->id;
                $insertarsdetail['detail_services_id'] = $s->id;

                $detail_service_bill = detail_service_bills::create($insertarsdetail);
            }
        }

        $insertarb['final_date'] =  $fechafinalG ;
        $insertarb['initial_date'] = $fechainicialG;
        $insertarb['total'] =  $total;
        $insertarb['booking_code'] = $bookingcode;
        $insertarb['pay_status'] =  'PENDIENTE';
        $insertarb['state_record'] = 'ACTIVAR';
        $insertarb['PAYMENT_METHODS_id'] = 3 ;
        $insertarb['USERS_id'] =  $user->id;

        $Booking = Bookings::create($insertarb);

        $insertardetailb['state_record'] = 'ACTIVAR';
        $insertardetailb['BOOKING_id'] =  $Booking -> id ;
        $insertardetailb['DETAIL_SERVICES_id'] = null;
        $insertardetailb['product_bills_id'] =  $product_bill -> id;
        $insertardetailb['service_bills_id'] =  $service_bill -> id;

        $detailBooking = detail_booking::create($insertardetailb);

        $userId = $user->id;
        $keys = Product::all()->pluck('id')->toArray(); # se consultan todos los productos y los convertimos a arreglo
        foreach ($keys as $key) {
            $idRegistro = 'product' . $userId . $key;
            Cache::flush($idRegistro);
        }

        $keyDetails = Detail_service::all()->pluck('id')->toArray();
        foreach ($keyDetails as $keyDetail) {
            $idRegistro = 'detail_service' . $userId . $keyDetail;
            Cache::flush($idRegistro);
        }

        $book = $Booking -> id ;
        // Cache::flush(); # Se elimina todo lo que coincida con las llaves
        // return view('customers.shoppingCar.shoppingcar', compact('products'));
        // return redirect(route('shoppingCar.index')) ->with('ok', 'ok'); # redirecciona a la vista del carrito
        return redirect()->route('bills.billsGetDates', ['idBook' => $book]); //return que me enviará el parametro al billscontroller
        // Lógica adicional para procesar los valores y realizar acciones

        // Redirigir a otra página, devolver una respuesta, etc.
    }

    public function show(Bookings $book)
    {

        $booking = Bookings::select(
            'bookings.id',
            'bookings.final_date',
            'bookings.initial_date',
            'bookings.booking_code',
            'bookings.pay_status',
            'bookings.create_time',
            'bookings.update_time',
            'bookings.state_record',
            'payment_methods.title_payment',
            'detail_service_bills.tittle',
            'users.name',
            'users.last_name',
            'users.phone_number',
            'users.email',
            'users.identification_number',
            'detail_service_bills.amount_adults',
            'detail_service_bills.amount_child',
            'service_bills.total'
        )
            ->join('users', 'bookings.users_id', '=', 'users.id')
            ->join('payment_methods', 'bookings.payment_methods_id', '=', 'payment_methods.id')
            ->join('detail_booking', 'bookings.id', '=', 'detail_booking.booking_id')
            ->join('service_bills', 'detail_booking.service_bills_id', '=', 'service_bills.id')
            ->join('detail_service_bills', 'service_bills.id', '=', 'detail_service_bills.service_bills_id')
            //->join('detail_services', 'service_bills.detail_services_id', '=', 'detail_services.id')
            ->where('bookings.id', '=', $book->id)
            ->first();

        $booking_members = Booking_members::select(
            'booking_members.first_name_member',
            'booking_members.last_name_member',
            'booking_members.age_member',
            'booking_members.document_member'
        )
            ->join('bookings', 'booking_members.booking_id', '=', 'bookings.id')
            ->where('booking_members.booking_id', '=', $book->id)
            ->get();

        $booking_product = Product::select(
            'detail_product_bills.name_product',
            'detail_product_bills.price',
            'detail_product_bills.amount_product',
        )

            ->join('detail_product_bills', 'products.id', '=', 'detail_product_bills.products_id')
            ->join('product_bills', 'detail_product_bills.product_bills_id', '=', 'product_bills.id')
            //->join('detail_product_bills', 'product_bills.id', '=', 'detail_product_bills.product_bills_id')
            ->join('detail_booking', 'product_bills.id', '=', 'detail_booking.product_bills_id')
            ->where('detail_booking.booking_id', '=', $book->id)
            ->get();

        $suma_product = DB::table('product_bills')
            ->join('detail_booking', 'product_bills.id', '=', 'detail_booking.product_bills_id')
            ->where('detail_booking.booking_id', '=', $book->id)
            ->sum('product_bills.total');

        $total_booking = Bookings::select('total')
            ->where('id', '=', $book->id)
            ->get();
        $total_booking = $total_booking[0]->total;

        return view('modules.bookings.detail', compact('booking', 'booking_product', 'booking_members', 'suma_product', 'total_booking'));
    }
    public function update(Request $request, $id)
    {
        $bookings = Bookings::find($id);
        $validatedData = $request->validate([
            'pay_status' => 'required|string|max:12'
        ]);
        $bookings->pay_status = $request->input('pay_status');
        $bookings->save();
        return redirect()->route('bookings.index')->with('update', 'ok');
    }
    public function destroy($id)
    {
        $booking = Bookings::findOrFail($id);
        if ($booking->state_record == 'ACTIVAR') {
            $booking->state_record = 'DESACTIVAR';
        } else {
            $booking->state_record = 'ACTIVAR';
        }
        $booking->save();
        return redirect()->route('bookings.index')->with('destroy', 'ok');;
    }

    public function billsviews(){

        return view('customers.bills.billsviews');
      }


      public function billsGetDates( $idBook )
      {

          $id = $idBook;

            $booking = Bookings::select(
                'bookings.id',
                'bookings.final_date',
                'bookings.initial_date',
                'bookings.booking_code',
                'bookings.pay_status',
                'bookings.create_time',
                'bookings.update_time',
                'bookings.state_record',
                'payment_methods.title_payment',
                'detail_service_bills.tittle',
                'users.name',
                'users.last_name',
                'users.phone_number',
                'users.email',
                'users.identification_number',
                'detail_service_bills.amount_adults',
                'detail_service_bills.amount_child',
                'service_bills.total'
            )
                ->join('users', 'bookings.users_id', '=', 'users.id')
                ->join('payment_methods', 'bookings.payment_methods_id', '=', 'payment_methods.id')
                ->join('detail_booking', 'bookings.id', '=', 'detail_booking.booking_id')
                ->join('service_bills', 'detail_booking.service_bills_id', '=', 'service_bills.id')
                ->join('detail_service_bills', 'service_bills.id', '=', 'detail_service_bills.service_bills_id')
                //->join('detail_services', 'service_bills.detail_services_id', '=', 'detail_services.id')
                ->where('bookings.id', '=', $id)
                ->first();

            $booking_members = Booking_members::select(
                'booking_members.first_name_member',
                'booking_members.last_name_member',
                'booking_members.age_member',
                'booking_members.document_member'
            )
                ->join('bookings', 'booking_members.booking_id', '=', 'bookings.id')
                ->where('booking_members.booking_id', '=', $id)
                ->get();

            $booking_product = Product::select(
                'detail_product_bills.name_product',
                'detail_product_bills.price',
                'detail_product_bills.amount_product',
            )

                ->join('detail_product_bills', 'products.id', '=', 'detail_product_bills.products_id')
                ->join('product_bills', 'detail_product_bills.product_bills_id', '=', 'product_bills.id')
                //->join('detail_product_bills', 'product_bills.id', '=', 'detail_product_bills.product_bills_id')
                ->join('detail_booking', 'product_bills.id', '=', 'detail_booking.product_bills_id')
                ->where('detail_booking.booking_id', '=', $id)
                ->get();

            $suma_product = DB::table('product_bills')
                ->join('detail_booking', 'product_bills.id', '=', 'detail_booking.product_bills_id')
                ->where('detail_booking.booking_id', '=', $id)
                ->sum('product_bills.total');

            $total_booking = Bookings::select('total')
                ->where('id', '=', $id)
                ->get();
            $total_booking = $total_booking[0]->total;



          return view('customers.bills.billsviews', compact('booking', 'booking_product', 'booking_members', 'suma_product', 'total_booking'));

      }


}
