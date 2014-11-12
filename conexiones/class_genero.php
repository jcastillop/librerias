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
class genero
{
	//private $monedas=array();
	private $generos;
	
	public function __construct()
		{
			$this->generos=array();
		}
	public function get_generos()
	{
		$sql="
		
			select 
				int_cod_gen,
				var_nom_gen,
				var_des_gen,
				case when int_est_gen=1 then 'Activo' else 'Inactivo' end int_est_gen
				from T_generos where int_est_gen<>0
		
		";	
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->generos[]=$reg;
		}
			return $this->generos;
	}
	
	
		
	public function add_generos($var_nom_gen,$var_des_gen,$int_est_gen, $usu_crea,$fec_crea,$usu_mod,$fec_mod)
	{
		$sql="insert into T_generos values 
				(null,
				'$var_nom_gen',
				'$var_des_gen',
				'$int_est_gen',
				'$usu_crea',
				'$fec_crea',
				'$usu_mod',
				'$fec_mod')	
		";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('SE INSERTO CORRECTAMENTE');
		cerrar();
		window.location='generos.php?load=1';
		</script>";
	}
	public function get_generos_por_id($id)
	{
		$sql="select 
			t.int_cod_gen,
			t.var_nom_gen,
			t.var_des_gen,
			t.int_est_gen
			from T_generos t
	 		where int_est_gen<>0 and t.int_cod_gen='$id'";		
		 
		$res=mysql_query($sql,Conectar::con());
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->generos[]=$reg;
		}
			return $this->generos;
	}
	public function edit_generos($id,$var_nom_gen,$var_des_gen,$int_est_gen,$usu_mod)
	{
		//$sql="update monedas set nombre_monedas='$nom',texto='$texto' where id=$id";
	
		$sql="update T_generos "
			." set "
		
		."
		var_nom_gen='$var_nom_gen',
		var_des_gen='$var_des_gen',
		int_est_gen='$int_est_gen',
		var_usumod_gen='$usu_mod',
		date_fecmod_gen=now()
		
		"
		
			." where "
			." int_cod_gen=$id ";
			
			
			
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('El registro ha sido modificado correctamente');
		window.location='mod_generos.php?id=$id && load=1';
		</script>
		<SCRIPT LANGUAGE=javascript>
  
</SCRIPT> 
		
		";	
		
	}
	public function eliminar_generos($id)
	{
		$sql="update T_generos set int_est_gen=0 where int_cod_gen=$id";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		
		window.location='eliminar_generos.php?eliminado=1';
		</script>";
	}
}
?>
