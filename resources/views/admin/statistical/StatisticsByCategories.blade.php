  @extends('layout.master')
  @push('css')
    <style>
.highcharts-figure,
.highcharts-data-table table {
  min-width: 320px;
  max-width: 660px;
  margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #ebebeb;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}

.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}

.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
  padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}

.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
    </style>
@endpush
@section('content')
     <div class="d-flex">
        <input id="begin" type="date">
        <input id="end" type="date">
        <button id="showchart" class="btn btn-info" type="button">Show Chart</button>
    </div>
  <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<figure class="highcharts-figure">
  <div id="container"></div>
  <p class="highcharts-description">
    Pie chart where the individual slices can be clicked to expose more
    detailed data.
  </p>
</figure>
@endsection
@push('js')
    <script src={{ asset("js/pagination.js")}}></script>
        <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>
<script>
    $('#showchart').click(function(){
        let begin=$('#begin').val()
        let end=$('#end').val()
        showCart(begin,end)
    })
    function showCart(begin,end){
      $.ajax({
                url: "{{route('admin.statistical.bycategories')}}?"+'begin='+begin+'&end='+end,
                type: 'GET',
                success: function(response) {
                    const arrX=Object.values(response[0]) 
                        console.log(response)
                    const arrDetail=[]
                    Object.values(response[1]).forEach(e => {
                        //console.log(e['data'])
                        e['data']=Object.values(e.data)
                        arrDetail.push(e)
                    });
                  //  console.log(arrX)
                   // Create the chart
                        Highcharts.chart('container', {
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: 'Browser market shares. January, 2022'
                        },
                        subtitle: {
                            text: 'Click the slices to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
                        },

                        accessibility: {
                            announceNewData: {
                            enabled: true
                            },
                            point: {
                            valueSuffix: '%'
                            }
                        },

                        plotOptions: {
                            series: {
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}: {point.y:.1f}%'
                            }
                            }
                        },

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                        },

                        series: [
                            {
                            name: "Browsers",
                            colorByPoint: true,
                            data: arrX
                            }
                        ],
                        drilldown: {
                            series: arrDetail
                        }
                        });
                },
                error: function(response) {
                }
            });
        }
</script>
    
@endpush