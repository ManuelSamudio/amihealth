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

    var blood_pressures = {!! $blood_pressures_graph !!};
    var pesos = {!! $pesos_graph !!};
    var cinturas = {!! $cinturas_graph !!};
    if(blood_pressures.length == 0){
        Morris.Line({
            element: 'morris-lineal-blood-pressures',
            data: [{"label":"DATOS NO DISPONIBLES", "value":"100"}],
            xkey: 'label',
            ykeys: ['value'],
            hideHover: 'auto',
            resize: true,
            ymin: 'auto',
        });
    }else{
        Morris.Line({
            element: 'morris-lineal-blood-pressures',
            data: blood_pressures,
            xkey: 'created_at',
            xLabels: 'day',
            ykeys: ['SYS', 'DIS', 'pulso'],
            labels: ['SYS', 'DIS', 'Pulso'],
            pointSize: 8,
            hideHover: 'auto',
            resize: true,
            ymin: 'auto',
            smooth: false,
            yLabelFormat: function(y) {return y = Math.round(y);},
        });
    }
    if(pesos.length == 0){
        Morris.Line({
            element: 'morris-lineal-weight',
            data: [{"label":"DATOS NO DISPONIBLES", "value":"100"}],
            xkey: 'label',
            ykeys: ['value'],
            hideHover: 'auto',
            resize: true,
            ymin: 'auto',
        });

        Morris.Line({
            element: 'morris-lineal-imc',
            data: [{"label":"DATOS NO DISPONIBLES", "value":"100"}],
            xkey: 'label',
            ykeys: ['value'],
            hideHover: 'auto',
            resize: true,
            ymin: 'auto',
        });
    }else{
        Morris.Line({
            element: 'morris-lineal-weight',
            data: pesos,
            xkey: 'created_at',
            xLabels: 'day',
            ykeys: ['peso'],
            labels: ['Peso'],
            pointSize: 8,
            hideHover: 'auto',
            resize: true,
            ymin: 'auto',
            smooth: false,
            yLabelFormat: function(y) {return y = y.toFixed(2);},
        });

        Morris.Line({
            element: 'morris-lineal-imc',
            data: pesos,
            xkey: 'created_at',
            xLabels: 'day',
            ykeys: ['imc'],
            labels: ['IMC'],
            lineColors: ['#673AB7'],
            pointFillColors: ['#7E57C2'],
            pointSize: 8,
            hideHover: 'auto',
            resize: true,
            ymin: 'auto',
            smooth: false,
            yLabelFormat: function(y) {return y = y.toFixed(2);},
        });
    }
    if (cinturas.length == 0 ){

        Morris.Line({
            element: 'morris-lineal-cintura',
            data: [{"label":"DATOS NO DISPONIBLES", "value":"100"}],
            xkey: 'label',
            ykeys: ['value'],
            hideHover: 'auto',
            resize: true,
            ymin: 'auto',
        });

        Morris.Line({
            element: 'morris-lineal-ica',
            data: [{"label":"DATOS NO DISPONIBLES", "value":"100"}],
            xkey: 'label',
            ykeys: ['value'],
            hideHover: 'auto',
            resize: true,
            ymin: 'auto',
        });

    }
    else{

        Morris.Line({
            element: 'morris-lineal-cintura',
            data: cinturas,
            xkey: 'created_at',
            xLabels: 'day',
            ykeys: ['cintura'],
            labels: ['Cinturas'],
            pointSize: 8,
            hideHover: 'auto',
            resize: true,
            ymin: 'auto',
            smooth: false,
            yLabelFormat: function(y) {return y = y.toFixed(2);},

        });

        Morris.Line({
            element: 'morris-lineal-ica',
            data: cinturas,
            xkey: 'created_at',
            xLabels: 'day',
            ykeys: ['ica'],
            labels: ['ICA'],
            lineColors: ['#673AB7'],
            pointFillColors: ['#7E57C2'],
            pointSize: 8,
            hideHover: 'auto',
            resize: true,
            ymin: 'auto',
            smooth: false,
            yLabelFormat: function(y) {return y = y.toFixed(2);},
        });
    }
</script>