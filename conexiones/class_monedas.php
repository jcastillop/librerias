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
class monedas
{
	//private $monedas=array();
	private $monedas;
	
	public function __construct()
		{
			$this->monedas=array();
		}
	public function get_monedas()
	{
		$sql="
		
			select 
				int_cod_mon,
				var_nom_mon,
				var_desc_mon,
				case when int_est_mon=1 then 'Activo' else 'Inactivo' end int_est_mon
				from T_monedas where int_est_mon<>0
		
		";	
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->monedas[]=$reg;
		}
			return $this->monedas;
	}
	
	
		
	public function add_monedas($var_nom_mon,$var_des_mon,$int_est_mon, $usu_crea,$fec_crea,$usu_mod,$fec_mod)
	{
		$sql="insert into T_monedas values 
				(null,
				'$var_nom_mon',
				'$var_des_mon',
				'$int_est_mon',
				'$usu_crea',
				'$fec_crea',
				'$usu_mod',
				'$fec_mod')	
		";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('SE INSERTO CORRECTAMENTE');
		cerrar();
		window.location='monedas.php?load=1';
		</script>";
	}
	public function get_monedas_por_id($id)
	{
		$sql="select 
			t.int_cod_mon,
			t.var_nom_mon,
			t.var_desc_mon,
			t.int_est_mon
			from T_monedas t
	 		where int_est_mon<>0 and t.int_cod_mon='$id'";		
		 
		$res=mysql_query($sql,Conectar::con());
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->monedas[]=$reg;
		}
			return $this->monedas;
	}
	public function edit_monedas($id,$var_nom_mon,$var_des_mon,$int_est_mon,$usu_mod)
	{
		//$sql="update monedas set nombre_monedas='$nom',texto='$texto' where id=$id";
	
		$sql="update T_monedas "
			." set "
		
		."
		var_nom_mon='$var_nom_mon',
		var_desc_mon='$var_des_mon',
		int_est_mon='$int_est_mon',
		var_usumod_mon='$usu_mod',
		date_fecmod_mon=now()
		
		"
		
			." where "
			." int_cod_mon=$id ";
			
			
			
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('El registro ha sido modificado correctamente');
		window.location='mod_monedas.php?id=$id && load=1';
		</script>
		<SCRIPT LANGUAGE=javascript>
  
</SCRIPT> 
		
		";	
		
	}
	public function eliminar_monedas($id)
	{
		$sql="update T_monedas set int_est_mon=0 where int_cod_mon=$id";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		
		window.location='eliminar_monedas.php?eliminado=1';
		</script>";
	}
	public function get_combo_monedas()
	{
		$sql="select int_cod_mon, var_nom_mon from T_monedas where int_est_mon<>0 ORDER BY int_cod_mon";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->monedas[]=$reg;
		}
			return $this->monedas;
	}
	
	
}
?>
