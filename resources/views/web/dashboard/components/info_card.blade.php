 <div class="col-xxl-9">
   
    <div class="row row-cols-xxxl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
       

        <div class="col">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center  gap-3">
                        <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Pending Order</p>
                            <h6 class="mb-0">{{ $orderStatistics['totalPendingOrder'] }}</h6>
                        </div>
                       
                        <div id="new-pending-chart" class="remove-tooltip-title rounded-tooltip-value"></div>

                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 {{ $orderStatistics['totalPendingOrder'] > $orderStatistics['totalPendingOrdersPreviousMonth'] ? 'text-success-main' : 'text-danger-main' }}">
                            <iconify-icon icon="{{ $orderStatistics['totalPendingOrder'] > $orderStatistics['totalPendingOrdersPreviousMonth'] ? 'bxs:up-arrow' : 'bxs:down-arrow' }}" class="text-xs"></iconify-icon>
                            {{ $orderStatistics['totalPendingOrder'] - $orderStatistics['totalPendingOrdersPreviousMonth'] }}
                        </span>
                        Last 30 days subscription
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                        <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Delivered Order</p>
                            <h6 class="mb-0">{{ $orderStatistics['deliveredOrders'] }}</h6>
                        </div>
                       
                    <div id="monthly-deleviry-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 {{ $orderStatistics['deliveredOrders'] > $orderStatistics['totalOrdersDeliverePreviousMonth'] ? 'text-success-main' : 'text-danger-main' }}">
                            <iconify-icon icon="{{ $orderStatistics['deliveredOrders'] > $orderStatistics['totalOrdersDeliverePreviousMonth'] ? 'bxs:up-arrow' : 'bxs:down-arrow' }}" class="text-xs"></iconify-icon>
                            {{ $orderStatistics['deliveredOrders'] - $orderStatistics['totalOrdersDeliverePreviousMonth'] }}
                        </span>
                        Last 30 days users
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                        <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Returned Order</p>
                            <h6 class="mb-0">{{ $orderStatistics['returnedOrders'] }}</h6>
                        </div>
                       
                        <div id="total-return-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 {{ $orderStatistics['returnedOrders'] > $orderStatistics['totalOrdersReturnedPreviousMonth'] ? 'text-success-main' : 'text-danger-main' }}">
                            <iconify-icon icon="{{ $orderStatistics['returnedOrders'] > $orderStatistics['totalOrdersReturnedPreviousMonth'] ? 'bxs:up-arrow' : 'bxs:down-arrow' }}" class="text-xs"></iconify-icon>
                            {{ $orderStatistics['returnedOrders'] - $orderStatistics['totalOrdersReturnedPreviousMonth'] }}
                        </span>
                        Last 30 days subscription
                    </p>
                </div>
            </div>
        </div>
        



       
        
     

        <div class="col">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                        <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Sale</p>
                            <h6 class="mb-0">
                                {{ number_format($data['overall']['total_sales'] ?? 0) }}
                               
                            </h6>
                        </div>
                       
                        <div id="total-sal-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> 
                            {{$last30daysTotalSalesDeliveredOrders ?? 0 }}
                        </span>
                        Last 30 days delivered orders
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-4 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
                        <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa6-solid:file-invoice-dollar" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Return Amount</p>
                           
                            <h6 class="mb-0">
                                {{  $data['total']['returned'] ?? '0'}}
                            </h6>
                        </div>
                       <div  id="total-return-sales-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main">
                            <iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> 
                            {{$last30daysReturn ?? 0 }}
                        </span>
                        Last 30 days returned orders
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        

        <div class="col">
            <div class="card shadow-none border bg-gradient-start-4 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Cancel Amount</p>
                            <h6 class="mb-0">
                                <!-- Check if the cancel amount exists and is not empty, else show default value -->
                              
                                {{ $data['total']['cancel'] ?? '0' }}
                            </h6>
                        </div>
                        <div id="total-cancel-sales-chart" class="remove-tooltip-title rounded-tooltip-value"></div>

                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> 
                            {{$last30daysCancel ?? 0 }}
                        </span>
                        Last 30 days cancelled orders
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        
        
      

    </div>


</div>
{{-- </div> --}}