// <?php
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

		for ($i=0; $i < 20; $i++) { 
			$object = array(
				'Nombres' => $this->faker->firstName,
				'Apellidos' =>  $this->faker->lastName,
				'Direccion' =>  $this->faker->streetAddress,
				'ci_ruc' =>  $this->faker->numberBetween($min = 1000, $max = 20000),
				'Telefono' => $this->faker->numberBetween($min = 100000, $max = 20000000),
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
				echo "Seeding categoria table".PHP_EOL;
								$this->db->truncate('producto_servicio');
				$this->db->truncate('servicio');
				$this->db->truncate('detalle_servicio');
				echo "tavicho table";
				echo "Seeding categoria table".PHP_EOL;
				$this->db->truncate('categoria');

				$this->db->truncate('stock');
		for ($i=0; $i < 1; $i++) { 
			$object = array(
				'Nombres' => $this->faker->firstName,
				'Apellidos' =>  $this->faker->lastName,
				'Direccion' =>  $this->faker->streetAddress,
				'Telefono' =>  $this->faker->phoneNumber,
				'Sueldo' =>  $this->faker->latitude,
				'Cargo' =>  $this->faker->firstName,
				'Geo_posicion_idGeo_posicion' =>  $this->faker->randomDigit(5),
				);
			$this->db->insert('empleado', $object);
			$empleado = $this->db->insert_id();
			$permiso = 1;
			$user = array(
				'Usuario' => $this->faker->userName,
				'Password' =>  $this->faker->password,
				'Empleado_idEmpleado' =>  $empleado,
				'Permiso_idPermiso' => 1,
				);
			$this->db->insert('usuario', $user);
			$empleado = $this->db->insert_id();
			$cate = array(
				'Categoria' => $this->faker->colorName,
				'Descrip' =>  $this->faker->catchPhrase,
				);
			$this->db->insert('categoria', $cate);
			$categoria = $this->db->insert_id();
			$object = array(
				'Codigo' => $this->faker->postcode,
				'Nombre' => $this->faker->city,
				'Codigo_Barra' => $this->faker->creditCardNumber,
				'Descripcion' =>  $this->faker->catchPhrase,
				'Precio_Unitario' =>  $this->faker->numberBetween($min = 1000, $max = 2000),
				'Cantidad' =>  $categoria,
				'Descuento' =>  $this->faker->ean8,
				'Iva' =>  10,
				'Img' =>  $this->faker->numberBetween($min = 1000, $max = 2000),
				'Categoria_idCategoria' =>  $categoria,
				);
			$this->db->insert('producto_servicio', $object);
			$producto_servicio = $this->db->insert_id();
			$stock = array(
				'Cantidad_stock' => $this->faker->numberBetween($min = 10, $max = 1000),
				'Producto_Servicio_idProducto_Servicio' => $producto_servicio,
				);
			$this->db->insert('stock', $stock);
			$id_stock = $this->db->insert_id();
			$Servicio = array(
				'Servicio' => $this->faker->colorName,
				'Monto_total_servicio' => $this->faker->numberBetween($min = 1000, $max = 20000),				
				'Descripcion' =>  $this->faker->catchPhrase,
				);
			$this->db->insert('servicio', $Servicio);
			$Servicio_idServicio = $this->db->insert_id();
			for ($i=0; $i < 10 ; $i++) { 
				$detalle_servicio = array(
				'Costo' =>  $this->faker->numberBetween($min = 1000, $max = 2000),
				'Cantidad_detalle' =>  $this->faker->numberBetween($min = 10, $max = 100),
				'Producto_Servicio_idProducto_Servicio' => $this->faker->numberBetween($min = 1, $max = 200),
				'Servicio_idServicio' =>  $Servicio_idServicio,
				);
			$this->db->insert('detalle_servicio', $detalle_servicio);
			$id = $this->db->insert_id();
			echo 'servicio' .$id. PHP_EOL;

			}
		}
		echo "tavicho table";

	}
	public function xx()
	{
				$this->db->truncate('producto_servicio');
				$this->db->truncate('servicio');
				$this->db->truncate('detalle_servicio');
				$this->db->truncate('categoria');
				$this->db->truncate('stock');
		for ($i=0; $i < 10; $i++) { 
			$cate = array(
				'Categoria' => $this->faker->colorName,
				'Descrip' =>  $this->faker->catchPhrase,
				);
			$this->db->insert('categoria', $cate);
			$categoria = $this->db->insert_id();
			$object = array(
				'Codigo' => $this->faker->postcode,
				'Nombre' => $this->faker->city,
				'Codigo_Barra' => $this->faker->creditCardNumber,
				'Descripcion' =>  $this->faker->catchPhrase,
				'Precio_Unitario' =>  $this->faker->numberBetween($min = 1000, $max = 2000),
				'Cantidad' =>  $categoria,
				'Descuento' =>  $this->faker->ean8,
				'Iva' =>  10,
				'Img' =>  $this->faker->numberBetween($min = 1000, $max = 2000),
				'Categoria_idCategoria' =>  $categoria,
				);
			$this->db->insert('producto_servicio', $object);
			$producto_servicio = $this->db->insert_id();
			$stock = array(
				'Cantidad_stock' => $this->faker->numberBetween($min = 10, $max = 1000),
				'Producto_Servicio_idProducto_Servicio' => $producto_servicio,
				);
			$this->db->insert('stock', $stock);
			$id_stock = $this->db->insert_id();
			$Servicio = array(
				'Servicio' => $this->faker->colorName,
				'Monto_total_servicio' => $this->faker->numberBetween($min = 1000, $max = 20000),				
				'Descripcion' =>  $this->faker->catchPhrase,
				);
			$this->db->insert('servicio', $Servicio);
			$Servicio_idServicio = $this->db->insert_id();
			for ($i=0; $i < 4 ; $i++) { 
				$detalle_servicio = array(
				'Costo' =>  $this->faker->numberBetween($min = 1000, $max = 2000),
				'Cantidad_detalle' =>  $this->faker->numberBetween($min = 10, $max = 100),
				'Producto_Servicio_idProducto_Servicio' => $this->faker->numberBetween($min = 1, $max = 200),
				'Servicio_idServicio' =>  $Servicio_idServicio,
				);
			$this->db->insert('detalle_servicio', $detalle_servicio);
			$id = $this->db->insert_id();
			echo 'servicio' .$id. PHP_EOL;

			}
		}
		echo "tavicho table";

	}

}

/* End of file Seeder.php */
/* Location: ./application/controllers/Seeder.php */