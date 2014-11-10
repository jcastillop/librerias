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
require("conexion.php");
//******************************************************************
class ordcomp_cabecera
{
	//private $titulos=array();
	private $ordcomp_cabecera;
	
	public function __construct()
		{
			$this->ordcomp_cabecera=array();
		}
	public function get_ordcomp_cabecera()
	{
			
			$sk=mysql_query("set @a:=0;");
			$sql="select o.var_cod_comp_cab,p.var_rsoc_prov,od.int_cod_suc,
				s.var_nom_suc,o.int_cod_emp,e.var_nom_emp,month(o.date_fec_rec_comp_cab) as mes,year(o.date_fec_rec_comp_cab) as año   
				from T_ordcomp_cab o, T_ordcomp_det od
				inner join T_proveedor p on od.int_cod_prov=p.int_cod_prov 
				inner join T_sucursal s on s.int_cod_suc=od.int_cod_suc  
				inner join T_empresa e on e.int_cod_emp=od.int_cod_emp 
				where o.var_cod_comp_cab=od.var_cod_comp_cab 
				and o.int_cod_emp=od.int_cod_emp 
				and o.int_cod_suc=od.int_cod_suc
				group by CONCAT(o.var_cod_comp_cab, '_', p.var_rsoc_prov) 
				order by o.var_cod_comp_cab desc;
		
		";	
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->ordcomp_cabecera[]=$reg;
		}
			return $this->ordcomp_cabecera;
	}
	
	/*
	public function get_combo_editorial()
	{
		$sql="select * from t_editoriales ORDER BY int_cod_edit";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->titulos[]=$reg;
		}
			return $this->titulos;
	}*/
	
	public function get_combo_sucursal_update($id_sucursal)
	{
		$sql="select * from T_sucursal where not int_cod_suc='$id_sucursal'  ORDER BY int_cod_suc";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->pedidos[]=$reg;
		}
			return $this->pedidos;
	}
	/*
	public function get_combo_generos()
	{
		$sql="select * from t_generos ORDER BY int_cod_gen";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->titulos[]=$reg;
		}
			return $this->titulos;
	}*/
	
	public function get_combo_empresa_update($id_empresa)
	{
		$sql="select * from T_empresa where not int_cod_emp='$id_empresa'  ORDER BY int_cod_emp";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->pedidos[]=$reg;
		}
			return $this->pedidos;
	}
	/*
	public function get_combo_pais()
	{
		$sql="select int_cod_pais, var_nom_pais from t_pais ORDER BY int_cod_pais";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->titulos[]=$reg;
		}
			return $this->titulos;
	}*/
	
	public function get_combo_cliente_update($id_cliente)
	{
		$sql="select * from T_cliente where not int_cod_cli='$id_cliente'  ORDER BY int_cod_cli";
		
		$res=mysql_query($sql,Conectar::con());
		
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->pedidos[]=$reg;
		}
			return $this->pedidos;
	}
	/*	
	public function add_titulos($nom_tit,$autor_tit,$des_tit,$isbn_tit,$edic_tit,$numpag_tit,$edit_tit,$gen_tit,$pais_tit,$preven_def_tit,$preven_sug_tit,$est_tit,$cod_bar_tit,$usu_crea,$fec_crea,$usu_mod,$fec_mod)
	{
		$sql="
			insert into t_titulos values (null,
			'$nom_tit',
			'$autor_tit',
			'$des_tit',			
			'$isbn_tit',
			'$edic_tit',
			'$numpag_tit',
			'$edit_tit',
			'$gen_tit',
			'$pais_tit',
			'$preven_def_tit',
			'$preven_sug_tit',
			'$est_tit',
			'$cod_bar_tit',
			'$usu_crea',
			'$fec_crea',
			'$usu_mod',
			'$fec_mod')	
					";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('SE INSERTO CORRECTAMENTE');
		cerrar();
		window.location='titulos.php?load=1';
		</script>";
	}*/
	public function get_guia_por_id($id)
	{
		$sql="select 
			   	f.var_cod_fact_cab,
				f.var_cod_ser,
				f.int_tip_doc_fact,
				f.int_cod_suc,
				z.var_nom_suc,				
				f.int_cod_cli,
				c.var_rsoc_cli,
				f.int_cod_usu,
				u.var_nom_usu,
				date(f.date_fecenv_fact_cab) as date_fecenv_fact_cab
				from T_factura_cabecera f
				inner join T_serie s on s.var_cod_ser=f.var_cod_ser	
				inner join T_sucursal z on z.int_cod_suc=f.int_cod_suc
				inner join T_usuario u on u.int_cod_usu=f.int_cod_usu
				inner join T_cliente c on c.int_cod_cli=f.int_cod_cli
  				where f.var_cod_fact_cab='$id'";		
		 
		$res=mysql_query($sql,Conectar::con());
		while ($reg=mysql_fetch_assoc($res))
		{
			$this->guia[]=$reg;
		}
			return $this->guia;
	}
	public function edit_pedidos($id,$cod_suc,$cod_emp,$cod_cli,$est_ped,$fecpec_cab,$usu_mod)
	{
		//$sql="update titulos set nombre_titulos='$nom',texto='$texto' where id=$id";
	
		$sql="update T_pedido_cabecera "
			." set "
		
		."
		int_cod_suc='$cod_suc',
		int_cod_emp='$cod_emp',
		int_cod_cli='$cod_cli',
		int_est_pedi_cab='$est_ped',	
		date_fecped_pedi_cab='$fecpec_cab',	
		var_usumod_pedi_cab='$usu_mod',
		date_fecmod_pedi_cab=now()
		
		"
		
			." where "
			." var_cod_pedi_cab='$id' ";
			
			
			
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		alert('El registro ha sido modificado correctamente');
		window.location='mod_pedidos.php?id=$id && load=1';
		</script>
		<SCRIPT LANGUAGE=javascript>
  
		</SCRIPT> 
		
		";	
	
	}
	/*
	public function eliminar_pedidos($id)
	{
		$sql="delete from t_pedido_cabecera where var_cod_pedi_cab='$id'";
		$res=mysql_query($sql,Conectar::con());
		echo "<script type='text/javascript'>
		
		window.location='eliminar_pedidos.php?eliminado=1';
		</script>";
	}*/
}

?>
