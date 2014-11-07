</script>
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
class sucursal
{
	//private $usuario=array();
	private $sucursal;
	
	public function __construct()
		{
			$this->sucursal=array();
		}
	public function get_sucursal()
	{
		$sql="select 
			s.int_cod_suc,
			s.int_cod_emp,
			em.var_nom_emp,
			s.var_nom_suc,
			s.var_des_suc,
			case when s.int_est_suc=1 then 'Activo' else 'Inactivo' end int_est_suc,
			s.int_cod_pais,
			p.var_nom_pais,
			s.int_cod_dept,
			d.var_nom_dept,
			s.int_cod_provi,
			pr.var_nom_provi,
			s.var_dir_suc,
			s.var_telf_suc
			from T_sucursal s
			inner join T_empresa em on em.int_cod_emp=s.int_cod_emp
			inner join T_pais p on p.int_cod_pais=s.int_cod_pais
			inner join T_departamentos d on d.int_cod_dept=s.int_cod_dept
			inner join T_provincias pr on pr.int_cod_provi=s.int_cod_provi
			where int_est_suc<>0
			order by int_cod_suc desc
		";
		/*
		int_cod_suc,
		int_cod_emp,
		var_nom_suc,
		var_des_suc,
		int_est_suc,
		var_dir_suc,
		var_telf_suc,
		var_usuadd_suc,
		date_fecadd_suc,
		var_usumod_suc,
		date_fecmod_suc from t_sucursal ORDER BY int_cod_suc desc
		*/
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->sucursal[]=$reg;
		}
			return $this->sucursal;
	}
	
	public function get_combo_sucursal_update($id_emp)
	{
		$sql="select int_cod_emp,var_nom_emp from T_empresa where int_est_suc<>0 and not int_cod_emp='$id_emp'  ORDER BY int_cod_emp";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->usuario[]=$reg;
		}
			return $this->usuario;
	}
	
	public function get_combo_sucursal()
	{
		$sql="select int_cod_suc, var_nom_suc from T_sucursal where int_est_suc<>0 ORDER BY int_cod_suc";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->sucursal[]=$reg;
		}
			return $this->sucursal;
	}
		
	public function add_sucursal($cod_emp,$nom_suc,$des_suc,$est_suc,$pais_suc,$dept_suc,$prov_suc,$dir_suc,$telf_suc,$usu_crea,$fec_crea,$usu_mod,$fec_mod)
	{
		$sql="CALL proc_insertar_sucursal(".$cod_emp.",'".$nom_suc."','".$des_suc."',".$est_suc.",".$pais_suc.",".$dept_suc.",".$prov_suc.",'".$dir_suc."','".$telf_suc."','".$usu_crea."','".$fec_crea."',@n_Flag, @c_msg); ";
		$res=mysql_query($sql,Conectar::con());
		$sql="insert into T_cliente (var_rsoc_cli, int_est_cli, int_iden_suc_cli, int_tipper_cli, var_dir_cli, int_cod_pais, int_cod_dept, 
              	                       int_cod_provi, var_usuadd_cli, date_fecadd_cli)
                               values ('$nom_suc','1','1','1','$dir_suc','$pais_suc','$dept_suc','$prov_suc','$usu_crea','$fec_crea');";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('SE INSERTO CORRECTAMENTE $cod_emp');
		cerrar();
		window.location='sucursales.php?load=1';
		</script>";
	}
	public function get_sucursal_por_id($id)
	{
		$sql="select
		 		s.int_cod_suc,
				s.int_cod_emp,
				em.var_nom_emp,
				s.var_nom_suc,
				s.var_des_suc,
				s.int_est_suc,
				s.int_cod_pais,
				p.var_nom_pais,
				s.int_cod_dept,
				d.var_nom_dept,
				s.int_cod_provi,
				pr.var_nom_provi,
				s.var_dir_suc,
				s.var_telf_suc
				from T_sucursal s
				inner join T_empresa em on em.int_cod_emp=s.int_cod_emp
				inner join T_pais p on p.int_cod_pais=s.int_cod_pais
				inner join T_departamentos d on d.int_cod_dept=s.int_cod_dept
				inner join T_provincias pr on pr.int_cod_provi=s.int_cod_provi
   		 		where s.int_est_suc<>0 and s.int_cod_suc='$id' ORDER BY s.int_cod_suc desc";
		$res=mysql_query($sql,Conectar::con());
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->sucursal[]=$reg;
		}
			return $this->sucursal;
	}
	public function edit_sucursal($id,$cod_emp,$var_nom_suc,$descripcion,$estado,$dir,$telf,$usu_mod)
	{
		//$sql="update usuario set nombre_persona='$nom',texto='$texto' where id=$id";
	
		$sql="update T_sucursal "
			." set "
		
		."
		
		
			int_cod_emp='$cod_emp',
			var_nom_suc='$var_nom_suc',
			var_des_suc='$descripcion',
			int_est_suc='$estado',
			var_dir_suc='$dir',
			var_telf_suc='$telf',
			var_usumod_suc='$usu_mod',
			date_fecmod_suc=now()

		
		"
		
			." where "
			." int_cod_suc=$id ";
			
			
			
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('El registro ha sido modificado correctamente');
		window.location='mod_sucursales.php?id=$id && load=1';
		</script>
		<SCRIPT LANGUAGE=javascript>
  
</SCRIPT> 
		
		";	
		
	}
	public function eliminar_sucursal($id)
	{
		$sql="update T_sucursal set int_est_suc=0 where int_cod_suc=$id";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		
		window.location='eliminar_sucursales.php?eliminado=1';
		</script>";
	}
}
?>
