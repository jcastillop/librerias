   
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
		
}
?>
