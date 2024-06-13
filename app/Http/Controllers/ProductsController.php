<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use DateTime;
use Illuminate\Support\Facades\Cache;

class productsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all();
        return view('modules.products.index')->with('products', $products);
    }

    public function create()
    {
        $products = Product::all();
        return view('modules.products.create')->with('products', $products);
    }

    public function store(Request $request)
    {
        $products = new Product();
        $products->name_product = $request->name_product;
        $products->decripcion = $request->decripcion;
        $products->price = $request->price;

        $fecha = new DateTime();

        if (isset($_FILES['picture']) && ($_FILES['picture']['name'] != null)) {
            $fecha = new DateTime();
            $Types = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp');

            $picture = $fecha->getTimestamp() . "_" .  $_FILES['picture']['name']; //subir la imagen con tiempo diferente, para diferenciar el mismo nombre pero hora diferente
            $imagen_temporal = $_FILES['picture']['tmp_name'];
            $validation = $_FILES['picture']['type'];

            if (in_array($validation, $Types)) {
                move_uploaded_file($imagen_temporal, "storage/imgProducts/" . $picture); //mover la imagen y guardarla en una carpeta

                $products->picture = $picture;
                $products->save();
                return redirect(route('products.index'))->with('save', 'ok');
            } else {
                return redirect()->back()->with('error', 'ok');
            }
        }
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('modules.products.edit', compact('products'));
    }

    public function show($id)
    {
        $products = Product::findOrFail($id);
        return view('modules.products.show', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $products = Product::findOrFail($id);
        $products->name_product = $request->name_product;
        $products->decripcion = $request->decripcion;
        $products->price = $request->price;


        $rutaArchivo = public_path('storage/imgProducts/') . '/' . $products->picture;


        if (isset($_FILES['picture']) && ($_FILES['picture']['name'] != null)) {
            $fecha = new DateTime();
            $Types = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp');

            $picture = $fecha->getTimestamp() . "_" .  $_FILES['picture']['name']; //subir la imagen con tiempo diferente, para diferenciar el mismo nombre pero hora diferente
            $imagen_temporal = $_FILES['picture']['tmp_name'];
            $validation = $_FILES['picture']['type'];

            if (in_array($validation, $Types)) {
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
                move_uploaded_file($imagen_temporal, "storage/imgProducts/" . $picture);

                $products->picture = $picture;
                $products->save();
                return redirect(route('products.index'))->with('update', 'ok');
            } else {
                $products->picture = $request->pictureOld;
                $products->update();
                return redirect()->back()->with('error', 'ok');
            }
        } else if (isset($_FILES['picture']) && ($_FILES['picture']['name'] == null)) {
            $products->picture = $request->pictureOld;
            $products->update();
            return redirect(route('products.index'))->with('update', 'ok');
        }
    }

    public function disableProducts($id)
    {
        $products = Product::findOrFail($id);

        if ($products->state_record = 'ACTIVAR') {
            $products->state_record = 'DESACTIVAR';
        } else {
            $products->state_record = 'ACTIVAR';
        }

        $products->save();

        return redirect()->back();
    }

    public function activeProducts($id)
    {
        $products = Product::findOrFail($id);

        if ($products->state_record = 'DESACTIVAR') {
            $products->state_record = 'ACTIVAR';
        } else {
            $products->state_record = 'DESACTIVAR';
        }

        $products->save();

        return redirect()->back();
    }

    public function productsviews()
    {
        $products = Product::where('state_record', 'ACTIVAR')->get();
        return view('customers.products.productsviews')->with('products', $products);
    }

    public function showviews($id)
    {
        $products = Product::findOrFail($id);
        return view('customers.products.showviews', compact('products'));
    }

    public function productDetails($id)
    {
        $user = auth()->user();
        $products = Product::findOrFail($id);
        $key = 'product' . $user?->id . $products?->id;
        $product = Cache::get($key);
        $result = $product === null ? false : true;
        return view('customers.products.showviews', compact('result', 'products'));
    }
}
