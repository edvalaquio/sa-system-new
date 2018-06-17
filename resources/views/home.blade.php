@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 m8 l6">
            <div class="card card-default preview">
                <div class="card-header">
                    <span class="status complete">Complete</span>
                    <a href="#" class="title"><h4>Requires Signature from Dean</h4></a>
                    <div class="additional-details">
                        <span class="type received"><i class="material-icons">inbox</i>&nbsp;Received,&nbsp;</span>
                        <span class="timestamp">December 25, 2018, 9:32 am</span>
                    </div>
                </div>
                <div class="card-body">
                    <p class="particular">Requires Signature from Dean.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.
                    </p>

                    <h6>Attachments:</h6>
                    <ul class="files">
                        <li><i class="material-icons amber-text">attach_file</i>
                        Guidelines_for_Thesis.pdf</li>
                    </ul>

                    <p class="note">
                        This is a note. Users can add these to inform the receiver of the document.
                    </p>

                </div>
                <div class="card-footer">
                    <a href="/transaction/1" class="btn light-blue">View Transaction</a>
                </div>
            </div>
        </div>
        <div class="col s12 m4 l6">
            <div class="fiter">
                <!-- <button class="dropdown-trigger btn-flat" data-target="date-filter"><i class="material-icons">date_range</i></button>   -->
                <ul id="date-filter">
                    <li><a href="#!">TODAY</a></li>
                    <li><a href="#!">YESTERDAY</a></li>
                    <li><input type="text" id="date" name="date" class="datepicker" placeholder="OTHER DATES"></li>
                </ul>
            </div>
            @forelse ($transactions as $transaction)
            <div class="card card-default">
                <div class="card-body">
                    <a href="#" class="title"><h4 class="truncate">{{ $transaction->title }}</h4></a>
                    <p class="particular">{{ $transaction->description }}</p>
                    <section class="additional-details">
                        @if($transaction->receiver_id == Auth::user()->id)
                            <span class="type received"><i class="material-icons">inbox</i>&nbsp;Receive,&nbsp;</span>
                        @else
                            <span class="type received"><i class="material-icons">near_me</i>&nbsp;Sent,&nbsp;</span>
                        @endif
                        <span class="timestamp">{{ date('F d Y', strtotime($transaction->created_at)) }}</span>
                        <span class="status pending">Pending</span>
                    </section>
                </div>
            </div>
            @empty
                No Data
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.datepicker').datepicker()
            $('.dropdown-trigger').dropdown()
        })
    </script>
@endpush
