<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignProductRequest;
use App\Http\Requests\CampaignStoreRequest;
use App\Http\Requests\UpdateProductCampaignRequest;
use App\Models\Campaign;
use App\Models\Product;
use App\Models\ProductCampaign;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function index()
    {

        return view('web.dashboard.campaign.addCam');
    }

    public function allCampaigns()
    {
        $campaigns = Campaign::latest()->get();

        return view('web.dashboard.campaign.allCampaigns', compact('campaigns'));
    }


    public function editproductcampain($id)
    {
       
        $campaign = Campaign::findOrFail($id);

    
     $productCampaign = ProductCampaign::where('campaign_id', $id)->first();


   
      $availableProducts = Product::all();

    
    $allCampaigns = Campaign::all();

    return view('web.dashboard.campaign.edit', [
        'campaign' => $campaign,
        'productCampaign' => $productCampaign, 
        'availableProducts' => $availableProducts,
        'allCampaigns' => $allCampaigns,
    ]);
    }

    public function store(CampaignStoreRequest $request)
    {

        $validated = $request->validated();
        $code = $validated['code'] ??  $this->generateUniqueCode();

        Campaign::create([
            'name' => $validated['name'],
            'start_date' => $validated['start_date'],
            'expiry_date' => $validated['expiry_date'],
            'discount' => $validated['discount'],
            'code' => $code,
        ]);

        toastr()->success('Campaign created successfully');
        return redirect()->route('dashboard.campaign.all');
    }

    private function generateUniqueCode()
    {
        $prefix = 'CPN-';
        $codeLength = 10;
        $uniquePart = strtoupper(substr(uniqid(), -$codeLength));
        $code = $prefix . $uniquePart;

        // Check for uniqueness
        while (Campaign::where('code', $code)->exists()) {
            $uniquePart = strtoupper(substr(uniqid(), -$codeLength));
            $code = $prefix . $uniquePart;
        }

        return $code;
    }

    public function update(CampaignStoreRequest $request, $id)
    {
       
      $validated = $request->validated();
        
        $productCampaign = Campaign::findOrFail($id);
        $productCampaign->update($request->except('_token'));


        toastr()->success('Campaign updated successfully');
     
        return back();
    }

    public function destroy($id)
    {


        $productCampaign = Campaign::findOrFail($id);

        $productCampaign->delete();


        toastr()->success('Campaign deleted successfully');
        return back();
    }

    public function  addCampaigns()
    {

        $products = Product::whereNotNull('products.name')->get();
        $campaigns = Campaign::all();
        $productCampaigns = DB::table('product_campaigns')
            ->leftJoin('products', 'product_campaigns.product_id', '=', 'products.id')
            ->leftJoin('campaigns', 'product_campaigns.campaign_id', '=', 'campaigns.id')
         
            ->select(
                'product_campaigns.*',
                'products.name as product_name',
                'campaigns.name as campaign_name'
            )
            ->get();
          


        return view('web.dashboard.campaign.addcampaign', compact('products', 'campaigns', 'productCampaigns'));
    }

    public function productCodeEdit($id)
    {
      //return $id;
      $campaigns = Campaign::find($id);
        return view('web.dashboard.campaign.edit_campaign', compact('campaigns'));
    }

    public function storeProduct(CampaignProductRequest $request)
    {


        $validated = $request->validated();

        // alredy exist check  valid d
        // $productCampaign = ProductCampaign::where('product_id', $validated['product_id'])->first();
        // if ($productCampaign) {
        //     toastr()->error('Product already added to campaign');
        //     return back();
        // }

        ProductCampaign::create($validated);



        toastr()->success('Product added to campaign successfully');
        return back();
    }

    public function productCodeUpdate(CampaignProductRequest $request, $id)
    {
        
        $validated = $request->validated();

        $validated = $request->validated();

        $productCampaign = ProductCampaign::findOrFail($id);
        $productCampaign->update($validated);

        

        toastr()->success('Product code updated successfully');
        return back();
    }

    public function deleteProductCode($id)
    {
        //return $id;
       $productCampaign = ProductCampaign::findOrFail($id);
       $productCampaign->delete();
        
     

        toastr()->success('Product code deleted successfully');
        return back();
    }
}
