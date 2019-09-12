<?php

$data = (array) $this->view->resultado;

if($data['total']<= 0){
    echo'<h3>Nenhum resultado cadastrado para criação de relatorio</h3>';
    return; 
}
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php?error=1');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Grafico - pie</title>
</head>

<body>
    <div class="row">

        <div class="col-md-6">
            <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>


            <script>
                $(document).ready(function() {

                    // Build the chart
                    Highcharts.chart('container', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Porcentagem de produto por Localidade'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Porcentagem',
                            colorByPoint: true,


                            
                            data: [{
                           
                                <?php
                                    $grafico ='';
                                    foreach ($data['results'] as $res) {
                                        $grafico .= 'name:"'. $res['DESCRICAO'] . '",';
                                        $grafico .= 'y:' . $res['quantidade'] . '}';
                                        $grafico .= ',{';
                                    }
                                    $resultado = substr($grafico,0,-3);
                                    echo  $resultado;
                                ?>

                            }]
                        }]
                    });
                });
            </script>


        </div>
        <!-- grafico  em barra  -->
        <div class="col-md-6">

            <div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
            <div class="btn-group" role="group">
                <button id="plain" class="btn btn-info">Plano</button>
                <button id="inverted" class="btn btn-success">Lateral</button>
            </div>


            <script>
                $(document).ready(function() {
                    var chart = Highcharts.chart('container2', {

                        title: {
                            text: 'Quadro de Produtos'
                        },

                        subtitle: {
                            text: 'Grafico'
                        },

                        xAxis: {
                            categories: [
                                <?php
                                    $grafico= '';
                                    foreach ($data['results'] as $res) {
                                        $grafico .= "'" . $res['DESCRICAO'] . "',";
                                    }
                                    //$resultado = substr($grafico,0,-);
                                    echo  $grafico;
                                ?>
                            ]
                        },

                        series: [{
                            name: 'Patrimonios',

                            type: 'column',
                            colorByPoint: true,
                            data: [
                                <?php
                                    foreach ($data['results'] as $res) {
                                        echo $res['quantidade'] . ',';
                                    }
                                ?>
                            ],
                            showInLegend: false
                        }]

                    });

                    $('#plain').click(function() {
                        chart.update({
                            chart: {
                                inverted: false,
                                polar: false
                            },
                            subtitle: {
                                text: 'Plano'
                            }
                        });
                    });

                    $('#inverted').click(function() {
                        chart.update({
                            chart: {
                                inverted: true,
                                polar: false
                            },
                            subtitle: {
                                text: 'Invertido'
                            }
                        });
                    });


                });
            </script>
        </div>
    </div>

</body>

</html>