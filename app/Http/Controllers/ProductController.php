<?php

namespace App\Http\Controllers;

use App\Model\IncomingInvoice;
use App\Model\IncomingPaymentOrder;
use Illuminate\Http\Request;
use App\Model\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Product::all();
        $products ['products'] = $items->toArray();

        return view('product', $products);
    }

    /**
     * Сохранение информации при добавлении или редактировании товара
     */
    public function setProduct(Request $request)
    {
        $id = $request->product_id;
        $name = $request->product_name;
        $quantity = $request->product_quantity;
        $price = $request->product_price;

        if($id) {
            $product = Product::find($id);
            $product->name = $name;
            $product->quantity = $quantity;
            $product->price = $price;
        } else {
            $product = new Product();

            $product->name = $name;
            $product->quantity = $quantity;
            $product->price = $price;
        }
//        dump($product->name);
        $product->save();

        $products = $this->getAllProducts();

        return $products;

    }

    /**
     * Получение данных по конкретному продукту
     */
    public function getProduct(Request $request)
    {
        $id = $request->id;

        $productInfo = Product::find($id);
        $product = $productInfo->toArray();

        return $product;
    }

    /**
     * Удаление продукта
     */
    public function delProduct(Request $request)
    {
        $id = $request->id;

        if(Product::destroy($id)) {
            return $this->getAllProducts();
        }
    }

    /**
     * Получение списка всех товаров
     *
     * @return array
     */
    public function getAllProducts()
    {
        $items = Product::all();
        $products = $items->toArray();

//        dump($products);
        return $products;
    }

    /**
     * Добавление товара в приходную накладную
     */
    public function addProductIncoming(Request $request)
    {
        $product_id = $request->product_id;
        // номер накладной
        $order_id = $request->order_id;
        $counterparty_id = $request->counterparty_id;
        $incoming_payment_order_quantity = $request->incoming_payment_order_quantity;
        $incoming_payment_order_summa = $request->incoming_payment_order_summa;

        $product = Product::find($product_id);
        $name = $product->name;
        $price = $product->price;
        $quantity = 1;

        if($order_id) {
            $order = IncomingPaymentOrder::find($order_id);
            $invoice = $order->relationInvoiceIncoming;
            if(empty($items = $invoice->where('product_id', $product_id))) {
                foreach ($items as $item) {
                    $item->relationProduct;
                    $item->quantity++;
                    $item->save();
                }
            } else {
                dump('Товара нет в инвойсе!');
            }
            foreach ($invoice as $item) {
                $item->relationProduct;
            }
            return $order->relationInvoiceIncoming;

        } else {
            $order = new IncomingPaymentOrder();
            $order->counterparty_id = $counterparty_id;
            $order->quantity = $incoming_payment_order_quantity;
            $order->price = $incoming_payment_order_summa;
        }
        $order->save();

//        $invoice = IncomingInvoice::all()->where('incoming_payment_order_id', $order_id);
//        dump($invoice);


    }
}
