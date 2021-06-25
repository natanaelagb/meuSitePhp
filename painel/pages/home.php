<?php 

	$conteudo = Painel::listarUsuariosOnline();
	$visitas = MySql::connect()->prepare("SELECT * FROM `tb_admin.visitas`");
	$visitas->execute(); 
	$visitas = $visitas->rowCount();

	$visitasHoje = MySql::connect()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
	$visitasHoje->execute(array(date("Y-m-d")));
	$visitasHoje = $visitasHoje->rowCount();

	$cadastrados = Painel::listarUsuariosCadastrados();


?>
		

	<div class="content">
		<div class="box-content">
			<h2><i class="fas fa-home"></i> Painel de Controle - Eagle Code </h2>

			<div class="box-info">
				<div class="w33 left">
					<div class="box-info-single" style="background-color: #f9a825">
						<p>Usuários Online</p>
						<p><?php echo count($conteudo) ?></p>
					</div>
				</div>
				<div class="w33 left">
					<div class="box-info-single" style="background-color: #ff8a65">
						<p>Total de Visitas</p>
						<p><?php echo $visitas;?></p>
					</div>
				</div>
				<div class="w33 left" >
					<div class="box-info-single" style="background-color: #388e3c">
						<p>Visitas Hoje</p>
						<p><?php echo $visitasHoje;?></p>
					</div>
				</div>
				<div class="clear"></div>	
			</div>
		</div>

		<div class="box-content">

			<h2><i class="fas fa-globe-americas"></i> Usuários Online</h2>
			<div class="box-tabela">

				<div class="row">
					<div class="col">
						<span>Ip</span>
					</div>
					<div class="col">
						<span>Ultima ação</span>
					</div>
				<div class="clear"></div>		
				</div>
				
				<?php foreach ($conteudo as $key => $value){	?>

				
				<div class="row">
					<div class="col">
						<span><?php echo $value['ip']; ?></span>
					</div>
					<div class="col">
						<span><?php echo $value['ultima_acao']; ?></span>
					</div>
				<div class="clear"></div>
				</div>

				<?php } ?>

			</div>	
			
		</div>

		<div class="box-content">

			<h2><i class="fas fa-globe-americas"></i> Usuários Cadastrados</h2>
			<div class="box-tabela">

				<div class="row">
					<div class="col">
						<span>Nome</span>
					</div>
					<div class="col">
						<span>Cargo</span>
					</div>
				<div class="clear"></div>		
				</div>
				
				<?php foreach ($cadastrados as $key => $value){	?>

				
				<div class="row">
					<div class="col">
						<span><?php echo $value['nome']; ?></span>
					</div>
					<div class="col">
						<span><?php echo $value['cargo']; ?></span>
					</div>
				<div class="clear"></div>
				</div>

				<?php } ?>
				
			</div>	
	
		</div>	<!--Usuarios Cadastrados-->	

	</div><!--content-->