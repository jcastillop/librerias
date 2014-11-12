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
class tipocambio
{
	//private $tipocambio=array();
	private $tipocambio;
	
	public function __construct()
		{
			$this->tipocambio=array();
		}
	public function get_tipocambio()
	{
		$sql="
					SELECT 
					t.int_cod_mon,
					m.var_nom_mon,
					t.date_fecha_tipcam,
					t.dec_val_tipcam,
					t.var_desc_tipcam 
					FROM T_tipocambio t
					inner join T_monedas m on m.int_cod_mon=t.int_cod_mon
		
		";	
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->tipocambio[]=$reg;
		}
			return $this->tipocambio;
	}
	
	
		
public function add_tipocambio($int_cod_mon,$var_fec_tc,$dec_val_tc,$var_desc_tc, $usu_crea,$fec_crea,$usu_mod,$fec_mod)
	{
		$sql="insert into T_tipocambio values 
				(
				'$int_cod_mon',
				'$var_fec_tc',
				'$dec_val_tc',
				'$var_desc_tc',
				'$usu_crea',
				'$fec_crea',
				'$usu_mod',
				'$fec_mod')	
		";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('SE INSERTO CORRECTAMENTE');
		cerrar();
		window.location='tipocambio.php?load=1';
		</script>";
	}
	
	public function get_tipocambio_por_id($id, $fecha)
	{	$sql=" select
		t.int_cod_mon,
		m.var_nom_mon,		
		t.date_fecha_tipcam,			
		t.dec_val_tipcam,
		t.var_desc_tipcam			
		from T_tipocambio t
		inner join T_monedas m on m.int_cod_mon=t.int_cod_mon	 		
		where t.int_cod_mon='$id' and t.date_fecha_tipcam='$fecha'";			
		 
		$res=mysql_query($sql,Conectar::con());
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->tipocambio[]=$reg;
		}
			return $this->tipocambio;
	}
	public function edit_tipocambio($id,$var_fec_tc,$dec_val_tc,$var_desc_tc,$usu_tc)
	{
		//$sql="update monedas set nombre_monedas='$nom',texto='$texto' where id=$id";
	
		$sql="update T_tipocambio "
			." set "
		
		."
		dec_val_tipcam='$dec_val_tc',
		var_desc_tipcam='$var_desc_tc',
		var_usumod_tipcam='$usu_tc',
		date_fecmod_tipcam=now()
		
		"
		
			." where "
			." int_cod_mon=$id and date_fecha_tipcam='$var_fec_tc' ";
			
			
			
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('El registro ha sido modificado correctamente');
		window.location='mod_tipocambio.php?id=$id && fecha=$fecha && load=1';
		</script>
		<SCRIPT LANGUAGE=javascript>
  
</SCRIPT> 
		
		";	
		
	}
	public function eliminar_tipocambio($id, $fecha)
	{
		$sql="delete from T_tipocambio where int_cod_mon=$id and date_fecha_tipcam='$fecha'";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		
		window.location='eliminar_tipocambio.php?eliminado=1';
		</script>";
	}
}
?>
