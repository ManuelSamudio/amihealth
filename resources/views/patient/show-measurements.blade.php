@extends('layouts.amihealth')

@section('content')
  <link href="/css/event.css" rel="stylesheet">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"> Medidas de Presión Arterial</h1>
  </div>
      <!-- /.col-lg-12 -->
       <div class="row">
         <div class="col-xs-12">
             @if (session('status'))
                 <div class="alert alert-success">
                     {{ session('status') }}
                 </div>
             @endif
             @if (session('warning'))
                 <div class="alert alert-warning">
                     {{ session('warning') }}
                 </div>
             @endif
             @if(count($blood_pressures) >= 1)
                 @foreach ($blood_pressures as $blood_pressure)
                     <ul class="event-list">
                         <li>
                             <time style="background:{{$blood_pressure->rgb}}"datetime="{{$blood_pressure->created_at->format('Y-m-d')}}">
                                 <span class="day">{{$blood_pressure->created_at->format('d')}}</span>
                                 <span class="month">{{$blood_pressure->created_at->format('M')}}</span>
                                 <span class="year">{{$blood_pressure->created_at->format('Y')}}</span>
                             </time>
                             <time style="background-color:{{$blood_pressure->rgb}};opacity: 0.9">
                                 <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>SYS</label></h3></span>
                                 <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$blood_pressure->SYS}}</h1></span>
                                 <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">mmHg</div>
                             </time>
                             <time style="background-color:{{$blood_pressure->rgb}}; opacity: 0.85">
                                 <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>DIS</label></h3></span>
                                 <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$blood_pressure->DIS}}</h1></span>
                                 <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">mmHg</div>
                             </time>
                             <time style="background-color:{{$blood_pressure->rgb}}; opacity: 0.8">
                                 <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>Pulso</label></h3></span>
                                 <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$blood_pressure->pulso}}</h1></span>
                                 <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">Bpm</div>
                             </time>
                             <div class="info">
                                 <h2 class="title">{{$blood_pressure->descrip}}</h2>
                             </div>
                             <div class="social">
                                 <ul>
                                     <li class="facebook" style="width:33%;"><a href="edit-hta/{{ $blood_pressure->id }}"><span class="fa fa-pencil"></span></a></li>
                                     <li class="twitter" style="width:34%;"><a href="" data-toggle="modal" data-target="#myModal"><span class="fa fa-info"></span></a></li>
                                     <li class="google-plus" style="width:33%;"><a href="delete-hta/{{ $blood_pressure->id }}"><span class="fa fa-trash"></span></a></li>
                                 </ul>
                             </div>
                         </li>
                         <li class="event-details">
                             <div class="info" style="height:auto">
                                 <p class="desc">{{ucwords($blood_pressure->created_at->format('l d, F Y, h:i A'))}}</p>
                             </div>
                         </li>
                     </ul>
                 @endforeach
                 {{$blood_pressures->links()}}
             @else
                 <div class="form-group">
                     <div class="alert alert-warning col-xs-12 col-md-8 col-md-offset-2">
                         <p class="bg-warning text-center">No hay Medidas de Presión Arterial disponibles</p>
                     </div>

                     <div class="col-xs-12 col-md-8 col-md-offset-2">
                         <a class="btn btn-primary btn-lg btn-block" href="/new-measurement">Agregar Nueva Medida</a>
                     </div>
                 </div>

             @endif

         </div>
       </div>
          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Clasificación de Hipertensión Arterial</h4>
                      </div>
                      <div class="modal-body">
                          <table class="table table-hover">
                              <thead>
                                  <tr>
                                      <th>Categoría</th>
                                      <th>Sistólica (mmHg)</th>
                                      <th>Diastólica (mmHg)</th>
                                      <th></th>
                                  </tr>
                              </thead>
                              <tbody>
                                    <tr>
                                        <th>Óptima</th>
                                        <th><120</th>
                                        <th><80</th>
                                        <th style="background-color: #8BC34A"></th>
                                    </tr>
                                    <tr>
                                        <th>Normal</th>
                                        <th>120-129</th>
                                        <th>80-84</th>
                                        <th style="background-color: #558B2F"></th>
                                    </tr>
                                    <tr>
                                        <th>Normal alta</th>
                                        <th>130-139</th>
                                        <th>85-89</th>
                                        <th style="background-color: #33691E"></th>
                                    </tr>
                                    <tr>
                                        <th>Hipertensión grado 1</th>
                                        <th>140-159</th>
                                        <th>90-99</th>
                                        <th style="background-color: #FFAB00"></th>
                                    </tr>
                                    <tr>
                                        <th>Hipertensión grado 2</th>
                                        <th>160-179</th>
                                        <th>100-109</th>
                                        <th style="background-color: #EF6C00"></th>
                                    </tr>
                                    <tr>
                                        <th>Hipertensión grado 3</th>
                                        <th>≥180</th>
                                        <th>≥110</th>
                                        <th style="background-color: #B71C1C"></th>
                                    </tr>
                                    <tr>
                                        <th>Hipertensión sistólica aislada</th>
                                        <th>≥140</th>
                                        <th><90</th>
                                        <th style="background-color: #EF6C00"></th>
                                    </tr>
                              </tbody>

                          </table>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                      </div>
                  </div>
              </div>
          </div>

  <script type="text/javascript">
        $(document).ready(function() {
          $('.event-details').css('display','none');
          $('.event-details').css('height','auto');
          $('.event-details').css('margin-top','-17px');
          $('.event-details > .info').css('height','auto');
          $('.disabled').prev().css('cursor','default');

          $('.event-list > li').click(function() {
              if (!$(this).nextAll('.event-details').first().hasClass('disabled')) {
                  //$(this).nextAll('.event-details').first().height('auto');
                  $(this).nextAll('.event-details').first().nextAll('.info').first().height('auto');
                  $(this).nextAll('.event-details').first().slideToggle();
              }
          });
        })
  </script>
@endsection
