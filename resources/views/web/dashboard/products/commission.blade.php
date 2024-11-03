<div>
    @extends('web.dashboard.app', ['page' => 'All Products'])
    @section('css')
        @livewireStyles
    @endsection

    @section('content')
       <livewire:backend.products.commission>
    @endsection

    @section('js')
        @livewireScripts
    @endsection
</div>
