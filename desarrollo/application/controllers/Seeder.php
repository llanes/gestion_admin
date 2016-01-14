<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeder extends CI_Controller {
	private $faker;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		if (!$this->input->is_cli_request()) {
			exit('Nose puede');
		}
		if (ENVIRONMENT !== 'development') {
			# code...
			exit('solo es valido desde la consola');
		}
		$this->faker =  Faker\Factory::create('es_ES');
	}
	public function cliente()
	{
		echo "Seeding cliente table".PHP_EOL;
		$this->db->truncate('cliente');
		// $this->db->truncate('usuario');
		for ($i=0; $i < 50; $i++) { 
			$object = array(
				'Nombres' => $this->faker->firstName,
				'Apellidos' =>  $this->faker->lastName,
				'Direccion' =>  $this->faker->streetAddress,
				'Telefono' =>  $this->faker->phoneNumber,
				'Email' =>  $this->faker->email,
				'Geo_posicion_idGeo_posicion' =>  $this->faker->randomDigit(5),
				);
			$this->db->insert('cliente', $object);
			$id = $this->db->insert_id();
			$permiso = 2;
			$user = array(
				'Usuario' => $this->faker->userName,
				'Password' =>  $this->faker->password,
				'Empleado_idEmpleado' =>  $id,
				'Permiso_idPermiso' => $permiso,
				'Cliente_idCliente' =>$id,
				);
			$this->db->insert('usuario', $user);
			$id2 = $this->db->insert_id();

			echo 'User'.$id2. PHP_EOL;
		}
		echo "finist table";
	}
	public function empleado()
	{
		echo "Seeding empleado table".PHP_EOL;
		$this->db->truncate('empleado');
		// $this->db->truncate('usuario');
		for ($i=0; $i < 50; $i++) { 
			$object = array(
				'Nombres' => $this->faker->firstName,
				'Apellidos' =>  $this->faker->lastName,
				'Direccion' =>  $this->faker->streetAddress,
				'Telefono' =>  $this->faker->phoneNumber,
				'Sueldo' =>  $this->faker->latitude,
				'Cargo' =>  $this->faker->company,
				'Geo_posicion_idGeo_posicion' =>  $this->faker->randomDigit(5),
				);
			$this->db->insert('empleado', $object);
			$id = $this->db->insert_id();
			$permiso = 1;
			$user = array(
				'Usuario' => $this->faker->userName,
				'Password' =>  $this->faker->password,
				'Empleado_idEmpleado' =>  $id,
				'Permiso_idPermiso' => $permiso,
				);
			$this->db->insert('usuario', $user);
			$id2 = $this->db->insert_id();

			echo 'User'.$id2. PHP_EOL;
		}
		echo "finist table";
	}
	public function productos()
	{
		echo "Seeding categoria table".PHP_EOL;
		$this->db->truncate('categoria');
			$this->db->truncate('producto_servicio');
		// $this->db->truncate('usuario');
		for ($i=0; $i < 50; $i++) { 
			$cate = array(
				'Categoria' => $this->faker->colorName,
				'Descrip' =>  $this->faker->catchPhrase,
				);
			$this->db->insert('categoria', $cate);
			$id2 = $this->db->insert_id();
			$object = array(
				'Codigo' => $this->faker->postcode,
				'Nombre' => $this->faker->firstName,
				'Codigo_Barra' => $this->faker->creditCardNumber,
				'Descripcion' =>  $this->faker->catchPhrase,
				'Precio_Unitario' =>  $this->faker->randomDigit(5),
				'Cantidad' =>  $id2,
				'Descuento' =>  $this->faker->ean8,
				'Iva' =>  $id2,
				'Img' =>  $this->faker->imageUrl($width = 640, $height = 480),
				'Categoria_idCategoria' =>  $id2,
				);
			$this->db->insert('producto_servicio', $object);
			$id = $this->db->insert_id();
			echo 'producto_servicio' .$id. PHP_EOL;
		}
		echo "tavicho table";
	}

}

/* End of file Seeder.php */
/* Location: ./application/controllers/Seeder.php */