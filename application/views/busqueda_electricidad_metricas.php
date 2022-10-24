<html>
<body onload="load()">
<div id="print">
    <div id="navigation" class="noprint">
        <a href="#print" onclick="printPage();return false;">Imprimir</a>
    </div>



<?php echo form_open("consumo_electricidad/metricas_buscar/"); ?>
<div>
<div class="buscador">
	<div>
		<label>Número de servicio</label>
	</div>
	<div class="input-group">
			<input
				id="servicio"
				name="servicio"
				class="form-control"
				type="text"
				value="<?php if(!empty($num_servicio)) { echo $num_servicio; } ?>"
			>
	</div>
</div>
<div class="buscador">
	<div>
		<label>Dependencia</label>
	</div>
	<select
			id="dependencia"
			name="dependencia"
			class="form-control"
		>
			<option value="">----</option>
		<?php foreach($catalogo as $item): ?>
			<option value="<?php echo $item->dependencia; ?>"
			<?php if($dependencia) echo ($item->dependencia==$dependencia)? 'selected' : ''; ?>
			><?php echo $item->dependencia; ?></option>
		<?php endforeach; ?>
		</select>
</div>
<div class="busqueda_boton">
	<div>
		<button
			name="enviar"
			value="aceptar"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-search"></span> Buscar</button>
	</div>
	<div>
		<button
			name="enviar"
			value="volver"
			class="btn"
			type="submit"
		><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver a Catálogo</button>
	</div>
</div>
</div>
<div class="text-right">
	<label><a href="http://www.cfe.gob.mx/paginas/home.aspx">CFE</a></label>
</div>
<div class="text-right">
	<label><a href="http://cfectiva.cfe.gob.mx/cfectiva/index.php">CFEfectiva Empresarial</a></label>
</div>




<link rel="alternate" type="application/rss+xml" title="" href="/feed"/>
<style type="text/css">
            @media print { .noprint{display:none;} pre{border:1px dashed;background-color:#FFFFFF;} body{background-color:#FFFFFF;} #main{border:none;margin:0px 0px;width:auto;} .reveal{display:none;} }
            #print:target .noprint { display: none; }
            #print:target pre { border:1px dashed; background-color:#FFFFFF; }
            #print:target code { border:0px; background-color:#FFFFFF; }
            body#print:target {background-color:#FFFFFF;}
            #print:target #main{border:none;margin:0px 0px;width:auto;}
            .doprint .noprint { display: none; }
            .doprint pre { border:1px dashed; background-color:#FFFFFF; }
            .doprint code { border:0px; background-color:#FFFFFF; }
            .doprint body{background-color:#FFFFFF;}
            .doprint #main{border:none;margin:0px 0px;width:auto;}
            #print:target .reveal:after{content: attr(title);}
            .doprint .reveal:after{content: attr(title);}
        </style>
<script type="text/javascript">
            window.onload=function() {
                if (location.hash === '#print') printPage();
            };
            function printPage() {
                document.body.className += ' doprint';
                location.hash = '#print';
                window.print();
            }
            function cancelPrint() {
                document.body.className = "";
                location.hash = "#";
                return false;
            }
</script>
<?php echo form_close(); ?>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Número de servicio</th>
				<th>Dependencia</th>
				<th>Total Consumo</th>
				<th>Consumo per capita</th>
				<th>Año</th>
				<th>Acciones</th>
			</tr>
		</thead>

		<tbody>

		<?php if($servicios): ?>
			<?php foreach($servicios as $item): ?>
			<tr>
				<td><?php echo $item->cuenta; ?></td>
				<td><?php echo $item->dependencia; ?></td>
				<!--td>?php echo $item->total_consumo; ?> Kw/h</td-->
				<td><?php echo number_format($item->total_consumo); ?></td>
				<!--td>?php echo $item->consumo_persona; ?> Kw/h</td-->
				<td><?php echo number_format($item->consumo_persona); ?></td>
				<td><?php echo $item->year; ?></td>
				<td><small>
				<?php echo anchor('consumo_electricidad/metrica_actualizar/'.$item->id, '<span class="icon-edit"></span> Actualizar'); ?>
				<?php echo anchor('consumo_electricidad/metrica_borrar/'.$item->id, '<span class="icon-trash"></span> Borrar', 'class="delete"'); ?>
				</small></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan=10>No se han registrado recibos de consumo.</td>
			</tr>
		<?php endif; ?>
		</tbody>

	</table>
</div> <!-- table-responsive -->

<div class="center">
	<ul class="pagination pagination-lg">
	<?php echo $this->pagination->create_links(); ?>
	</ul>
</div>
</div>
</body>
</html>