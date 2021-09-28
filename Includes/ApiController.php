<?php

namespace Includes;


class ApiController
{
    public static function index()
    {
        $cart = getResult();
        $subTotal = $cart['CartPrice'] + $cart['CartVat'];
        $invoice = array([
            "ItemType: " . $cart['ProductName'],
            "Country: " . $cart['ShippingCountry'],
            "ItemPrice: $" . $cart['CartPrice'],
            "Subtotal: $" . $subTotal,
            "Shipping: $" . $cart['ShippingPrice'],
            "Rate: $" . $cart['rate_price'],
            "VAT: $" . $cart['CartVat'],
            "Total: $" . $cart['CartTotal'],
        ]);

        echo json_encode($invoice);
    }

    public static function store()
    {
        $vat = 14;
        $gram = 1000;
        $names = $_POST['product'];

        $str_arr = explode(",", $names);

        /* Some Queries For Helping To Debug
         * $get_single = $product->GeTable("products", 'Item_type', '"' . $name . '"');
         * * $get_all = $product->GeTable("products");
         * * */

        $model = new FactoryDB();


        foreach ($str_arr as $k => $v) {
            $relation = $model->relationTable("products", "shipping_rates", "shipping_rates.id as rate_ID,
            shipping_rates.country as rate_country,shipping_rates.rate as rate_price,products.id as Product_id,products.Item_price as ProductPrice,
            products.weight as Product_weight,products.Item_type as Product_name",
                'id', 'shipping_rates_id', 'products.Item_type', '"' . $v . '"');

            /*Calculate Shipping method by MULTIPLICATION weight * kilogram transform value * rate_price division 100  */
            $shipping = $relation['Product_weight'] * $gram * $relation['rate_price'] / 100;
            /*Calculate Vat method by MULTIPLICATION Item_price * define vat value division 100  */
            $vat = $relation['ProductPrice'] * $vat / 100;
            /*Calculate Total method by Plus Item_price + ShippingValue + VAT */
            $total = $relation['ProductPrice'] + $shipping + $vat;
            /*Calculate Total method by Plus Item_price +  VAT */
            $subTotal = $relation['ProductPrice'] + $vat;
            $array = array(
                "product_id" => $relation['Product_id'],
                "rate_id" => $relation['rate_ID'],
                "vat" => $vat,
                "shipping" => $shipping,
                "discount" => 0,
                "price" => $relation['ProductPrice'],
                "total" => $total,
            );
            $model->insertInto("cart", $array);
        }

        $invoice = array([
            "ItemType: " . $relation['Product_name'],
            "Country: " . $relation['rate_country'],
            "ItemPrice: $" . $relation['ProductPrice'],
            "Subtotal: $" . $subTotal,
            "Shipping: $" . $shipping,
            "Rate: $" . $relation['rate_price'],
            "VAT: $" . $vat,
            "Total: $" . $total,
        ]);

        if ($invoice) {
            echo json_encode(["success" => true, "items" => $invoice]);

        } else {
            echo json_encode(["success" => false]);
        }

    }
}
