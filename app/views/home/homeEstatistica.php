<?php 
    $res = reset($this->view->estatistica['results']);
?>

<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="row bg-white has-shadow">
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-violet">
                        <i class="icon-user"></i>
                    </div>
                    <div class="title"><span>Transferencias</span>
                        <div class="progress">
                        <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="100" aria-valuemin="1000"
                            aria-valuemax="100" class="progress-bar bg-violet"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?php echo $res['QTD_TRANSFERENCIA']; ?></strong></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="icon-padnote"></i></div>
                    <div class="title"><span>Patrôminios</span>
                        <div class="progress">
                        <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="70" aria-valuemin="0"
                            aria-valuemax="100" class="progress-bar bg-red"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?php echo $res['QTD_PATRIMONIO']; ?></strong></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="icon-bill"></i></div>
                    <div class="title"><span>Locais</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="40" aria-valuemin="0"
                                aria-valuemax="100" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                    <div class="number"><strong><?php echo $res['QTD_LOCAL']; ?></strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                <div class="icon bg-orange"><i class="icon-check"></i></div>
                <div class="title"><span>Transferencias</span>
                    <div class="progress">
                    <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0"
                        aria-valuemax="100" class="progress-bar bg-orange"></div>
                    </div>
                </div>
                <div class="number"><strong><?php echo $res['MINHAS_TRANSFERENCIAS']; ?></strong></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Dashboard Header Section    -->
<section class="dashboard-header">
        <div class="container-fluid">
        </div>
</section>
                

<!-- Feeds Section-->
<section class="feeds no-padding-top">
    <div class="container-fluid">
        <div class="row">
            <!-- Trending Articles-->
            <div class="col-lg-6">
                <div class="articles card">
                    <div class="card-header d-flex align-items-center">
                        <h2 class="h3">Ultimos produtos adicionados </h2>
                        <div class="badge badge-rounded bg-green">4 novas 			
                        </div>
                    </div>
                    <div class="card-body no-padding">
                        <div class="item d-flex align-items-center">
                            <div class="image">
                                <img src="imagens/patrimonio/padrao.png" alt="..." class="img-fluid rounded-circle">
                            </div>
                            <div class="text"><a href="#">
                                <h3 class="h5">Lorem Ipsum Dolor</h3>
                                </a><small>Posted on 5th June 2017 by Aria Smith. </small>
                            </div>
                        </div>

                        <div class="item d-flex align-items-center">
                            <div class="image">
                                <img src="imagens/patrimonio/padrao.png" alt="..." class="img-fluid rounded-circle">
                            </div>
                            <div class="text"><a href="#">
                                <h3 class="h5">Lorem Ipsum Dolor</h3>
                                </a><small>Posted on 5th June 2017 by Frank Williams. </small>
                            </div>
                        </div>
                    
                        <div class="item d-flex align-items-center">
                            <div class="image">
                                <img src="imagens/patrimonio/padrao.png" alt="..." class="img-fluid rounded-circle">
                            </div>
                            <div class="text"><a href="#">
                                <h3 class="h5">Lorem Ipsum Dolor</h3>
                                </a><small>Posted on 5th June 2017 by Ashley Wood. </small>
                            </div>
                        </div>

                        <div class="item d-flex align-items-center">
                            <div class="image">
                                <img src="imagens/patrimonio/padrao.png" alt="..." class="img-fluid rounded-circle">
                            </div>
                            <div class="text"><a href="#">
                                <h3 class="h5">Lorem Ipsum Dolor</h3>
                                </a><small>Posted on 5th June 2017 by Jason Doe. </small>
                            </div>
                        </div>

                        <div class="item d-flex align-items-center">
                            <div class="image">
                                <img src="imagens/patrimonio/padrao.png" alt="..." class="img-fluid rounded-circle">
                            </div>
                            <div class="text">
                                <a href="#">
                                <h3 class="h5">Lorem Ipsum Dolor</h3>
                                </a><small>Posted on 5th June 2017 by Sam Martinez. </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trending Articles-->
            <div class="col-lg-6">
                <div class="articles card">
                    <div class="card-header d-flex align-items-center">
                        <h2 class="h3">Ultimas Transferencias </h2>
                        <div class="badge badge-rounded bg-green">4 novas 			
                        </div>
                    </div>
                    <div class="card-body no-padding">
                        <div class="item d-flex align-items-center">
                            <div class="image">
                                <img src="imagens/patrimonio/padrao.png" alt="..." class="img-fluid rounded-circle">
                            </div>
                            <div class="text"><a href="#">
                                <h3 class="h5">Lorem Ipsum Dolor</h3>
                                </a><small>Posted on 5th June 2017 by Aria Smith. </small>
                            </div>
                        </div>

                        <div class="item d-flex align-items-center">
                            <div class="image">
                                <img src="imagens/patrimonio/padrao.png" alt="..." class="img-fluid rounded-circle">
                            </div>
                            <div class="text"><a href="#">
                                <h3 class="h5">Lorem Ipsum Dolor</h3>
                                </a><small>Posted on 5th June 2017 by Frank Williams. </small>
                            </div>
                        </div>
                    
                        <div class="item d-flex align-items-center">
                            <div class="image">
                                <img src="imagens/patrimonio/padrao.png" alt="..." class="img-fluid rounded-circle">
                            </div>
                            <div class="text"><a href="#">
                                <h3 class="h5">Lorem Ipsum Dolor</h3>
                                </a><small>Posted on 5th June 2017 by Ashley Wood. </small>
                            </div>
                        </div>

                        <div class="item d-flex align-items-center">
                            <div class="image">
                                <img src="imagens/patrimonio/padrao.png" alt="..." class="img-fluid rounded-circle">
                            </div>
                            <div class="text"><a href="#">
                                <h3 class="h5">Lorem Ipsum Dolor</h3>
                                </a><small>Posted on 5th June 2017 by Jason Doe. </small>
                            </div>
                        </div>

                        <div class="item d-flex align-items-center">
                            <div class="image">
                                <img src="imagens/patrimonio/padrao.png" alt="..." class="img-fluid rounded-circle">
                            </div>
                            <div class="text">
                                <a href="#">
                                <h3 class="h5">Lorem Ipsum Dolor</h3>
                                </a><small>Posted on 5th June 2017 by Sam Martinez. </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

                
        <?php
            if($_SESSION['perfil']==="administrador"){
                $teste = '  
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


