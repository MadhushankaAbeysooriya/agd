@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">

                <div class="col-sm-6 mb-4">
                    <h1>Dashboard</h1>
                </div>

                <div>
                  <div class="container-fluid p-0">

                    @php
                    
                        $counterPendingop = 0;
                        $counterPendingoc = 0;
                        $counterPendingco = 0;
                        $counterCompleted = 0;
                        $counterCompletedco = 0;
                        $counterRejected = 0;
                        $counterRejectedco = 0;
                        // dte of s&t 
                        $counterPendingst = 0;
                        $counterCompletedst = 0;
                        $counterRejectedst = 0;

                    @endphp

                    @foreach ($demandFromLocations as $demandFromLocation)
                        
                        @if (($demandFromLocation->status == '0' && $demandFromLocation->location_id == Auth::user()->location_id) || ($demandFromLocation->status == '1' && $demandFromLocation->location_id == Auth::user()->location_id))
                            @php
                                $counterPendingop++;
                            @endphp                                    
                        @endif

                        @if ($demandFromLocation->status == '1' && $demandFromLocation->location_id == Auth::user()->location_id)
                            @php
                                $counterPendingoc++;
                            @endphp                                    
                        @endif

                        @if ($demandFromLocation->status == '2' && $demandFromLocation->location_id == Auth::user()->location_id)
                            @php
                                $counterPendingco++;
                            @endphp                                    
                        @endif

                        @if (($demandFromLocation->status == '4' && $demandFromLocation->location_id == Auth::user()->location_id) || ($demandFromLocation->status == '2' && $demandFromLocation->location_id == Auth::user()->location_id))
                            @php
                                $counterCompleted++;
                            @endphp                                    
                        @endif

                        @if ($demandFromLocation->status == '4' && $demandFromLocation->location_id == Auth::user()->location_id)
                            @php
                                $counterCompletedco++;
                            @endphp                                    
                        @endif

                        @if (($demandFromLocation->status == '3' && $demandFromLocation->location_id == Auth::user()->location_id) || ($demandFromLocation->status == '5' && $demandFromLocation->location_id == Auth::user()->location_id))
                            @php
                                $counterRejected++;
                            @endphp                                    
                        @endif

                        @if ($demandFromLocation->status == '5' && $demandFromLocation->location_id == Auth::user()->location_id)
                            @php
                                $counterRejectedco++;
                            @endphp                                    
                        @endif

                        @if ($demandFromLocation->status == '0' || $demandFromLocation->status == '1')
                            @php
                                $counterPendingst++;
                            @endphp                                    
                        @endif

                        @if ($demandFromLocation->status == '2' || $demandFromLocation->status == '4')
                            @php
                                $counterCompletedst++;
                            @endphp                                    
                        @endif

                        @if ($demandFromLocation->status == '3' || $demandFromLocation->status == '5')
                            @php
                                $counterRejectedst++;
                            @endphp                                    
                        @endif

                    @endforeach
              
                        <div class="row dashboard_boxes">

                            {{-- Dte of S&T --}}
                            @if (Auth::user()->can('demand-from-location-list'))
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $counterPendingst }}</h3>
                                        <p>Pending Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shipping-fast"></i>
                                        
                                    </div>
                                    <a href="{{ route('demand_from_locations.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ $counterCompletedst }}</h3>
                                        <p>Completed Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-list-alt"></i>
                                        
                                    </div>
                                    <a href="{{ route('demand_from_locations.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-danger">
                                    <div class="inner">
                                            <h3>{{ $counterRejectedst }}</h3>
                                        <p>Rejected Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-thumbs-down"></i>
                                    </div>
                                    <a href="{{ route('demand_from_locations.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                            @endif
                            
                            {{-- Cleck --}}
                            @if (Auth::user()->can('demand-from-location-op-pending'))
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $counterPendingop }}</h3>
                                        <p>Pending Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shipping-fast"></i>
                                        
                                    </div>
                                    <a href="{{ route('demand_from_locations.pendingtoop') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>  
                            @endif

                            @if (Auth::user()->can('demand-from-location-op-completed'))
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ $counterCompleted }}</h3>
                                        <p>Completed Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-list-alt"></i>
                                        
                                    </div>
                                    <a href="{{ route('demand_from_locations.completedop') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            @endif

                            @if (Auth::user()->can('demand-from-location-op-rejected'))
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-danger">
                                    <div class="inner">
                                            <h3>{{ $counterRejected }}</h3>
                                        <p>Rejected Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-thumbs-down"></i>
                                    </div>
                                    <a href="{{ route('demand_from_locations.rejectedop') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            @endif
                          
                      
                            {{-- Officer Commanding --}}
                            @if (Auth::user()->can('demand-from-location-oc-pending'))
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $counterPendingoc }}</h3>
                                        <p>Pending Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shipping-fast"></i>
                                        
                                    </div>
                                    <a href="{{ route('demand_from_locations.pendingtooc') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>  
                            @endif

                            @if (Auth::user()->can('demand-from-location-oc-fwd'))
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ $counterCompleted }}</h3>
                                        <p>Completed Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-list-alt"></i>
                                        
                                    </div>
                                    <a href="{{ route('demand_from_locations.completedbyoc') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            @endif

                            @if (Auth::user()->can('demand-from-location-oc-rejected'))
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-danger">
                                    <div class="inner">
                                            <h3>{{ $counterRejected }}</h3>
                                        <p>Rejected Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-thumbs-down"></i>
                                    </div>
                                    <a href="{{ route('demand_from_locations.rejectedbyoc') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            @endif                          

                            {{-- Commanding Officer --}}
                            @if (Auth::user()->can('demand-from-location-co-pending'))
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $counterPendingco }}</h3>
                                        <p>Pending Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shipping-fast"></i>
                                        
                                    </div>
                                    <a href="{{ route('demand_from_locations.pendingtoco') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>  
                            @endif

                            @if (Auth::user()->can('demand-from-location-co-appd'))
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ $counterCompleted }}</h3>
                                        <p>Completed Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-list-alt"></i>
                                        
                                    </div>
                                    <a href="{{ route('demand_from_locations.completedbyco') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            @endif

                            @if (Auth::user()->can('demand-from-location-co-rejected'))
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-danger">
                                    <div class="inner">
                                            <h3>{{ $counterRejectedco }}</h3>
                                        <p>Rejected Demands</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-thumbs-down"></i>
                                    </div>
                                    <a href="{{ route('demand_from_locations.rejectedbyco') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            @endif

                      </div>

                      <div class="row">
                        <div class="col-md-6">
                            <!-- Line chart -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-chart-bar"></i>
                                    Line Chart
                                </h3>
                
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                </div>
                                <div class="card-body">
                                <div id="line-chart" style="height: 300px;"></div>
                                </div>
                                <!-- /.card-body-->
                            </div>
                            <!-- /.card -->
                        </div>
                      </div>
                         
                  </div>                      
            
              </div>
        </section>
      </div>
               
@endsection

@push('page_scripts')

<!-- FLOT CHARTS -->
<script src="{{ asset('plugins/flot/jquery.flot.js') }}"></script>
    <script>

    $(function () {
        /*
     * LINE CHART
     * ----------
     */
    //LINE randomly generated data

    var sin = [],
        cos = []
    for (var i = 0; i < 14; i += 0.5) {
      sin.push([i, Math.sin(i)])
      cos.push([i, Math.cos(i)])
    }
    var line_data1 = {
      data : sin,
      color: '#3c8dbc'
    }
    var line_data2 = {
      data : cos,
      color: '#00c0ef'
    }
    $.plot('#line-chart', [line_data1, line_data2], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2)

        $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })
    /* END LINE CHART */
    });

    </script>

@endpush

