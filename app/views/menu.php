<div class="barraMenu">
    <div class="nav">
        <div class="menu">
            <ul>
                <li><a href="home"><img src="./imagens/iconPainel2.png"/><p>Dashboard</p></a></li>
                <li><a href=""><img src="./imagens/iconCarro.png"/><p>Transferencia</p></a>
                    <ul>
                        <li><a href="transferencia"><p>Transferir</p></a></li>
                        <li><a href="minhas_transferencias"><p>Minhas Transferencias</p></a></li>
                    </ul>
                </li>
                <li><a href="patrimonio"><img src="./imagens/icon-caixa.svg"/><p>Patrimonios</p></a></li>
                <li><a href="localidade"><img src="./imagens/iconLocal.png"/><p>Locais</p></a></li>
                <li><a href="relatorio"><img src="./imagens/icon-estatisticas.png"/><p>Relatório</p></a></li>
                <?php 
                    if($_SESSION['perfil'] === 'administrador'){
                        echo '<li><a href="administrador"><img src="./imagens/icon-config.png"/><p>Usuarios</p></a></li>';
                    }
                ?>
                
            </ul>
        </div>
        <div class="buttonNav">
            <a>
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </div>
</div>

<div class="barraPerfil">
    <img src="./imagens/logo2.png" alt=""/>
    <div class="perfil">
        <span class="fa fa-user fa-fw"></span>
        <div>
            <p><?= $_SESSION['usuario']?></p>                    
            <p> <?= $_SESSION['perfil']?></p>
        </div>
        
        <div class="sair" style="margin-left: 1rem; text-align: center; font-size: 99%; cursor: pointer; user-select: none;">
            <i class="fa fa-power-off" aria-hidden="true"></i>
            <p>sair</p>	
        </div>
    </div>
</div>
