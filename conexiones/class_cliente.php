
        <script type="text/javascript">
        function cerrar() {
            var data = window.document.getElementById('val1').value;
            window.opener.document.getElementById('deHijo').innerHTML = "Este texto viene de la página hijo: "+data;        
			
			
            /*this.window.close();*/
			opener.location.reload();
        }
		
        </script>
<input type="hidden" id="val1" value="" disabled="disabled"/> 
  
<?php

//******************************************************************
class cliente
{
	//private $usuario=array();
	private $cliente;
	
	public function __construct()
		{
			$this->cliente=array();
		}
	public function get_cliente()
	{
		$sql="select 
				c.int_cod_cli,
				c.var_rsoc_cli,
				case when c.int_est_cli=1 then 'Activo' else 'Inactivo' end int_est_cli,
				c.var_ruc_cli,
				c.var_dir_cli,
				c.var_refdom_cli,
				c.int_cod_dept,
				d.var_nom_dept,
				c.int_cod_provi,
				pr.var_nom_provi,
				c.var_dist_cli,
				c.var_telf_cli,
				c.var_cor_cli
				from T_cliente c
				inner join T_departamentos d on d.int_cod_dept=c.int_cod_dept
				inner join T_provincias pr on pr.int_cod_provi=c.int_cod_provi
				where int_est_cli<>0
				order by int_cod_cli desc
				";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->cliente[]=$reg;
		}
			return $this->cliente;
	}
		public function get_cliente_like($q)
	{
		$sql="select 
				c.int_cod_cli,
				c.var_rsoc_cli,
				case when c.int_est_cli=1 then 'Activo' else 'Inactivo' end int_est_cli,
				case when c.int_tipper_cli=1 then 'Natural' ELSE 'Juridico' END int_tipper_cli,
				c.var_ruc_cli,
				c.var_dir_cli,
				c.var_refdom_cli,
				c.int_cod_pais,
				p.var_nom_pais,
				c.int_cod_dept,
				d.var_nom_dept,
				c.int_cod_provi,
				pr.var_nom_provi,
				c.var_dist_cli,
				c.var_telf_cli,
				c.var_fax_cli,
				c.var_dni_cli,
				c.var_cor_cli
				from T_cliente c
				inner join T_pais p on p.int_cod_pais=c.int_cod_pais
				inner join T_departamentos d on d.int_cod_dept=c.int_cod_dept
				inner join T_provincias pr on pr.int_cod_provi=c.int_cod_provi
				where int_est_cli<>0 and int_iden_suc_cli=0 and c.var_rsoc_cli like '%$q%'
				order by int_cod_cli desc
				";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->cliente[]=$reg;
		}
			return $this->cliente;
	}
		public function get_combo_cliente()
	{
		$sql="select int_cod_cli, var_rsoc_cli from T_cliente where int_est_cli<>0 ORDER BY int_cod_cli";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->cliente[]=$reg;
		}
			return $this->cliente;
	}
		
	
		
	public function add_cliente($rsoc,$estado,$tip_per,$ruc,$dir,$refdom,$cod_pais,$cod_dep,$cod_provi,$dist,$tel,$fax,$dni,$cor,$usu_crea,$fec_crea,$usu_mod,$fec_mod)
	{
		$sql="insert into T_cliente values 
				(null,
				'$rsoc',
				'$estado',
				0,
				'$tip_per',
				'$ruc',
				'$dir',
				'$refdom',
				'$cod_pais',
				'$cod_dep',
				'$cod_provi',
				'$dist',
				'$tel',
				'$fax',
				'$dni',
				'$cor',
				'$usu_crea',
				'$fec_crea',
				'$usu_mod',
				'$fec_mod')	
						";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('SE INSERTO CORRECTAMENTE');
		cerrar();
		window.location='cliente.php?load=1';
		</script>";
	}
	public function get_cliente_por_id($id)
	{
		$sql="select
				c.int_cod_cli,
				c.var_rsoc_cli,
				c.int_est_cli,
				c.int_tipper_cli,
				c.var_ruc_cli,
				c.var_dir_cli,
				c.int_cod_pais,
				c.var_refdom_cli,
				p.var_nom_pais,
				c.int_cod_dept,
				d.var_nom_dept,
				c.int_cod_provi,
				pr.var_nom_provi,
				c.var_dist_cli,
				c.var_telf_cli,
				c.var_fax_cli,
				c.var_dni_cli,
				c.var_cor_cli
				from T_cliente c
				inner join T_pais p on p.int_cod_pais=c.int_cod_pais
				inner join T_departamentos d on d.int_cod_dept=c.int_cod_dept
				inner join T_provincias pr on pr.int_cod_provi=c.int_cod_provi
	    		where int_est_cli<>0 and int_cod_cli='$id'";
		$res=mysql_query($sql,Conectar::con());
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->cliente[]=$reg;
		}
			return $this->cliente;
	}
	public function edit_cliente($id,$rsoc,$estado,$tip_per,$ruc,$dir,$refdom,$cod_pais,$cod_dep,$cod_provi,$dist,$tel,$fax,$dni,$cor,$usu_mod)
	{
		
		$sql="update T_cliente "
			." set "
		
		."
			var_rsoc_cli='$rsoc',
			int_est_cli='$estado',
			int_tipper_cli='$tip_per',
			var_ruc_cli='$ruc',
			var_dir_cli='$dir',
			var_refdom_cli='$refdom',
			int_cod_pais='$cod_pais',
			int_cod_dept='$cod_dep',
			int_cod_provi='$cod_provi',
			var_dist_cli='$dist',
			var_telf_cli='$tel',
			var_fax_cli='$fax',
			var_dni_cli='$dni',
			var_cor_cli='$cor',
			var_usumod_cli='$usu_mod',
			date_fecmod_cli=now()
		
		"
		
			." where "
			." int_cod_cli=$id ";
			
			
			
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('El registro ha sido modificado correctamente');
		window.location='mod_cliente.php?id=$id && load=1';
		</script>
		 
		
		";	
		
	}
	public function eliminar_cliente($id)
	{
		$sql="update T_cliente t set t.int_est_cli=0 where int_cod_cli=$id";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		
		window.location='eliminar_cliente.php?eliminado=1';
		</script>";
	}
}
?>
