<?php
		
	if(isset($_GET['ordenar']))
	{
		Painel::ordenar($_GET['ordenar'],$_GET['id'],"tb_site.depoimentos");
	}


	if(isset($_GET['excluir']))
	{
		$id = (int)($_GET['excluir']);
		$deletado = Painel::deletar(array($id), "tb_site.depoimentos", "id=?");

		if ($deletado == 0) {
			Painel::alerta("Ocorreu um erro ao deletar o depoimento");
		}

		Painel::redirecionar(INCLUDE_PATH_PAINEL."listar-depoimentos");
	}


	$paginaAtual = isset($_GET['pagina'])? (int)$_GET['pagina']: 1;

	$quantidade = isset($_GET['limite'])? (int)$_GET['limite']: 3;

	$conteudo = Painel::selecionarTudo("id,nome,data",'tb_site.depoimentos',($paginaAtual-1)*$quantidade,$quantidade,"order_id");

	$totalElementos = count(Painel::selecionarTudo("id","tb_site.depoimentos"));

	$totalPaginas = ceil($totalElementos/$quantidade);


?>

<div class="content">
	<div class="box-content">

		<h2><i class="far fa-comment-alt"></i> Depoimentos Cadastrados</h2>

		<div class="quantidade-paginas right">
				<label>Depoimentos por página: </label>

				<select name="limite">
				<?php 
				
					for ($i=2; $i<=$totalElementos ; $i++) { 
						if($i==$quantidade)
							echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
						else
							echo '<option value="'.$i.'">'.$i.'</option>';
					}
				?>
				</select>
				
		</div>
		<div class="clear"></div>

		<div class="box-tabela">
			<table>
				<tr>
					<th>Nome</th>
					<th>Data</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			<?php foreach ($conteudo as $key => $value){?>
					
				<tr>
					<td style="width: 40%"><?php echo $value['nome']; ?></td>
					<td style="width: 20%"><?php echo $value['data']; ?></td>
					<td style="width: 15%">
						<a  id="editar" href="<?php echo INCLUDE_PATH_PAINEL;?>editar-depoimento?id=<?php echo $value['id']?>"><i class="fas fa-edit"></i> Editar </a>
					</td>

					<td style="width: 15%">
						<a id="deletar" actionBtn="deletar-depoimento" href="<?php echo INCLUDE_PATH_PAINEL;?>listar-depoimentos?excluir=<?php echo $value['id']?>"><i class="fas fa-trash-alt"></i> Excluir </a>
					</td>

					<td style="width: 5%">
						<span name='ordenar' value='up' id="<?php echo $value["id"] ?>"><i class="fas fa-angle-up"></i></span>	
					</td>

					<td style="width: 5%">
						<span name='ordenar' value='down' id="<?php echo $value["id"] ?>"> <i class="fas fa-angle-down"></i></span>	
					</td>


				</tr>

			<?php  } ?>
			</table>
		</div>

		<div class="paginas">
			<?php
			
				for ($i=1; $i <= $totalPaginas; $i++)
				{
					if($i==$paginaAtual)
					
						echo '<span value="'.$i.'" class="ativado">'.$i.'</span>';
					else
						echo '<span value="'.$i.'">'.$i.'</span>';

				}

			?>	
		</div>

		<form id="form">

		</form>

	</div>
</div>