<?php 
    $res = reset($this->view->estatistica['results']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>              
    </head>
    <body>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <a class ="painel-azul" href="transferencia">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list-alt fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"> <?php echo $res['QTD_TRANSFERENCIA']; ?> </div>
                                <div>TRANSFERENCIAS</div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="panel-footer home_azul">
                        <span class="pull-left"> Abrir Painel Transferencia</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a class ="painel-verde" href="patrimonio">
               
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                           
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>

                            <div class="col-xs-9 text-right">
                                <div class="huge"> <?php echo $res['QTD_PATRIMONIO']; ?> </div>
                                <div>PATRIMONIOS</div>
                            </div>

                        </div>
                    </div>
                       
                    <div class="panel-footer home_verde ">
                        <span class="pull-left">Cadastrar Patrimonio</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div> 
                </div>
            </a> 
        </div>

        <div class="col-lg-3 col-md-6">
            <a class ="painel-amarelo" href="localidade">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-home fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"> <?php echo $res['QTD_LOCAL']; ?> </div>
                                <div>LOCAIS</div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer  home_amarelo ">
                        <span class="pull-left ">Cadastrar Local</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a class ="painel-red" href="minhas_transferencias">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-th   fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $res['MINHAS_TRANSFERENCIAS']; ?></div>
                                <div>TRANSFERENCIAS</div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer home_vermelho">
                        <span class="pull-left">Minhas Transferencias</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>

        <?php
            if($_SESSION['perfil']==="administrador"){
                echo '  
                    <div class="col-lg-3 col-md-6">
                        <a class ="painel-red" href="administrador">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-cog fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div>ADMINISTRADOR</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer home_vermelho">
                                    <span class="pull-left">Cadastrar Usuario</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                ';
        } 
        ?>

    </div>
<!-- /.row -->
</div>
</body>
</html>

