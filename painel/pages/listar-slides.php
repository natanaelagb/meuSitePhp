<?php
		
	if(isset($_GET['ordenar']))
	{
		Painel::ordenar($_GET['ordenar'],$_GET['id'],"tb_site.slides");
	}


	if(isset($_GET['excluir']))
	{
		$id = (int)($_GET['excluir']);
		$deletado = Painel::deletar(array($id),"tb_site.slides","id=?");

		if ($deletado != 0) 
			Painel::deletarImagem($_GET['slide']);
		else
			Painel::alerta("Ocorreu um erro ao deletar o slide");

		Painel::redirecionar(INCLUDE_PATH_PAINEL."listar-slides");
	}


	$paginaAtual = isset($_GET['pagina'])? (int)$_GET['pagina']: 1;

	$quantidade = isset($_GET['limite'])? (int)$_GET['limite']: 3;

	$conteudo = Painel::selecionarTudo("id,nome,slide",'tb_site.slides',($paginaAtual-1)*$quantidade,$quantidade,"order_id");

	$totalElementos = count(Painel::selecionarTudo("id","tb_site.slides"));

	$totalPaginas = ceil($totalElementos/$quantidade);


?>

<div class="content">
	<div class="box-content">

		<h2><i class="far fa-comment-alt"></i> Slides Cadastrados</h2>

		<div class="quantidade-paginas right">
				<label>Slides por página: </label>

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
					<th>Slide</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			<?php foreach ($conteudo as $key => $value){?>
					
				<tr>
					<td style="width: 30%"><?php echo $value['nome']; ?></td>

					<td style="width: 30%"><img  src='<?php echo INCLUDE_PATH_PAINEL."uploads/".$value["slide"]; ?>'></td>

					<td style="width: 15%">
						<a  id="editar" href="<?php echo INCLUDE_PATH_PAINEL;?>editar-slide?id=<?php echo $value['id']?>&slide=<?php echo
						 $value['slide']?>"><i class="fas fa-edit"></i> Editar </a>
					</td>

					<td style="width: 15%">
						<a id="deletar" actionBtn="deletar-slide" href="<?php echo INCLUDE_PATH_PAINEL;?>listar-slides?excluir=<?php echo $value['id']?>"><i class="fas fa-trash-alt"></i> Excluir </a>
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