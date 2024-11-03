{{-- <div class="col-xxl-12">
    <div class="row row-cols-4 gy-4">
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Active Orders</p>
                            <h6 class="mb-0">{{ $statistics['activeOrders'] ?? 0 }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main">
                            <iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon>
                            {{ $statistics['last30DaysOrders'] ?? 0 }}
                        </span>
                        Last 30 days subscription
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Pending Orders</p>
                            <h6 class="mb-0">{{ $statistics['pendingOrders'] ?? 0 }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fluent:people-20-filled"
                                class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                            {{ $statistics['last30DaysPendingUsers'] ?? 0 }}
                        </span>
                        Last 30 days users
                    </p>
                </div>
            </div>
        </div>

        <!-- Repeat similar blocks for other statistics -->

        <div class="col">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Subscription</p>
                            <h6 class="mb-0">{{ $statistics['totalUsers'] ?? 0 }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main">
                            <iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon>
                            {{ $statistics['last30DaysUsers'] ?? 0 }}
                        </span>
                        Last 30 days subscription
                    </p>
                </div>
            </div>
        </div>

        <!-- Add other dynamic sections accordingly -->
    </div>
</div> --}}



<div class="col-xxl-12">

    <div class="row row-cols-4 ">
        <div class="col mb-3 ">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <div
                            class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Active Orders</p>
                            <h6 class="mb-0">
                                {{ $statistics['activeOrders'] ?? 0 }}
                            </h6>
                        </div>

                        <div id="actives-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>


                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main"><iconify-icon
                                icon="bxs:down-arrow" class="text-xs"></iconify-icon>
                            {{ $statistics['last30DaysOrders'] ?? 0 }}
                        </span>
                        Last 30 days subscription
                    </p>
                </div>
            </div><!-- card end -->
        </div>


        <div class="col mb-3">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fluent:people-20-filled"
                                class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Pending Orders</p>
                            <h6 class="mb-0">
                                {{ $statistics['pendingOrders'] ?? 0 }}
                            </h6>
                        </div>
                        <div id="new-pending-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main"><iconify-icon
                                icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                            {{ $statistics['last30DaysPendingUsers'] ?? 0 }}
                        </span>
                        Last 30 days users
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col mb-3">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Processing Orders</p>
                            <h6 class="mb-0">

                                {{ $statistics['processingOrders'] ?? 0 }}
                            </h6>
                        </div>

                        <div id="processin-sales-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main"><iconify-icon
                                icon="bxs:down-arrow" class="text-xs"></iconify-icon>
                            {{ $statistics['last30DaysProcessingOrders'] ?? 0 }}
                        </span>
                        Last 30 days subscription
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col mb-3">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fluent:people-20-filled"
                                class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Pending Deliveries</p>
                            <h6 class="mb-0">
                                {{ $statistics['pendingDeliveries'] ?? 0 }}
                            </h6>
                        </div>
                        <div id="pendin-delevery-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        {{-- <div id="total-sales-chart" class="remove-tooltip-title rounded-tooltip-value"></div> --}}

                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main"><iconify-icon
                                icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                            {{ $statistics['last30DaysPendingDeliveriesUsers'] ?? 0 }}
                        </span>
                        Last 30 days users
                    </p>
                </div>
            </div><!-- card end -->
        </div>



        <div class="col mb-3">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Subscription</p>
                            <h6 class="mb-0">
                                {{ $statistics['totalUsers'] ?? 0 }}
                            </h6>
                        </div>
                        <div id="total-user-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main"><iconify-icon
                                icon="bxs:down-arrow" class="text-xs"></iconify-icon>
                            {{ $statistics['last30DaysUsers'] ?? 0 }}
                        </span>
                        Last 30 days subscription
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col mb-3">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">On Delivery</p>
                            <h6 class="mb-0">
                                {{ $statistics['totalDeliveryOrders'] ?? 0 }}
                            </h6>
                        </div>
                        <div id="monthly-deleviry-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        {{-- <div id="total-sales-chart" class="remove-tooltip-title rounded-tooltip-value"></div> --}}
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main"><iconify-icon
                                icon="bxs:down-arrow" class="text-xs"></iconify-icon>
                            {{ $statistics['last30DaysDeliveryOrders'] ?? 0 }}
                        </span>
                        Last 30 days subscription
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col mb-3">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fluent:people-20-filled"
                                class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Returned Orders</p>
                            <h6 class="mb-0">
                                {{ $statistics['totalReturnedOrders'] ?? 0 }}
                            </h6>
                        </div>
                        <div id="total-return-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                        {{-- <div id="total-sales-chart" class="remove-tooltip-title rounded-tooltip-value"></div> --}}
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main"><iconify-icon
                                icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                            {{ $statistics['last30ReturnedOrders'] ?? 0 }}
                        </span>
                        Last 30 days users
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col mb-3">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div
                            class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Canceled Orders</p>
                            <h6 class="mb-0">
                                {{ $statistics['totalCancelledOrders'] ?? 0 }}
                            </h6>
                        </div>
                        <div id="total-cancel-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main"><iconify-icon
                                icon="bxs:down-arrow" class="text-xs"></iconify-icon>
                            {{ $statistics['last30CancelledOrders'] ?? 0 }}
                        </span>
                        Last 30 days subscription
                    </p>
                </div>
            </div><!-- card end -->
        </div>
    </div>


</div>



