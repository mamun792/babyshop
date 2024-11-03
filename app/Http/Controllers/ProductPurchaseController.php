<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemsPurchaseStoreRequest;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdateProductPurchaseRequest;
use App\Models\ItemPurchase;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Traits\ImageManipulation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\select;

class ProductPurchaseController extends Controller
{
    use ImageManipulation;
    public function index()
    {
      

     $purchases =   Purchase::join('suppliers', 'suppliers.id', 'purchases.supplier_id')
     ->select('purchases.*', 'supplier_name as supplier_name', 'suppliers.company_name', 'suppliers.company_phone', 'suppliers.company_address')
     ->orderBy('purchases.id', 'desc')
           
            ->get();

      
        return view('web.dashboard.purchase.index', compact('purchases'));
    }

    public function create()
    {
        $supplier = Supplier::all();

        return view('web.dashboard.purchase.create', compact('supplier'));
    }


    // StorePurchaseRequest
    public function store(StorePurchaseRequest $request)
    {
       
          //return $request->all();
        $request->validated();
        $documentPath = null;
        // document
        if ($request->hasFile('document')) {

            $file = $request->file('document');

            $destinationPath = '/documents';

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path($destinationPath), $fileName);

            $documentPath = $destinationPath . '/' . $fileName;
        }

        // $invoice_number =   $invoice_number = "INV-" . $request->input('invoice_number');


        $purcha  = Purchase::create([
            'purchase_name' => $request->input('purchase_name'),
            'purchase_date' => $request->input('purchase_date'),
            'invoice_number' => $request->input('invoice_number'),
            'supplier_id' => $request->input('supplier_id'),
            'document' => $documentPath,
            'comment' => $request->input('comment'),
        ]);



        toastr()->success('Purchase record added.');
        return redirect()->route('dashboard.product-purchase.addPurchaseItems',  ['purchase' => $purcha->id, 'stored' => '1']);



    }


    public function edit($id)
    {
        $purchase = ProductPurchase::findOrFail($id);

        if (!$purchase) {
            abort(404, 'Product Purchase not found');
        }
        $suppliers = Supplier::all();


        return view('web.dashboard.purchase.edit', compact('purchase', 'suppliers'));
    }

    public function update(UpdateProductPurchaseRequest $request, Purchase $purchase)
    {

        $purchase->update([
            'purchase_name' => $request->input('purchase_name'),
            'purchase_date' => $request->input('purchase_date'),
            'invoice_number' => $request->input('invoice_number'),
            'supplier_id' => $request->input('supplier_id'),
            'comment' => $request->input('comment'),
        ]);



        // Handle the document upload
        if ($request->hasFile('document')) {
            // Delete old document if it exists

            if ($purchase->document) {
                $oldDocumentPath = public_path($purchase->document);
                if (File::exists($oldDocumentPath)) {
                    File::delete($oldDocumentPath);
                }
            }

            // Store the new document
            $file = $request->file('document');
            $destinationPath = '/documents';
            $fileName = time() . '_' . $file->getClientOriginalName();

            if ($file->move(public_path($destinationPath), $fileName)) {
                $documentPath = $destinationPath . '/' . $fileName;
                $purchase->update([

                    'document' =>  $documentPath
                ]);
            }
        }


        toastr()->success('Product purchase updated successfully');

        return back();
    }

    public function destroy($id)
    {
        $purchase = ProductPurchase::findOrFail($id);

        $purchase->delete();

        toastr()->success('Product purchase deleted successfully');
        return back();
    }



    public function addProductToPurchase(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'product_code' => ['unique:product_purchases'], // Use an array for multiple rules
            'quantity' => 'required',
            'price' => 'required',
            'total_price' => 'required',
        ]);


        //  optional user type product code othewise generate random product code unique time base
        $product_code = $request->product_code ?? 'PV-' . time() . '-' . mt_rand(100000, 999999);

        $purchase = Purchase::findOrFail($request->purchase_id);



        ProductPurchase::create([


            'purchase_name' => $request->name,
            'purchase_id' => $purchase->id,
            'purchase_date' => $purchase->purchase_date,
            'invoice_number' => $purchase->invoice_number,
            'supplier_id' => $purchase->supplier_id,
            'product_code' => $product_code,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total_price' => $request->total_price,
            'comment' => $purchase->comment,
            'created_at' => Carbon::now(),
        ]);

        toastr()->success('Product added to purchase successfully');

        return response()->json(['success' => true, 'message' => 'Product added successfully']);
       
    }


    function items_purchase($purchase)
    {

        $supplier = Supplier::all();
       $products = Product::where('purchase_id', $purchase)->get();
    


         $data = Supplier::join('purchases', 'suppliers.id', 'purchases.supplier_id')->where('purchases.id', $purchase)->first();

    
        return view('web.dashboard.purchase.purchase_items', compact('data', 'products', 'purchase', 'supplier'));
    }
    function purchaseUpdate(Request $request, Purchase $purchase)
    {
        // $products = ItemPurchase::where('purchase_id', $purchase)->get();
        return $products = Product::where('purchase_id', $purchase)->get();
        $data =  Purchase::join('suppliers', 'suppliers.id', 'purchases.supplier_id')->where('purchases.id', $purchase)->first();
        toastr()->success('Product added to purchase successfully');
        return view('web.dashboard.purchase.purchase_items', compact('data', 'products', 'purchase'));
    }

   

    public function items_purchase_store(StoreItemsPurchaseStoreRequest $request)
{
    
    $supplier = Purchase::find($request->purchase_id);
    

    if (!$supplier) {
        toastr()->error('Purchase not found!');
        return back();
    }

    $supplier_id = $supplier->supplier_id;

   
    $existingProduct = Product::where('product_code', $request->product_code)->first();

    if ($existingProduct) {

        toastr()->error('Product with the same product code already exists');
        return back();
    }

   
    Product::create([
        'name' => $request->product_name,
        'product_code' => $request->product_code,
        'purchase_quantity' => $request->quantity,
        'purchase_price' => $request->price,
        'purchase_id' => $request->purchase_id,
        'purchase_total_price' => $request->total_price,
        'supplier_id' => $supplier_id,
    ]);

    toastr()->success('Product added to purchase successfully');
    return back();
}



    function updateItemsPurchase(Request $request, Product $item)
    {


        $data =   [
            'name' => $request->product_name,
            'product_code' => $request->product_code,
            'purchase_quantity' => $request->quantity,
            'purchase_price' => $request->price,
            'purchase_total_price' => $request->total_price,
        ];

        $item->update($data);
        toastr()->success('Product purchase updated successfully');
        return back();
    }

    function deleteItemsPurchase(Product $item)
    {




        if ($item->featured_image) {
            $this->deleteImage($item->featured_image);
        }
        if ($item->gallery_image_one) {
            $this->deleteImage($item->gallery_image_one);
        }
        if ($item->gallery_image_two) {
            $this->deleteImage($item->gallery_image_two);
        }
        if ($item->gallery_image_three) {
            $this->deleteImage($item->gallery_image_three);
        }




        $item->delete();
        return back();
    }
}
