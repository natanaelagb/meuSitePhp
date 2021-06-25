<?php
	
	$url = explode('/',$_GET['url']);
	if(!isset($url[2])){

		$categoria = Painel::selecionarUm("slug=?",array(@$url[1]),'tb_site.categorias');
		if($categoria == "" && @$url[1]!="todas-categorias"){
			Painel::redirecionar(INCLUDE_PATH."noticias/todas-categorias");
		}
		$categorias = Painel::selecionarTudo("*","tb_site.categorias",0,100,'order_id');
		$infoAutor = Painel::selecionarUm("id=?",array(1),'tb_site.editar');
?>

<section class="header-noticias">

	<div class="center">
		<i class="far fa-bell"></i>
		<h2>ACOMPANHE AS ULTIMAS <span style="color: red">NOTÍCIAS DO PORTAL</span></h2>
	</div>
	
</section>

<section class="container-noticias">
	<div class="center">
		<div class="box-ferramentas left">

			<div class="ferramentas-single w100">
				<form method="get" onsubmit="

				">
					<label>Realizar uma busca <i class="fas fa-search"></i></label>
					<input type="text" name="parametro" placeholder="O que deseja procurar?" required="">
					<input type="submit">
				</form>
			</div>

			<div class="ferramentas-single w100">
				<form>

					<label>Selecione uma categoria <i class="fas fa-sitemap"></i></label>
					
					<select 
					onchange="
					window.location.href = include_path+'noticias/'+this.options[this.selectedIndex].value;
					">

					<option value="todas-categorias">Todas categorias</option>

					<?php foreach ($categorias as $key => $value) { ?>
						<option <?php if($value['slug'] == @$url[1]) echo "selected"?> value="<?php echo $value['slug'] ?>"><?php echo $value['categoria'] ?></option>
					<?php } ?>

					</select>

				</form>				
			</div>

			<div class="ferramentas-single w100">
				<div class="info-autor">
					<span>Conheça o autor:</span>
					<img src="<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$infoAutor['foto-autor']?>">
					<h2><?php echo $infoAutor['nome-autor']?></h2>
					<p><?php echo substr($infoAutor['descricao-autor'], 0,300).'...'?></p>
				</div>
			</div>

			<div class="ferramentas-single w100">

				<label>As mais lidas <i class="fas fa-bookmark"></i></label>

				<div class="ferramentas-links">

					<a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
					<a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
					<a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
					<a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a>
					</div>
				</div>
			
		</div><!--ferramentas-->

		<div class="box-noticias left">

			<?php 

				if($categoria == ""){
					echo "<h2> Vizualizando todas as notícias </h2>";
				}else
					echo "<h2> Vizualizando as notícias da categoria <span> $categoria[categoria]</span><h2>";

				$paginaAtual = isset($_GET['pagina'])? (int)$_GET['pagina']: 1;
				$limite= isset($_GET['limite'])? (int)$_GET['limite']: 4;
				$indice = ($paginaAtual-1)*$limite;

				$query = "SELECT * FROM `tb_site.noticias` ";

				$nome = @$categoria['categoria'];

				if($categoria != "")
				{
					$query.= "WHERE categoria = '$nome' ";
				}

				if(isset($_GET['parametro']))
				{
					$busca = $_GET['parametro'];

					if (strstr($query, "WHERE") !== false) {
						$query.= "AND titulo LIKE '%$busca%' OR categoria = '$nome' AND conteudo LIKE '%$busca%' ";
					}else{
						$query.= "WHERE titulo LIKE '%$busca%' OR conteudo LIKE '%$busca%' ";
					}

				}

				$quantidadeNoticias = Painel::comandoPorQuery($query,null,3);

				$query.= "ORDER BY order_id LIMIT $indice,$limite";

				$noticias = Painel::comandoPorQuery($query,null,1);

				$quantidadePaginas = ceil($quantidadeNoticias/$limite);

				
			?>

			<div class="quantidade-paginas right">
				<label>Notícias por página: </label>

				<select name="limite">
				<?php 
				
					for ($i=4; $i<=$quantidadeNoticias ; $i+=2) { 
						if($i==$limite)
							echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
						else
							echo '<option value="'.$i.'">'.$i.'</option>';
					}
				?>
				</select>
				
			</div><!--Quaditade por paginas-->
			<div class="clear"></div>

			 <?php	foreach($noticias as $key => $value) { ?>
			 
				<div class="noticia-single">
					<h2><?php echo $value['data']." - ".$value['titulo']?></h2>
					<p><?php echo substr(strip_tags($value['conteudo']),0,400).'...'?></p>
					<a href="<?php echo INCLUDE_PATH.'noticias/'.Painel::gerarSlug($value['categoria']).'/'.$value['slug']?>">Leia mais</a>	
				</div>

			<?php } ?>

			<div class="pagina-indice">

			<?php
				for ($i=1; $i <= $quantidadePaginas; $i++)
				{
					if($i==$paginaAtual)
					
						echo '<span value="'.$i.'" class="ativado">'.$i.'</span>';
					else
						echo '<span value="'.$i.'">'.$i.'</span>';

				}
			?>

			</div>
	
		</div><!--Notícias-->
		<div class="clear"></div>

	</div>
	
</section>

<?php 

}else
{ 
	$noticia = Painel::selecionarUm("slug=?",array($url[2]),'tb_site.noticias');
	if($noticia != ""){

?>

<div class="center">

	<div class="pagina-noticia-single">

		<div id="titulo">
			<h2><i class="far fa-calendar-alt"></i><?php echo $noticia['data'].' - '.$noticia['titulo']?></h2>
		</div>

		<div id="conteudo">
			<?php echo $noticia['conteudo']?>
		</div>		

		<img src="<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$noticia['capa'] ?>">

	</div>					

</div>
	

<?php 
	}else{
		Painel::redirecionar(INCLUDE_PATH."noticias");
	}
} 

?>