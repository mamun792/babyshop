<div>
    @extends('web.dashboard.app', ['page' => 'Withdraw requests'])
    @section('css')
        @livewireStyles
    @endsection

    @section('content')
       <livewire:backend.affiliate.withdraws>
    @endsection

    @section('js')
        @livewireScripts
    @endsection
</div>